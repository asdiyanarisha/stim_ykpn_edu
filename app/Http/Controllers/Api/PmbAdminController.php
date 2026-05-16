<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pmb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PmbAdminController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pmbs = Pmb::orderBy('created_at', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'data' => $pmbs
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data PMB: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $pmb = Pmb::findOrFail($id);
            return response()->json([
                'status' => 'success',
                'data' => $pmb
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data PMB tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pmb,email,'.$id,
            'nomor_hp_wa' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            'alamat_asal' => 'required|string',
            'asal_sekolah' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'sumber_informasi' => 'required|string|max:255',
            'jalur_registrasi' => 'required|string|max:255',
            'kode_voucher' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $pmb = Pmb::findOrFail($id);
            $pmb->update($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Data PMB berhasil diupdate',
                'data' => $pmb
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengupdate data PMB: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pmb = Pmb::findOrFail($id);
            $pmb->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data PMB berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data PMB'
            ], 500);
        }
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:pmb,id'
        ]);

        try {
            Pmb::whereIn('id', $request->ids)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data PMB terpilih berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus data PMB terpilih: ' . $e->getMessage()
            ], 500);
        }
    }
}
