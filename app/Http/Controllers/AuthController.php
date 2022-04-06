<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Services\LogService;
use App\Http\Traits\ImageTrait;

class AuthController extends Controller {
    
    use ImageTrait;
    public function login() {
        
        return view('auth.login');

    }
    
    public function register() {
        
        return view('auth.register_admin');

    }

    public function authenticate(Request $request) {
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {

            $request->session()->regenerate();

            (new LogService)->createLoginLogEntry();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
        
    }

    

    public function logout() {
        
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('login');

    }

}
