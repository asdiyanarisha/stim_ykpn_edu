<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryTeacherController extends Controller
{
    /**
     * Display a listing of the category teachers.
     */
    public function index()
    {
        try {
            $categories = CategoryTeacher::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data kategori dosen: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created category teacher record.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'slug' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $slug = $request->slug;
            if (!$slug && $request->title) {
                $slug = Str::slug($request->title);
            }

            $category = CategoryTeacher::create([
                'title' => $request->title,
                'slug' => $slug,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori dosen berhasil dibuat',
                'data' => $category
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat kategori dosen: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified category teacher.
     */
    public function show($id)
    {
        try {
            $category = CategoryTeacher::find($id);

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori dosen tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail kategori dosen: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified category teacher record.
     */
    public function update(Request $request, $id)
    {
        try {
            $category = CategoryTeacher::find($id);

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori dosen tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'slug' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $slug = $request->slug;
            if (!$slug && $request->title) {
                $slug = Str::slug($request->title);
            }

            $category->update([
                'title' => $request->title,
                'slug' => $slug,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori dosen berhasil diperbarui',
                'data' => $category
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui kategori dosen: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified category teacher record.
     */
    public function destroy($id)
    {
        try {
            $category = CategoryTeacher::find($id);

            if (!$category) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kategori dosen tidak ditemukan'
                ], 404);
            }

            $category->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori dosen berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kategori dosen: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete category teachers.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            CategoryTeacher::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori dosen berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kategori dosen: ' . $e->getMessage()
            ], 500);
        }
    }
}
