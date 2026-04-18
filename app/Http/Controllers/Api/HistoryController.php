<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{
    /**
     * Display the first history record.
     */
    public function show()
    {
        try {
            $data = History::first();

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data Sejarah: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store or Update the single history record.
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $currentData = History::first();
            
            $fields = [
                'title' => $request->title,
                'content' => $request->content,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($currentData && $currentData->header_image && str_contains($currentData->header_image, '/storage/history/')) {
                    $oldPath = 'history/' . basename($currentData->header_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('history', 'public');
                $url = Storage::url($path);
                $fields['header_image'] = asset($url);
            }

            if ($currentData) {
                $currentData->update($fields);
                $message = 'Sejarah berhasil diperbarui';
            } else {
                $currentData = History::create($fields);
                $message = 'Sejarah berhasil dibuat';
            }

            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $currentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan Sejarah: ' . $e->getMessage()
            ], 500);
        }
    }
}
