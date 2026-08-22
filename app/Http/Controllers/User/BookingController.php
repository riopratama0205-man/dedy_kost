<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Villa;
use App\Models\Sewa;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        return view('user.rooms.index');
    }

    public function list($type)
    {
        if ($type === 'villa') {
            $rooms = Villa::all();
        } else {
            $rooms = Kamar::all();
        }
        return view('user.rooms.list', compact('rooms', 'type'));
    }

    public function show($id, Request $request)
    {
        $type = $request->get('type', 'kost');
        if ($type === 'villa') {
            $room = Villa::findOrFail($id);
            $bookedDates = Sewa::where('kdvilla', $id)
                ->whereIn('status', ['disetujui', 'menunggu'])
                ->get(['tglmulai as start_date', 'tglselesai as end_date']);
        } else {
            $room = Kamar::findOrFail($id);
            $bookedDates = Sewa::where('kdkamar', $id)
                ->whereIn('status', ['disetujui', 'menunggu'])
                ->get(['tglmulai as start_date', 'tglselesai as end_date']);
        }

        // Get active payment method
        $paymentMethod = \App\Models\MetodePembayaran::where('aktif', 1)->first();

        return view('user.rooms.show', compact('room', 'bookedDates', 'type', 'paymentMethod'));
    }

    public function create($id, Request $request)
    {
        $type = $request->get('type', 'kost');
        if ($type === 'villa') {
            $room = Villa::findOrFail($id);
            $bookedDates = Sewa::where('kdvilla', $id)
                ->whereIn('status', ['disetujui', 'menunggu'])
                ->get(['tglmulai as start_date', 'tglselesai as end_date']);
        } else {
            $room = Kamar::findOrFail($id);
            $bookedDates = Sewa::where('kdkamar', $id)
                ->whereIn('status', ['disetujui', 'menunggu'])
                ->get(['tglmulai as start_date', 'tglselesai as end_date']);
        }

        $paymentMethod = MetodePembayaran::first();

        return view('user.bookings.create', compact('room', 'bookedDates', 'paymentMethod', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tglmulai' => 'required|date|after_or_equal:today',
            'tglselesai' => 'required|date|after:tglmulai',
            'payment_method' => 'required|in:transfer,cash',
            'buktibayar' => 'required_if:payment_method,transfer|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $type = $request->get('type', 'kost');
        $kdkamar = null;
        $kdvilla = null;
        $hargasewa = 0;

        if ($type === 'villa') {
            $villa = Villa::findOrFail($request->id);
            $kdvilla = $villa->kdvilla;
            $hargasewa = $villa->hargasewa;
        } else {
            $kamar = Kamar::findOrFail($request->id);
            $kdkamar = $kamar->kdkamar;
            $hargasewa = $kamar->hargasewa;
        }

        $start = Carbon::parse($request->tglmulai);
        $end = Carbon::parse($request->tglselesai);

        // Check for overlapping bookings (only menunggu and disetujui block new bookings)
        $query = Sewa::whereIn('status', ['menunggu', 'disetujui'])
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('tglmulai', [$start, $end])
                    ->orWhereBetween('tglselesai', [$start, $end])
                    ->orWhere(function ($sq) use ($start, $end) {
                        $sq->where('tglmulai', '<=', $start)
                            ->where('tglselesai', '>=', $end);
                    });
            });

        if ($type === 'villa') {
            $query->where('kdvilla', $kdvilla);
        } else {
            $query->where('kdkamar', $kdkamar);
        }

        if ($query->exists()) {
            $unitName = $type === 'villa' ? ($villa->namavilla ?? 'Villa') : ($kamar->namakamar ?? 'Kamar');
            return back()->withErrors(['tglmulai' => $unitName . ' tidak tersedia pada tanggal yang dipilih. Silakan pilih tanggal lain atau unit berbeda.'])->withInput();
        }

        $days = $start->diffInDays($end) ?: 1;
        $totalbayar = $hargasewa * $days;

        $paymentProofPath = null;
        if ($request->hasFile('buktibayar')) {
            $paymentProofPath = $request->file('buktibayar')->store('payment_proofs', 'public');
        }

        // Generate kode booking unik
        do {
            $kodeBooking = 'DK-' . strtoupper(Str::random(6));
        } while (Sewa::where('kode_booking', $kodeBooking)->exists());

        $sewa = Sewa::create([
            'idpenyewa' => Auth::guard('web')->user()->idpenyewa,
            'kdkamar' => $kdkamar,
            'kdvilla' => $kdvilla,
            'kode_booking' => $kodeBooking,
            'tglmulai' => $request->tglmulai,
            'tglselesai' => $request->tglselesai,
            'totalharga' => $totalbayar,
            'status' => 'pending',
            'catatan' => ($request->payment_method === 'cash' ? '[BAYAR DI TEMPAT] ' : '[TRANSFER] ') . $request->catatan,
            'buktibayar' => $paymentProofPath,
        ]);

        return redirect()->route('user.bookings.ticket', $sewa->kdsewa)
            ->with('success', 'Booking berhasil dibuat! Simpan tiket ini sebagai bukti pemesanan Anda.');
    }

    public function ticket($id)
    {
        $booking = Sewa::with(['penyewa', 'kamar', 'villa'])
            ->where('kdsewa', $id)
            ->where('idpenyewa', Auth::guard('web')->user()->idpenyewa)
            ->firstOrFail();

        $unit = $booking->kamar ?? $booking->villa;
        $type = $booking->kdvilla ? 'villa' : 'kost';

        return view('user.bookings.ticket', compact('booking', 'unit', 'type'));
    }

    public function destroy($id)
    {
        $booking = Sewa::where('kdsewa', $id)->where('idpenyewa', Auth::guard('web')->user()->idpenyewa)->firstOrFail();

        // Soft delete: hanya sembunyikan dari penyewa, data tetap ada di database dan admin
        $booking->update(['disembunyikan_dari_penyewa' => true]);

        return back()->with('success', 'Riwayat booking berhasil dihapus dari tampilan Anda.');
    }
}
