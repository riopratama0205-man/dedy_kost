<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use App\Models\Kamar;
use App\Models\Villa;
use App\Models\Penyewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // Get search and filter parameters
        $search = $request->get('search');
        $status = $request->get('status');

        // Build query
        $query = Sewa::with(['penyewa', 'kamar']);

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('penyewa', function ($userQuery) use ($search) {
                    $userQuery->where('namapenyewa', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                    ->orWhereHas('kamar', function ($roomQuery) use ($search) {
                        $roomQuery->where('namakamar', 'like', "%{$search}%");
                    });
            });
        }

        // Apply status filter
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        // Get paginated results (10 per page)
        $bookings = $query->orderBy('kdsewa', 'desc')->paginate(10);

        return view('admin.bookings.index', compact('bookings', 'search', 'status'));
    }

    public function create()
    {
        $rooms = Kamar::all();
        $villas = Villa::all();
        $users = Penyewa::all();
        return view('admin.bookings.create', compact('rooms', 'villas', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpenyewa' => 'required|exists:penyewa,idpenyewa',
            'tglmulai' => 'required|date',
            'tglselesai' => 'required|date|after:tglmulai',
            'status' => 'required|in:menunggu,disetujui,ditolak,dibatalkan',
        ]);

        $totalbayar = 0;
        if ($request->kdkamar) {
            $room = Kamar::findOrFail($request->kdkamar);
            $totalbayar = $room->hargasewa;
        } elseif ($request->kdvilla) {
            $villa = Villa::findOrFail($request->kdvilla);
            $totalbayar = $villa->hargasewa;
        }

        // Basic daily price calculation if needed, or just use hargasewa
        $start = \Carbon\Carbon::parse($request->tglmulai);
        $end = \Carbon\Carbon::parse($request->tglselesai);
        $days = $start->diffInDays($end) ?: 1;
        $totalbayar = $totalbayar * $days;

        Sewa::create([
            'idpenyewa' => $request->idpenyewa,
            'kdkamar' => $request->kdkamar,
            'kdvilla' => $request->kdvilla,
            'tglmulai' => $request->tglmulai,
            'tglselesai' => $request->tglselesai,
            'totalharga' => $totalbayar,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dibuat.');
    }

    public function edit($id)
    {
        $booking = Sewa::findOrFail($id);
        $rooms = Kamar::all();
        $villas = Villa::all();
        $users = Penyewa::all();
        return view('admin.bookings.edit', compact('booking', 'rooms', 'villas', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tglmulai' => 'required|date',
            'tglselesai' => 'required|date|after:tglmulai',
            'status' => 'required|in:menunggu,disetujui,ditolak,dibatalkan',
        ]);

        $booking = Sewa::findOrFail($id);

        $totalbayar = 0;
        if ($request->kdkamar) {
            $room = Kamar::findOrFail($request->kdkamar);
            $totalbayar = $room->hargasewa;
        } elseif ($request->kdvilla) {
            $villa = Villa::findOrFail($request->kdvilla);
            $totalbayar = $villa->hargasewa;
        }

        $start = \Carbon\Carbon::parse($request->tglmulai);
        $end = \Carbon\Carbon::parse($request->tglselesai);
        $days = $start->diffInDays($end) ?: 1;
        $totalbayar = $totalbayar * $days;

        $booking->update([
            'kdkamar' => $request->kdkamar,
            'kdvilla' => $request->kdvilla,
            'tglmulai' => $request->tglmulai,
            'tglselesai' => $request->tglselesai,
            'totalharga' => $totalbayar,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $booking = Sewa::findOrFail($id);
        $booking->delete();

        return back()->with('success', 'Booking berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak,dibatalkan',
        ]);

        $booking = Sewa::findOrFail($id);
        $oldStatus = $booking->status;
        $newStatus = $request->status;

        // Update booking status
        $booking->update(['status' => $newStatus]);

        $today = \Carbon\Carbon::today();

        // Auto-update room/villa status based on booking status
        if ($newStatus == 'disetujui') {
            // Only mark as 'terisi' if the booking end date has NOT passed yet
            if (\Carbon\Carbon::parse($booking->tglselesai)->gte($today)) {
                if ($booking->kdkamar) {
                    $room = Kamar::find($booking->kdkamar);
                    if ($room) {
                        $room->update(['status' => 'terisi']);
                    }
                } elseif ($booking->kdvilla) {
                    $villa = Villa::find($booking->kdvilla);
                    if ($villa) {
                        $villa->update(['status' => 'terisi']);
                    }
                }
            }
        } elseif (in_array($newStatus, ['ditolak', 'dibatalkan'])) {
            // Mark room/villa as available, but only if no other ACTIVE (non-expired) approved bookings exist
            if ($booking->kdkamar) {
                $room = Kamar::find($booking->kdkamar);
                if ($room) {
                    $activeBookings = Sewa::where('kdkamar', $booking->kdkamar)
                        ->where('status', 'disetujui')
                        ->where('kdsewa', '!=', $booking->kdsewa)
                        ->whereDate('tglselesai', '>=', $today)
                        ->count();

                    if ($activeBookings == 0) {
                        $room->update(['status' => 'tersedia']);
                    }
                }
            } elseif ($booking->kdvilla) {
                $villa = Villa::find($booking->kdvilla);
                if ($villa) {
                    $activeBookings = Sewa::where('kdvilla', $booking->kdvilla)
                        ->where('status', 'disetujui')
                        ->where('kdsewa', '!=', $booking->kdsewa)
                        ->whereDate('tglselesai', '>=', $today)
                        ->count();

                    if ($activeBookings == 0) {
                        $villa->update(['status' => 'tersedia']);
                    }
                }
            }
        }

        return back()->with('success', 'Status pemesanan berhasil diperbarui.');
    }
}




