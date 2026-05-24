<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpmiAkreditasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpmiAkreditasiController extends Controller
{
    /**
     * Display the first SPMI & Akreditasi record.
     */
    public function show()
    {
        try {
            $data = SpmiAkreditasi::first();

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data SPMI & Akreditasi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store or Update the single SPMI & Akreditasi record.
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'dasar_hukum' => 'nullable|string',
                'dokumen_spmi' => 'nullable|string',
                'dokumen_akreditasi' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $currentData = SpmiAkreditasi::first();
            
            $fields = [
                'dasar_hukum' => $request->dasar_hukum,
                'dokumen_spmi' => $request->dokumen_spmi,
                'dokumen_akreditasi' => $request->dokumen_akreditasi,
            ];

            if ($currentData) {
                $currentData->update($fields);
                $message = 'Data SPMI & Akreditasi berhasil diperbarui';
            } else {
                $currentData = SpmiAkreditasi::create($fields);
                $message = 'Data SPMI & Akreditasi berhasil dibuat';
            }

            return response()->json([
                'status' => 'success',
                'message' => $message,
                'data' => $currentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan data SPMI & Akreditasi: ' . $e->getMessage()
            ], 500);
        }
    }
}
