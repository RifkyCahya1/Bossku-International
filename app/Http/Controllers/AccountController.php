<?php

namespace App\Http\Controllers;

use App\Models\BossUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AccountController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $users = BossUser::orderBy('id', 'desc')->get();

        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"     => "required|string|max:255",
            "email"    => "required|email|max:255|unique:boss_users,email",
            "password" => "required|string|min:6",
            "role"     => "required|in:user,admin,superadmin",
        ]);

        BossUser::create([
            "name"     => $request->name,
            "email"    => $request->email,
            "password" => Hash::make($request->password),
            "role"     => $request->role,
        ]);

        return redirect()->back()->with("success", "User berhasil ditambahkan!");
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manage-users');

        $user = BossUser::findOrFail($id);

        $request->validate([
            "name"  => "required|string|max:255",
            "email" => "required|email|max:255|unique:boss_users,email,$id",
            "role"  => "required|in:user,admin,superadmin",
        ]);

        $user->update([
            "name"  => $request->name,
            "email" => $request->email,
            "role"  => $request->role,
        ]);

        return redirect()->back()->with("success", "User berhasil diperbarui!");
    }

    public function delete($id)
    {
        $this->authorize('manage-users');

        BossUser::findOrFail($id)->delete();

        return redirect()->back()->with("success", "User berhasil dihapus!");
    }
}
