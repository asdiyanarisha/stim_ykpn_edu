<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PmbProgramExtensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PmbProgramExtensiController extends Controller
{
    public function show()
    {
        try {
            $data = PmbProgramExtensi::first();
            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal mengambil data: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'content' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => 'Validation failed', 'errors' => $validator->errors()], 422);
            }

            $currentData = PmbProgramExtensi::first();
            $fields = ['title' => $request->title, 'content' => $request->content];

            if ($request->hasFile('image')) {
                if ($currentData && $currentData->header_image && str_contains($currentData->header_image, '/storage/pmb/')) {
                    $oldPath = 'pmb/' . basename($currentData->header_image);
                    Storage::disk('public')->delete($oldPath);
                }
                $path = $request->file('image')->store('pmb', 'public');
                $url = Storage::url($path);
                $fields['header_image'] = asset($url);
            }

            if ($currentData) {
                $currentData->update($fields);
                $message = 'Data berhasil diperbarui';
            } else {
                $currentData = PmbProgramExtensi::create($fields);
                $message = 'Data berhasil dibuat';
            }

            return response()->json(['status' => 'success', 'message' => $message, 'data' => $currentData]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $e->getMessage()], 500);
        }
    }
}
