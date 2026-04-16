<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CertificationLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CertificationLogoController extends Controller
{
    /**
     * Display a listing of the certification logos.
     */
    public function index()
    {
        try {
            $logos = CertificationLogo::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $logos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data logo sertifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created certification logo.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
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
                // Save to storage/public/certification_logos
                $path = $request->file('image')->store('certification_logos', 'public');
                $url = Storage::url($path);
                $url_image = asset($url);
            }

            $logo = CertificationLogo::create([
                'title' => $request->title,
                'description' => $request->description,
                'url_image' => $url_image,
                'created_by' => auth()->id() ?? 1,
                'views_count' => 0,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Logo sertifikasi berhasil dibuat',
                'data' => $logo
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat logo sertifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified certification logo.
     */
    public function show($id)
    {
        try {
            $logo = CertificationLogo::find($id);

            if (!$logo) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Logo sertifikasi tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $logo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail logo sertifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified certification logo.
     */
    public function update(Request $request, $id)
    {
        try {
            $logo = CertificationLogo::find($id);

            if (!$logo) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Logo sertifikasi tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
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
            ];

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($logo->url_image && str_contains($logo->url_image, '/storage/certification_logos/')) {
                    $oldPath = 'certification_logos/' . basename($logo->url_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('certification_logos', 'public');
                $url = Storage::url($path);
                $data['url_image'] = asset($url);
            }

            $logo->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Logo sertifikasi berhasil diperbarui',
                'data' => $logo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui logo sertifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified certification logo.
     */
    public function destroy($id)
    {
        try {
            $logo = CertificationLogo::find($id);

            if (!$logo) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Logo sertifikasi tidak ditemukan'
                ], 404);
            }

            // Delete image from storage
            if ($logo->url_image && str_contains($logo->url_image, '/storage/certification_logos/')) {
                $oldPath = 'certification_logos/' . basename($logo->url_image);
                Storage::disk('public')->delete($oldPath);
            }

            $logo->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logo sertifikasi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus logo sertifikasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete certification logos.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $logos = CertificationLogo::whereIn('id', $ids)->get();
            foreach ($logos as $logo) {
                if ($logo->url_image && str_contains($logo->url_image, '/storage/certification_logos/')) {
                    $oldPath = 'certification_logos/' . basename($logo->url_image);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            CertificationLogo::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logo sertifikasi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus logo sertifikasi: ' . $e->getMessage()
            ], 500);
        }
    }
}
