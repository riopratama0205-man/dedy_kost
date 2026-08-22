<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sewa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', Carbon::now()->month);
        $selectedYear = $request->input('year', Carbon::now()->year);

        $data = $this->getFinanceData($selectedMonth, $selectedYear);

        // Pass selected filters to view
        $data['selectedMonth'] = $selectedMonth;
        $data['selectedYear'] = $selectedYear;
        $data['months'] = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        // Generate years dynamically based on data
        $minYear = Sewa::min(DB::raw('YEAR(tglmulai)')) ?? Carbon::now()->year;
        $maxYear = Carbon::now()->year + 1; // Allow checking next year
        $data['years'] = range($maxYear, $minYear);

        return view('admin.finance.index', $data);
    }

    public function print(Request $request)
    {
        $selectedMonth = $request->input('month', Carbon::now()->month);
        $selectedYear = $request->input('year', Carbon::now()->year);

        $data = $this->getFinanceData($selectedMonth, $selectedYear);
        $data['selectedMonth'] = $selectedMonth;
        $data['selectedYear'] = $selectedYear;
        $data['monthName'] = Carbon::create()->month($selectedMonth)->locale('id')->monthName;

        return view('admin.finance.print', $data);
    }

    private function getFinanceData($month, $year)
    {
        // Filtered Revenue (Total Pemasukan untuk Bulan & Tahun yang dipilih)
        $filteredRevenue = Sewa::where('status', 'approved')
            ->whereMonth('tglmulai', $month)
            ->whereYear('tglmulai', $year)
            ->sum('totalharga');

        // Transactions for the selected period
        $transactions = Sewa::where('status', 'approved')
            ->whereMonth('tglmulai', $month)
            ->whereYear('tglmulai', $year)
            ->with(['penyewa', 'kamar'])
            ->orderBy('kdsewa', 'desc')
            ->get();

        return compact(
            'filteredRevenue',
            'transactions'
        );
    }
}



