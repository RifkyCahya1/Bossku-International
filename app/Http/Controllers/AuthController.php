<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $messages = [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ];

        $user = User::where('email_users', $request->email)->first();

        if ($user && Hash::check($request->password, $user->pass_users)) {
            Auth::login($user);

            return $user->role === 'admin'
                ? redirect()->route('admin.app')
                : redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }
    
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email_users',
            'password' => 'required|string|min:8|confirmed',
        ], [ 
            'name.required' => 'Nama wajib diisi.', 
            'email.required' => 'Email wajib diisi.', 
            'email.email' => 'Format email tidak valid.', 
            'email.unique' => 'Email sudah terdaftar.', 
            'password.required' => 'Password wajib diisi.', 
            'password.min' => 'Password minimal 8 karakter.', 
            'password.confirmed' => 'Konfirmasi password tidak sama.', 
        ]);

        $user = User::create([
            'name_users' => $request->name,
            'email_users' => $request->email,
            'pass_users' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);

        return $user->role === 'admin'
            ? redirect()->route('admin.app')
            : redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('status', 'Kamu sudah logout.');
    }
}
