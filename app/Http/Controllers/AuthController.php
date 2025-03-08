<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function postLogin(Request $request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            $user = Auth::user();
            $roles = RoleUser::where('user_id', $user->id)->get();

            if ($roles->count() > 1) {
                return redirect()->route('select.role')->with('success', 'Pilih Hak Akses Yang Akan Digunakan!');
            } else if ($roles->count() == 1) {
                session(['selected_role' => $roles->first()->role]);
                return redirect()->intended('/dashboard');
            } else {
                Auth::logout();
                return redirect('/login')->with('error', 'Akun tidak memiliki akses!');
            }
        } else {
            return redirect('/login')->with('error', 'Username atau password salah!');
        }
        return redirect()->route('login')->with('error', 'Username atau password salah!');
    }
    public function login()
    {
        if (auth()->user() != null) {
            return redirect('dashboard');
        }
        return view('content.auth.login');
    }
    public function logout()
    {
        session()->forget('selected_role');
        Auth::guard('web')->logout();
        return redirect('/login');
    }
}
