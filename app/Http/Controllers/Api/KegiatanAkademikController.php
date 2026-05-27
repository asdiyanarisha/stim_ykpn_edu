<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KegiatanAkademik;
use App\Models\Semester;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KegiatanAkademikController extends Controller
{
    /**
     * Display a listing of academic calendar activities.
     */
    public function index()
    {
        try {
            $kegiatan = KegiatanAkademik::orderBy('tanggal_mulai', 'asc')->get();
            
            // Manually decorate with semester and kategori to respect the rule
            // of having no relationship methods in the models.
            $semesters = Semester::all()->keyBy('id');
            $kategori = Kategori::all()->keyBy('id');
            
            $kegiatan->each(function($item) use ($semesters, $kategori) {
                $item->semester = $semesters->get($item->semester_id);
                $item->kategori = $kategori->get($item->kategori_id);
            });

            return response()->json([
                'status' => 'success',
                'data' => $kegiatan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data kegiatan akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified activity.
     */
    public function show($id)
    {
        try {
            $kegiatan = KegiatanAkademik::find($id);
            
            if (!$kegiatan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kegiatan akademik tidak ditemukan'
                ], 404);
            }

            $kegiatan->semester = Semester::find($kegiatan->semester_id);
            $kegiatan->kategori = Kategori::find($kegiatan->kategori_id);

            return response()->json([
                'status' => 'success',
                'data' => $kegiatan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail kegiatan akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created activity.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'semester_id' => 'required|integer',
                'kategori_id' => 'required|integer',
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'aktif' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $kegiatan = KegiatanAkademik::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan akademik berhasil ditambahkan',
                'data' => $kegiatan
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan kegiatan akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified activity.
     */
    public function update(Request $request, $id)
    {
        try {
            $kegiatan = KegiatanAkademik::find($id);
            
            if (!$kegiatan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kegiatan akademik tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'semester_id' => 'required|integer',
                'kategori_id' => 'required|integer',
                'judul' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'aktif' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $kegiatan->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan akademik berhasil diperbarui',
                'data' => $kegiatan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui kegiatan akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified activity.
     */
    public function destroy($id)
    {
        try {
            $kegiatan = KegiatanAkademik::find($id);
            
            if (!$kegiatan) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kegiatan akademik tidak ditemukan'
                ], 404);
            }

            $kegiatan->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan akademik berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kegiatan akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get semesters and kategori for dropdown options.
     */
    public function getOptions()
    {
        try {
            $semesters = Semester::orderBy('id', 'asc')->get();
            $kategori = Kategori::orderBy('id', 'asc')->get();
            
            return response()->json([
                'status' => 'success',
                'data' => [
                    'semesters' => $semesters,
                    'kategori' => $kategori
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil pilihan: ' . $e->getMessage()
            ], 500);
        }
    }
}
