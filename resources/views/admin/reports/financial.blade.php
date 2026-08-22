@extends('layouts.admin')

@section('admin-content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Laporan Pemasukan Bulanan</h1>
    </div>

    {{-- Filter Section --}}
    <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6 shadow-sm">
        <form action="{{ route('admin.reports.financial') }}" method="GET" class="flex items-end gap-4">
            <div class="flex-1">
                <label class="block text-slate-600 text-sm font-medium mb-2">Pilih Bulan</label>
                <select name="month"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create(null, $m, 1)->locale('id')->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-slate-600 text-sm font-medium mb-2">Pilih Tahun</label>
                <select name="year"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500">
                    @foreach($availableYears as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                class="bg-cyan-600 hover:bg-cyan-700 text-white px-8 py-2 rounded-lg font-medium transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                Tampilkan Laporan
            </button>
        </form>
    </div>

    {{-- Total Revenue Card --}}
    <div class="bg-gradient-to-br from-slate-50 to-cyan-50 rounded-xl border border-slate-200 p-8 mb-6 text-center">
        <h2 class="text-slate-600 text-lg mb-2">Total Pemasukan untuk {{ $monthName }} {{ $year }}</h2>
        <div class="text-5xl font-bold text-green-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
    </div>

    {{-- Booking Details Table --}}
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-200">
            <h3 class="text-xl font-bold text-slate-900">Detail Booking</h3>
            <p class="text-sm text-slate-500 mt-1">Daftar booking yang sudah disetujui</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-sm uppercase border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-medium">NO</th>
                        <th class="px-6 py-4 font-medium">NAMA PENYEWA</th>
                        <th class="px-6 py-4 font-medium">KAMAR/VILLA</th>
                        <th class="px-6 py-4 font-medium">TOTAL HARGA</th>
                        <th class="px-6 py-4 font-medium">TANGGAL BOOKING</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-600">
                    @forelse($bookings as $index => $booking)
                        @php $unit = $booking->kamar ?? $booking->villa; @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-900">{{ $booking->penyewa->namapenyewa ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium">{{ $unit->namakamar ?? $unit->namavilla ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium">Rp {{ number_format($booking->totalharga, 0, ',', '.') }}</span>
                            </td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->tglmulai)->format('d F Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                Tidak ada data booking yang disetujui untuk bulan {{ $monthName }} {{ $year }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Floating Print Button (Sticky) --}}
    <a href="{{ route('admin.reports.financial.print', ['month' => $month, 'year' => $year]) }}" target="_blank"
        class="fixed bottom-8 right-8 bg-slate-600 hover:bg-slate-700 text-white px-6 py-3 rounded-full font-medium transition-all shadow-2xl hover:shadow-3xl hover:scale-105 flex items-center gap-2 z-50">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
            </path>
        </svg>
        Cetak Laporan
    </a>
@endsection