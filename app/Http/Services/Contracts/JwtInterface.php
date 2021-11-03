<?php
namespace App\Http\Services\Contracts;

interface JwtInterface
{
    public function generateToken();

    public function getDecodedJwtPayload(string $jwtToken);
}
