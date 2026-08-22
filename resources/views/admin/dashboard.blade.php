@extends('layouts.admin')

@section('admin-content')
    <!-- Hero / Welcome Section -->
    <div
        class="relative bg-gradient-to-br from-slate-900 via-cyan-900 to-blue-900 rounded-3xl p-8 mb-10 overflow-hidden shadow-2xl">
        <div
            class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-cyan-400 rounded-full blur-3xl opacity-20 pointer-events-none animate-pulse">
        </div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-blue-400 rounded-full blur-3xl opacity-20 pointer-events-none animate-pulse"
            style="animation-delay: 1s;">
        </div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div
                    class="inline-flex items-center px-3 py-1 rounded-full bg-cyan-500/20 border border-cyan-400/30 text-cyan-300 text-xs font-medium mb-3 backdrop-blur-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 mr-2 animate-pulse"></span>
                    System Online
                </div>
                <h1 class="text-3xl font-bold text-white mb-2 tracking-tight">Command Center</h1>
                <p class="text-slate-300 max-w-xl text-lg font-light">Selamat datang, <span
                        class="text-cyan-300 font-medium">{{ auth('admin')->user()->namaadmin }}</span>. Berikut ringkasan
                    properti Anda.</p>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Revenue -->
        <div
            class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
            <p class="text-slate-500 text-sm font-medium mb-1">Pendapatan Bulan Ini</p>
            <h3 class="text-2xl font-bold text-slate-800 tracking-tight">Rp
                {{ number_format($monthlyRevenue, 0, ',', '.') }}
            </h3>
            <div class="mt-4 flex items-center text-xs text-amber-600 bg-amber-50 inline-block px-2 py-1 rounded">
                <span class="font-bold">Keuangan</span>
            </div>
        </div>

        <!-- Bookings -->
        <div
            class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
            <p class="text-slate-500 text-sm font-medium mb-1">Jumlah Booking</p>
            <h3 class="text-3xl font-bold text-slate-800 tracking-tight">{{ $totalRooms }}</h3>
            <div class="mt-4 flex gap-2">
                <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded">{{ $totalKamar }}
                    Kamar</span>
                <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2 py-1 rounded">{{ $totalVilla }}
                    Villa</span>
            </div>
        </div>

        <!-- Pending -->
        <div
            class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
            <p class="text-slate-500 text-sm font-medium mb-1">Butuh Tindakan</p>
            <h3 class="text-3xl font-bold text-slate-800 tracking-tight">{{ $pendingBookings }}</h3>
            <div class="mt-4 flex items-center text-xs text-red-600 bg-red-50 inline-block px-2 py-1 rounded">
                <span class="font-bold">Pending Booking</span>
            </div>
        </div>

        <!-- Messages -->
        <div
            class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md transition-all">
            <p class="text-slate-500 text-sm font-medium mb-1">Total Pesan</p>
            <h3 class="text-3xl font-bold text-slate-800 tracking-tight">{{ $totalMessages }}</h3>
            <div class="mt-4 flex items-center text-xs text-purple-600 bg-purple-50 inline-block px-2 py-1 rounded">
                <a href="{{ route('admin.tenants.index') }}" class="hover:underline">Lihat Penyewa &rarr;</a>
            </div>
        </div>
    </div>

    <!-- MAIN SECTIONS STACKED -->
    <div class="space-y-10">
        <!-- RECENT TENANTS -->
        <section>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <h3 class="text-xl font-bold text-slate-900">Pesanan Terbaru (Aktif)</h3>
                </div>
                <a href="{{ route('admin.bookings.index') }}"
                    class="text-cyan-600 hover:text-cyan-700 font-medium text-sm">Lihat Semua Data &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($recentTenants ?? [] as $sewa)
                    <div
                        class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-all group">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-lg group-hover:bg-cyan-100 group-hover:text-cyan-600 transition-colors">
                                {{ substr(($sewa->penyewa?->namapenyewa ?? 'U'), 0, 2) }}
                            </div>
                            <div class="overflow-hidden">
                                <h4 class="font-bold text-slate-900 truncate">{{ $sewa->penyewa?->namapenyewa ?? 'Unknown' }}
                                </h4>
                                <p class="text-xs text-slate-500 truncate">{{ $sewa->penyewa?->email ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Unit:</span>
                                <span
                                    class="font-medium text-slate-900">{{ $sewa->kamar?->namakamar ?? $sewa->villa?->namavilla ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Masuk:</span>
                                <span
                                    class="font-medium text-slate-900">{{ \Carbon\Carbon::parse($sewa->tglmulai)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Keluar:</span>
                                <span
                                    class="font-medium text-slate-900">{{ \Carbon\Carbon::parse($sewa->tglselesai)->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-bold {{ $sewa->status == 'disetujui' ? 'bg-green-100 text-green-700' : ($sewa->status == 'menunggu' ? 'bg-yellow-100 text-yellow-700' : ($sewa->status == 'ditolak' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700')) }}">
                                {{ ucfirst($sewa->status ?? 'Menunggu') }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-dashed border-slate-200">
                        <p class="text-slate-400">Belum ada data penyewa.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Log Pendaftaran Section removed to keep Pengunjung limited to registration action -->
    </div>
@endsection