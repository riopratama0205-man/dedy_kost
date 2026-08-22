<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::guard('web')->user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();

        $request->validate([
            'namapenyewa' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:penyewa,email,' . $user->idpenyewa . ',idpenyewa',
            'telp' => 'required|string|max:20',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
            }
        }

        $user->namapenyewa = $request->namapenyewa;
        $user->email = $request->email;
        $user->telp = $request->telp;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}




