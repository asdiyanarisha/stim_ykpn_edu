<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the academic years.
     */
    public function index()
    {
        try {
            $years = AcademicYear::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $years
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data tahun ajaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created academic year.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'school_year' => 'nullable|string|max:255',
                'start' => 'required|date',
                'end' => 'required|date|after:start',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $year = AcademicYear::create($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Tahun ajaran berhasil ditambahkan',
                'data' => $year
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan tahun ajaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified academic year.
     */
    public function show($id)
    {
        try {
            $year = AcademicYear::find($id);

            if (!$year) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tahun ajaran tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $year
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail tahun ajaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified academic year.
     */
    public function update(Request $request, $id)
    {
        try {
            $year = AcademicYear::find($id);

            if (!$year) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tahun ajaran tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'school_year' => 'nullable|string|max:255',
                'start' => 'required|date',
                'end' => 'required|date|after:start',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $year->update($request->all());

            return response()->json([
                'status' => 'success',
                'message' => 'Tahun ajaran berhasil diperbarui',
                'data' => $year
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui tahun ajaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified academic year.
     */
    public function destroy($id)
    {
        try {
            $year = AcademicYear::find($id);

            if (!$year) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tahun ajaran tidak ditemukan'
                ], 404);
            }

            $year->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Tahun ajaran berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus tahun ajaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete academic years.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            AcademicYear::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Tahun ajaran terpilih berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus tahun ajaran: ' . $e->getMessage()
            ], 500);
        }
    }
}
