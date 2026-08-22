<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $messages = Pesan::where('idpenyewa', $user->idpenyewa)
            ->orderBy('tgl', 'desc')
            ->paginate(10);

        return view('user.messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $user = Auth::guard('web')->user();

        Pesan::create([
            'idpenyewa' => $user->idpenyewa,
            'nama' => $user->namapenyewa,
            'email' => $user->email,
            'telp' => $user->telp,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tgl' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('user.messages.index')->with('success', 'Pesan berhasil dikirim.');
    }
}
