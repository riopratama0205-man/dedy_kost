<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - {{ $monthName }} {{ $selectedYear }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-white p-8 font-sans">
    <div class="max-w-4xl mx-auto">
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-slate-800 uppercase tracking-wide mb-2">Laporan Pemasukan Bulanan</h1>
            <h2 class="text-xl text-slate-600">DEDY KOST & VILLA</h2>
            <p class="text-slate-500 text-sm mt-1">Periode: {{ $monthName }} {{ $selectedYear }}</p>
        </div>

        {{-- Summary Box --}}
        <div class="bg-slate-100 rounded-xl p-8 text-center mb-10 border border-slate-200">
            <h2 class="text-lg font-medium text-slate-600 mb-2">Total Pemasukan untuk {{ $monthName }}
                {{ $selectedYear }}
            </h2>
            <div class="text-5xl font-bold text-green-600">
                Rp {{ number_format($filteredRevenue, 0, ',', '.') }}
            </div>
        </div>

        {{-- Table --}}
        <div class="mb-8">
            <table class="w-full text-left border-collapse border border-slate-200">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-4 py-3 font-semibold text-slate-600 text-sm uppercase border border-slate-200">NO
                        </th>
                        <th class="px-4 py-3 font-semibold text-slate-600 text-sm uppercase border border-slate-200">
                            NAMA PENYEWA</th>
                        <th class="px-4 py-3 font-semibold text-slate-600 text-sm uppercase border border-slate-200">
                            KAMAR/VILLA</th>
                        <th class="px-4 py-3 font-semibold text-slate-600 text-sm uppercase border border-slate-200">
                            TOTAL HARGA</th>
                        <th class="px-4 py-3 font-semibold text-slate-600 text-sm uppercase border border-slate-200">
                            TANGGAL BOOKING</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $index => $transaction)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-3 text-slate-500 border border-slate-200">{{ $index + 1 }}</td>
                            <td class="px-4 py-3 font-medium text-slate-700 border border-slate-200">
                                {{ $transaction->penyewa->namapenyewa ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-slate-600 border border-slate-200">
                                {{ $transaction->kamar?->namakamar ?? ($transaction->villa?->namavilla ?? '-') }}</td>
                            <td class="px-4 py-3 text-slate-600 border border-slate-200">Rp
                                {{ number_format($transaction->totalbayar, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-slate-500 border border-slate-200">
                                {{ $transaction->dibuat_pada->format('d F Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-slate-500 italic border border-slate-200">
                                Tidak ada data transaksi untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div class="mt-12 flex justify-between items-end text-sm text-slate-500">
            <div>
                <p>Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
                <p>&copy; {{ date('Y') }} Dedy Kost & Villa Management System.</p>
            </div>
            <div class="text-right">
                <p class="mb-16">Mengetahui,</p>
                <p class="font-bold text-slate-800 underline">Admin Pengelola</p>
            </div>
        </div>

        {{-- Print Button (Hidden when printing) --}}
        <div class="fixed bottom-8 right-8 no-print">
            <button onclick="window.print()"
                class="bg-slate-800 hover:bg-slate-900 text-white px-6 py-3 rounded-lg shadow-lg font-bold flex items-center transition-transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                Cetak Sekarang
            </button>
        </div>
    </div>
</body>

</html>

