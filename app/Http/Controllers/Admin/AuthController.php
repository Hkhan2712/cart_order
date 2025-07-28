<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller {
    public function __construct(protected AuthService $authService) {
    }
    public function showLoginForm() {
        return view('admin.auth.login');
    }

    public function login(Request $request) {
        if ($this->authService->login($request)) {
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->withInput()->withErrors(['email' => 'Email or password wrong']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login.form');
    }
}