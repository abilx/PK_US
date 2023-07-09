<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{

    public function show($id)
    {
        $user = User::find($id);

        return view('Admin.ProfileAdmin.profile-admin-tes', [
            'user' => $user,
            "title" => "profile-admin"
        ]);
    }

    public function update(Request $request)
    {
        if ($request->username) {
            $validatedData = $request->validate([
                'username' => 'required|unique:users,username'
            ]);
            User::where('id', $request->user_id)
                ->update($validatedData);
            return redirect()->route('profile.show', $request->id)->with('success', 'Username berhasil diubah!');
        }

        if ($request->password) {
            $validatedData = $request->validate([
                'password' => 'required'
            ]);
            $validatedData['password'] = Hash::make($request->password);
            User::where('id', $request->user_id)
                ->update($validatedData);
            return redirect()->route('profile.show', $request->id)->with('success', 'Password berhasil diubah!');
        }
    }
}
