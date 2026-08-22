@extends('layouts.app', ['hideNavbar' => true])

@section('content')
    <div class="min-h-screen bg-slate-50 pt-32 pb-12">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto">
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-8 font-medium">
                    <a href="{{ route('user.dashboard') }}" class="hover:text-cyan-600 transition-colors">Dashboard</a>
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('user.messages.index') }}" class="hover:text-cyan-600 transition-colors">Pesan
                        Saya</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-cyan-600 font-bold">Kirim Pesan</span>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-cyan-50 mb-4">
                            <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                </path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-slate-900">Kirim Pesan</h1>
                        <p class="text-slate-500 mt-2">Hubungi admin untuk pertanyaan atau bantuan.</p>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-slate-600 text-sm font-medium mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" readonly
                                    class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-slate-600 text-sm font-medium mb-2">Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" readonly
                                    class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-500 cursor-not-allowed">
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-600 text-sm font-medium mb-2">Subjek</label>
                            <select name="subject" required
                                class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:outline-none focus:border-cyan-500 transition-colors appearance-none">
                                <option value="" disabled selected>Pilih subjek pesan...</option>
                                <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                                <option value="Laporan Kerusakan">Laporan Kerusakan</option>
                                <option value="Masalah Pembayaran">Masalah Pembayaran</option>
                                <option value="Keluhan">Keluhan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-slate-600 text-sm font-medium mb-2">Pesan</label>
                            <textarea name="message" rows="5" required
                                class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:outline-none focus:border-cyan-500 transition-colors"
                                placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-4 rounded-xl transition-all transform hover:scale-[1.02] shadow-lg shadow-cyan-500/30">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection