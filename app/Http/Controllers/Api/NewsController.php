<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index()
    {
        try {
            $news = News::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $news
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created news record.
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
                // Save to storage/public/news
                $path = $request->file('image')->store('news', 'public');
                $url = Storage::url($path);
                $url_image = asset($url);
            }

            $news = News::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'url_image' => $url_image,
                'created_by' => auth()->id() ?? 1, // Fallback to 1 if no auth for some reason, but jwt.auth should be active
                'views_count' => 0,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil dibuat',
                'data' => $news
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified news.
     */
    public function show($id)
    {
        try {
            $news = News::find($id);

            if (!$news) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Berita tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $news
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified news record.
     */
    public function update(Request $request, $id)
    {
        try {
            $news = News::find($id);

            if (!$news) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Berita tidak ditemukan'
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
                if ($news->url_image && str_contains($news->url_image, '/storage/news/')) {
                    $oldPath = 'news/' . basename($news->url_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('news', 'public');
                $url = Storage::url($path);
                $data['url_image'] = asset($url);
            }

            $news->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil diperbarui',
                'data' => $news
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified news record.
     */
    public function destroy($id)
    {
        try {
            $news = News::find($id);

            if (!$news) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Berita tidak ditemukan'
                ], 404);
            }

            // Delete image from storage
            if ($news->url_image && str_contains($news->url_image, '/storage/news/')) {
                $oldPath = 'news/' . basename($news->url_image);
                Storage::disk('public')->delete($oldPath);
            }

            $news->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete news.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $newsItems = News::whereIn('id', $ids)->get();
            foreach ($newsItems as $news) {
                if ($news->url_image && str_contains($news->url_image, '/storage/news/')) {
                    $oldPath = 'news/' . basename($news->url_image);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            News::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk publish news.
     */
    public function bulkPublish(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            // Only update news that are currently in 'draft' status
            $count = News::whereIn('id', $ids)
                ->where('status', 'draft')
                ->update(['status' => 'published']);

            return response()->json([
                'status' => 'success',
                'message' => $count . ' berita berhasil dipublikasikan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mempublikasikan berita: ' . $e->getMessage()
            ], 500);
        }
    }
}
