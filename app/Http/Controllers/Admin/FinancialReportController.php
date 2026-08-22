<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FinancialReportController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        // Get approved bookings for selected month/year
        $bookings = Sewa::where('status', 'disetujui')
            ->whereYear('tglmulai', $year)
            ->whereMonth('tglmulai', $month)
            ->with(['kamar', 'villa', 'penyewa'])
            ->orderBy('tglmulai', 'asc')
            ->get();

        // Calculate total revenue
        $totalRevenue = $bookings->sum('totalharga');

        // Get month name in Indonesian
        $monthName = Carbon::create($year, $month, 1)->locale('id')->translatedFormat('F');

        // Get years from database
        $dbYears = Sewa::selectRaw('YEAR(tglmulai) as year')
            ->distinct()
            ->pluck('year')
            ->toArray();

        // Create a default range of last 5 years
        $currentYear = Carbon::now()->year;
        $defaultYears = range($currentYear, $currentYear - 5);

        // Merge, unique, and sort years
        $availableYears = array_unique(array_merge($dbYears, $defaultYears));
        if (!in_array((int) $year, $availableYears)) {
            $availableYears[] = (int) $year;
        }
        rsort($availableYears);

        return view('admin.reports.financial', compact(
            'bookings',
            'totalRevenue',
            'month',
            'year',
            'monthName',
            'availableYears'
        ));
    }

    public function print(Request $request)
    {
        $month = $request->get('month', Carbon::now()->month);
        $year = $request->get('year', Carbon::now()->year);

        $bookings = Sewa::where('status', 'disetujui')
            ->whereYear('tglmulai', $year)
            ->whereMonth('tglmulai', $month)
            ->with(['kamar', 'villa', 'penyewa'])
            ->orderBy('tglmulai', 'asc')
            ->get();

        $totalRevenue = $bookings->sum('totalharga');
        $monthName = Carbon::create($year, $month, 1)->locale('id')->translatedFormat('F');

        return view('admin.reports.financial-print', compact(
            'bookings',
            'totalRevenue',
            'month',
            'year',
            'monthName'
        ));
    }
}
