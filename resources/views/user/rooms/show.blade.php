@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Premium Calendar Styling */
        .flatpickr-calendar {
            background: #ffffff !important;
            border: none !important;
            border-radius: 1.5rem !important;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
            font-family: inherit !important;
        }
        
        /* Specific for Inline Availability Calendar */
        #availabilityCalendar .flatpickr-calendar {
            width: 100% !important;
            max-width: 100% !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        .flatpickr-months .flatpickr-month {
            height: 50px !important;
            color: #1e293b !important;
        }

        .flatpickr-current-month {
            font-size: 1.1rem !important;
            font-weight: 700 !important;
        }

        span.flatpickr-weekday {
            color: #94a3b8 !important;
            font-weight: 700 !important;
        }

        .flatpickr-day {
            border-radius: 10px !important;
            color: #475569 !important;
            font-weight: 500 !important;
            margin: 2px !important;
            border: 1px solid transparent !important;
        }

        .flatpickr-day:hover {
            background: #f1f5f9 !important;
            color: #0f172a !important;
        }

        .flatpickr-day.today {
            border-color: #06b6d4 !important;
            color: #06b6d4 !important;
            background: #ecfeff !important;
        }

        .flatpickr-day.selected, 
        .flatpickr-day.startRange, 
        .flatpickr-day.endRange {
            background: #0ea5e9 !important;
            color: white !important;
            border-color: #0ea5e9 !important;
            box-shadow: 0 4px 6px -1px rgb(14 165 233 / 0.4) !important;
        }

        .flatpickr-day.inRange {
            background: #f0f9ff !important;
            border-color: transparent !important;
            color: #075985 !important;
            box-shadow: -5px 0 0 #f0f9ff, 5px 0 0 #f0f9ff !important;
        }

        .flatpickr-day.booked-date {
            background: #fff1f2 !important;
            color: #e11d48 !important;
            text-decoration: line-through !important;
            opacity: 0.5 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }

        .flatpickr-day.flatpickr-disabled {
            color: #cbd5e1 !important;
            background: transparent !important;
        }

        /* Modal & Blur Effects */
        .blur-wrapper {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        body.modal-open header,
        body.modal-open .blur-wrapper,
        body.modal-open footer {
            filter: blur(15px) grayscale(30%);
            transform: scale(0.985);
            pointer-events: none;
        }

        /* Ensure header and footer transition smoothly */
        header, footer {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .booking-modal {
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* Booked Dates Styling */
        .flatpickr-day.booked-date,
        .flatpickr-day.booked-date.flatpickr-disabled,
        .flatpickr-day.booked-date.flatpickr-disabled:hover {
            background: #ef4444 !important;
            border-color: #dc2626 !important;
            color: #ffffff !important;
            opacity: 1 !important;
            cursor: not-allowed !important;
        }
        
        .flatpickr-day.booked-date::after {
            font-size: 10px;
            position: absolute;
            top: 2px;
            right: 2px;
            color: white !important;
            font-weight: 900;
            z-index: 10;
        }
    </style>
@endpush

@section('content')
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <div id="main-content" class="blur-wrapper">
        <div class="min-h-screen bg-gradient-to-br from-slate-50 via-slate-100 to-blue-50/20 pt-28 pb-20 animate-fade-in-up">
        <div class="container mx-auto px-6 max-w-7xl">
            <!-- Breadcrumb & Back -->
            <div class="flex items-center space-x-2 text-sm text-slate-500 mb-8 font-medium">
                <a href="{{ route('user.dashboard') }}" class="hover:text-cyan-600 transition-colors">Dashboard</a>
                <span class="text-slate-300">/</span>
                <a href="{{ route('user.rooms.list', $type) }}" class="hover:text-cyan-600 transition-colors">Daftar
                    {{ ucfirst($type) }}</a>
                <span class="text-slate-300">/</span>
                <span class="text-cyan-600 font-bold">{{ $room->namakamar ?? ($room->namavilla ?? 'Detail Unit') }}</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                <!-- Left Column: Content (8 cols) -->
                <div class="lg:col-span-8 space-y-10">

                    @php
                        $images = $type === 'kost' ? ($room->fotoKamar ?? collect([])) : ($room->fotoVilla ?? collect([]));
                        // If no images, use a placeholder
                        $imageUrls = $images->count() > 0
                            ? $images->map(fn($img) => Storage::url($img->jalur_foto))
                            : collect([]);
                    @endphp



                    <!-- Room Header & Pricing -->
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-10 border-b border-slate-100">
                        <div>
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="flex items-center text-xs font-bold text-slate-400 uppercase tracking-wider">
                                    <svg class="w-4 h-4 mr-1 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Lokasi Strategis
                                </span>
                            </div>
                            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight font-sans mb-2">
                                {{ $room->namakamar ?? ($room->namavilla ?? '-') }}
                            </h1>
                            <p class="text-slate-400 text-lg">Hunian eksklusif dengan kenyamanan maksimal.</p>
                        </div>
                        <div class="text-right">
                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1">Mulai Dari</div>
                            <div class="flex items-center justify-end">
                                <span class="text-5xl font-bold text-cyan-600 mr-1">Rp</span>
                                <span class="text-5xl font-extrabold text-slate-900 tracking-tighter">
                                    {{ number_format($room->hargasewa, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="text-sm font-medium text-slate-400 mt-1">per malam</div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="prose prose-lg prose-slate max-w-none">
                        <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Tentang Unit Ini
                        </h3>
                        <p class="text-slate-600 leading-relaxed text-lg">
                            {{ trim($room->deskripsi) ?: 'Nikmati kenyamanan hunian modern dengan fasilitas lengkap yang dirancang untuk mendukung gaya hidup Anda. Hubungi kami untuk informasi lebih lanjut.' }}
                        </p>
                    </div>

                    <!-- Facilities -->
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-8 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            Fasilitas
                        </h3>
                        @if ($room->fasilitas)
                            @php
                                $iconMap = [
                                    'ac'             => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                                    'wifi'           => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>',
                                    'parkir'         => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>',
                                    'km dalam'       => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
                                    'kamar mandi dalam' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
                                    'lemari'         => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v18M19 3v18M3 3h18v18H3V3zM12 3v18"/>',
                                    'kasur'          => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12v6h18v-6M3 12V8a2 2 0 012-2h14a2 2 0 012 2v4M3 12h18"/>',
                                    'dapur'          => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/>',
                                    'tv'             => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
                                    'kolam renang'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12.5l1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1M4.5 16.5l1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1M3 8l9-5 9 5"/>',
                                    'listrik'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                                    'air panas'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"/>',
                                    'keamanan 24 jam'=> '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
                                    'meja & kursi'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>',
                                    'meja dan kursi' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>',
                                    // default (checkmark)
                                    'default'        => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>',
                                ];
                            @endphp
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach (explode(',', $room->fasilitas) as $fasilitas)
                                    @php
                                        $fasKey = strtolower(trim($fasilitas));
                                        $icon = $iconMap[$fasKey] ?? $iconMap['default'];
                                    @endphp
                                    <div class="flex items-center p-4 bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-md hover:border-cyan-200 hover:bg-cyan-50/40 transition-all duration-300 group">
                                        <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center mr-3 flex-shrink-0 group-hover:bg-cyan-500 group-hover:text-white transition-all duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icon !!}</svg>
                                        </div>
                                        <span class="font-semibold text-slate-700 text-sm group-hover:text-cyan-900">{{ trim($fasilitas) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-8 bg-slate-50 rounded-2xl border border-slate-100 text-center text-slate-500 italic">
                                Belum ada data fasilitas.
                            </div>
                        @endif
                    </div>

                    <!-- Availability -->
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-8 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Ketersediaan
                        </h3>
                        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                            <div id="availabilityCalendar"></div>
                            
                            <!-- Calendar Legend -->
                            <div class="mt-8 pt-8 border-t border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-4 h-4 rounded-md bg-white border border-slate-200"></div>
                                    <span class="text-sm font-medium text-slate-600">Tersedia</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-4 h-4 rounded-md bg-red-500 border border-red-600 flex items-center justify-center font-bold text-[8px] text-white tracking-tighter shadow-sm">✕</div>
                                    <span class="text-sm font-medium text-slate-600 font-bold">Terisi</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-4 h-4 rounded-md bg-cyan-50 border border-cyan-200"></div>
                                    <span class="text-sm font-medium text-slate-600">Hari Ini</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-4 h-4 rounded-md bg-slate-50 border border-slate-200 flex items-center justify-center font-bold text-[8px] text-slate-300">/</div>
                                    <span class="text-sm font-medium text-slate-600">Lampau</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sticky Booking (4 cols) -->
                <div class="lg:col-span-4">
                    <div class="sticky top-8 space-y-6">
                        <!-- Unified Booking & Info Card -->
                        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-[0_20px_50px_rgb(0,0,0,0.08)] overflow-hidden relative">
                            <!-- Decor -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-50/50 rounded-bl-[4rem] -mr-8 -mt-8 pointer-events-none"></div>
                            
                            <div class="p-8">
                                <div class="mb-8 relative">
                                    <h3 class="font-extrabold text-slate-900 text-2xl">Booking Unit</h3>
                                    <p class="text-slate-400 text-xs mt-1 font-medium italic">Silakan pilih tanggal hunian Anda.</p>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-8">
                                    <div onclick="document.getElementById('checkin').focus()" class="bg-slate-50 p-5 rounded-3xl border-2 border-slate-100 group hover:bg-white hover:border-cyan-500 hover:shadow-2xl hover:shadow-cyan-500/20 transition-all duration-500 cursor-pointer relative overflow-hidden active:scale-95">
                                        <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="bg-cyan-500 text-white text-[8px] font-black px-2 py-0.5 rounded-full uppercase tracking-tighter shadow-sm animate-bounce">Klik</span>
                                        </div>
                                        <label class="flex items-center text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-3 group-hover:text-cyan-600 transition-colors pointer-events-none">
                                            <svg class="w-4 h-4 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            Check-In
                                        </label>
                                        <input type="text" id="checkin" name="start_date" placeholder="Pilih Tanggal" required readonly
                                            value="{{ old('tglmulai') }}"
                                            class="w-full bg-transparent text-lg font-black text-slate-900 placeholder-slate-300 outline-none cursor-pointer">
                                    </div>
                                    <div onclick="document.getElementById('checkout').focus()" class="bg-slate-50 p-5 rounded-3xl border-2 border-slate-100 group hover:bg-white hover:border-cyan-500 hover:shadow-2xl hover:shadow-cyan-500/20 transition-all duration-500 cursor-pointer relative overflow-hidden active:scale-95">
                                        <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="bg-cyan-500 text-white text-[8px] font-black px-2 py-0.5 rounded-full uppercase tracking-tighter shadow-sm animate-bounce">Klik</span>
                                        </div>
                                        <label class="flex items-center text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mb-3 group-hover:text-cyan-600 transition-colors pointer-events-none">
                                            <svg class="w-4 h-4 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            Check-Out
                                        </label>
                                        <input type="text" id="checkout" name="end_date" placeholder="Pilih Tanggal" required readonly
                                            value="{{ old('tglselesai') }}"
                                            class="w-full bg-transparent text-lg font-black text-slate-900 placeholder-slate-300 outline-none cursor-pointer">
                                    </div>
                                </div>

                                <div class="bg-slate-50 rounded-[2rem] p-6 mb-8 border border-slate-100">
                                    <h4 class="font-black text-slate-400 mb-4 text-[10px] uppercase tracking-[0.2em]">Informasi Penting</h4>
                                    <div class="grid grid-cols-1 gap-4">
                                        <div class="flex items-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center mr-3 shrink-0 text-blue-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                            <div>
                                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-tighter">Check-in</span>
                                                <strong class="text-slate-900 text-sm font-black">14:00 WIB</strong>
                                            </div>
                                        </div>
                                        <div class="flex items-center p-3 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center mr-3 shrink-0 text-blue-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            </div>
                                            <div>
                                                <span class="block text-[9px] font-black text-slate-400 uppercase tracking-tighter">Check-out</span>
                                                <strong class="text-slate-900 text-sm font-black">12:00 WIB</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" onclick="openBookingModal()"
                                    class="w-full py-6 bg-slate-900 text-white rounded-[2rem] font-black text-sm tracking-[0.2em] uppercase hover:bg-cyan-600 transition-all duration-300 shadow-2xl shadow-slate-900/30 hover:shadow-cyan-500/40 flex items-center justify-center group overflow-hidden relative">
                                    <span class="relative z-10 group-hover:pr-8 transition-all duration-300">Lanjutkan Booking</span>
                                    <svg class="w-6 h-6 absolute right-8 opacity-0 group-hover:opacity-100 group-hover:right-12 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="bookingModal" class="fixed inset-0 z-[100] hidden overflow-y-auto bg-slate-900/40 backdrop-blur-sm transition-all duration-500" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl overflow-hidden booking-modal scale-95 opacity-0 transform" id="modalContainer">
                {{-- Modal Header --}}
                <div class="p-8 pb-4 flex justify-between items-center border-b border-slate-50">
                    <h3 class="text-xl font-extrabold text-slate-800 tracking-tight">Konfirmasi Pesan</h3>
                    <button onclick="closeBookingModal()" class="text-slate-400 hover:text-slate-600 transition-colors p-2 hover:bg-slate-50 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="p-8 md:p-10 pt-6">
                    <form action="{{ route('user.bookings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        {{-- Error Notifications --}}
                        @if ($errors->any())
                            <div class="bg-red-50 border-2 border-red-100 p-6 rounded-3xl animate-shake mb-4">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-red-100 rounded-xl flex items-center justify-center text-red-600 mr-4 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-red-900 uppercase tracking-widest mb-1">Gagal Memproses Pesanan</h4>
                                        <ul class="list-disc list-inside text-xs text-red-700 font-medium space-y-0.5">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @elseif(session('error'))
                            <div class="bg-red-50 border-2 border-red-100 p-6 rounded-3xl animate-shake mb-4">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-red-100 rounded-xl flex items-center justify-center text-red-600 mr-4 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-red-900 uppercase tracking-widest mb-1">Pemberitahuan</h4>
                                        <p class="text-xs text-red-700 font-medium">{{ session('error') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <input type="hidden" name="id" value="{{ $room->kdkamar ?? $room->kdvilla }}">
                        <input type="hidden" name="type" value="{{ $type }}">

                        {{-- Section: Dates Info (Readonly) --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Check-In</label>
                                <input type="text" id="modal_tglmulai" name="tglmulai" readonly class="bg-transparent font-bold text-slate-900 outline-none w-full">
                            </div>
                            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Check-Out</label>
                                <input type="text" id="modal_tglselesai" name="tglselesai" readonly class="bg-transparent font-bold text-slate-900 outline-none w-full">
                            </div>
                        </div>

                        {{-- Section: Payment --}}
                        <div class="space-y-4">
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Metode Pembayaran</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="relative flex items-center p-5 border-2 border-slate-100 bg-slate-50 rounded-2xl cursor-pointer hover:border-cyan-400 transition-all group has-[:checked]:border-cyan-500 has-[:checked]:bg-cyan-50/30">
                                    <input type="radio" name="payment_method" value="transfer" checked class="hidden modal-payment-radio">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 group-hover:text-cyan-600 group-[.has-\[:checked\]]:text-cyan-600 transition-colors shadow-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                        </div>
                                        <div>
                                            <span class="block font-black text-slate-900 uppercase text-[10px] tracking-tight text-left">Transfer / QRIS</span>
                                            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-tighter">
                                                {{ $paymentMethod->norek ?? '123-456-789' }} ({{ $paymentMethod->namabank ?? 'BCA' }})
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ml-auto opacity-0 group-[.has-\[:checked\]]:opacity-100 transition-opacity">
                                        <div class="w-4 h-4 bg-cyan-600 rounded-full flex items-center justify-center">
                                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </div>
                                </label>
                                <label class="relative flex items-center p-5 border-2 border-slate-100 bg-slate-50 rounded-2xl cursor-pointer hover:border-cyan-400 transition-all group has-[:checked]:border-cyan-500 has-[:checked]:bg-cyan-50/30">
                                    <input type="radio" name="payment_method" value="cash" class="hidden modal-payment-radio">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 group-hover:text-cyan-600 group-[.has-\[:checked\]]:text-cyan-600 transition-colors shadow-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <div>
                                            <span class="block font-black text-slate-900 uppercase text-[10px] tracking-tight">Bayar di Tempat</span>
                                            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-tighter">Saat Tiba</p>
                                        </div>
                                    </div>
                                    <div class="ml-auto opacity-0 group-[.has-\[:checked\]]:opacity-100 transition-opacity">
                                        <div class="w-4 h-4 bg-cyan-600 rounded-full flex items-center justify-center">
                                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-[10px] text-red-500 font-black uppercase tracking-widest mt-2 ml-1">
                                    * {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div id="modalTransferInfo" class="space-y-4">
                            <div class="p-6 bg-blue-50/50 border-2 border-blue-100 border-dashed rounded-3xl relative overflow-hidden group">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600/5 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                                <div class="relative z-10 flex flex-col md:flex-row gap-6 items-center">
                                    <div class="flex-grow space-y-3 w-full">
                                        <label class="block text-[10px] font-black text-blue-900 uppercase tracking-[0.2em] mb-1">Detail Rekening</label>
                                        <div class="flex items-center justify-between p-3 bg-white/80 rounded-xl border border-blue-100">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">{{ $paymentMethod->namabank ?? 'Bank BCA' }}</span>
                                            <span class="text-sm font-black text-slate-900 tracking-wider">{{ $paymentMethod->norek ?? '123-456-7890' }}</span>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-white/80 rounded-xl border border-blue-100">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Atas Nama</span>
                                            <span class="text-xs font-black text-slate-900 uppercase">{{ $paymentMethod->pemilikrek ?? 'DEDY KOST ADMIN' }}</span>
                                        </div>
                                    </div>
                                    <div class="shrink-0">
                                        <div class="w-32 h-32 bg-white p-2 rounded-2xl border-2 border-blue-100 shadow-sm flex flex-col items-center justify-center relative group-hover:scale-105 transition-transform overflow-hidden">
                                            @if($paymentMethod && $paymentMethod->gambar_qr_code)
                                                <img src="{{ Storage::url($paymentMethod->gambar_qr_code) }}" alt="QRIS" class="w-full h-full object-contain rounded-xl">
                                            @else
                                                {{-- QRIS Placeholder --}}
                                                <div class="w-full h-full bg-slate-50 rounded-xl flex items-center justify-center flex-col space-y-1">
                                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 17h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Scan QRIS</span>
                                                </div>
                                            @endif
                                            @if(!($paymentMethod && $paymentMethod->gambar_qr_code))
                                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 rounded-2xl">
                                                     <span class="text-[8px] font-black text-blue-600 uppercase text-center px-2">Belum ada Gambar QRIS</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-6 bg-slate-50 border-2 border-slate-100 border-dashed rounded-3xl">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Upload Bukti Transfer</label>
                                <div class="relative group">
                                    <input type="file" name="buktibayar" class="w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-cyan-600 file:text-white hover:file:bg-cyan-700 transition-all cursor-pointer">
                                </div>
                                <p class="text-[9px] text-slate-400 font-bold uppercase mt-3">* Format: JPG, PNG (Maks. 2MB)</p>
                                @error('buktibayar')
                                    <p class="text-[10px] text-red-500 font-black uppercase tracking-widest mt-2">
                                        * {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div id="modalCashInfo" class="hidden">
                             <div class="p-6 bg-amber-50/50 border-2 border-amber-200 border-dashed rounded-3xl relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-24 h-24 bg-amber-500/10 rounded-full -mr-12 -mt-12 blur-2xl"></div>
                                <div class="relative z-10 flex items-start space-x-4">
                                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 shrink-0">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="space-y-2">
                                        <h4 class="text-xs font-black text-amber-900 uppercase tracking-widest leading-none">Instruksi Pembayaran</h4>
                                        <p class="text-[11px] text-amber-800/80 font-medium leading-relaxed">
                                            Silakan melakukan pembayaran tunai langsung kepada admin/pengelola saat Anda tiba di lokasi. <br>
                                            <span class="font-black text-amber-900 mt-1 block uppercase">• Harap tunjukkan kartu identitas yang berlaku.</span>
                                            <span class="font-black text-amber-900 block uppercase">• Pembayaran wajib diselesaikan sebelum serah terima kunci.</span>
                                        </p>
                                    </div>
                                </div>
                             </div>
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-6">
                            <button type="button" onclick="closeBookingModal()"
                                class="px-8 py-3.5 bg-slate-50 text-slate-500 rounded-2xl font-bold text-xs tracking-wider uppercase hover:bg-slate-100 transition-all">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-10 py-3.5 bg-cyan-600 text-white rounded-2xl font-bold text-xs tracking-wider uppercase hover:bg-cyan-700 transition-all shadow-lg shadow-cyan-600/20">
                                Kirim Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookedDates = @json($bookedDates);
            const disableDates = bookedDates.map(booking => ({
                from: booking.start_date,
                to: booking.end_date
            }));

            flatpickr("#availabilityCalendar", {
                inline: true,
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disableDates,
                onDayCreate: function (dObj, dStr, fp, dayElem) {
                    const dateStr = fp.formatDate(dayElem.dateObj, "Y-m-d");
                    if (bookedDates.some(b => dateStr >= b.start_date && dateStr <= b.end_date)) {
                        dayElem.classList.add('booked-date');
                    }
                }
            });

            const checkin = flatpickr("#checkin", {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disableDates,
                onDayCreate: function (dObj, dStr, fp, dayElem) {
                    const dateStr = fp.formatDate(dayElem.dateObj, "Y-m-d");
                    if (bookedDates.some(b => dateStr >= b.start_date && dateStr <= b.end_date)) {
                        dayElem.classList.add('booked-date');
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates[0]) {
                        const nextDay = new Date(selectedDates[0]);
                        nextDay.setDate(nextDay.getDate() + 1);
                        checkout.set("minDate", nextDay);
                        setTimeout(() => checkout.open(), 100);
                    }
                }
            });

            const checkout = flatpickr("#checkout", {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disableDates,
                onDayCreate: function (dObj, dStr, fp, dayElem) {
                    const dateStr = fp.formatDate(dayElem.dateObj, "Y-m-d");
                    if (bookedDates.some(b => dateStr >= b.start_date && dateStr <= b.end_date)) {
                        dayElem.classList.add('booked-date');
                    }
                },
                onOpen: function(selectedDates, dateStr, instance) {
                    if (!checkin.selectedDates[0]) {
                        instance.close();
                        checkin.open();
                    }
                }
            });

            // Modal Logic
            window.openBookingModal = function() {
                const startDate = document.getElementById('checkin').value;
                const endDate = document.getElementById('checkout').value;

                if (!startDate || !endDate) {
                    alert('Silakan pilih tanggal check-in dan check-out terlebih dahulu.');
                    return;
                }

                document.getElementById('modal_tglmulai').value = startDate;
                document.getElementById('modal_tglselesai').value = endDate;

                const modal = document.getElementById('bookingModal');
                const container = document.getElementById('modalContainer');
                
                modal.classList.remove('hidden');
                document.body.classList.add('modal-open');
                
                setTimeout(() => {
                    container.classList.remove('scale-95', 'opacity-0');
                    container.classList.add('scale-100', 'opacity-100');
                }, 10);
            };

            window.closeBookingModal = function() {
                const modal = document.getElementById('bookingModal');
                const container = document.getElementById('modalContainer');
                
                container.classList.remove('scale-100', 'opacity-100');
                container.classList.add('scale-95', 'opacity-0');
                
                setTimeout(() => {
                    modal.classList.add('hidden');
                    document.body.classList.remove('modal-open');
                }, 400);
            };

            // Modal Payment Info Toggle
            document.querySelectorAll('.modal-payment-radio').forEach(radio => {
                radio.addEventListener('change', (e) => {
                    const transferInfo = document.getElementById('modalTransferInfo');
                    const cashInfo = document.getElementById('modalCashInfo');
                    
                    if (e.target.value === 'transfer') {
                        transferInfo.classList.remove('hidden');
                        cashInfo.classList.add('hidden');
                    } else {
                        transferInfo.classList.add('hidden');
                        cashInfo.classList.remove('hidden');
                    }
                });
            });

            // Auto-reopen modal if there are validation errors
            @if ($errors->any() || session('error'))
                const start = document.getElementById('checkin').value;
                const end = document.getElementById('checkout').value;
                if (start && end) {
                    setTimeout(() => {
                        openBookingModal();
                    }, 500);
                }
            @endif
        });
    </script>
@endpush