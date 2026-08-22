@extends('layouts.app')

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

    {{-- Hero Section --}}
    <section class="relative h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-purple-900 to-blue-900">
        {{-- Background Image with Overlay --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/rooms/home.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-purple-900/60 via-slate-900/40 to-blue-900/80"></div>
        </div>

        {{-- Animated Background Elements --}}
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 h-full flex flex-col justify-center items-center text-center pt-20">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight leading-tight">
                Villa Eksklusif<br>
                <span class="bg-gradient-to-r from-purple-400 to-blue-500 bg-clip-text text-transparent">Untuk Liburan Anda</span>
            </h1>

            <p class="text-xl md:text-2xl text-slate-300 mb-10 max-w-3xl mx-auto font-light">
                Villa mewah dengan pemandangan indah dan fasilitas premium. Mulai dari Rp 270k/Malam.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#villas" class="px-8 py-4 bg-gradient-to-r from-purple-500 to-blue-600 hover:from-purple-600 hover:to-blue-700 text-white rounded-full font-semibold text-lg transition-all transform hover:scale-105 shadow-xl shadow-purple-500/30">
                    Lihat Villa Tersedia →
                </a>
                <a href="/kontak" class="px-8 py-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white border-2 border-white/30 rounded-full font-semibold text-lg transition-all">
                    Hubungi Kami
                </a>
            </div>

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-8 mt-16 max-w-2xl mx-auto">
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-400 mb-2">{{ $villas->count() }}</div>
                    <div class="text-slate-400 text-sm uppercase tracking-wide">Villa Tersedia</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-400 mb-2">{{ $villas->count() }}</div>
                    <div class="text-slate-400 text-sm uppercase tracking-wide">Siap Huni</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-purple-400 mb-2">24/7</div>
                    <div class="text-slate-400 text-sm uppercase tracking-wide">Layanan</div>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    {{-- Villas Section --}}
    <div id="villas" class="bg-white py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-purple-600 font-semibold uppercase tracking-wider text-sm">Pilihan Premium</span>
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4 mt-2">Pilihan Villa</h2>
                <p class="text-slate-600 text-lg max-w-2xl mx-auto">Nikmati liburan sempurna di villa eksklusif kami</p>
            </div>

            <!-- GLOBAL GALLERY SECTION -->
            @php
                $allImages = collect();
                $seenFiles = [];

                foreach($villas as $v) {
                    $imgs = $v->fotoVilla ?? [];
                    
                    foreach($imgs as $img) {
                        $filename = basename($img->jalur_foto);
                        if (preg_match('/^\d+_[a-z0-9]+_(.+)$/', $filename, $matches)) {
                             $originalName = $matches[1];
                        } else {
                             $originalName = $filename;
                        }

                        if (!in_array($originalName, $seenFiles)) {
                            $seenFiles[] = $originalName;
                            $allImages->push(['url' => Storage::url($img->jalur_foto), 'name' => $v->namavilla ?? 'Unit']);
                        }
                    }
                }
                
                $galleryImages = $allImages->take(20);
            @endphp

            @if($galleryImages->count() > 0)
                <div class="mb-16">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-slate-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Galeri Foto
                        </h2>
                        <span class="text-sm text-slate-500">Geser untuk melihat lebih banyak &rarr;</span>
                    </div>
                    
                    <div class="relative group">
                        <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 scroll-smooth hide-scrollbar">
                            @foreach($galleryImages as $imgItem)
                                <div class="flex-none w-72 md:w-96 aspect-[4/3] snap-center relative rounded-2xl overflow-hidden shadow-lg group/card hover:-translate-y-1 transition-transform duration-300">
                                    <img src="{{ $imgItem['url'] }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover/card:opacity-100 transition-opacity">
                                        <div class="absolute bottom-4 left-4 text-white font-medium text-sm">
                                            {{ $imgItem['name'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="absolute inset-y-0 left-0 w-8 bg-gradient-to-r from-slate-50 to-transparent pointer-events-none"></div>
                        <div class="absolute inset-y-0 right-0 w-8 bg-gradient-to-l from-slate-50 to-transparent pointer-events-none"></div>
                    </div>
                </div>
            @endif

            <!-- Grid of Cards -->
            @if ($villas->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($villas as $villa)
                        @php 
                            $name = $villa->namavilla ?? 'Unit';
                            $price = $villa->hargasewa;
                            $id = $villa->kdvilla;
                            $deskripsi = $villa->deskripsi ?? 'Hunian nyaman dengan fasilitas lengkap.';
                            $priceK = ($price >= 1000) ? number_format($price / 1000, 0) . 'K' : $price;
                        @endphp
                        
                        <!-- Premium Card -->
                        <div class="group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] hover:border-cyan-200 transition-all duration-500 flex flex-col h-full relative hover:-translate-y-1">
                            
                            <!-- Header with Status -->
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 group-hover:text-cyan-700 transition-colors tracking-tight font-sans">{{ $name }}</h3>
                                    <span class="inline-block mt-2 bg-gradient-to-r from-purple-50 to-pink-50 text-purple-600 border border-purple-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                        Villa Premium
                                    </span>
                                </div>
                                <span class="bg-green-50 text-green-600 border border-green-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider shadow-sm">
                                    Tersedia
                                </span>
                            </div>

                            <!-- Description -->
                            <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2">
                                {{ Str::limit($deskripsi, 60) }}
                            </p>

                            <!-- Facilities Box -->
                            <div class="bg-slate-50 rounded-2xl p-5 mb-8 border border-slate-100 group-hover:bg-cyan-50/30 group-hover:border-cyan-100 transition-colors">
                                <p class="text-xs text-slate-500 font-medium leading-relaxed">
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Fasilitas Unit</span> 
                                    <span class="text-slate-700">
                                        {{ $villa->fasilitas ?: 'Fasilitas standar tersedia.' }}
                                    </span>
                                </p>
                            </div>

                            <!-- Footer: Price & Action -->
                            <div class="mt-auto flex items-end justify-between pt-4 border-t border-slate-50 relative">
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-1">Mulai Dari</p>
                                    <div class="flex items-baseline">
                                        <span class="text-xs font-semibold text-cyan-600 align-top mr-0.5">Rp</span>
                                        <span class="text-2xl font-extrabold text-slate-900 tracking-tight">{{ $priceK }}</span>
                                        <span class="text-xs text-slate-400 font-medium ml-1">/mlm</span>
                                    </div>
                                </div>
                                
                                <a href="/register" 
                                    class="relative overflow-hidden bg-slate-900 hover:bg-cyan-600 text-white pl-6 pr-8 py-3 rounded-2xl transition-all duration-300 shadow-lg shadow-slate-900/10 group/btn">
                                    <span class="relative z-10 text-xs font-bold uppercase tracking-wider">Booking</span>
                                    <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-white/50 group-hover/btn:text-white group-hover/btn:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-6 text-slate-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Data</h3>
                    <p class="text-slate-500 max-w-md mx-auto">Saat ini belum ada villa yang tersedia untuk disewa. Silakan cek kembali nanti.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
