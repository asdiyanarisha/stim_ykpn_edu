<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PublicFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PublicFileController extends Controller
{
    /**
     * Display a listing of the public files.
     */
    public function index()
    {
        try {
            $files = PublicFile::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $files
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data file publik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created public file.
     */
    public function store(Request $request)
    {
        try {
            // Cek apakah request mengandung file
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                if (!$file->isValid()) {
                    $phpErrorCode = $file->getError();
                    $phpErrorMessages = [
                        UPLOAD_ERR_INI_SIZE   => 'File melebihi batas upload_max_filesize di php.ini (saat ini: ' . ini_get('upload_max_filesize') . ')',
                        UPLOAD_ERR_FORM_SIZE  => 'File melebihi batas MAX_FILE_SIZE yang ditentukan di form HTML',
                        UPLOAD_ERR_PARTIAL    => 'File hanya terunggah sebagian. Silakan coba lagi.',
                        UPLOAD_ERR_NO_FILE    => 'Tidak ada file yang diunggah.',
                        UPLOAD_ERR_NO_TMP_DIR => 'Folder temporary tidak ditemukan di server.',
                        UPLOAD_ERR_CANT_WRITE => 'Gagal menulis file ke disk server.',
                        UPLOAD_ERR_EXTENSION  => 'Ekstensi PHP menghentikan proses upload.',
                    ];
                    $errorMsg = $phpErrorMessages[$phpErrorCode] ?? 'Error upload tidak diketahui (kode: ' . $phpErrorCode . ')';

                    return response()->json([
                        'status' => 'error',
                        'message' => 'Upload file gagal: ' . $errorMsg,
                    ], 422);
                }
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png,zip,rar,xls,xlsx|max:10240',
            ], [
                'file.mimes' => 'Format file tidak didukung.',
                'file.max' => 'Ukuran file terlalu besar. Maksimal 10MB.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $file_path = null;
            $file_size = null;

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $storedPath = $file->store('public_files', 'public');

                if (!$storedPath) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan file ke storage.',
                    ], 500);
                }

                $file_path = asset(Storage::url($storedPath));
                
                // Format file size
                $size = $file->getSize();
                $file_size = $this->formatBytes($size);
            }

            $publicFile = PublicFile::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $file_path,
                'file_size' => $file_size,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'File publik berhasil ditambahkan',
                'data' => $publicFile
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan file publik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified public file.
     */
    public function show($id)
    {
        try {
            $file = PublicFile::find($id);

            if (!$file) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File publik tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $file
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail file publik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified public file.
     */
    public function update(Request $request, $id)
    {
        try {
            $publicFile = PublicFile::find($id);

            if (!$publicFile) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File publik tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png,zip,rar,xls,xlsx|max:10240',
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

            if ($request->hasFile('file')) {
                // Delete old file
                if ($publicFile->file_path) {
                    $oldPath = str_replace(asset(Storage::url('')), '', $publicFile->file_path);
                    Storage::disk('public')->delete($oldPath);
                }

                $file = $request->file('file');
                $storedPath = $file->store('public_files', 'public');
                $data['file_path'] = asset(Storage::url($storedPath));
                
                // Format file size
                $size = $file->getSize();
                $data['file_size'] = $this->formatBytes($size);
            }

            $publicFile->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'File publik berhasil diperbarui',
                'data' => $publicFile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui file publik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified public file.
     */
    public function destroy($id)
    {
        try {
            $file = PublicFile::find($id);

            if (!$file) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'File publik tidak ditemukan'
                ], 404);
            }

            if ($file->file_path) {
                $oldPath = str_replace(asset(Storage::url('')), '', $file->file_path);
                Storage::disk('public')->delete($oldPath);
            }

            $file->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'File publik berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus file publik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete public files.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $files = PublicFile::whereIn('id', $ids)->get();
            foreach ($files as $file) {
                if ($file->file_path) {
                    $oldPath = str_replace(asset(Storage::url('')), '', $file->file_path);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            PublicFile::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'File publik terpilih berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus file publik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Helper to format bytes to human readable size.
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
