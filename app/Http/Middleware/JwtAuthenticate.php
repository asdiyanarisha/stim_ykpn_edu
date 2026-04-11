<?php

namespace App\Http\Middleware;

use App\Helpers\JwtHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware untuk memvalidasi JWT token pada setiap request.
 *
 * Cara penggunaan di route:
 *   Route::middleware('jwt.auth')->group(function () { ... });
 */
class JwtAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Authorization');

        // Cek apakah header Authorization ada
        if (!$header || !str_starts_with($header, 'Bearer ')) {
            return response()->json([
                'status'  => 'error',
                'code'    => 401,
                'message' => 'Akses ditolak. Token autentikasi tidak ditemukan. Sertakan header Authorization dengan format: Bearer {token}',
                'data'    => null,
            ], 401);
        }

        $token = trim(substr($header, 7));

        // Validasi token
        $result = JwtHelper::validate($token);

        if (!$result['valid']) {
            return response()->json([
                'status'  => 'error',
                'code'    => 401,
                'message' => $result['error'],
                'data'    => null,
            ], 401);
        }

        // Validasi ekstra: Cek ke database apakah user benar-benar masih ada
        $user = \App\Models\User::where('name', $result['payload']['username'] ?? '')->first();

        if (!$user) {
            return response()->json([
                'status'  => 'error',
                'code'    => 401,
                'message' => 'Token valid, namun akun pengguna tidak ditemukan di sistem.',
                'data'    => null,
            ], 401);
        }

        // Simpan data user (bisa dari DB langsung atau dari JWT) ke dalam request
        $request->attributes->set('jwt_user', [
            'username'   => $user->name,
            'role_id'    => $user->role_id,
            'issued_at'  => date('Y-m-d H:i:s', $result['payload']['iat']),
            'expires_at' => date('Y-m-d H:i:s', $result['payload']['exp']),
        ]);

        return $next($request);
    }
}
