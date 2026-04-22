<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicGoalAchieve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AcademicGoalAchieveController extends Controller
{
    /**
     * Display the first academic goal achieve record.
     */
    public function show()
    {
        try {
            $data = AcademicGoalAchieve::first();

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data Cara Mencapai Sasaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store or Update the single academic goal achieve record.
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

            $currentData = AcademicGoalAchieve::first();
            
            $fields = [
                'title' => $request->title,
                'content' => $request->content,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($currentData && $currentData->header_image && str_contains($currentData->header_image, '/storage/academic-goal-achieve/')) {
                    $oldPath = 'academic-goal-achieve/' . basename($currentData->header_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('academic-goal-achieve', 'public');
                $url = Storage::url($path);
                $fields['header_image'] = asset($url);
            }

            if ($currentData) {
                $currentData->update($fields);
                $message = 'Cara Mencapai Sasaran berhasil diperbarui';
            } else {
                $currentData = AcademicGoalAchieve::create($fields);
                $message = 'Cara Mencapai Sasaran berhasil dibuat';
            }

            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $currentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan Cara Mencapai Sasaran: ' . $e->getMessage()
            ], 500);
        }
    }
}
