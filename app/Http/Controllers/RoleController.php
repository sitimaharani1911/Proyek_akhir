<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function selectRole()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $roles = RoleUser::where('user_id', Auth::id())
            ->get();

        return view('content.auth.select-role', compact('roles'));
    }

    public function setRole(Request $request)
    {
        $request->validate([
            'role' => 'required',
        ]);

        $hasRole = RoleUser::where('user_id', Auth::id())
            ->where('role', $request->role)
            ->exists();

        if (!$hasRole) {
            return redirect()->route('select.role')->with('error', 'Invalid role selection');
        }

        session(['selected_role' => $request->role]);

        return redirect('/dashboard');
    }
}
