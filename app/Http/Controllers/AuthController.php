<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BossUser;

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
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = BossUser::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            if (in_array($user->role, ['superadmin', 'admin'])) {
                return redirect()->route('admin.app');
            }

            if ($user->role === 'partner') {
                return redirect()->route('partner.app');
            }

            return redirect()->route('home');
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
        // Register publik selalu menghasilkan role 'user'
        // Minimal password 8 karakter untuk user & partner
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:boss_users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        $user = BossUser::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user', // selalu 'user', tidak bisa dimanipulasi
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    // Khusus superadmin: membuat akun admin, partner, atau user baru
    public function showCreateUser()
    {
        // Pastikan hanya superadmin yang bisa akses
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Akses ditolak.');
        }

        return view('admin.create-user');
    }

    public function createUser(Request $request)
    {
        // Pastikan hanya superadmin yang bisa akses
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Akses ditolak.');
        }

        $role = $request->input('role', 'user');

        // Minimal password berdasarkan role (server-side, tidak bisa dimanipulasi)
        $minPassword = in_array($role, ['superadmin', 'admin']) ? 4 : 8;

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:boss_users,email',
            'password' => "required|string|min:{$minPassword}|confirmed",
            'role'     => 'required|in:superadmin,admin,partner,user',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => "Password minimal {$minPassword} karakter untuk role {$role}.",
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'role.required'      => 'Role wajib dipilih.',
            'role.in'            => 'Role tidak valid.',
        ]);

        BossUser::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $role,
        ]);

        return redirect()->back()->with('success', "Akun {$role} berhasil dibuat.");
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        $user = Auth::user();

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profile updated!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Minimal password berdasarkan role user yang sedang login
        $minPassword = in_array($user->role, ['superadmin', 'admin']) ? 4 : 8;

        $request->validate([
            'current_password' => 'required',
            'password'         => "required|min:{$minPassword}|confirmed",
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'password.required'         => 'Password baru wajib diisi.',
            'password.min'              => "Password minimal {$minPassword} karakter.",
            'password.confirmed'        => 'Konfirmasi password tidak sama.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama salah!');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated!');
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah, bro. Coba dicek maneh. 😅');
        }

        Auth::logout();
        $user->delete();

        return redirect()->route('login')
            ->with('status', 'Akunmu wis kehapus. Semoga ketemu maneh nang dunia maya 🤝');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')
            ->with('status', 'You Have Been Logged Out.');
    }
}
