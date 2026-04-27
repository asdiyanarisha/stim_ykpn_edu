<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArticleTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArticleTeacherController extends Controller
{
    /**
     * Display a listing of the research journals.
     */
    public function index()
    {
        try {
            $journals = ArticleTeacher::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $journals
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data jurnal penelitian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created journal record.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'type_article' => 'required|string|max:255',
                'author' => 'nullable|string|max:255',
                'year' => 'nullable|string|max:4',
                'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:10240',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $file_path = null;
            if ($request->hasFile('file')) {
                // Save to storage/public/journals
                $path = $request->file('file')->store('journals', 'public');
                $url = Storage::url($path);
                $file_path = asset($url);
            }

            $journal = ArticleTeacher::create([
                'title' => $request->title,
                'type_article' => $request->type_article,
                'author' => $request->author,
                'year' => $request->year,
                'file_path' => $file_path,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Jurnal penelitian berhasil dibuat',
                'data' => $journal
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat jurnal penelitian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified journal.
     */
    public function show($id)
    {
        try {
            $journal = ArticleTeacher::find($id);

            if (!$journal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jurnal penelitian tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $journal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail jurnal penelitian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified journal record.
     */
    public function update(Request $request, $id)
    {
        try {
            $journal = ArticleTeacher::find($id);

            if (!$journal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jurnal penelitian tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'type_article' => 'required|string|max:255',
                'author' => 'nullable|string|max:255',
                'year' => 'nullable|string|max:4',
                'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:10240',
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
                'type_article' => $request->type_article,
                'author' => $request->author,
                'year' => $request->year,
            ];

            if ($request->hasFile('file')) {
                // Delete old file if it exists
                if ($journal->file_path && str_contains($journal->file_path, '/storage/journals/')) {
                    $oldPath = 'journals/' . basename($journal->file_path);
                    Storage::disk('public')->delete($oldPath);
                }

                $path = $request->file('file')->store('journals', 'public');
                $url = Storage::url($path);
                $data['file_path'] = asset($url);
            }

            $journal->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Jurnal penelitian berhasil diperbarui',
                'data' => $journal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui jurnal penelitian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified journal record.
     */
    public function destroy($id)
    {
        try {
            $journal = ArticleTeacher::find($id);

            if (!$journal) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Jurnal penelitian tidak ditemukan'
                ], 404);
            }

            // Delete file from storage
            if ($journal->file_path && str_contains($journal->file_path, '/storage/journals/')) {
                $oldPath = 'journals/' . basename($journal->file_path);
                Storage::disk('public')->delete($oldPath);
            }

            $journal->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Jurnal penelitian berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus jurnal penelitian: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete journals.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $journalItems = ArticleTeacher::whereIn('id', $ids)->get();
            foreach ($journalItems as $journal) {
                if ($journal->file_path && str_contains($journal->file_path, '/storage/journals/')) {
                    $oldPath = 'journals/' . basename($journal->file_path);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            ArticleTeacher::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Jurnal penelitian berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus jurnal penelitian: ' . $e->getMessage()
            ], 500);
        }
    }
}
