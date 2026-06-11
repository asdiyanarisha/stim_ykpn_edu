<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\News;
use App\Models\ProgramStudy;
use App\Models\Pmb;
use App\Models\StudentActivity;
use App\Models\StudentUkm;
use App\Models\TestimonyAlumni;
use App\Models\AcademicYear;
use App\Models\Brochure;
use App\Models\PublicFile;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * GET /api/dashboard/stats
     *
     * Mengembalikan statistik dashboard dari database.
     * Menerima parameter opsional `end_date` untuk memfilter data
     * dari awal (data pertama) sampai tanggal yang diberikan.
     *
     * @queryParam end_date date optional Tanggal akhir filter (format: Y-m-d). Default: hari ini.
     *
     * @return JsonResponse
     */
    public function stats(Request $request): JsonResponse
    {
        try {
            $endDate = $request->query('end_date')
                ? \Carbon\Carbon::parse($request->query('end_date'))->endOfDay()
                : now()->endOfDay();

            // Stat Cards
            $totalDosen = Teacher::where('created_at', '<=', $endDate)->count();
            $beritaTerbit = News::where('status', 'published')
                ->where('created_at', '<=', $endDate)
                ->count();
            $programStudi = ProgramStudy::where('created_at', '<=', $endDate)->count();
            $pendaftarPmb = Pmb::where('created_at', '<=', $endDate)->count();

            // Kemahasiswaan
            $totalKegiatan = StudentActivity::where('created_at', '<=', $endDate)->count();
            $totalUkm = StudentUkm::where('created_at', '<=', $endDate)->count();
            $totalTestimoni = TestimonyAlumni::where('created_at', '<=', $endDate)->count();

            // Akademik & PMB
            $totalTahunAjaran = AcademicYear::where('created_at', '<=', $endDate)->count();
            $totalBrosur = Brochure::where('created_at', '<=', $endDate)->count();
            $totalFilePublik = PublicFile::where('created_at', '<=', $endDate)->count();

            // Konten Terbaru (5 berita terbaru sampai end_date)
            $recentNews = News::where('created_at', '<=', $endDate)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get(['id', 'title', 'status', 'created_at']);

            // Pendaftar PMB Terbaru (5 pendaftar terakhir)
            $recentPmb = Pmb::where('created_at', '<=', $endDate)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get(['id', 'nama_lengkap', 'program_studi', 'jalur_registrasi', 'created_at']);

            // PMB per Program Studi (breakdown)
            $pmbByProgram = Pmb::where('created_at', '<=', $endDate)
                ->selectRaw('program_studi, COUNT(*) as total')
                ->groupBy('program_studi')
                ->orderByDesc('total')
                ->get();

            // Google Analytics Data (3 Bulan Terakhir)
            $gaData = [
                'active_users' => 0,
                'bounce_rate' => 0,
                'avg_session_duration' => '0m 0s',
                'note' => 'Belum ada data (Situs masih baru atau tidak ada pengunjung 3 bulan terakhir)',
                'events' => [
                    'click_pmb' => 0,
                    'download_brosur' => 0,
                    'click_whatsapp' => 0,
                    'click_kalender_akademik' => 0,
                ],
                'referrers' => []
            ];

            try {
                $metrics = \Spatie\Analytics\Facades\Analytics::get(
                    \Spatie\Analytics\Period::days(90),
                    ['activeUsers', 'bounceRate', 'averageSessionDuration']
                );

                if (count($metrics) > 0) {
                    $firstRow = $metrics[0];
                    $gaData['active_users'] = $firstRow['activeUsers'] ?? 0;
                    $gaData['bounce_rate'] = round(($firstRow['bounceRate'] ?? 0) * 100, 2);
                    
                    $seconds = (int) ($firstRow['averageSessionDuration'] ?? 0);
                    $m = floor($seconds / 60);
                    $s = $seconds % 60;
                    $gaData['avg_session_duration'] = "{$m}m {$s}s";
                    $gaData['note'] = 'Data riil 3 bulan terakhir dari Google Analytics';
                }

                // Fetch Custom Events
                $eventMetrics = \Spatie\Analytics\Facades\Analytics::get(
                    \Spatie\Analytics\Period::days(90),
                    ['eventCount'],
                    ['eventName']
                );

                foreach ($eventMetrics as $event) {
                    if (isset($gaData['events'][$event['eventName']])) {
                        $gaData['events'][$event['eventName']] = (int) $event['eventCount'];
                    }
                }

                // Fetch Top Referrers
                $gaData['referrers'] = \Spatie\Analytics\Facades\Analytics::fetchTopReferrers(\Spatie\Analytics\Period::days(90), 5);

            } catch (\Exception $e) {
                $gaData['note'] = 'Menunggu data masuk atau error API: ' . $e->getMessage();
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'stat_cards' => [
                        'total_dosen' => $totalDosen,
                        'berita_terbit' => $beritaTerbit,
                        'program_studi' => $programStudi,
                        'pendaftar_pmb' => $pendaftarPmb,
                    ],
                    'kemahasiswaan' => [
                        'kegiatan' => $totalKegiatan,
                        'ukm' => $totalUkm,
                        'testimoni' => $totalTestimoni,
                    ],
                    'akademik' => [
                        'tahun_ajaran' => $totalTahunAjaran,
                        'brosur' => $totalBrosur,
                        'file_publik' => $totalFilePublik,
                    ],
                    'recent_news' => $recentNews,
                    'recent_pmb' => $recentPmb,
                    'pmb_by_program' => $pmbByProgram,
                    'filter_end_date' => $endDate->toDateString(),
                    'google_analytics' => $gaData,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data dashboard: ' . $e->getMessage(),
            ], 500);
        }
    }
}
