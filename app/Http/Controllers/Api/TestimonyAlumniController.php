<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TestimonyAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestimonyAlumniController extends Controller
{
    /**
     * Display a listing of the testimony.
     */
    public function index()
    {
        try {
            $testimonies = TestimonyAlumni::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $testimonies
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data testimoni: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created testimony.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'testimony' => 'nullable|string',
                'image' => 'nullable|image|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
                ], 422);
            }

            $image_path = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('testimony-alumni', 'public');
                $url = Storage::url($path);
                $image_path = asset($url);
            }

            $testimony = TestimonyAlumni::create([
                'name' => $request->name,
                'testimony' => $request->testimony,
                'image' => $image_path,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil dibuat',
                'data' => $testimony
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat testimoni: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified testimony.
     */
    public function show($id)
    {
        try {
            $testimony = TestimonyAlumni::find($id);

            if (!$testimony) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Testimoni tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $testimony
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail testimoni: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified testimony.
     */
    public function update(Request $request, $id)
    {
        try {
            $testimony = TestimonyAlumni::find($id);

            if (!$testimony) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Testimoni tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'nullable|string|max:255',
                'testimony' => 'nullable|string',
                'image' => 'nullable|image|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = [
                'name' => $request->name,
                'testimony' => $request->testimony,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($testimony->image && str_contains($testimony->image, '/storage/testimony-alumni/')) {
                    $oldPath = 'testimony-alumni/' . basename($testimony->image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('testimony-alumni', 'public');
                $url = Storage::url($path);
                $data['image'] = asset($url);
            }

            $testimony->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil diperbarui',
                'data' => $testimony
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui testimoni: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified testimony.
     */
    public function destroy($id)
    {
        try {
            $testimony = TestimonyAlumni::find($id);

            if (!$testimony) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Testimoni tidak ditemukan'
                ], 404);
            }

            // Delete image from storage
            if ($testimony->image && str_contains($testimony->image, '/storage/testimony-alumni/')) {
                $oldPath = 'testimony-alumni/' . basename($testimony->image);
                Storage::disk('public')->delete($oldPath);
            }

            $testimony->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus testimoni: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete testimonies.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $items = TestimonyAlumni::whereIn('id', $ids)->get();
            foreach ($items as $item) {
                if ($item->image && str_contains($item->image, '/storage/testimony-alumni/')) {
                    $oldPath = 'testimony-alumni/' . basename($item->image);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            TestimonyAlumni::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus testimoni: ' . $e->getMessage()
            ], 500);
        }
    }
}
