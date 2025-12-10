<?php

namespace App\Http\Controllers;

use App\Models\BossUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        $users = BossUser::all();
        return view('admin.component.account', compact('users'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6'
        ]);

        BossUser::create([
            'name' => $req->name,
            'email' => $req->email,
            'role' => $req->role,
            'password' => Hash::make($req->password)
        ]);

        return back()->with('success', 'Akun berhasil ditambahkan.');
    }

    public function update(Request $req, $id)
    {
        $user = BossUser::findOrFail($id);

        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
        ]);

        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = $req->role;

        if ($req->password) {
            $user->password = Hash::make($req->password);
        }

        $user->save();

        return back()->with('success', 'Akun berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = BossUser::findOrFail($id);

        // superadmin tidak boleh delete dirinya sendiri
        if (auth()->id() == $id) {
            return back()->with('error', 'Tidak bisa hapus akun sendiri.');
        }

        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
