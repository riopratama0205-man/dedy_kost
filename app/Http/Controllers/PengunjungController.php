<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PengunjungController extends Controller
{
    public function pendaftaran(Request $request)
    {
        $request->validate([
            'namapenyewa' => 'required|string|max:255',
            'email' => 'required|email|unique:penyewa,email',
            'password' => 'required|min:6|confirmed',
            'telp' => 'required|string|max:15',
        ]);

        $pengunjung = new Pengunjung();
        $penyewa = $pengunjung->pendaftaran($request->all());

        if ($penyewa) {
            Auth::guard('web')->login($penyewa);
            return redirect()->route('user.dashboard')->with('success', 'Pendaftaran berhasil!');
        }

        return back()->with('error', 'Pendaftaran gagal.');
    }

}



