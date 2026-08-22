@extends('layouts.admin')

@section('admin-content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Kelola Pemesanan</h1>
            <p class="text-slate-600">Atur jadwal booking, hapus, atau edit pesanan.</p>
        </div>
        <a href="{{ route('admin.bookings.create') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg font-bold transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Booking 
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search and Filter Box --}}
    <div class="bg-white rounded-xl border border-slate-200 p-4 mb-6 shadow-sm">
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            {{-- Search Input --}}
            <div class="flex-1">
                <input type="text" name="search" value="{{ $search ?? '' }}" 
                       placeholder="Cari berdasarkan nama penyewa, email, atau nama kamar..."
                       class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
            </div>
            
            {{-- Status Filter --}}
            <div class="w-full md:w-48">
                <select name="status" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    <option value="all" {{ ($status ?? 'all') == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="menunggu" {{ ($status ?? '') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="disetujui" {{ ($status ?? '') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ ($status ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            
            {{-- Buttons --}}
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg font-medium transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
            </button>
            @if($search || ($status && $status !== 'all'))
                <a href="{{ route('admin.bookings.index') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Daftar Pemesanan</h3>
                    <p class="text-sm text-slate-500 mt-1">Total: {{ $bookings->total() }} booking</p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-sm uppercase">
                    <tr>
                        <th class="px-6 py-4 font-medium">Penyewa</th>
                        <th class="px-6 py-4 font-medium">Kamar/Villa</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Total Harga</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-600">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $booking->penyewa->namapenyewa ?? 'Unknown' }}</div>
                                <div class="text-xs text-slate-500">{{ $booking->penyewa->email ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $booking->kamar->namakamar ?? ($booking->villa->namavilla ?? '-') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <span class="text-slate-500">In:</span> {{ \Carbon\Carbon::parse($booking->tglmulai)->format('d M Y') }}<br>
                                    <span class="text-slate-500">Out:</span> {{ \Carbon\Carbon::parse($booking->tglselesai)->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
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
                            <td class="px-6 py-4">
                                @php
                                    $statusLower = strtolower($booking->status);
                                @endphp
                                @if($statusLower == 'menunggu' || $statusLower == 'pending')
                                    <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-xs font-bold">Pending</span>
                                @elseif($statusLower == 'disetujui')
                                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-xs font-bold">Disetujui</span>
                                @elseif($statusLower == 'ditolak')
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-bold">Ditolak</span>
                                @else
                                    <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-bold">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    {{-- Status Actions (Only for Pending) --}}
                                    @if(strtolower($booking->status) == 'pending' || strtolower($booking->status) == 'menunggu')
                                        <form action="{{ route('admin.bookings.update-status', $booking->kdsewa) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="disetujui">
                                            <button type="submit" class="px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-bold rounded-lg transition-all flex items-center gap-1" title="Terima">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Terima
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.update-status', $booking->kdsewa) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-lg transition-all flex items-center gap-1" title="Tolak">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                Tolak
                                            </button>
                                        </form>
                                    @endif

                                    {{-- View Payment Proof (if Transfer) --}}
                                    @if($booking->buktibayar)
                                        <a href="{{ asset('storage/' . $booking->buktibayar) }}" target="_blank" class="text-cyan-600 hover:text-cyan-800" title="Lihat Bukti Transfer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                    @endif


                                    {{-- Edit Button --}}
                                    <a href="{{ route('admin.bookings.edit', $booking->kdsewa) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <p>Belum ada pesanan masuk.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($bookings->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-slate-600">
                        Menampilkan <span class="font-semibold text-slate-900">{{ $bookings->firstItem() }}</span> 
                        sampai <span class="font-semibold text-slate-900">{{ $bookings->lastItem() }}</span> 
                        dari <span class="font-semibold text-slate-900">{{ $bookings->total() }}</span> pesanan
                    </div>
                    <div>
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection



