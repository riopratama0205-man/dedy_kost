@extends('layouts.admin')

@section('admin-content')
    <div>
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex justify-between items-center mb-2">
                <h1 class="text-3xl font-bold text-slate-900">Kelola Kamar & Villa</h1>
                <a href="{{ route('admin.rooms.create') }}"
                    class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-lg font-semibold transition-all inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Baru
                </a>
            </div>
            <p class="text-slate-500">Atur dan kelola semua kamar dan villa</p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-3.5 rounded-lg mb-8">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        {{-- Kamar Kost --}}
        <div class="mb-10">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-bold text-slate-900">Kamar Kost</h2>
                        <p class="text-sm text-slate-500">{{ $kostRooms->count() }} kamar</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid gap-6" style="grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));">
                        @foreach($kostRooms as $room)
                            <div class="group">
                                <div
                                    class="bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-cyan-500 hover:shadow-lg transition-all text-center">
                                    <h4 class="font-bold text-slate-800 mb-1">{{ $room->namakamar }}</h4>
                                    <div class="mb-4">
                                        @if($room->status == 'terisi')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-red-100 text-red-600 text-[10px] font-black uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                                Terisi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-600 text-[10px] font-black uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Tersedia
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <a href="{{ route('admin.rooms.show', [$room->kdkamar, 'type' => 'kost']) }}"
                                            class="flex items-center justify-center gap-2 px-4 py-2.5 bg-white border-2 border-slate-100 text-slate-700 rounded-xl text-xs font-bold hover:bg-cyan-50 hover:border-cyan-200 hover:text-cyan-700 hover:shadow-sm transition-all active:scale-95 group/btn">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            Kalender
                                        </a>
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.rooms.edit', [$room->kdkamar, 'type' => 'kost']) }}"
                                                class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-white border-2 border-slate-100 text-slate-600 rounded-xl text-xs font-bold hover:bg-amber-50 hover:border-amber-200 hover:text-amber-700 hover:shadow-sm transition-all active:scale-95">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Ubah
                                            </a>
                                            <form action="{{ route('admin.rooms.destroy', [$room->kdkamar, 'type' => 'kost']) }}" method="POST"
                                                class="flex-1">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-white border-2 border-slate-100 text-rose-500 rounded-xl text-xs font-bold hover:bg-rose-50 hover:border-rose-200 hover:text-rose-700 hover:shadow-sm transition-all active:scale-95"
                                                    onclick="return confirm('Hapus kamar ini?')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Villa --}}
        <div>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-200">
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-bold text-slate-900">Villa</h2>
                        <p class="text-sm text-slate-500">{{ $villas->count() }} villa</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid gap-5" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
                        @foreach($villas as $villa)
                            <div
                                class="bg-white border-2 border-slate-200 rounded-xl overflow-hidden hover:border-cyan-500 hover:shadow-lg transition-all p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-bold text-slate-900">{{ $villa->namavilla }}</h3>
                                    <span class="text-2xl font-bold">Rp
                                        {{ number_format($villa->hargasewa, 0, ',', '.') }}</span>
                                </div>
                                <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{ $villa->deskripsi }}</p>

                                <div class="mb-4">
                                    @if($villa->status == 'terisi')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-100 text-red-600 text-[10px] font-black uppercase tracking-wider">
                                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                            Terisi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-600 text-[10px] font-black uppercase tracking-wider">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                            Tersedia
                                        </span>
                                    @endif
                                </div>

                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('admin.rooms.show', [$villa->kdvilla, 'type' => 'villa']) }}"
                                        class="flex items-center justify-center gap-2 px-4 py-2.5 bg-white border-2 border-slate-100 text-slate-700 rounded-xl text-xs font-bold hover:bg-cyan-50 hover:border-cyan-200 hover:text-cyan-700 hover:shadow-sm transition-all active:scale-95">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Kalender
                                    </a>
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.rooms.edit', [$villa->kdvilla, 'type' => 'villa']) }}"
                                            class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-white border-2 border-slate-100 text-slate-600 rounded-xl text-xs font-bold hover:bg-amber-50 hover:border-amber-200 hover:text-amber-700 hover:shadow-sm transition-all active:scale-95">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            Ubah
                                        </a>
                                        <form action="{{ route('admin.rooms.destroy', [$villa->kdvilla, 'type' => 'villa']) }}"
                                            method="POST" class="flex-1">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-white border-2 border-slate-100 text-rose-500 rounded-xl text-xs font-bold hover:bg-rose-50 hover:border-rose-200 hover:text-rose-700 hover:shadow-sm transition-all active:scale-95"
                                                onclick="return confirm('Hapus villa ini?')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection