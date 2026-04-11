<?php

namespace App\Http\Controllers\Api;

use App\Helpers\JwtHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controller untuk autentikasi JWT.
 *
 * Catatan:
 * - Terkoneksi dengan database (tabel users).
 * - Fokus pada mekanisme generate JWT dan validasi session JWT.
 */
class AuthController extends Controller
{
    /**
     * Durasi token dalam detik (1 jam).
     */
    private const TOKEN_EXPIRY = 3600;

    /**
     * POST /api/auth/login
     *
     * Melakukan login dan menghasilkan JWT token.
     *
     * @bodyParam username string required Username pengguna.
     * @bodyParam password string required Password pengguna.
     *
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Cek apakah username ada di database
        $user = User::where('name', $username)->first();

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'code'    => 401,
                'message' => 'Login gagal. Username tidak ditemukan.',
                'data'    => null,
            ], 401);
        }

        // Cek apakah password cocok
        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'status'  => 'error',
                'code'    => 401,
                'message' => 'Login gagal. Password yang Anda masukkan salah.',
                'data'    => null,
            ], 401);
        }

        // Generate JWT token
        $token = JwtHelper::generate([
            'sub'      => $username,
            'username' => $username,
            'role_id'  => $user->role_id,
        ], self::TOKEN_EXPIRY);

        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Login berhasil.',
            'data'    => [
                'token'      => $token,
                'token_type' => 'Bearer',
                'expires_in' => self::TOKEN_EXPIRY,
                'user'       => [
                    'username' => $username,
                    'role_id'  => $user->role_id,
                ],
            ],
        ], 200);
    }

    /**
     * POST /api/auth/validate-token
     *
     * Memvalidasi apakah JWT token masih valid atau tidak.
     *
     * @header Authorization Bearer {token}
     *
     * @return JsonResponse
     */
    public function validateToken(Request $request): JsonResponse
    {
        $token = $this->extractToken($request);

        if (!$token) {
            return response()->json([
                'status'  => 'error',
                'code'    => 401,
                'message' => 'Token tidak ditemukan. Sertakan token di header Authorization dengan format: Bearer {token}',
                'data'    => null,
            ], 401);
        }

        $result = JwtHelper::validate($token);

        if (!$result['valid']) {
            return response()->json([
                'status'  => 'error',
                'code'    => 401,
                'message' => $result['error'],
                'data'    => null,
            ], 401);
        }

        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Token valid.',
            'data'    => [
                'username'   => $result['payload']['username'] ?? null,
                'role_id'    => $result['payload']['role_id'] ?? null,
                'issued_at'  => date('Y-m-d H:i:s', $result['payload']['iat']),
                'expires_at' => date('Y-m-d H:i:s', $result['payload']['exp']),
            ],
        ], 200);
    }

    /**
     * GET /api/auth/me
     *
     * Mendapatkan informasi user yang sedang login berdasarkan token.
     * Endpoint ini dilindungi oleh middleware JWT.
     *
     * @header Authorization Bearer {token}
     *
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        // Data user sudah di-set oleh middleware
        $user = $request->attributes->get('jwt_user');

        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Data user berhasil diambil.',
            'data'    => $user,
        ], 200);
    }

    /**
     * Mengambil token dari header Authorization.
     */
    private function extractToken(Request $request): ?string
    {
        $header = $request->header('Authorization');

        if (!$header || !str_starts_with($header, 'Bearer ')) {
            return null;
        }

        return trim(substr($header, 7));
    }
}
