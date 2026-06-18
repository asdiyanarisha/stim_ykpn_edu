<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class FacilityController extends Controller
{
    /**
     * Display a listing of the facilities ordered by sort_order.
     */
    public function index()
    {
        try {
            $facilities = Facility::orderBy('sort_order', 'asc')
                ->orderBy('id', 'asc')
                ->get();
            return response()->json([
                'status' => 'success',
                'data' => $facilities
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data fasilitas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created facility.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'top_facility' => 'nullable|string|max:255',
                'icon' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $fields = [
                'title' => $request->title,
                'content' => $request->content,
                'top_facility' => $request->top_facility,
                'icon' => $request->icon,
            ];

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('facility', 'public');
                $url = Storage::url($path);
                $fields['header_image'] = asset($url);
            }

            // Auto-assign sort_order
            $maxSortOrder = Facility::max('sort_order') ?? 0;
            $fields['sort_order'] = $maxSortOrder + 1;

            $facility = Facility::create($fields);

            return response()->json([
                'status' => 'success',
                'message' => 'Fasilitas berhasil ditambahkan',
                'data' => $facility
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat fasilitas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified facility.
     */
    public function show($id)
    {
        try {
            $facility = Facility::find($id);

            if (!$facility) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Fasilitas tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $facility
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data fasilitas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified facility.
     */
    public function update(Request $request, $id)
    {
        try {
            $facility = Facility::find($id);

            if (!$facility) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Fasilitas tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'top_facility' => 'nullable|string|max:255',
                'icon' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $fields = [
                'title' => $request->title,
                'content' => $request->content,
                'top_facility' => $request->top_facility,
                'icon' => $request->icon,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($facility->header_image && str_contains($facility->header_image, '/storage/')) {
                    $oldPath = str_replace(asset('storage'), '', $facility->header_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('facility', 'public');
                $url = Storage::url($path);
                $fields['header_image'] = asset($url);
            }

            $facility->update($fields);

            return response()->json([
                'status' => 'success',
                'message' => 'Fasilitas berhasil diperbarui',
                'data' => $facility
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui fasilitas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified facility.
     */
    public function destroy($id)
    {
        try {
            $facility = Facility::find($id);

            if (!$facility) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Fasilitas tidak ditemukan'
                ], 404);
            }

            // Delete image from storage
            if ($facility->header_image && str_contains($facility->header_image, '/storage/')) {
                $oldPath = str_replace(asset('storage'), '', $facility->header_image);
                Storage::disk('public')->delete($oldPath);
            }

            $facility->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Fasilitas berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus fasilitas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete facilities.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'Tidak ada ID yang dipilih'], 400);
            }

            $facilities = Facility::whereIn('id', $ids)->get();

            foreach ($facilities as $facility) {
                if ($facility->header_image && str_contains($facility->header_image, '/storage/')) {
                    $oldPath = str_replace(asset('storage'), '', $facility->header_image);
                    Storage::disk('public')->delete($oldPath);
                }
                $facility->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Fasilitas yang dipilih berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus beberapa fasilitas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reorder facilities.
     */
    public function reorder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orders' => 'required|array|min:1',
            'orders.*.id' => 'required|integer|exists:facilities,id',
            'orders.*.sort_order' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->orders as $item) {
                    Facility::where('id', $item['id'])
                        ->update(['sort_order' => $item['sort_order']]);
                }
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Urutan fasilitas berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan urutan: ' . $e->getMessage()
            ], 500);
        }
    }
}
