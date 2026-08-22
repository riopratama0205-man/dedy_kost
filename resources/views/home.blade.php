@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section
        class="relative h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-cyan-900">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/rooms/home.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/40 to-slate-900/80"></div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 1s;"></div>
        </div>

        <div
            class="relative z-10 container mx-auto px-6 h-full flex flex-col justify-center items-center text-center pt-20">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 tracking-tight leading-tight">
                Sewa Kamar & Villa<br>
                <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Terbaik di
                    Kota</span>
            </h1>

            <p class="text-xl md:text-2xl text-slate-300 mb-10 max-w-3xl mx-auto font-light">
                Bersih, Strategis, dan Harga Terjangkau. Rasakan pengalaman menginap seperti di rumah sendiri.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/register"
                    class="px-8 py-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-full font-semibold text-lg transition-all transform hover:scale-105 shadow-xl shadow-cyan-500/30">
                    Mulai Sekarang →
                </a>
                <a href="/kost"
                    class="px-8 py-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white border-2 border-white/30 rounded-full font-semibold text-lg transition-all">
                    Lihat Kamar
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-8 mt-16 max-w-2xl mx-auto">
                <div class="text-center">
                    <div class="text-4xl font-bold text-cyan-400 mb-2">{{ $totalKamar }}</div>
                    <div class="text-slate-400 text-sm uppercase tracking-wide">Kamar Kost</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-cyan-400 mb-2">{{ $totalVilla }}</div>
                    <div class="text-slate-400 text-sm uppercase tracking-wide">Villa</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold text-cyan-400 mb-2">24/7</div>
                    <div class="text-slate-400 text-sm uppercase tracking-wide">Layanan</div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <span class="text-cyan-600 font-semibold uppercase tracking-wider text-sm">Keunggulan Kami</span>
                <h2 class="text-3xl md:text-5xl font-bold mb-4 text-slate-900 mt-2">Kenapa Memilih Kami?</h2>
                <p class="text-slate-600 max-w-2xl mx-auto text-lg">Kami menyediakan fasilitas terbaik untuk kenyamanan dan
                    keamanan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="p-8 rounded-2xl bg-gradient-to-br from-slate-50 to-cyan-50/30 border border-slate-200 hover:border-cyan-500/50 transition-all hover:shadow-xl hover:-translate-y-2 group">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 text-white group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-slate-900">Lokasi Strategis</h3>
                    <p class="text-slate-600 leading-relaxed">Terletak di pusat kota, dekat dengan berbagai fasilitas umum,
                        kampus, dan akses transportasi mudah.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="p-8 rounded-2xl bg-gradient-to-br from-slate-50 to-blue-50/30 border border-slate-200 hover:border-cyan-500/50 transition-all hover:shadow-xl hover:-translate-y-2 group">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 text-white group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-slate-900">Fasilitas Lengkap</h3>
                    <p class="text-slate-600 leading-relaxed">Kamar mandi dalam, AC, WiFi super cepat, area parkir luas,
                        rental motor, dan minimarket untuk kemudahan Anda.</p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="p-8 rounded-2xl bg-gradient-to-br from-slate-50 to-cyan-50/30 border border-slate-200 hover:border-cyan-500/50 transition-all hover:shadow-xl hover:-translate-y-2 group">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 text-white group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-slate-900">Keamanan 24 Jam</h3>
                    <p class="text-slate-600 leading-relaxed">Sistem keamanan CCTV 24 jam dan penjaga keamanan profesional
                        untuk ketenangan Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-cyan-600 to-blue-700 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Siap Menemukan Hunian Impian Anda?
                </h2>
                <p class="text-xl text-cyan-100 mb-10">
                    Daftar sekarang dan dapatkan penawaran spesial untuk penyewa baru!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/register"
                        class="px-10 py-4 bg-white text-cyan-600 hover:bg-slate-100 rounded-full font-bold text-lg transition-all transform hover:scale-105 shadow-xl">
                        Daftar Gratis
                    </a>
                    <a href="/kontak"
                        class="px-10 py-4 bg-transparent border-2 border-white text-white hover:bg-white/10 rounded-full font-bold text-lg transition-all">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection