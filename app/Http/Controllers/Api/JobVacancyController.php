<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the job vacancies.
     */
    public function index()
    {
        try {
            $vacancies = JobVacancy::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $vacancies
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data lowongan kerja: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created job vacancy.
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
                // Save to storage/public/jobs
                $path = $request->file('image')->store('jobs', 'public');
                $url = Storage::url($path);
                $url_image = asset($url);
            }

            $vacancy = JobVacancy::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'url_image' => $url_image,
                'created_by' => auth()->id() ?? 1,
                'views_count' => 0,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Lowongan kerja berhasil dibuat',
                'data' => $vacancy
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat lowongan kerja: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified job vacancy.
     */
    public function show($id)
    {
        try {
            $vacancy = JobVacancy::find($id);

            if (!$vacancy) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lowongan kerja tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $vacancy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail lowongan kerja: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified job vacancy.
     */
    public function update(Request $request, $id)
    {
        try {
            $vacancy = JobVacancy::find($id);

            if (!$vacancy) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lowongan kerja tidak ditemukan'
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
                if ($vacancy->url_image && str_contains($vacancy->url_image, '/storage/jobs/')) {
                    $oldPath = 'jobs/' . basename($vacancy->url_image);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('image')->store('jobs', 'public');
                $url = Storage::url($path);
                $data['url_image'] = asset($url);
            }

            $vacancy->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Lowongan kerja berhasil diperbarui',
                'data' => $vacancy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui lowongan kerja: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified job vacancy.
     */
    public function destroy($id)
    {
        try {
            $vacancy = JobVacancy::find($id);

            if (!$vacancy) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Lowongan kerja tidak ditemukan'
                ], 404);
            }

            // Delete image from storage
            if ($vacancy->url_image && str_contains($vacancy->url_image, '/storage/jobs/')) {
                $oldPath = 'jobs/' . basename($vacancy->url_image);
                Storage::disk('public')->delete($oldPath);
            }

            $vacancy->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Lowongan kerja berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus lowongan kerja: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete job vacancies.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $vacancies = JobVacancy::whereIn('id', $ids)->get();
            foreach ($vacancies as $vacancy) {
                if ($vacancy->url_image && str_contains($vacancy->url_image, '/storage/jobs/')) {
                    $oldPath = 'jobs/' . basename($vacancy->url_image);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            JobVacancy::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Lowongan kerja berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus lowongan kerja: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk publish job vacancies.
     */
    public function bulkPublish(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            // Only update vacancies that are currently in 'draft' status
            $count = JobVacancy::whereIn('id', $ids)
                ->where('status', 'draft')
                ->update(['status' => 'published']);

            return response()->json([
                'status' => 'success',
                'message' => $count . ' lowongan kerja berhasil dipublikasikan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mempublikasikan lowongan kerja: ' . $e->getMessage()
            ], 500);
        }
    }
}
