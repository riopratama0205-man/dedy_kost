<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class GuestMessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telp' => 'nullable|string|max:20',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Pesan::create([
            'idpenyewa' => null, // Tamu tidak punya ID Penyewa
            'nama' => $request->nama,
            'email' => $request->email,
            'telp' => $request->telp,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tgl' => now(),
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim. Kami akan menghubungi Anda segera.');
    }
}
