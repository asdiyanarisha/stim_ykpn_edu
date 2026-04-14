<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContentBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ContentBannerController extends Controller
{
    /**
     * Display a listing of the banners.
     */
    public function index()
    {
        $banners = ContentBanner::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $banners
        ]);
    }

    /**
     * Store a newly created banner.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'button_text' => 'required|string|max:100',
            'link' => 'required|string',
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

        $banner = ContentBanner::create([
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'link' => $request->link,
            'url_image' => asset($url),
            'created_by' => auth()->id() ?? 1,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Banner created successfully',
            'data' => $banner
        ], 201);
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
}
