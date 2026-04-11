<?php

namespace App\Helpers;

/**
 * Helper class untuk generate dan validasi JWT (JSON Web Token).
 *
 * Implementasi murni PHP tanpa library eksternal.
 * Menggunakan HMAC-SHA256 sebagai algoritma signing.
 */
class JwtHelper
{
    /**
     * Algoritma yang digunakan untuk signing.
     */
    private const ALGORITHM = 'HS256';

    /**
     * Mendapatkan secret key dari environment.
     */
    private static function getSecret(): string
    {
        $secret = config('app.jwt_secret', env('JWT_SECRET'));

        if (empty($secret)) {
            // Fallback ke APP_KEY jika JWT_SECRET belum diset
            $secret = config('app.key');
        }

        return $secret;
    }

    /**
     * Encode data ke Base64 URL-safe.
     */
    private static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Decode data dari Base64 URL-safe.
     */
    private static function base64UrlDecode(string $data): string
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }

    /**
     * Generate JWT token.
     *
     * @param array $payload Data yang akan disimpan di dalam token.
     * @param int   $expiry  Waktu kadaluarsa dalam detik (default: 3600 = 1 jam).
     * @return string JWT token string.
     */
    public static function generate(array $payload, int $expiry = 3600): string
    {
        // Header
        $header = self::base64UrlEncode(json_encode([
            'alg' => self::ALGORITHM,
            'typ' => 'JWT',
        ]));

        // Payload — tambahkan standard claims
        $payload = array_merge($payload, [
            'iat' => time(),               // Issued At
            'exp' => time() + $expiry,     // Expiration
            'jti' => bin2hex(random_bytes(16)), // JWT ID (unique)
        ]);

        $payloadEncoded = self::base64UrlEncode(json_encode($payload));

        // Signature
        $signature = self::base64UrlEncode(
            hash_hmac('sha256', "{$header}.{$payloadEncoded}", self::getSecret(), true)
        );

        return "{$header}.{$payloadEncoded}.{$signature}";
    }

    /**
     * Validasi dan decode JWT token.
     *
     * @param string $token JWT token string.
     * @return array{valid: bool, payload: array|null, error: string|null}
     */
    public static function validate(string $token): array
    {
        $parts = explode('.', $token);

        // Token harus terdiri dari 3 bagian: header.payload.signature
        if (count($parts) !== 3) {
            return [
                'valid'   => false,
                'payload' => null,
                'error'   => 'Format token tidak valid. Token harus memiliki 3 segment.',
            ];
        }

        [$header, $payloadEncoded, $signature] = $parts;

        // Verifikasi signature
        $expectedSignature = self::base64UrlEncode(
            hash_hmac('sha256', "{$header}.{$payloadEncoded}", self::getSecret(), true)
        );

        if (!hash_equals($expectedSignature, $signature)) {
            return [
                'valid'   => false,
                'payload' => null,
                'error'   => 'Signature token tidak valid. Token mungkin telah dimodifikasi.',
            ];
        }

        // Decode payload
        $payload = json_decode(self::base64UrlDecode($payloadEncoded), true);

        if ($payload === null) {
            return [
                'valid'   => false,
                'payload' => null,
                'error'   => 'Payload token tidak dapat di-decode.',
            ];
        }

        // Cek expiry
        if (isset($payload['exp']) && $payload['exp'] < time()) {
            return [
                'valid'   => false,
                'payload' => $payload,
                'error'   => 'Token sudah kadaluarsa (expired).',
            ];
        }

        return [
            'valid'   => true,
            'payload' => $payload,
            'error'   => null,
        ];
    }
}
