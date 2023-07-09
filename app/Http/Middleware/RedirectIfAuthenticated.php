<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
use App\Models\pk;
use App\Models\rw;
use App\Models\warga;

class RedirectIfAuthenticated
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        $roles = Role::all();
        
        foreach ($guards as $guard) {
			if (!empty($request->username)) {
				$user = User::where('username', $request->username)->first();
				if ($user) {
					$active = $this->checkAccountStatus($user);

					if ($active == "0") {
						return back()->with('gagal', 'Akun Tidak Aktif');
					}
				} else {
					return back()->with('gagal', 'User tidak ditemukan');
				}
			}
			else if (Auth::guard($guard)->check()) {
                foreach ($roles as $role) 
                {
                    if (auth($guard)->user()->role_id == $role->id) {
                        return redirect($role->redirectTo);
                    }
                }
            }
    	}
        return $next($request);
    }

    private function checkAccountStatus($user)
    {
        if ($user->role_id == "3" || $user->role_id == "2") {
            return pk::where('user_id', $user->id)->first()->status_pk;
        } elseif ($user->role_id == "4") {
            return rw::where('user_id', $user->id)->first()->status_rw;
        } elseif ($user->role_id == "6") {
            return warga::where('user_id', $user->id)->withTrashed()->first()->active;
        }
        
        return "1";
    }
}
