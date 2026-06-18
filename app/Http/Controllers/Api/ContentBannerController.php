<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContentBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ContentBannerController extends Controller
{
    /**
     * Display a listing of the banners ordered by sort_order.
     */
    public function index()
    {
        try {
            $banners = ContentBanner::orderBy('sort_order', 'asc')
                ->orderBy('id', 'asc')
                ->get();
            return response()->json([
                'status' => 'success',
                'data' => $banners
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data banner: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created banner.
     * Auto-assign sort_order as max + 1 so new banners go to the end.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'button_text' => 'nullable|string|max:100',
                'link' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $path = $request->file('image')->store('banners', 'public');
            $url = Storage::url($path);

            // Auto-assign sort_order: ambil nilai max yang ada + 1
            $maxSortOrder = ContentBanner::max('sort_order') ?? 0;

            $banner = ContentBanner::create([
                'title' => $request->title,
                'description' => $request->description,
                'button_text' => $request->button_text,
                'link' => $request->link,
                'url_image' => asset($url),
                'created_by' => auth()->id() ?? 1,
                'sort_order' => $maxSortOrder + 1,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Banner created successfully',
                'data' => $banner
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat banner: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified banner.
     */
    public function update(Request $request, $id)
    {
        try {
            $banner = ContentBanner::find($id);

            if (!$banner) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Banner not found'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'button_text' => 'nullable|string|max:100',
                'link' => 'nullable|string',
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
                'description' => $request->description,
                'button_text' => $request->button_text,
                'link' => $request->link,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if it exists on our storage
                if ($banner->url_image && str_contains($banner->url_image, '/storage/')) {
                    $oldPath = str_replace(asset('storage'), '', $banner->url_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('banners', 'public');
                $url = Storage::url($path);
                $data['url_image'] = asset($url);
            }

            $banner->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Banner updated successfully',
                'data' => $banner
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui banner: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified banner.
     */
    public function show($id)
    {
        $banner = ContentBanner::find($id);

        if (!$banner) {
            return response()->json([
                'status' => 'error',
                'message' => 'Banner not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $banner
        ]);
    }

    /**
     * Remove the specified banner.
     */
    public function destroy($id)
    {
        $banner = ContentBanner::find($id);

        if (!$banner) {
            return response()->json([
                'status' => 'error',
                'message' => 'Banner not found'
            ], 404);
        }

        // Optional: delete image from storage
        // if ($banner->url_image) {
        //     $path = str_replace(asset(Storage::url('')), '', $banner->url_image);
        //     Storage::disk('public')->delete($path);
        // }

        $banner->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Banner deleted successfully'
        ]);
    }

    /**
     * Bulk delete banners.
     */
    public function bulkDestroy(Request $request)
    {
        $ids = $request->ids;
        if (!is_array($ids) || empty($ids)) {
            return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
        }

        ContentBanner::whereIn('id', $ids)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Banners deleted successfully'
        ]);
    }

    /**
     * Reorder banners by updating sort_order for each banner.
     * Expects request body: { "orders": [{"id": 1, "sort_order": 0}, {"id": 3, "sort_order": 1}, ...] }
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orders' => 'required|array|min:1',
            'orders.*.id' => 'required|integer|exists:content_banner,id',
            'orders.*.sort_order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->orders as $item) {
                    ContentBanner::where('id', $item['id'])
                        ->update(['sort_order' => $item['sort_order']]);
                }
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Urutan banner berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan urutan: ' . $e->getMessage()
            ], 500);
        }
    }
}
