<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brochure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrochureController extends Controller
{
    /**
     * Display a listing of the brochures.
     */
    public function index()
    {
        try {
            $brochures = Brochure::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $brochures
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data brosur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created brochure.
     */
    public function store(Request $request)
    {
        try {
            // Debug: log semua file yang diterima
            $uploadErrors = [];

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
                        'debug' => [
                            'php_error_code' => $phpErrorCode,
                            'upload_max_filesize' => ini_get('upload_max_filesize'),
                            'post_max_size' => ini_get('post_max_size'),
                            'file_name' => $file->getClientOriginalName(),
                            'file_size_bytes' => $file->getSize(),
                        ]
                    ], 422);
                }
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
            ], [
                'file.mimes' => 'Format file tidak didukung. Gunakan: PDF, DOC, DOCX, PPT, PPTX, JPG, JPEG, atau PNG.',
                'file.max' => 'Ukuran file terlalu besar. Maksimal 10MB (10240 KB). Upload max server: ' . ini_get('upload_max_filesize'),
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                    'debug' => [
                        'has_file' => $request->hasFile('file'),
                        'all_files' => array_keys($request->allFiles()),
                        'upload_max_filesize' => ini_get('upload_max_filesize'),
                        'post_max_size' => ini_get('post_max_size'),
                    ]
                ], 422);
            }

            $file_path = null;
            $file_size = null;

            if ($request->hasFile('file')) {
                $file = $request->file('file');

                $storedPath = $file->store('brochures', 'public');

                if (!$storedPath) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan file ke storage. Pastikan folder storage/app/public/brochures memiliki izin tulis.',
                        'debug' => [
                            'disk' => 'public',
                            'target_dir' => 'brochures',
                            'storage_path' => storage_path('app/public/brochures'),
                        ]
                    ], 500);
                }

                $file_path = asset(Storage::url($storedPath));

                // Format file size
                $size = $file->getSize();
                $file_size = $this->formatBytes($size);
            }

            $brochure = Brochure::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $file_path,
                'file_size' => $file_size,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Brosur berhasil ditambahkan',
                'data' => $brochure
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menambahkan brosur: ' . $e->getMessage(),
                'debug' => [
                    'exception' => get_class($e),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            ], 500);
        }
    }

    /**
     * Display the specified brochure.
     */
    public function show($id)
    {
        try {
            $brochure = Brochure::find($id);

            if (!$brochure) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Brosur tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $brochure
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil detail brosur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified brochure.
     */
    public function update(Request $request, $id)
    {
        try {
            $brochure = Brochure::find($id);

            if (!$brochure) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Brosur tidak ditemukan'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
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
                if ($brochure->file_path) {
                    $oldPath = str_replace(asset(Storage::url('')), '', $brochure->file_path);
                    Storage::disk('public')->delete($oldPath);
                }

                $file = $request->file('file');
                $file_path = $file->store('brochures', 'public');
                $data['file_path'] = asset(Storage::url($file_path));
                
                // Format file size
                $size = $file->getSize();
                $data['file_size'] = $this->formatBytes($size);
            }

            $brochure->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Brosur berhasil diperbarui',
                'data' => $brochure
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memperbarui brosur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified brochure.
     */
    public function destroy($id)
    {
        try {
            $brochure = Brochure::find($id);

            if (!$brochure) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Brosur tidak ditemukan'
                ], 404);
            }

            if ($brochure->file_path) {
                $oldPath = str_replace(asset(Storage::url('')), '', $brochure->file_path);
                Storage::disk('public')->delete($oldPath);
            }

            $brochure->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Brosur berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus brosur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Bulk delete brochures.
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $ids = $request->ids;
            if (!is_array($ids) || empty($ids)) {
                return response()->json(['status' => 'error', 'message' => 'No IDs provided'], 400);
            }

            $brochures = Brochure::whereIn('id', $ids)->get();
            foreach ($brochures as $brochure) {
                if ($brochure->file_path) {
                    $oldPath = str_replace(asset(Storage::url('')), '', $brochure->file_path);
                    Storage::disk('public')->delete($oldPath);
                }
            }

            Brochure::whereIn('id', $ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Brosur terpilih berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus brosur: ' . $e->getMessage()
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
