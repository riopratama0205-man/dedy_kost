<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Villa;
use App\Models\Sewa;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $kostRooms = Kamar::with('sewa')->get();
        $villas = Villa::with('sewa')->get();

        return view('admin.rooms.index', compact('kostRooms', 'villas'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaunit' => 'nullable|string|max:255',
            'tipeunit' => 'required|string|in:kost,villa',
            'hargasewa' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'fasilitas' => 'nullable|string',
        ]);

        if ($request->tipeunit === 'kost') {
            $data = [
                'namakamar' => $request->namaunit,
                'tipekamar' => 'kost',
                'hargasewa' => $request->hargasewa,
                'deskripsi' => $request->deskripsi,
                'fasilitas' => $request->fasilitas,
                'status' => 'available',
            ];

            if (empty($data['namakamar'])) {
                $count = Kamar::count();
                $data['namakamar'] = 'Kamar ' . ($count + 1);
            }

            Kamar::create($data);
        } else {
            $data = [
                'namavilla' => $request->namaunit,
                'tipevilla' => 'villa',
                'hargasewa' => $request->hargasewa,
                'deskripsi' => $request->deskripsi,
                'fasilitas' => $request->fasilitas,
                'status' => 'available',
            ];

            if (empty($data['namavilla'])) {
                $count = Villa::count();
                $data['namavilla'] = 'Villa ' . ($count + 1);
            }

            Villa::create($data);
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Unit berhasil ditambahkan.');
    }

    public function show($id, Request $request)
    {
        $type = $request->get('type', 'kost');
        if ($type === 'villa') {
            $room = Villa::findOrFail($id);
            $bookedDates = Sewa::where('kdvilla', $id)
                ->whereIn('status', ['disetujui', 'menunggu'])
                ->get(['tglmulai as start_date', 'tglselesai as end_date', 'status']);
        } else {
            $room = Kamar::findOrFail($id);
            $bookedDates = Sewa::where('kdkamar', $id)
                ->whereIn('status', ['disetujui', 'menunggu'])
                ->get(['tglmulai as start_date', 'tglselesai as end_date', 'status']);
        }

        return view('admin.rooms.show', compact('room', 'bookedDates', 'type'));
    }

    public function edit($id, Request $request)
    {
        $type = $request->get('type', 'kost');
        if ($type === 'villa') {
            $room = Villa::findOrFail($id);
        } else {
            $room = Kamar::findOrFail($id);
        }
        return view('admin.rooms.edit', compact('room', 'type'));
    }

    public function update(Request $request, $id)
    {
        $type = $request->get('type', 'kost');

        if ($type === 'kost') {
            $request->validate([
                'namakamar' => 'required|string|max:255',
                'hargasewa' => 'required|numeric|min:0',
                'deskripsi' => 'nullable|string',
                'fasilitas' => 'nullable|string',
            ]);
            $room = Kamar::findOrFail($id);
            $room->update($request->all());
        } else {
            $request->validate([
                'namavilla' => 'required|string|max:255',
                'hargasewa' => 'required|numeric|min:0',
                'deskripsi' => 'nullable|string',
                'fasilitas' => 'nullable|string',
            ]);
            $room = Villa::findOrFail($id);
            $room->update($request->all());
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Unit berhasil diperbarui.');
    }

    public function destroy($id, Request $request)
    {
        $type = $request->get('type', 'kost');
        if ($type === 'villa') {
            $room = Villa::findOrFail($id);
        } else {
            $room = Kamar::findOrFail($id);
        }
        $room->delete();

        return back()->with('success', 'Unit berhasil dihapus.');
    }
}



