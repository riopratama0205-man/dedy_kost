@extends('layouts.admin')

@section('admin-content')
    <div class="mb-8">
        {{-- Back Button --}}
        <a href="{{ route('admin.tenants.index') }}"
            class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium mb-4 group transition-all">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Data Penyewa
        </a>

        <h1 class="text-3xl font-bold text-slate-900">Detail Penyewa</h1>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-8 max-w-2xl shadow-sm">
        <div class="flex items-center space-x-6 mb-8">
            <div class="w-24 h-24 bg-cyan-600 rounded-full flex items-center justify-center text-white font-bold text-4xl">
                {{ substr($tenant->namapenyewa, 0, 1) }}
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-900">{{ $tenant->namapenyewa }}</h2>
                <p class="text-slate-500">{{ $tenant->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                <label class="block text-slate-500 text-sm mb-1">Nomor HP</label>
                <p class="text-slate-900 font-medium">{{ $tenant->telp ?? '-' }}</p>
            </div>
        </div>

        <div class="mt-10">
            <h3 class="text-xl font-bold text-slate-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
                Riwayat Pesanan
            </h3>

            <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-500 text-xs uppercase border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 font-bold">Unit</th>
                            <th class="px-6 py-4 font-bold">Periode</th>
                            <th class="px-6 py-4 font-bold">Total</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($tenant->sewa as $sewa)
                            @php $unit = $sewa->kamar ?? $sewa->villa; @endphp
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-900">{{ $unit->namakamar ?? $unit->namavilla ?? '-' }}</div>
                                    <div class="text-[10px] text-slate-400 font-bold uppercase">{{ $sewa->kamar ? 'Kamar' : 'Villa' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-xs font-bold text-slate-700">
                                        {{ \Carbon\Carbon::parse($sewa->tglmulai)->format('d M Y') }} -
                                        {{ \Carbon\Carbon::parse($sewa->tglselesai)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-black text-slate-900 text-sm">Rp {{ number_format($sewa->totalharga, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider
                                        {{ $sewa->status == 'disetujui' ? 'bg-green-100 text-green-700' : 
                                           ($sewa->status == 'menunggu' ? 'bg-yellow-100 text-yellow-700' : 
                                           ($sewa->status == 'ditolak' ? 'bg-red-100 text-red-700' : 'bg-slate-100 text-slate-700')) }}">
                                        {{ $sewa->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-500 italic text-sm">
                                    Belum ada riwayat pesanan untuk penyewa ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-200 flex justify-end">
            <form action="{{ route('admin.tenants.destroy', $tenant->idpenyewa) }}" method="POST"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus penyewa ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-lg font-medium transition-colors shadow-sm">
                    Hapus Penyewa
                </button>
            </form>
        </div>
    </div>
@endsection