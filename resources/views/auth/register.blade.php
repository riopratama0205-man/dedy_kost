@extends('layouts.app', ['hideNavbar' => true])

@section('content')
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-slate-800 to-cyan-900 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        {{-- Logo Top Left --}}
        <div class="absolute top-6 left-6 z-20">
            <a href="/" class="flex items-center space-x-2 hover:opacity-90 transition-all group">
                <div class="logo-icon flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </div>
                <span class="logo-text">DEDY KOST</span>
            </a>
        </div>

        <div class="max-w-md w-full space-y-8 relative z-10">
            <div class="bg-white/95 backdrop-blur-sm p-8 rounded-2xl shadow-2xl">
                <div class="text-center mb-8">
                    <h2
                        class="text-4xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent mb-2">
                        Daftar</h2>
                    <p class="text-slate-600">Bergabung dengan DEDY KOST hari ini</p>
                </div>

                <form class="space-y-5" action="/register" method="POST">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                        <input name="namapenyewa" type="text" required value="{{ old('namapenyewa') }}"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('namapenyewa') border-red-500 @enderror"
                            placeholder="Nama Lengkap">
                        @error('namapenyewa') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input name="email" type="email" required value="{{ old('email') }}"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('email') border-red-500 @enderror"
                            placeholder="nama@email.com">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nomor HP</label>
                        <input name="telp" type="text" required value="{{ old('telp') }}"
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('telp') border-red-500 @enderror"
                            placeholder="08123456789">
                        @error('telp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" name="password" type="password" required
                                class="w-full px-4 py-3 pr-11 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('password') border-red-500 @enderror"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password', 'eye-password')"
                                class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="w-full px-4 py-3 pr-11 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-500"
                                placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye-confirm')"
                                class="absolute inset-y-0 right-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg id="eye-confirm" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <script>
                        function togglePassword(inputId, iconId) {
                            const input = document.getElementById(inputId);
                            const icon  = document.getElementById(iconId);
                            const isHidden = input.type === 'password';
                            input.type = isHidden ? 'text' : 'password';

                            // Ganti icon: mata terbuka ↔ mata dicoret
                            icon.innerHTML = isHidden
                                ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.05-3.37M6.938 6.938A9.967 9.967 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-1.544 2.952M6.938 6.938L3 3m3.938 3.938l9.124 9.124M3 3l18 18" />`
                                : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
                        }
                    </script>

                    <button type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold rounded-xl transition-all shadow-lg shadow-cyan-500/30">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-6">
                    <p class="text-center text-sm text-slate-600">
                        Sudah punya akun?
                        <a href="/login" class="font-medium text-cyan-600 hover:text-cyan-700">Masuk disini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection