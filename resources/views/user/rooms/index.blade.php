@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 pt-12 pb-12">
        <div class="container mx-auto px-6">
            <a href="{{ route('user.dashboard') }}"
                class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium mb-8 group transition-all">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Dashboard
            </a>

            <div class="mb-12 text-center">
                <h1 class="text-3xl font-bold text-slate-900 mb-4">Pilih Tipe Hunian</h1>
                <p class="text-slate-600">Silakan pilih jenis hunian yang Anda inginkan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Kamar Kost Card -->
                <a href="{{ route('user.rooms.list', 'kost') }}"
                    class="group relative overflow-hidden rounded-2xl aspect-video bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-cyan-500 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-50/50 via-transparent to-transparent z-10">
                    </div>
                    <!-- Placeholder Image -->
                    <div
                        class="absolute inset-0 bg-slate-100 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                        <svg class="w-24 h-24 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 p-8 z-20 w-full bg-white/90 backdrop-blur-sm border-t border-slate-100">
                        <h2 class="text-3xl font-bold text-slate-900 mb-2 group-hover:text-cyan-600 transition-colors">Kamar
                            Kost</h2>
                        <p class="text-slate-600">Hunian nyaman untuk mahasiswa dan karyawan.</p>
                        <div class="mt-4 flex items-center text-cyan-600 font-medium">
                            Lihat Daftar Kamar
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Villa Card -->
                <a href="{{ route('user.rooms.list', 'villa') }}"
                    class="group relative overflow-hidden rounded-2xl aspect-video bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-cyan-500 transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-50/50 via-transparent to-transparent z-10">
                    </div>
                    <!-- Placeholder Image -->
                    <div
                        class="absolute inset-0 bg-slate-100 flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                        <svg class="w-24 h-24 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div
                        class="absolute bottom-0 left-0 p-8 z-20 w-full bg-white/90 backdrop-blur-sm border-t border-slate-100">
                        <h2 class="text-3xl font-bold text-slate-900 mb-2 group-hover:text-cyan-600 transition-colors">Villa
                        </h2>
                        <p class="text-slate-600">Liburan seru bersama keluarga atau teman.</p>
                        <div class="mt-4 flex items-center text-cyan-600 font-medium">
                            Lihat Daftar Villa
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection