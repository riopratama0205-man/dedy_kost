@extends('layouts.admin')

@section('admin-content')
    <div class="mb-8">
        <a href="{{ route('admin.bookings.index') }}"
            class="group inline-flex items-center text-slate-500 hover:text-cyan-700 font-medium transition-colors mb-4">
            <div
                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center mr-2 group-hover:bg-cyan-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </div>
            Kembali ke Daftar
        </a>
        <div>
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Tambah Booking Manual</h1>
            <p class="text-slate-600">Buat booking baru untuk penyewa atau blokir tanggal.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 md:p-8 max-w-4xl">
        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column: Details -->
                <div class="space-y-6">
                    <h3 class="font-bold text-lg text-slate-800 flex items-center pb-3 border-b border-slate-100">
                        <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Utama
                    </h3>

                    <!-- User Selection -->
                    <div
                        class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Pilih
                            Penyewa</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-hover:text-cyan-500 transition-colors" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <select id="user-select" name="idpenyewa"
                                class="pl-10 block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm py-2.5 font-medium text-slate-700 bg-white shadow-sm">
                                <option value="">-- Pilih Akun Penyewa --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->idpenyewa }}">{{ $user->namapenyewa }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('idpenyewa') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Room Selection -->
                    <div
                        class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Pilih
                            Kamar</label>
                        <div class="relative">
                            <select id="room-select" name="kdkamar"
                                class="block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm py-2.5 font-medium text-slate-700 bg-white shadow-sm">
                                <option value="">-- Pilih Kamar (Optional jika Villa) --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->kdkamar }}">{{ $room->namakamar }} - Rp
                                        {{ number_format($room->hargasewa, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('kdkamar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Villa Selection -->
                    <div
                        class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Pilih
                            Villa</label>
                        <div class="relative">
                            <select id="villa-select" name="kdvilla"
                                class="block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm py-2.5 font-medium text-slate-700 bg-white shadow-sm">
                                <option value="">-- Pilih Villa (Optional jika Kamar) --</option>
                                @foreach($villas as $villa)
                                    <option value="{{ $villa->kdvilla }}">{{ $villa->namavilla }} - Rp
                                        {{ number_format($villa->hargasewa, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('kdvilla') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Status Selection -->
                    <div
                        class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Status
                            Pesanan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-hover:text-cyan-500 transition-colors" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <select name="status"
                                class="pl-10 block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm py-2.5 font-medium text-slate-700 bg-white shadow-sm">
                                <option value="menunggu">Menunggu Konfirmasi</option>
                                <option value="disetujui">Disetujui</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                        @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Right Column: Date & Notes -->
                <div class="space-y-6">
                    <h3 class="font-bold text-lg text-slate-800 flex items-center pb-3 border-b border-slate-100">
                        <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Jadwal & Catatan
                    </h3>

                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group">
                            <label
                                class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Check-in</label>
                            <input type="date" name="tglmulai"
                                class="block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm py-2.5 bg-white shadow-sm">
                            @error('tglmulai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div
                            class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group">
                            <label
                                class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Check-out</label>
                            <input type="date" name="tglselesai"
                                class="block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm py-2.5 bg-white shadow-sm">
                            @error('tglselesai') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div
                        class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group h-[calc(100%-8rem)]">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Catatan
                            Tambahan</label>
                        <textarea name="catatan" rows="6"
                            class="block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm bg-white shadow-sm h-full resize-none"
                            placeholder="Tulis catatan jika ada..."></textarea>
                    </div>
                </div>
            </div>

            <div class="pt-8 mt-8 border-t border-slate-100 flex justify-end">
                <button type="submit"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition-all transform hover:scale-[1.02] flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Booking
                </button>
            </div>
        </form>
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
        <style>
            /* Custom styling to match Tailwind UI */
            .ts-control {
                border-radius: 0.5rem;
                padding: 0.75rem 0.75rem 0.75rem 2.5rem !important;
                /* pl-10 roughly */
                border-color: #cbd5e1;
                /* slate-300 */
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                background-image: none;
                z-index: 10;
            }

            .ts-control.focus {
                border-color: #06b6d4;
                /* cyan-500 */
                box-shadow: 0 0 0 1px #06b6d4;
            }

            .ts-wrapper.group:hover .ts-control {
                border-color: #67e8f9;
                /* cyan-300 */
            }

            .ts-dropdown {
                border-radius: 0.5rem;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                border-color: #e2e8f0;
                z-index: 50;
            }

            .ts-dropdown .option.active {
                background-color: #ecfeff;
                /* cyan-50 */
                color: #0891b2;
                /* cyan-600 */
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var config = {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                };
                new TomSelect("#user-select", config);
                new TomSelect("#room-select", config);
            });
        </script>
    @endpush
@endsection