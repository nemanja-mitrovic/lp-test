<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\JwtInterface;

class JwtService implements JwtInterface
{
    private const JWT_HEADER = ['typ' => 'JWT', 'alg' => 'HS256'];

    const EXPIRES_IN = 10;

    public function generateToken(): string
    {
        // Encode Header to Base64Url String
        $base64UrlHeader = $this->encodeBase64(json_encode(self::JWT_HEADER));

        // Encode Payload to Base64Url String
        $base64UrlPayload = $this->encodeBase64(json_encode(['exp' => self::EXPIRES_IN]));

        // Encode Signature to Base64Url String
        $base64UrlSignature = $this->encodeBase64($this->createSignatureHash($base64UrlHeader,$base64UrlPayload));

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }

    private function encodeBase64(string $section): string
    {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($section));
    }

    private function createSignatureHash(string $encodedHeader, string $encodedPayload): string
    {
        return hash_hmac(
            'sha256',
            $encodedHeader . "." . $encodedPayload,
            env('JWT_SECRET'), true);
    }
}
