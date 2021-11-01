<?php

namespace App\Http\Controllers;

use App\Http\Services\Contracts\JwtInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JwtController extends Controller
{
    private $jwtService;

    function __construct(JwtInterface $service)
    {
        $this->jwtService = $service;
    }

    public function generate(): string
    {
        return $this->jwtService->generateToken();
    }
}
