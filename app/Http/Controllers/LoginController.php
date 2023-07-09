<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pk;
use App\Models\rw;
use App\Models\warga;


class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',

        ]);

        $user = User::find($request->username)->get();
        
        if($user->role_id == "3") // PK
        {
            $active = pk::find($user->user_id)->status_pk;
        }
        else if($user->role_id == "4") // RW
        {
            $active = rw::find($user->user_id)->status_rw;
        }
        else if($user->role_id == "6") // Warga
        {
            $active = warga::find($user->user_id)->active;
        }
        
            if (Auth::attempt($credentials)) {
                if($active == "1")
                {
                    $request->session()->regenerate();
                    return redirect()->intended('/');
                }
                else
                {
                    //return back()->with('loginError', 'Akun tidak aktif');
                }
            }
        
        

        return back()->with('loginError', 'Username atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/c_login_rw');
    }
}
