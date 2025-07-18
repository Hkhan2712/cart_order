<?php
namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface AuthServiceInterface {
    public function register(Request $request);
    public function login(Request $request): bool;
    public function logout(Request $request): void;
    public function redirectToGoogle();
    public function handleGoogleCallback();
}