<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the announcements.
     */
    public function index()
    {
        try {
            $announcements = Pengumuman::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $announcements
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created announcement record.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'status' => 'required|string|in:draft,published',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $url_image = null;
            if ($request->hasFile('image')) {
                // Save to storage/public/announcements
                $path = $request->file('image')->store('announcements', 'public');
                $url = Storage::url($path);
                $url_image = asset($url);
            }

            $announcement = Pengumuman::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'url_image' => $url_image,
                'created_by' => auth()->id() ?? 1,
                'views_count' => 0,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman berhasil dibuat',
                'data' => $announcement
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified announcement.
     */
    public function show($id)
    {
        try {
            $announcement = Pengumuman::find($id);

            if (!$announcement) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pengumuman tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $announcement
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified announcement record.
     */
    public function update(Request $request, $id)
    {
        try {
            $announcement = Pengumuman::find($id);

            if (!$announcement) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pengumuman tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'status' => 'required|string|in:draft,published',
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
                'status' => $request->status,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($announcement->url_image && str_contains($announcement->url_image, '/storage/announcements/')) {
                    $oldPath = 'announcements/' . basename($announcement->url_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('announcements', 'public');
                $url = Storage::url($path);
                $data['url_image'] = asset($url);
            }

            $announcement->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman berhasil diperbarui',
                'data' => $announcement
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified announcement record.
     */
    public function destroy($id)
    {
        try {
            $announcement = Pengumuman::find($id);

            if (!$announcement) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pengumuman tidak ditemukan'
                ], 404);
            }

            // Delete image from storage
            if ($announcement->url_image && str_contains($announcement->url_image, '/storage/announcements/')) {
                $oldPath = 'announcements/' . basename($announcement->url_image);
                Storage::disk('public')->delete($oldPath);
            }

            $announcement->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete announcements.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $announcements = Pengumuman::whereIn('id', $ids)->get();
            foreach ($announcements as $announcement) {
                if ($announcement->url_image && str_contains($announcement->url_image, '/storage/announcements/')) {
                    $oldPath = 'announcements/' . basename($announcement->url_image);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            Pengumuman::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Pengumuman berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk publish announcements.
     */
    public function bulkPublish(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $count = Pengumuman::whereIn('id', $ids)
                ->where('status', 'draft')
                ->update(['status' => 'published']);

            return response()->json([
                'status' => 'success',
                'message' => $count . ' pengumuman berhasil dipublikasikan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mempublikasikan pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }
}
