<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentUkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentUkmController extends Controller
{
    /**
     * Display a listing of the student ukm.
     */
    public function index()
    {
        try {
            $ukms = StudentUkm::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $ukms
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data UKM: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created ukm record.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'day' => 'nullable|string|max:255',
                'time' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'header_image' => 'nullable|image|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $image_path = null;
            if ($request->hasFile('header_image')) {
                $path = $request->file('header_image')->store('student-ukm', 'public');
                $url = Storage::url($path);
                $image_path = asset($url);
            }

            $ukm = StudentUkm::create([
                'title' => $request->title,
                'content' => $request->content,
                'day' => $request->day,
                'time' => $request->time,
                'location' => $request->location,
                'header_image' => $image_path,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'UKM berhasil dibuat',
                'data' => $ukm
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat UKM: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified ukm.
     */
    public function show($id)
    {
        try {
            $ukm = StudentUkm::find($id);

            if (!$ukm) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'UKM tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $ukm
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail UKM: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified ukm record.
     */
    public function update(Request $request, $id)
    {
        try {
            $ukm = StudentUkm::find($id);

            if (!$ukm) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'UKM tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'day' => 'nullable|string|max:255',
                'time' => 'nullable|string|max:255',
                'location' => 'nullable|string|max:255',
                'header_image' => 'nullable|image|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'day' => $request->day,
                'time' => $request->time,
                'location' => $request->location,
            ];

            if ($request->hasFile('header_image')) {
                // Delete old image if it exists
                if ($ukm->header_image && str_contains($ukm->header_image, '/storage/student-ukm/')) {
                    $oldPath = 'student-ukm/' . basename($ukm->header_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('header_image')->store('student-ukm', 'public');
                $url = Storage::url($path);
                $data['header_image'] = asset($url);
            }

            $ukm->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'UKM berhasil diperbarui',
                'data' => $ukm
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui UKM: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified ukm record.
     */
    public function destroy($id)
    {
        try {
            $ukm = StudentUkm::find($id);

            if (!$ukm) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'UKM tidak ditemukan'
                ], 404);
            }

            // Delete image from storage
            if ($ukm->header_image && str_contains($ukm->header_image, '/storage/student-ukm/')) {
                $oldPath = 'student-ukm/' . basename($ukm->header_image);
                Storage::disk('public')->delete($oldPath);
            }

            $ukm->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'UKM berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus UKM: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete ukms.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $items = StudentUkm::whereIn('id', $ids)->get();
            foreach ($items as $ukm) {
                if ($ukm->header_image && str_contains($ukm->header_image, '/storage/student-ukm/')) {
                    $oldPath = 'student-ukm/' . basename($ukm->header_image);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            StudentUkm::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'UKM berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus UKM: ' . $e->getMessage()
            ], 500);
        }
    }
}
