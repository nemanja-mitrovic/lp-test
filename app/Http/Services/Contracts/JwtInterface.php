<?php
namespace App\Http\Services\Contracts;

interface JwtInterface
{
    public function generateToken();
}
