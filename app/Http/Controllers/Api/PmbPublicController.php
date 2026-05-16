<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pmb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;

class PmbPublicController extends Controller
{
    /**
     * Store a newly created PMB registration in storage.
     * Endpoint ini diset public dan menggunakan throttle middleware untuk anti-bruteforce.
     * Eloquent ORM Laravel secara otomatis menggunakan PDO parameter binding yang mengamankan dari SQL Injection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Anti-Bruteforce: Batasi 1 request per 10 detik berdasarkan IP Address
        $rateLimitKey = 'pmb-register:' . $request->ip();
        
        if (RateLimiter::tooManyAttempts($rateLimitKey, 1)) {
            $seconds = RateLimiter::availableIn($rateLimitKey);
            return response()->json([
                'success' => false,
                'message' => 'Terlalu banyak permintaan. Silakan coba lagi dalam ' . $seconds . ' detik.',
            ], 429);
        }
        
        // Catat request ini dan kunci selama 10 detik
        RateLimiter::hit($rateLimitKey, 10);

        // Validasi data untuk memastikan struktur data benar dan mencegah mass-assignment sembarangan
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:pmb,email|max:255',
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
                'success' => false,
                'message' => 'Validasi data gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Data divalidasi, aman untuk dimasukkan ke database
            $pmb = Pmb::create($validator->validated());

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran Mahasiswa Baru berhasil disubmit.',
                'data' => $pmb
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan internal server saat menyimpan data.',
                // 'error' => $e->getMessage() // Uncomment untuk debug di development
            ], 500);
        }
    }
}
