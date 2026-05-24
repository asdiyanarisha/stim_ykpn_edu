<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JobTitleController extends Controller
{
    /**
     * Display a listing of the job titles.
     */
    public function index()
    {
        try {
            $jobTitles = JobTitle::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $jobTitles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data jabatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created job title record.
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

            $jobTitle = JobTitle::create([
                'title' => $request->title,
                'slug' => $slug,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Jabatan berhasil dibuat',
                'data' => $jobTitle
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat jabatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified job title.
     */
    public function show($id)
    {
        try {
            $jobTitle = JobTitle::find($id);

            if (!$jobTitle) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jabatan tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $jobTitle
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail jabatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified job title record.
     */
    public function update(Request $request, $id)
    {
        try {
            $jobTitle = JobTitle::find($id);

            if (!$jobTitle) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jabatan tidak ditemukan'
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

            $jobTitle->update([
                'title' => $request->title,
                'slug' => $slug,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Jabatan berhasil diperbarui',
                'data' => $jobTitle
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui jabatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified job title record.
     */
    public function destroy($id)
    {
        try {
            $jobTitle = JobTitle::find($id);

            if (!$jobTitle) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jabatan tidak ditemukan'
                ], 404);
            }

            $jobTitle->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Jabatan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus jabatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete job titles.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            JobTitle::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Jabatan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus jabatan: ' . $e->getMessage()
            ], 500);
        }
    }
}
