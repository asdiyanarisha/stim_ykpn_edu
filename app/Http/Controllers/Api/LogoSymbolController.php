<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LogoSymbol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LogoSymbolController extends Controller
{
    /**
     * Display the first logo symbol record.
     */
    public function show()
    {
        try {
            $data = LogoSymbol::first();

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data Logo & Lambang: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store or Update the single logo symbol record.
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

            $currentData = LogoSymbol::first();
            
            $fields = [
                'title' => $request->title,
                'content' => $request->content,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($currentData && $currentData->header_image && str_contains($currentData->header_image, '/storage/logo-symbol/')) {
                    $oldPath = 'logo-symbol/' . basename($currentData->header_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('logo-symbol', 'public');
                $url = Storage::url($path);
                $fields['header_image'] = asset($url);
            }

            if ($currentData) {
                $currentData->update($fields);
                $message = 'Logo & Lambang berhasil diperbarui';
            } else {
                $currentData = LogoSymbol::create($fields);
                $message = 'Logo & Lambang berhasil dibuat';
            }

            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $currentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan Logo & Lambang: ' . $e->getMessage()
            ], 500);
        }
    }
}
