@extends('layouts.admin')

@section('admin-content')
    <div class="bg-white rounded-xl shadow-sm p-8 min-h-screen">
        <h1 class="text-2xl font-bold text-slate-800 mb-6">Laporan Pemasukan Bulanan</h1>

        {{-- Filter Form --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6 shadow-sm">
            <form action="{{ route('admin.finance.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Bulan</label>
                    <select name="month" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent bg-white text-slate-700 font-medium">
                        @foreach($months as $num => $name)
                            <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Tahun</label>
                    <select name="year" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent bg-white text-slate-700 font-medium">
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-auto">
                    <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-8 py-2.5 rounded-lg font-medium transition-colors w-full md:w-auto flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Tampilkan Laporan
                    </button>
                </div>
            </form>
        </div>

        {{-- Summary Box --}}
        <div class="bg-slate-200 rounded-xl p-10 text-center mb-8">
            <h2 class="text-lg font-medium text-slate-600 mb-2">Total Pemasukan untuk {{ $months[$selectedMonth] }} {{ $selectedYear }}</h2>
            <div class="text-5xl font-bold text-green-500">
                Rp {{ number_format($filteredRevenue, 0, ',', '.') }}
            </div>
        </div>

        {{-- Table --}}
        <div class="border border-slate-200 rounded-lg overflow-hidden mb-8">
            <table class="w-full text-left">
                <thead class="bg-white border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-slate-500 text-sm uppercase tracking-wider">NO</th>
                        <th class="px-6 py-4 font-semibold text-slate-500 text-sm uppercase tracking-wider">NAMA PENYEWA</th>
                        <th class="px-6 py-4 font-semibold text-slate-500 text-sm uppercase tracking-wider">KAMAR/VILLA</th>
                        <th class="px-6 py-4 font-semibold text-slate-500 text-sm uppercase tracking-wider">TOTAL HARGA</th>
                        <th class="px-6 py-4 font-semibold text-slate-500 text-sm uppercase tracking-wider">TANGGAL BOOKING</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($transactions as $index => $transaction)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-slate-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-slate-700">{{ $transaction->penyewa->namapenyewa ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $transaction->kamar->namakamar ?? ($transaction->villa->namavilla ?? '-') }}</td>
                            <td class="px-6 py-4 text-slate-600">Rp {{ number_format($transaction->totalbayar, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ \Carbon\Carbon::parse($transaction->dibuat_pada)->format('d F Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500 italic">Tidak ada data transaksi untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Print Button --}}
        <div class="flex justify-end">
            <a href="{{ route('admin.finance.print', ['month' => $selectedMonth, 'year' => $selectedYear]) }}" target="_blank" class="bg-slate-500 hover:bg-slate-600 text-white px-6 py-2.5 rounded-lg font-medium transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
            </a>
        </div>
    </div>
@endsection

