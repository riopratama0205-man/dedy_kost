@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <section
        class="relative h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-cyan-900">
        {{-- Background Image with Overlay --}}
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/rooms/home.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-900/60 via-slate-900/40 to-slate-900/80"></div>
        </div>

        {{-- Animated Background Elements --}}
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 1s;"></div>
        </div>

        <div
            class="relative z-10 container mx-auto px-6 h-full flex flex-col justify-center items-center text-center pt-20">
            <div class="mb-4 inline-block px-6 py-2 bg-cyan-500/20 backdrop-blur-sm border border-cyan-500/30 rounded-full">
                <span class="text-cyan-300 font-semibold text-sm uppercase tracking-wider">📞 Hubungi Kami</span>
            </div>

            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Kami Siap<br>
                <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Membantu Anda</span>
            </h1>

            <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto font-light">
                Punya pertanyaan atau ingin memesan? Jangan ragu untuk menghubungi kami.
            </p>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    {{-- Contact Section --}}
    <div id="contact" class="bg-white py-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-6xl mx-auto mb-12">
                {{-- Contact Info --}}
                <div>
                    <div
                        class="bg-gradient-to-br from-slate-50 to-cyan-50/30 p-8 rounded-2xl border border-slate-200 shadow-lg">
                        <h3 class="text-2xl font-bold text-slate-900 mb-6">Informasi Kontak</h3>

                        <div class="space-y-6">
                            {{-- Alamat --}}
                            <a href="https://maps.app.goo.gl/bkXkptMrbKwSqnsQ8" target="_blank"
                                class="flex items-start space-x-4 group hover:bg-white p-4 rounded-xl transition-all">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white shrink-0 group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/30">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-slate-900 font-bold mb-1 group-hover:text-cyan-600 transition-colors">
                                        Alamat</h4>
                                    <p class="text-slate-600 text-sm">Jl. Adityawarman No.28, The Hok - Jambi</p>
                                </div>
                            </a>

                            {{-- WhatsApp --}}
                            <div class="flex items-start space-x-4 p-4 bg-white rounded-xl">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-cyan-500/30">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-slate-900 font-bold mb-1">Telepon / WhatsApp</h4>
                                    <div class="flex flex-col space-y-1">
                                        <a href="https://wa.me/628127334976" target="_blank"
                                            class="text-slate-600 text-sm hover:text-cyan-600 transition-colors font-medium">0812-7334-976</a>
                                        <a href="https://wa.me/6281274917928" target="_blank"
                                            class="text-slate-600 text-sm hover:text-cyan-600 transition-colors font-medium">0812-7491-7928</a>
                                    </div>
                                </div>
                            </div>

                            {{-- TikTok --}}
                            <a href="https://www.tiktok.com/@rintidedykost?_r=1&_t=ZS-91sgjPpramw" target="_blank"
                                class="flex items-start space-x-4 group hover:bg-white p-4 rounded-xl transition-all">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white shrink-0 group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/30">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-slate-900 font-bold mb-1 group-hover:text-cyan-600 transition-colors">
                                        TikTok</h4>
                                    <p class="text-slate-600 text-sm">@rintidedykost</p>
                                </div>
                            </a>

                            {{-- Instagram --}}
                            <a href="https://www.instagram.com/rintisundari2006?igsh=OHRocXpkMzd4eXRw" target="_blank"
                                class="flex items-start space-x-4 group hover:bg-white p-4 rounded-xl transition-all">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white shrink-0 group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/30">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01M7.8 21h8.4a5.5 5.5 0 005.5-5.5v-8.4a5.5 5.5 0 00-5.5-5.5H7.8a5.5 5.5 0 00-5.5 5.5v8.4a5.5 5.5 0 005.5 5.5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-slate-900 font-bold mb-1 group-hover:text-cyan-600 transition-colors">
                                        Instagram</h4>
                                    <p class="text-slate-600 text-sm">@rintisundari2006</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Message CTA --}}
                <div>
                    <div
                        class="bg-gradient-to-br from-cyan-600 to-blue-700 p-8 rounded-2xl flex flex-col justify-center items-center text-center shadow-xl h-full relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                            <div class="absolute bottom-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white mb-6 mx-auto">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-3xl font-bold text-white mb-4">Ingin Mengirim Pesan?</h3>
                            <p class="text-cyan-100 mb-8 max-w-md mx-auto text-lg">
                                Fitur pengiriman pesan hanya tersedia untuk penyewa yang terdaftar. Silakan login terlebih
                                dahulu untuk menghubungi kami melalui dashboard penyewa.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="/login"
                                    class="px-8 py-3 bg-white text-cyan-600 hover:bg-slate-100 font-bold rounded-full transition-all shadow-xl hover:scale-105">
                                    Login Penyewa
                                </a>
                                <a href="/register"
                                    class="px-8 py-3 bg-transparent border-2 border-white text-white hover:bg-white/10 font-bold rounded-full transition-all">
                                    Daftar Baru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Map Embed - Full Width --}}
            <div class="max-w-6xl mx-auto">
                <div class="bg-white p-2 rounded-2xl border border-slate-200 h-96 relative overflow-hidden shadow-lg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.234779286869!2d103.6045463!3d-1.6144864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2588f495555555%3A0x4b7b5b5b5b5b5b5b!2sJl.%20Adityawarman%20No.28%2C%20The%20Hok%2C%20Kec.%20Jambi%20Sel.%2C%20Kota%20Jambi%2C%20Jambi!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="rounded-xl grayscale hover:grayscale-0 transition-all duration-500"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection