<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $user = Auth::guard('admin')->user();

        $request->validate([
            'namaadmin' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('admin', 'email')->ignore($user->idadmin, 'idadmin')],
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->namaadmin = $request->namaadmin;
        $user->email = $request->email;

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
            }

            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->new_password);
            }
        }

        $user->save();

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}



