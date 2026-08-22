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
                <span class="text-cyan-300 font-semibold text-sm uppercase tracking-wider">📖 Panduan Lengkap</span>
            </div>

            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Panduan<br>
                <span class="bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">Penggunaan</span>
            </h1>

            <p class="text-xl md:text-2xl text-slate-300 max-w-3xl mx-auto font-light">
                Langkah mudah untuk mulai menyewa hunian impian Anda di DEDY KOST.
            </p>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    {{-- Steps Section --}}
    <div id="steps" class="bg-white py-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto mb-20">
                <!-- Step 1 -->
                <div
                    class="bg-gradient-to-br from-slate-50 to-cyan-50/30 p-8 rounded-2xl border border-slate-200 hover:border-cyan-500/50 transition-all group hover:shadow-xl hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/30">
                        <span class="text-3xl font-bold text-white">1</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Daftar Akun</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Buat akun baru sebagai penyewa dengan mengisi data diri lengkap. Pastikan email yang digunakan aktif
                        untuk verifikasi.
                    </p>
                </div>

                <!-- Step 2 -->
                <div
                    class="bg-gradient-to-br from-slate-50 to-blue-50/30 p-8 rounded-2xl border border-slate-200 hover:border-cyan-500/50 transition-all group hover:shadow-xl hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/30">
                        <span class="text-3xl font-bold text-white">2</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Pilih Kamar</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Jelajahi daftar kamar dan villa yang tersedia. Lihat fasilitas, lokasi, dan harga yang sesuai dengan
                        kebutuhan Anda.
                    </p>
                </div>

                <!-- Step 3 -->
                <div
                    class="bg-gradient-to-br from-slate-50 to-cyan-50/30 p-8 rounded-2xl border border-slate-200 hover:border-cyan-500/50 transition-all group hover:shadow-xl hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/30">
                        <span class="text-3xl font-bold text-white">3</span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-4">Ajukan Sewa</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Pilih kamar yang diinginkan dan ajukan permohonan sewa. Tunggu konfirmasi dari admin dan lakukan
                        pembayaran.
                    </p>
                </div>
            </div>

            {{-- Policies Section --}}
            <div class="max-w-4xl mx-auto mb-20">
                <div class="text-center mb-12">
                    <span class="text-cyan-600 font-semibold uppercase tracking-wider text-sm">Aturan & Kebijakan</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-2">Kebijakan & Ketentuan</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="bg-white p-6 rounded-xl border border-slate-200 flex items-start space-x-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-3 bg-cyan-50 rounded-lg text-cyan-600 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Penghuni yang Diterima</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Penginapan menerima penghuni mahasiswa/i, karyawan/i, serta pasangan suami istri.
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-xl border border-slate-200 flex items-start space-x-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-3 bg-cyan-50 rounded-lg text-cyan-600 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Kebijakan Anak</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Penghuni diperbolehkan membawa anak.
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-xl border border-slate-200 flex items-start space-x-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-3 bg-cyan-50 rounded-lg text-cyan-600 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Kebijakan Hewan Peliharaan</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Untuk menjaga kenyamanan bersama, hewan peliharaan tidak diperbolehkan berada di area
                                penginapan.
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-xl border border-slate-200 flex items-start space-x-4 shadow-sm hover:shadow-md transition-shadow">
                        <div class="p-3 bg-cyan-50 rounded-lg text-cyan-600 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Jam Akses</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Kost menyediakan akses keluar–masuk 24 jam, tanpa batasan jam malam.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA Section --}}
            <div
                class="bg-gradient-to-br from-cyan-600 to-blue-700 rounded-3xl p-8 md:p-12 text-center shadow-xl relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
                </div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Butuh Bantuan Lebih Lanjut?</h2>
                    <p class="text-cyan-100 text-lg mb-8 max-w-2xl mx-auto">
                        Tim support kami siap membantu Anda 24/7 jika mengalami kendala dalam penggunaan aplikasi.
                    </p>
                    <a href="/kontak"
                        class="inline-block px-10 py-4 bg-white text-cyan-600 hover:bg-slate-100 rounded-full font-bold text-lg transition-all shadow-xl hover:scale-105">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection