@extends('layouts.app', ['hideNavbar' => true])

@section('title', 'Tiket Booking - DEDY KOST')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 flex flex-col items-center justify-start py-10 px-4">

        {{-- Header --}}
        <div class="w-full max-w-lg mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </div>
                <span
                    class="text-2xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">DEDY
                    KOST</span>
            </div>
            <span class="text-sm text-slate-500 font-medium">Tiket Pemesanan</span>
        </div>

        @if(session('success'))
            <div
                class="w-full max-w-lg mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Ticket Card --}}
        <div id="ticket-card"
            class="w-full max-w-lg bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">

            {{-- Ticket Header --}}
            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 px-8 py-6 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full translate-y-10 -translate-x-10">
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <span class="text-sm font-semibold text-cyan-100 uppercase tracking-wider">Tiket Pemesanan
                            Resmi</span>
                    </div>
                    <h1 class="text-2xl font-bold">
                        {{ $unit->namakamar ?? ($unit->namavilla ?? 'Unit') }}
                    </h1>
                    <p class="text-cyan-100 text-sm mt-1">
                        {{ $type === 'villa' ? '🏡 Villa' : '🏠 Kamar Kost' }} &bull; DEDY KOST
                    </p>
                </div>
            </div>

            {{-- Kode Booking Box --}}
            <div class="px-8 py-6 bg-slate-50 border-b border-slate-100">
                <p class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-2 text-center">Kode Booking</p>
                <div class="bg-white border-2 border-dashed border-cyan-300 rounded-2xl py-5 px-6 text-center">
                    <span class="text-4xl font-black tracking-[0.25em] text-cyan-700 font-mono select-all">
                        {{ $booking->kode_booking ?? 'N/A' }}
                    </span>
                </div>
                <p class="text-center text-xs text-slate-400 mt-3">
                    📱 Tunjukkan kode ini kepada admin/pemilik saat tiba di lokasi
                </p>
            </div>

            {{-- Status Badge --}}
            <div class="flex justify-center py-4 bg-white border-b border-slate-100">
                @php
                    $statusMap = [
                        'menunggu' => ['label' => 'Menunggu Konfirmasi', 'class' => 'bg-yellow-100 text-yellow-700 border-yellow-300'],
                        'disetujui' => ['label' => 'Disetujui ✓', 'class' => 'bg-green-100 text-green-700 border-green-300'],
                        'ditolak' => ['label' => 'Ditolak', 'class' => 'bg-red-100 text-red-700 border-red-300'],
                        'dibatalkan' => ['label' => 'Dibatalkan', 'class' => 'bg-slate-100 text-slate-600 border-slate-300'],
                        'pending' => ['label' => 'Menunggu Konfirmasi', 'class' => 'bg-yellow-100 text-yellow-700 border-yellow-300'],
                    ];
                    $statusInfo = $statusMap[strtolower($booking->status)] ?? ['label' => ucfirst($booking->status), 'class' => 'bg-slate-100 text-slate-600 border-slate-300'];
                @endphp
                <span
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full border-2 font-bold text-sm {{ $statusInfo['class'] }}">
                    <span class="w-2 h-2 rounded-full bg-current animate-pulse inline-block"></span>
                    Status: {{ $statusInfo['label'] }}
                </span>
            </div>

            {{-- Detail Info --}}
            <div class="px-8 py-6 space-y-4">

                {{-- Penyewa --}}
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-cyan-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-slate-400 font-medium">Nama Penyewa</p>
                        <p class="text-slate-800 font-semibold">{{ $booking->penyewa->namapenyewa ?? '-' }}</p>
                    </div>
                </div>

                {{-- Tanggal --}}
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-slate-400 font-medium">Periode Sewa</p>
                        <p class="text-slate-800 font-semibold">
                            {{ \Carbon\Carbon::parse($booking->tglmulai)->format('d M Y') }}
                            <span class="text-slate-400 font-normal mx-1">→</span>
                            {{ \Carbon\Carbon::parse($booking->tglselesai)->format('d M Y') }}
                        </p>
                        @php
                            $durasi = \Carbon\Carbon::parse($booking->tglmulai)->diffInDays(\Carbon\Carbon::parse($booking->tglselesai));
                        @endphp
                        <p class="text-xs text-slate-400 mt-0.5">{{ $durasi }} {{ $durasi == 1 ? 'hari' : 'hari' }}</p>
                    </div>
                </div>

                {{-- Total Harga --}}
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-slate-400 font-medium">Total Pembayaran</p>
                        <p class="text-2xl font-black text-cyan-600">Rp
                            {{ number_format($booking->totalharga, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                @php
                    $isTransfer = str_contains($booking->catatan ?? '', '[TRANSFER]');
                    $isCash = str_contains($booking->catatan ?? '', '[BAYAR DI TEMPAT]');
                @endphp
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-slate-400 font-medium">Metode Pembayaran</p>
                        @if($isTransfer)
                            <p class="text-slate-800 font-semibold">💳 Transfer Bank</p>
                        @elseif($isCash)
                            <p class="text-slate-800 font-semibold">💵 Bayar di Tempat</p>
                        @else
                            <p class="text-slate-800 font-semibold">-</p>
                        @endif
                    </div>
                </div>

                {{-- ID Booking --}}
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <p class="text-xs text-slate-400 font-medium">ID Pemesanan</p>
                        <p class="text-slate-600 font-mono text-sm">#{{ $booking->kdsewa }}</p>
                    </div>
                </div>
            </div>

            {{-- Dashed Separator (perforated look) --}}
            <div class="relative px-4 py-2">
                <div class="border-t-2 border-dashed border-slate-200"></div>
                <div
                    class="absolute left-0 top-1/2 -translate-y-1/2 w-6 h-6 bg-slate-50 rounded-full -translate-x-3 border border-slate-200">
                </div>
                <div
                    class="absolute right-0 top-1/2 -translate-y-1/2 w-6 h-6 bg-slate-50 rounded-full translate-x-3 border border-slate-200">
                </div>
            </div>

            {{-- Footer Ticket --}}
            <div class="px-8 py-5 bg-slate-50 text-center">
                <p class="text-xs text-slate-400 leading-relaxed">
                    Tiket ini diterbitkan secara otomatis oleh sistem DEDY KOST.<br>
                    Harap simpan kode booking Anda. Diterbitkan pada {{ now()->format('d M Y, H:i') }} WIB.
                </p>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="w-full max-w-lg mt-6 flex flex-col sm:flex-row gap-3 no-print">
            <button onclick="window.print()"
                class="flex-1 flex items-center justify-center gap-2 py-3 px-6 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg hover:scale-[1.02] transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak / Simpan PDF
            </button>
            <a href="{{ route('user.dashboard') }}"
                class="flex-1 flex items-center justify-center gap-2 py-3 px-6 bg-white border-2 border-slate-200 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 hover:border-slate-300 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    {{-- Print Styles --}}
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            #ticket-card {
                box-shadow: none !important;
                border: 1px solid #e2e8f0 !important;
                max-width: 100% !important;
                margin: 0 !important;
            }

            .min-h-screen {
                min-height: unset !important;
                background: white !important;
                padding: 0 !important;
            }
        }
    </style>
@endsection