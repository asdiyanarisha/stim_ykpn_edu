<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AcademicCalendarCategoryController extends Controller
{
    /**
     * Display a listing of the category.
     */
    public function index()
    {
        try {
            $categories = Kategori::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data kategori kalender akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created category record.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255',
                'warna' => 'nullable|string|max:255',
                'ikon' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $category = Kategori::create([
                'nama' => $request->nama,
                'warna' => $request->warna ?? '#3B82F6',
                'ikon' => $request->ikon ?? 'bi-calendar',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori kalender akademik berhasil dibuat',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat kategori kalender akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified category.
     */
    public function show($id)
    {
        try {
            $category = Kategori::find($id);

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori kalender akademik tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail kategori kalender akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified category record.
     */
    public function update(Request $request, $id)
    {
        try {
            $category = Kategori::find($id);

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori kalender akademik tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255',
                'warna' => 'nullable|string|max:255',
                'ikon' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $category->update([
                'nama' => $request->nama,
                'warna' => $request->warna ?? $category->warna,
                'ikon' => $request->ikon ?? $category->ikon,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori kalender akademik berhasil diperbarui',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui kategori kalender akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified category record.
     */
    public function destroy($id)
    {
        try {
            $category = Kategori::find($id);

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori kalender akademik tidak ditemukan'
                ], 404);
            }

            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori kalender akademik berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kategori kalender akademik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete categories.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            Kategori::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori kalender akademik berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kategori kalender akademik: ' . $e->getMessage()
            ], 500);
        }
    }
}
