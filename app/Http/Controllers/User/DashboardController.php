<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        $bookings = Sewa::with(['kamar', 'villa', 'penyewa'])
            ->where('idpenyewa', $user->idpenyewa)
            ->where('disembunyikan_dari_penyewa', false)
            ->orderBy('kdsewa', 'desc')
            ->get();

        return view('user.dashboard', compact('bookings'));
    }
}



