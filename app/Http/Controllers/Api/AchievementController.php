<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AchievementController extends Controller
{
    /**
     * Display a listing of the achievements.
     */
    public function index()
    {
        try {
            $achievements = Achievement::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $achievements
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data prestasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created achievement.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $header_image = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('achievements', 'public');
                $url = Storage::url($path);
                $header_image = asset($url);
            }

            $achievement = Achievement::create([
                'title' => $request->title,
                'content' => $request->content,
                'header_image' => $header_image,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Prestasi berhasil dibuat',
                'data' => $achievement
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat prestasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified achievement.
     */
    public function show($id)
    {
        try {
            $achievement = Achievement::find($id);

            if (!$achievement) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Prestasi tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $achievement
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail prestasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified achievement.
     */
    public function update(Request $request, $id)
    {
        try {
            $achievement = Achievement::find($id);

            if (!$achievement) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Prestasi tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
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
            ];

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($achievement->header_image && str_contains($achievement->header_image, '/storage/achievements/')) {
                    $oldPath = 'achievements/' . basename($achievement->header_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('achievements', 'public');
                $url = Storage::url($path);
                $data['header_image'] = asset($url);
            }

            $achievement->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Prestasi berhasil diperbarui',
                'data' => $achievement
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui prestasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified achievement.
     */
    public function destroy($id)
    {
        try {
            $achievement = Achievement::find($id);

            if (!$achievement) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Prestasi tidak ditemukan'
                ], 404);
            }

            // Delete image from storage
            if ($achievement->header_image && str_contains($achievement->header_image, '/storage/achievements/')) {
                $oldPath = 'achievements/' . basename($achievement->header_image);
                Storage::disk('public')->delete($oldPath);
            }

            $achievement->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Prestasi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus prestasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete achievements.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $achievements = Achievement::whereIn('id', $ids)->get();
            foreach ($achievements as $achievement) {
                if ($achievement->header_image && str_contains($achievement->header_image, '/storage/achievements/')) {
                    $oldPath = 'achievements/' . basename($achievement->header_image);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            Achievement::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Prestasi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus prestasi: ' . $e->getMessage()
            ], 500);
        }
    }
}
