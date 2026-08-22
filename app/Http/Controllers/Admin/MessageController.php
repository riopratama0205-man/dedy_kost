<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Pesan::orderBy('tgl', 'desc')->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Pesan::findOrFail($id);

        // Mark as read if pending
        if ($message->status === 'pending') {
            $message->status = 'read';
            $message->save();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'balasan' => 'required|string',
        ]);

        $message = Pesan::findOrFail($id);

        $message->balasan = $request->balasan;
        $message->tglbalas = now();
        $message->idadmin = Auth::guard('admin')->user()->idadmin;
        $message->status = 'replied';
        $message->save();

        return back()->with('success', 'Balasan berhasil dikirim.');
    }

    public function destroy($id)
    {
        $message = Pesan::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
