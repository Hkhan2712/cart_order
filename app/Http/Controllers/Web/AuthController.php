<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\AuthServiceInterface;

class AuthController extends Controller
{
    public function __construct(
        protected AuthServiceInterface $authService
    )
    {}
    public function showRegisterForm() {
        return view('auth.register');
    }
    public function showLoginForm() {
        return view('auth.login');
    }

    public function register(Request $request) {
        $this->authService->register($request);
        return redirect('/')->with('success', 'Registed successfull');
    }

    public function login(Request $request) {
        if ($this->authService->login($request)) {
            return redirect('/')->with('success', 'Logged in successfully!');
        }
        return back()->withInput()->withErrors(['email' => 'Email or password wrong']);
    }

    public function logout(Request $request) {
        $this->authService->logout($request);
        return redirect('/')->with('success', 'Logged out!');
    }

    public function redirectToGoogle() {
        return $this->authService->redirectToGoogle();
    }

    public function handleGoogleCallback() {
        return $this->authService->handleGoogleCallback();
    }
}
