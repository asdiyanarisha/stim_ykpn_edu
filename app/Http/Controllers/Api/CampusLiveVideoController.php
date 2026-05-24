<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CampusLiveVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampusLiveVideoController extends Controller
{
    /**
     * Display a listing of the campus live videos.
     */
    public function index()
    {
        try {
            $videos = CampusLiveVideo::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $videos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data video: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created video record.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'link' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $video = CampusLiveVideo::create([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Video berhasil ditambahkan',
                'data' => $video
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan video: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified video.
     */
    public function show($id)
    {
        try {
            $video = CampusLiveVideo::find($id);

            if (!$video) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Video tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $video
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail video: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified video record.
     */
    public function update(Request $request, $id)
    {
        try {
            $video = CampusLiveVideo::find($id);

            if (!$video) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Video tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'link' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $video->update([
                'title' => $request->title,
                'description' => $request->description,
                'link' => $request->link,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Video berhasil diperbarui',
                'data' => $video
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui video: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified video record.
     */
    public function destroy($id)
    {
        try {
            $video = CampusLiveVideo::find($id);

            if (!$video) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Video tidak ditemukan'
                ], 404);
            }

            $video->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Video berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus video: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete videos.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            CampusLiveVideo::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Video berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus video: ' . $e->getMessage()
            ], 500);
        }
    }
}
