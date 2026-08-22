@extends('layouts.admin')

@section('admin-content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Data Penyewa</h1>
    </div>

    {{-- Search Box --}}
    <div class="bg-white rounded-xl border border-slate-200 p-4 mb-6 shadow-sm">
        <form action="{{ route('admin.tenants.index') }}" method="GET" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Cari berdasarkan nama, email, atau nomor HP..."
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
            </div>
            <button type="submit"
                class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg font-medium transition-colors shadow-sm flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
            </button>
            @if($search)
                <a href="{{ route('admin.tenants.index') }}"
                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-6 py-2 rounded-lg font-medium transition-colors">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-200 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-slate-900">Daftar Penyewa Aktif</h3>
                <p class="text-sm text-slate-500 mt-1">Total: {{ $tenants->total() }} penyewa</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-sm uppercase border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-medium">Nama</th>
                        <th class="px-6 py-4 font-medium">Email</th>
                        <th class="px-6 py-4 font-medium">No. HP</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-600">
                    @forelse($tenants as $tenant)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center font-bold">
                                        {{ substr($tenant->namapenyewa, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="text-slate-900 font-medium">{{ $tenant->namapenyewa }}</p>
                                            @if($tenant->penyewa_baru)
                                                <span
                                                    class="bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full animate-pulse">NEW</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $tenant->email }}</td>
                            <td class="px-6 py-4">{{ $tenant->telp ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.tenants.show', $tenant->idpenyewa) }}"
                                        class="text-cyan-600 hover:text-cyan-700 font-medium">Detail</a>
                                    <form action="{{ route('admin.tenants.destroy', $tenant->idpenyewa) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-slate-500">
                                @if($search)
                                    <p>Tidak ada penyewa yang cocok dengan pencarian "{{ $search }}".</p>
                                @else
                                    <p>Belum ada data penyewa.</p>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($tenants->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $tenants->links() }}
            </div>
        @endif
    </div>
@endsection