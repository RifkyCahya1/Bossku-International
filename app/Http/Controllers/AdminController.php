<?php

namespace App\Http\Controllers;

use App\Models\BossUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $activeTours = DB::table('LT_itinerary2 as iti')
            ->leftJoin('LT_itinnew as det', 'det.kode', '=', 'iti.landtour')
            ->leftJoin('LT_itin_profit_range as pr', function ($join) {
                $join->whereColumn('det.agent_twn', '>=', 'pr.price1')
                    ->whereColumn('det.agent_twn', '<=', 'pr.price2');
            })
            ->where('det.negara', 'INDONESIA')
            ->where('det.agent_twn', '>', 0)
            ->where('det.pax', '<', 4)
            ->get()
            ->groupBy(fn($item) => $item->judul . '|' . $item->landtour)
            ->map(fn($g) => $g->first())
            ->count();

        // Count users
        $totalUsers = BossUser::count();

        return view('admin.app', compact('totalUsers', 'activeTours'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:boss_users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Account updated successfully!');
    }
}
