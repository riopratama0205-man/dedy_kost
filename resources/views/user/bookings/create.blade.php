@extends('layouts.app', ['hideNavbar' => true])

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .flatpickr-calendar {
            background: #ffffff !important;
            border: none !important;
            border-radius: 1.5rem !important;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1) !important;
            padding: 10px !important;
        }

        .flatpickr-day.selected {
            background: #0891b2 !important;
            border-color: #0891b2 !important;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 pt-12 pb-20 animate-fade-in">
        {{-- Logo Header --}}
        <div class="container mx-auto px-6 mb-12">
            <div class="flex items-center justify-between">
                <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-2 group">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-2xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">DEDY
                        KOST</span>
                </a>
                <div class="hidden md:flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-slate-600 font-medium">Konfirmasi Booking</span>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">
                {{-- Breadcrumb --}}
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-8 font-medium">
                    <a href="{{ route('user.dashboard') }}" class="hover:text-cyan-600 transition-colors">Dashboard</a>
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('user.rooms.show', ['id' => $room->kdkamar ?? $room->kdvilla, 'type' => isset($room->kdkamar) ? 'kost' : 'villa']) }}"
                        class="hover:text-cyan-600 transition-colors">Detail Unit</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-cyan-600 font-bold">Booking</span>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-cyan-900/5 overflow-hidden">
                    {{-- Header Card --}}
                    <div class="bg-slate-900 p-8 md:p-10 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-cyan-500/10 rounded-full -mr-32 -mt-32 blur-3xl">
                        </div>
                        <div class="relative z-10">
                            <h1 class="text-3xl md:text-4xl font-black mb-2">Form Pemesanan</h1>
                            <p class="text-slate-400 font-medium">Lengkapi detail terakhir untuk hunian impian Anda.</p>
                        </div>
                    </div>

                    <div class="p-8 md:p-10">
                        @if ($errors->any())
                            <div
                                class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-2xl mb-8 flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <ul class="text-sm font-bold tracking-tight">
                                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.bookings.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-10">
                            @csrf
                            <input type="hidden" name="kdunit" value="{{ $room->kdkamar ?? $room->kdvilla }}">

                            {{-- Section: Unit Info --}}
                            <div
                                class="flex flex-col md:flex-row items-center gap-6 p-6 bg-slate-50 rounded-3xl border border-slate-100">
                                <div
                                    class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center shadow-sm text-cyan-600 border border-slate-100 shrink-0">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-slate-900">
                                        {{ $room->namakamar ?? ($room->namavilla ?? 'Unit Terpilih') }}</h3>
                                    <p class="text-slate-500 font-medium">Rp
                                        {{ number_format($room->hargasewa, 0, ',', '.') }} / malam</p>
                                </div>
                                <div class="md:ml-auto">
                                    <span
                                        class="bg-cyan-100 text-cyan-700 px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest">Tersedia</span>
                                </div>
                            </div>

                            {{-- Section: Dates --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="relative group">
                                    <label
                                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Tanggal
                                        Check-In</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400 group-hover:text-cyan-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="text" id="tglmulai" name="tglmulai" required
                                            value="{{ request('start_date') }}"
                                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl pl-12 pr-6 py-4 text-slate-900 font-bold focus:bg-white focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 outline-none transition-all cursor-pointer">
                                    </div>
                                </div>
                                <div class="relative group">
                                    <label
                                        class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-2">Tanggal
                                        Check-Out</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400 group-hover:text-cyan-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="text" id="tglselesai" name="tglselesai" required
                                            value="{{ request('end_date') }}"
                                            class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl pl-12 pr-6 py-4 text-slate-900 font-bold focus:bg-white focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 outline-none transition-all cursor-pointer">
                                    </div>
                                </div>
                            </div>

                            {{-- Section: Payment --}}
                            <div class="space-y-6">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-2">Metode
                                    Pembayaran</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <label
                                        class="relative flex items-center p-6 border-2 border-slate-100 bg-slate-50 rounded-3xl cursor-pointer hover:border-cyan-400 hover:bg-white transition-all group has-[:checked]:border-cyan-500 has-[:checked]:bg-cyan-50/30 has-[:checked]:ring-4 has-[:checked]:ring-cyan-500/10">
                                        <input type="radio" name="payment_method" value="transfer" checked
                                            class="hidden">
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-slate-400 group-hover:text-cyan-600 group-[.has-\[:checked\]]:text-cyan-600 transition-colors shadow-sm">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <span
                                                    class="block font-black text-slate-900 uppercase text-xs tracking-tight">Transfer
                                                    Bank / QRIS</span>
                                                <p
                                                    class="text-[10px] text-slate-500 font-bold uppercase tracking-tighter mt-0.5">
                                                    123-456-789 (BCA)</p>
                                            </div>
                                        </div>
                                        <div
                                            class="ml-auto opacity-0 group-[.has-\[:checked\]]:opacity-100 transition-opacity">
                                            <div class="w-5 h-5 bg-cyan-600 rounded-full flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>
                                    <label
                                        class="relative flex items-center p-6 border-2 border-slate-100 bg-slate-50 rounded-3xl cursor-pointer hover:border-cyan-400 hover:bg-white transition-all group has-[:checked]:border-cyan-500 has-[:checked]:bg-cyan-50/30 has-[:checked]:ring-4 has-[:checked]:ring-cyan-500/10">
                                        <input type="radio" name="payment_method" value="cash" class="hidden">
                                        <div class="flex items-center space-x-4">
                                            <div
                                                class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-slate-400 group-hover:text-cyan-600 group-[.has-\[:checked\]]:text-cyan-600 transition-colors shadow-sm">
                                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <span
                                                    class="block font-black text-slate-900 uppercase text-xs tracking-tight">Bayar
                                                    di Tempat</span>
                                                <p
                                                    class="text-[10px] text-slate-500 font-bold uppercase tracking-tighter mt-0.5">
                                                    Bayar Saat Tiba</p>
                                            </div>
                                        </div>
                                        <div
                                            class="ml-auto opacity-0 group-[.has-\[:checked\]]:opacity-100 transition-opacity">
                                            <div class="w-5 h-5 bg-cyan-600 rounded-full flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div id="transferInfo"
                                class="p-8 bg-blue-50/50 border-2 border-blue-100 border-dashed rounded-[2rem]">
                                <label class="block text-sm font-black text-blue-900 uppercase tracking-widest mb-4">Bukti
                                    Pembayaran</label>
                                <div class="relative">
                                    <input type="file" name="buktibayar"
                                        class="w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-black file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all cursor-pointer">
                                </div>
                                <p class="text-[10px] text-blue-700 font-bold uppercase mt-4">* Ekstensi yang didukung: JPG,
                                    PNG (Maks 2MB)</p>
                            </div>

                            <div class="flex flex-col md:flex-row-reverse gap-4 pt-6 border-t border-slate-100">
                                <button type="submit"
                                    class="flex-grow py-5 bg-cyan-600 text-white rounded-[2rem] font-black text-sm tracking-[0.2em] uppercase hover:bg-cyan-700 transition-all duration-300 shadow-xl shadow-cyan-500/30">
                                    Konfirmasi Pemesanan
                                </button>
                                <a href="{{ route('user.rooms.show', ['id' => $room->kdkamar ?? $room->kdvilla, 'type' => isset($room->kdkamar) ? 'kost' : 'villa']) }}"
                                    class="px-12 py-5 bg-slate-100 text-slate-600 rounded-[2rem] font-black text-sm tracking-[0.2em] uppercase hover:bg-slate-200 transition-all text-center">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookedDates = @json($bookedDates);
            const disableDates = bookedDates.map(b => ({ from: b.tglmulai, to: b.tglselesai }));

            const start = flatpickr("#tglmulai", {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disableDates,
                onChange: (s, d) => end.set('minDate', d)
            });
            const end = flatpickr("#tglselesai", {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disableDates
            });

            document.querySelectorAll('input[name="metode_pembayaran"]').forEach(radio => {
                radio.addEventListener('change', (e) => {
                    const info = document.getElementById('transferInfo');
                    if (e.target.value === 'transfer') {
                        info.style.display = 'block';
                    } else {
                        info.style.display = 'none';
                    }
                });
            });
        });
    </script>
@endpush