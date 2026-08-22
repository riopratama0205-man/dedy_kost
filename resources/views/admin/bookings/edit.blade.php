@extends('layouts.admin')

@section('admin-content')
    <div class="mb-8">
        {{-- Back Button --}}
        <a href="{{ route('admin.bookings.index') }}"
            class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium mb-4 group transition-all">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar Booking
        </a>

        <h1 class="text-3xl font-bold text-slate-900 mb-2">Edit Booking</h1>
        <p class="text-slate-600">Ubah detail booking atau status.</p>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8 max-w-4xl">
        <form action="{{ route('admin.bookings.update', $booking->kdsewa) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Left Column: User & Payment --}}
                <div class="space-y-6">
                    <div>
                        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Data Penyewa
                        </h3>
                        <div class="bg-slate-50 p-4 rounded-xl border-2 border-slate-100">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Penyewa</label>
                            <p class="font-bold text-slate-900">{{ $booking->penyewa->namapenyewa ?? 'Unknown' }}</p>
                            <p class="text-xs text-slate-500 font-medium">{{ $booking->penyewa->email ?? '-' }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                            Informasi Pembayaran
                        </h3>
                        <div
                            class="p-5 rounded-2xl border-2 border-dashed {{ \Illuminate\Support\Str::contains($booking->catatan, '[BAYAR DI TEMPAT]') ? 'bg-amber-50/50 border-amber-200' : 'bg-blue-50/50 border-blue-200' }}">
                            @if(\Illuminate\Support\Str::contains($booking->catatan, '[BAYAR DI TEMPAT]'))
                                <div class="flex items-center text-amber-700 font-black text-xs uppercase tracking-tight">
                                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    Bayar di Tempat (Cash)
                                </div>
                            @else
                                <div class="flex items-center text-blue-700 font-black text-xs uppercase tracking-tight">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    Transfer / QRIS
                                </div>
                            @endif

                            @if($booking->buktibayar)
                                <div class="mt-4 pt-4 border-t border-slate-200/50">
                                    <p class="text-[10px] font-black text-slate-400 uppercase mb-2">Bukti Pembayaran</p>
                                    <a href="{{ asset('storage/' . $booking->buktibayar) }}" target="_blank"
                                        class="group block relative aspect-video rounded-xl overflow-hidden border-2 border-slate-200 hover:border-cyan-500 transition-all shadow-sm bg-white">
                                        <img src="{{ asset('storage/' . $booking->buktibayar) }}"
                                            class="w-full h-full object-cover transition-transform group-hover:scale-105">
                                        <div
                                            class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity">
                                            <span
                                                class="bg-white text-slate-900 text-[10px] font-black px-3 py-1.5 rounded-full uppercase">Lihat
                                                Foto</span>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Right Column: Unit & Schedule --}}
                <div class="space-y-6">
                    <div>
                        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            Pilihan Unit & Jadwal
                        </h3>
                        <div class="bg-slate-50 p-5 rounded-2xl border-2 border-slate-100 space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-[10px] font-black text-slate-500 uppercase mb-1.5 ml-1">Kamar</label>
                                    <select name="kdkamar"
                                        class="w-full rounded-xl border-2 border-slate-200 focus:border-cyan-500 focus:ring-cyan-500 font-bold text-sm bg-white py-2.5">
                                        <option value="">-- Pilih --</option>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->kdkamar }}" {{ $booking->kdkamar == $room->kdkamar ? 'selected' : '' }}>{{ $room->namakamar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-black text-slate-500 uppercase mb-1.5 ml-1">Villa</label>
                                    <select name="kdvilla"
                                        class="w-full rounded-xl border-2 border-slate-200 focus:border-cyan-500 focus:ring-cyan-500 font-bold text-sm bg-white py-2.5">
                                        <option value="">-- Pilih --</option>
                                        @foreach($villas as $villa)
                                            <option value="{{ $villa->kdvilla }}" {{ $booking->kdvilla == $villa->kdvilla ? 'selected' : '' }}>{{ $villa->namavilla }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-[10px] font-black text-slate-500 uppercase mb-1.5 ml-1">Check-in</label>
                                    <input type="date" name="tglmulai"
                                        value="{{ \Carbon\Carbon::parse($booking->tglmulai)->format('Y-m-d') }}"
                                        class="w-full rounded-xl border-2 border-slate-200 focus:border-cyan-500 focus:ring-cyan-500 font-bold text-sm bg-white">
                                </div>
                                <div>
                                    <label
                                        class="block text-[10px] font-black text-slate-500 uppercase mb-1.5 ml-1">Check-out</label>
                                    <input type="date" name="tglselesai"
                                        value="{{ \Carbon\Carbon::parse($booking->tglselesai)->format('Y-m-d') }}"
                                        class="w-full rounded-xl border-2 border-slate-200 focus:border-cyan-500 focus:ring-cyan-500 font-bold text-sm bg-white">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-4 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Status & Catatan
                        </h3>
                        <div class="bg-slate-50 p-5 rounded-2xl border-2 border-slate-100 space-y-4">
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase mb-1.5 ml-1">Status
                                    Booking</label>
                                <select name="status"
                                    class="w-full rounded-xl border-2 border-slate-200 focus:border-cyan-500 focus:ring-cyan-500 font-black text-sm bg-white py-2.5 uppercase tracking-wide">
                                    <option value="menunggu" {{ $booking->status == 'menunggu' ? 'selected' : '' }}
                                        class="font-bold text-yellow-600">MENUNGGU</option>
                                    <option value="disetujui" {{ $booking->status == 'disetujui' ? 'selected' : '' }}
                                        class="font-bold text-green-600">DISETUJUI</option>
                                    <option value="ditolak" {{ $booking->status == 'ditolak' ? 'selected' : '' }}
                                        class="font-bold text-red-600">DITOLAK</option>
                                    <option value="dibatalkan" {{ $booking->status == 'dibatalkan' ? 'selected' : '' }}
                                        class="font-bold text-slate-600">DIBATALKAN</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black text-slate-500 uppercase mb-1.5 ml-1">Catatan
                                    Admin</label>
                                <textarea name="catatan" rows="3"
                                    class="w-full rounded-xl border-2 border-slate-200 focus:border-cyan-500 focus:ring-cyan-500 font-medium text-sm bg-white"
                                    placeholder="Tambahkan catatan jika perlu...">{{ $booking->catatan }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end pt-6 border-t border-slate-100">
                <button type="submit"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white px-10 py-3.5 rounded-2xl font-black uppercase tracking-widest transition-all shadow-lg shadow-cyan-600/20 hover:scale-105 active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection