<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pmb;
use App\Models\PmbStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PmbAdminController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Pmb::with(['status', 'affiliate.user'])->orderBy('created_at', 'desc');

            // Filter by affiliate_id untuk tampilan detail per affiliate
            if ($request->filled('affiliate_id')) {
                $query->where('affiliate_id', $request->affiliate_id);
            }

            $pmbs = $query->get();
            return response()->json([
                'status' => 'success',
                'data' => $pmbs
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data PMB: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $pmb = Pmb::with(['status', 'affiliate.user'])->findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $pmb
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data PMB tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pmb_status_id' => 'required|exists:pmb_status,id',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pmb,email,'.$id,
            'nomor_hp_wa' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'alamat_asal' => 'required|string',
            'asal_sekolah' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'sumber_informasi' => 'required|string|max:255',
            'jalur_registrasi' => 'required|string|max:255',
            'kode_voucher' => 'nullable|string|max:255',
            'affiliate_id' => 'nullable|exists:affiliates,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $pmb = Pmb::findOrFail($id);
            $pmb->update($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Data PMB berhasil diupdate',
                'data' => $pmb
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengupdate data PMB: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pmb = Pmb::findOrFail($id);
            $pmb->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data PMB berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data PMB'
            ], 500);
        }
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:pmb,id'
        ]);

        try {
            Pmb::whereIn('id', $request->ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data PMB terpilih berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data PMB terpilih: ' . $e->getMessage()
            ], 500);
        }
    }

    public function statuses()
    {
        try {
            $statuses = PmbStatus::orderBy('order')->orderBy('id')->get();
            return response()->json([
                'status' => 'success',
                'data' => $statuses
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data status PMB: ' . $e->getMessage()
            ], 500);
        }
    }

    public function export(Request $request)
    {
        try {
            $query = Pmb::query()->with(['status', 'affiliate.user']);

            if ($request->filled('program_studi') && $request->program_studi !== 'all') {
                $query->where('program_studi', $request->program_studi);
            }

            if ($request->filled('pmb_status_id') && $request->pmb_status_id !== 'all') {
                $query->where('pmb_status_id', $request->pmb_status_id);
            }

            if ($request->filled('jalur_registrasi') && $request->jalur_registrasi !== 'all') {
                $query->where('jalur_registrasi', $request->jalur_registrasi);
            }

            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            $pmbs = $query->orderBy('created_at', 'desc')->get();

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Set Header Columns
            $headers = [
                'ID Pendaftar', 'Nama Lengkap', 'Email', 'No. HP/WA', 'Tempat Lahir', 
                'Tanggal Lahir', 'Jenis Kelamin', 'Alamat Asal', 'Asal Sekolah', 
                'Program Studi', 'Sumber Informasi', 'Jalur Registrasi', 'Kode Voucher', 
                'Status PMB', 'Referral Affiliate', 'Tanggal Daftar'
            ];

            foreach ($headers as $colIndex => $headerText) {
                $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1);
                $sheet->setCellValue($colLetter . '1', $headerText);
                $sheet->getStyle($colLetter . '1')->getFont()->setBold(true);
            }

            // Fill Data Rows
            $rowNumber = 2;
            foreach ($pmbs as $pmb) {
                $sheet->setCellValue('A' . $rowNumber, $pmb->id_pendaftar);
                $sheet->setCellValue('B' . $rowNumber, $pmb->nama_lengkap);
                $sheet->setCellValue('C' . $rowNumber, $pmb->email);
                $sheet->setCellValue('D' . $rowNumber, $pmb->nomor_hp_wa);
                $sheet->setCellValue('E' . $rowNumber, $pmb->tempat_lahir);
                $sheet->setCellValue('F' . $rowNumber, $pmb->tanggal_lahir);
                $sheet->setCellValue('G' . $rowNumber, $pmb->jenis_kelamin);
                $sheet->setCellValue('H' . $rowNumber, $pmb->alamat_asal);
                $sheet->setCellValue('I' . $rowNumber, $pmb->asal_sekolah);
                $sheet->setCellValue('J' . $rowNumber, $pmb->program_studi);
                $sheet->setCellValue('K' . $rowNumber, $pmb->sumber_informasi);
                $sheet->setCellValue('L' . $rowNumber, $pmb->jalur_registrasi);
                $sheet->setCellValue('M' . $rowNumber, $pmb->kode_voucher ?? '-');
                $sheet->setCellValue('N' . $rowNumber, $pmb->status?->status ?? 'Registrasi Awal');
                $sheet->setCellValue('O' . $rowNumber, $pmb->affiliate ? ($pmb->affiliate->name . ' (' . ($pmb->affiliate->user?->name ?? '') . ')') : '-');
                $sheet->setCellValue('P' . $rowNumber, $pmb->created_at->format('Y-m-d H:i:s'));
                $rowNumber++;
            }

            // Auto-size columns
            foreach (range(1, count($headers)) as $colIndex) {
                $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
                $sheet->getColumnDimension($colLetter)->setAutoSize(true);
            }

            $writer = new Xlsx($spreadsheet);
            
            return response()->stream(
                function () use ($writer) {
                    $writer->save('php://output');
                },
                200,
                [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename="data_pendaftar_pmb_' . date('Ymd_His') . '.xlsx"',
                    'Cache-Control' => 'max-age=0',
                ]
            );

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengekspor data Excel: ' . $e->getMessage()
            ], 500);
        }
    }
}
