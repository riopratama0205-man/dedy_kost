@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-slate-100 to-cyan-50/20 pt-28 pb-20 animate-fade-in-up">
        <div class="container mx-auto px-6 max-w-7xl">
            <!-- Header & Navigation -->
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <div class="flex items-center space-x-2 text-sm text-slate-500 mb-4 font-medium"> 
                        <a href="{{ route('user.dashboard') }}" class="hover:text-cyan-600 transition-colors">Dashboard</a>
                        <span class="text-slate-300">/</span>
                        <span class="text-cyan-600 font-bold">Daftar {{ $type === 'kost' ? 'Kamar Kost' : ucfirst($type) }}</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-slate-900 tracking-tight font-sans">
                        Daftar {{ $type === 'kost' ? 'Kamar Kost' : ucfirst($type) }}
                    </h1>
                    <p class="text-slate-500 mt-2 text-lg">Temukan hunian {{ $type === 'villa' ? 'liburan' : 'nyaman' }} impian Anda hari ini.</p>
                </div>
            </div>

            <!-- GLOBAL GALLERY SECTION (Moved from Cards to Top) -->
            @php
                // Collect Unique images based on original filename to prevent duplicates
                $allImages = collect();
                $seenFiles = [];

                foreach($rooms as $r) {
                    $imgs = $type === 'kost' ? ($r->fotoKamar ?? []) : ($r->fotoVilla ?? []);
                    
                    foreach($imgs as $img) {
                        $filename = basename($img->jalur_foto);
                        // Extract original name (remove id_uniqid_ prefix added by seeder)
                        // Pattern matches: {id}_{uniqid}_{original_filename}
                        if (preg_match('/^\d+_[a-z0-9]+_(.+)$/', $filename, $matches)) {
                             $originalName = $matches[1];
                        } else {
                             $originalName = $filename;
                        }

                        if (!in_array($originalName, $seenFiles)) {
                            $seenFiles[] = $originalName;
                            $allImages->push(['url' => Storage::url($img->jalur_foto), 'name' => $r->namakamar ?? ($r->namavilla ?? 'Unit')]);
                        }
                    }
                }
                
                // Show all unique images found (up to 20)
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
                        <div id="topGallery" class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 scroll-smooth hide-scrollbar">
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
                        <!-- Blur Edges -->
                        <div class="absolute inset-y-0 left-0 w-8 bg-gradient-to-r from-slate-50 to-transparent pointer-events-none"></div>
                        <div class="absolute inset-y-0 right-0 w-8 bg-gradient-to-l from-slate-50 to-transparent pointer-events-none"></div>
                    </div>
                </div>
            @endif

            <!-- Grid of Cards (Visual Updates: Premium Design Mockup) -->
            @if ($rooms->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($rooms as $room)
                        @php 
                            $name = $room->namakamar ?? ($room->namavilla ?? 'Unit');
                            $price = $room->hargasewa;
                            $id = $room->kdkamar ?? ($room->kdvilla ?? null);
                            $deskripsi = $room->deskripsi ?? 'Hunian nyaman dengan fasilitas lengkap.';
                            
                            // Format price to K (e.g. 270000 -> 270K)
                            $priceK = ($price >= 1000) ? number_format($price / 1000, 0) . 'K' : $price;
                        @endphp
                        
                        <!-- Premium Card -->
                        <div class="group bg-white rounded-[2rem] p-6 border border-slate-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgb(0,0,0,0.08)] hover:border-cyan-200 transition-all duration-500 flex flex-col h-full relative hover:-translate-y-1">
                            
                            <!-- Header with Status -->
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 group-hover:text-cyan-700 transition-colors tracking-tight font-sans">{{ $name }}</h3>
                                    <span class="inline-block mt-2 bg-gradient-to-r from-purple-50 to-pink-50 text-purple-600 border border-purple-100 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                        {{ $type === 'kost' ? 'Kost Premium' : ucfirst($type) . ' Premium' }}
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
                                        {{ $room->fasilitas ?: 'Fasilitas standar tersedia.' }}
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
                                
                                <a href="{{ route('user.rooms.show', ['id' => $id, 'type' => $type]) }}" 
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
                    <p class="text-slate-500 max-w-md mx-auto">Saat ini belum ada unit {{ $type }} yang tersedia untuk disewa. Silakan cek kembali nanti.</p>
                </div>
            @endif
        </div>
    </div>
@endsection

