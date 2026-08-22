@extends('layouts.app', ['hideNavbar' => true])

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 pt-12 pb-12">
        {{-- Logo Header --}}
        <div class="container mx-auto px-6 mb-8">
            <div class="flex items-center justify-between">
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
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-slate-600 font-medium">Dashboard Penyewa</span>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar / Profile Card -->
                <div class="w-full md:w-80 flex-shrink-0">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sticky top-12 shadow-lg">
                        <div class="text-center mb-6">
                            <div
                                class="w-24 h-24 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-900">{{ auth('web')->user()->namapenyewa }}</h2>
                            <p class="text-cyan-600 font-medium">Penyewa</p>
                        </div>

                        <div class="space-y-3">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center justify-center space-x-2 w-full py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-medium transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Edit Profil</span>
                            </a>
                            <a href="{{ route('user.messages.index') }}"
                                class="flex items-center justify-center space-x-2 w-full py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-medium transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span>Pesan Saya</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                                @csrf
                                <button type="submit"
                                    class="flex items-center justify-center space-x-2 w-full py-3 px-4 border-2 border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 rounded-lg font-medium transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex-grow space-y-6">
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Room Selection -->
                    <div class="mb-8">
                        <div class="mb-6">
                            <h2 class="text-xl font-bold text-slate-900 mb-2">Pilih Tipe Hunian</h2>
                            <p class="text-slate-600">Silakan pilih jenis hunian yang Anda inginkan.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Kamar Kost Card -->
                            <a href="{{ route('user.rooms.list', 'kost') }}"
                                class="group relative overflow-hidden rounded-xl aspect-video bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-cyan-500 transition-all duration-300">
                                <!-- Background Image -->
                                <img src="{{ asset('images/rooms/kamar-menu.jpg') }}" alt="Kamar Kost" class="absolute inset-0 w-full h-full object-cover">
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/40 to-transparent z-10"></div>
                                <!-- Content -->
                                <div class="absolute inset-0 p-6 z-20 w-full flex flex-col justify-end">
                                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-cyan-300 transition-colors">Kamar</h3>
                                    <p class="text-sm text-slate-200">Hunian nyaman untuk sementara.</p>
                                </div>
                            </a>

                            <!-- Villa Card -->
                            <a href="{{ route('user.rooms.list', 'villa') }}"
                                class="group relative overflow-hidden rounded-xl aspect-video bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-cyan-500 transition-all duration-300">
                                <!-- Background Image -->
                                <img src="{{ asset('images/rooms/villa-menu.jpg') }}" alt="Villa" class="absolute inset-0 w-full h-full object-cover">
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/40 to-transparent z-10"></div>
                                <!-- Content -->
                                <div class="absolute inset-0 p-6 z-20 w-full flex flex-col justify-end">
                                    <h3 class="text-lg font-bold text-white mb-1 group-hover:text-cyan-300 transition-colors">Villa</h3>
                                    <p class="text-sm text-slate-200">Liburan seru bersama keluarga.</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Booking Info -->
                    @php
                        $activeBooking = $bookings->filter(function ($booking) {
                            $endDate = \Carbon\Carbon::parse($booking->tglselesai)->endOfDay();
                            return $endDate->isFuture() && !in_array(strtolower($booking->status), ['ditolak', 'dibatalkan', 'rejected']);
                        })->first();
                    @endphp

                    @if($activeBooking)
                        @php $unit = $activeBooking->kamar ?? $activeBooking->villa; @endphp
                        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                            <h3 class="text-xl font-bold text-slate-900 mb-4">Informasi Unit Aktif</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-slate-500 text-sm">Nama Unit</p>
                                        <p class="text-slate-900 font-medium">{{ $unit->namakamar ?? ($unit->namavilla ?? '-') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-slate-500 text-sm">Periode Sewa</p>
                                        <p class="text-slate-900 font-medium">
                                            {{ \Carbon\Carbon::parse($activeBooking->tglmulai)->format('d M Y') }} - 
                                            {{ \Carbon\Carbon::parse($activeBooking->tglselesai)->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-slate-500 text-sm">Status Sewa</p>
                                        @php
                                            $statusClasses = [
                                                'disetujui' => 'bg-green-100 text-green-600 border border-green-200',
                                                'ditolak' => 'bg-red-100 text-red-600 border border-red-200',
                                                'menunggu' => 'bg-yellow-100 text-yellow-600 border border-yellow-200',
                                                'dibatalkan' => 'bg-slate-100 text-slate-600 border border-slate-200',
                                            ];
                                            $currentStatus = strtolower($activeBooking->status);
                                            $class = $statusClasses[$currentStatus] ?? 'bg-slate-100 text-slate-600 border border-slate-200';
                                        @endphp
                                        <span class="px-3 py-1.5 rounded-full {{ $class }} shadow-sm text-xs font-bold uppercase">
                                            {{ $activeBooking->status_indonesia }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-slate-500 text-sm">Total Pembayaran</p>
                                        <p class="text-2xl font-bold text-cyan-600">Rp {{ number_format($activeBooking->totalbayar, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                            {{-- Tombol Lihat Tiket --}}
                            <div class="mt-4 pt-4 border-t border-slate-100">
                                <a href="{{ route('user.bookings.ticket', $activeBooking->kdsewa) }}"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold rounded-xl hover:shadow-md hover:scale-[1.02] transition-all duration-200 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                    </svg>
                                    Lihat Tiket Saya
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Booking History -->
                    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Riwayat Pemesanan</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50 text-slate-500 text-sm uppercase">
                                    <tr>
                                        <th class="px-4 py-3 font-medium">Unit</th>
                                        <th class="px-4 py-3 font-medium">Check-in</th>
                                        <th class="px-4 py-3 font-medium">Check-out</th>
                                        <th class="px-4 py-3 font-medium">Total</th>
                                        <th class="px-4 py-3 font-medium">Status</th>
                                        <th class="px-4 py-3 font-medium">Tiket</th>
                                        <th class="px-4 py-3 font-medium">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-600">
                                    @forelse($bookings as $booking)
                                        @php $unit = $booking->kamar ?? $booking->villa; @endphp
                                        <tr>
                                            <td class="px-4 py-3 font-medium text-slate-900">{{ $unit->namakamar ?? ($unit->namavilla ?? 'Unit dihapus') }}</td>
                                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($booking->tglmulai)->format('d M Y') }}</td>
                                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($booking->tglselesai)->format('d M Y') }}</td>
                                            <td class="px-4 py-3">
                                                <div class="font-bold text-cyan-600">Rp {{ number_format($booking->totalharga, 0, ',', '.') }}</div>
                                                @php
                                                    $isTransfer = str_contains($booking->catatan ?? '', '[TRANSFER]');
                                                    $isCash = str_contains($booking->catatan ?? '', '[BAYAR DI TEMPAT]');
                                                @endphp
                                                @if($isTransfer)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200 mt-1">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                                        Transfer
                                                    </span>
                                                @elseif($isCash)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-purple-100 text-purple-700 border border-purple-200 mt-1">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                        Bayar di Tempat
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3 text-xs font-bold uppercase">
                                                @php
                                                    $statusClasses = [
                                                        'disetujui' => 'bg-green-100 text-green-600 border border-green-200',
                                                        'ditolak' => 'bg-red-100 text-red-600 border border-red-200',
                                                        'menunggu' => 'bg-yellow-100 text-yellow-600 border border-yellow-200',
                                                        'dibatalkan' => 'bg-slate-100 text-slate-600 border border-slate-200',
                                                    ];
                                                    $currentStatus = strtolower($booking->status);
                                                    $class = $statusClasses[$currentStatus] ?? 'bg-slate-100 text-slate-600 border border-slate-200';
                                                @endphp
                                                <span class="px-3 py-1.5 rounded-full {{ $class }} shadow-sm">
                                                    {{ $booking->status_indonesia }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                @if(!in_array(strtolower($booking->status), ['ditolak', 'dibatalkan']))
                                                    <a href="{{ route('user.bookings.ticket', $booking->kdsewa) }}"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-cyan-50 border border-cyan-200 text-cyan-700 text-xs font-bold rounded-lg hover:bg-cyan-100 transition-colors">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                                        </svg>
                                                        Lihat
                                                    </a>
                                                @else
                                                    <span class="text-slate-300 text-xs">-</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <form action="{{ route('user.bookings.destroy', $booking->kdsewa) }}" method="POST" onsubmit="return confirm('Hapus riwayat ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada riwayat pemesanan.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

