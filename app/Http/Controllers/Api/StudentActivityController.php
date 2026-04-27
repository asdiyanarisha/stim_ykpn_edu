<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentActivityController extends Controller
{
    /**
     * Display a listing of the student activities.
     */
    public function index()
    {
        try {
            $activities = StudentActivity::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $activities
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data kegiatan mahasiswa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created activity record.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'location' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'is_publish' => 'boolean',
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
                $path = $request->file('header_image')->store('student-activities', 'public');
                $url = Storage::url($path);
                $image_path = asset($url);
            }

            $activity = StudentActivity::create([
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'location' => $request->location,
                'description' => $request->description,
                'is_publish' => $request->is_publish ?? false,
                'header_image' => $image_path,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan mahasiswa berhasil dibuat',
                'data' => $activity
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat kegiatan mahasiswa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified activity.
     */
    public function show($id)
    {
        try {
            $activity = StudentActivity::find($id);

            if (!$activity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kegiatan mahasiswa tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $activity
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail kegiatan mahasiswa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified activity record.
     */
    public function update(Request $request, $id)
    {
        try {
            $activity = StudentActivity::find($id);

            if (!$activity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kegiatan mahasiswa tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'location' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'is_publish' => 'boolean',
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
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'location' => $request->location,
                'description' => $request->description,
                'is_publish' => $request->is_publish ?? $activity->is_publish,
            ];

            if ($request->hasFile('header_image')) {
                // Delete old image if it exists
                if ($activity->header_image && str_contains($activity->header_image, '/storage/student-activities/')) {
                    $oldPath = 'student-activities/' . basename($activity->header_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('header_image')->store('student-activities', 'public');
                $url = Storage::url($path);
                $data['header_image'] = asset($url);
            }

            $activity->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan mahasiswa berhasil diperbarui',
                'data' => $activity
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui kegiatan mahasiswa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified activity record.
     */
    public function destroy($id)
    {
        try {
            $activity = StudentActivity::find($id);

            if (!$activity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kegiatan mahasiswa tidak ditemukan'
                ], 404);
            }

            // Delete image from storage
            if ($activity->header_image && str_contains($activity->header_image, '/storage/student-activities/')) {
                $oldPath = 'student-activities/' . basename($activity->header_image);
                Storage::disk('public')->delete($oldPath);
            }

            $activity->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan mahasiswa berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kegiatan mahasiswa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete activities.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $items = StudentActivity::whereIn('id', $ids)->get();
            foreach ($items as $activity) {
                if ($activity->header_image && str_contains($activity->header_image, '/storage/student-activities/')) {
                    $oldPath = 'student-activities/' . basename($activity->header_image);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            StudentActivity::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Kegiatan mahasiswa berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus kegiatan mahasiswa: ' . $e->getMessage()
            ], 500);
        }
    }
}
