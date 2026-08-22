@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-slate-50 py-20 px-4 relative">
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

        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-2xl border border-slate-200 shadow-xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-slate-900 uppercase tracking-wider">Admin Daftar</h2>
                <p class="mt-2 text-sm text-slate-600">
                    Daftar sebagai Admin DEDY KOST
                </p>
            </div>
            <form class="mt-8 space-y-6" action="#" method="POST">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="name" class="sr-only">Nama Lengkap</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            class="appearance-none relative block w-full px-3 py-3 border border-slate-300 placeholder-slate-400 text-slate-900 bg-white rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Nama Lengkap">
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none relative block w-full px-3 py-3 border border-slate-300 placeholder-slate-400 text-slate-900 bg-white rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Email address">
                    </div>
                    <div>
                        <label for="admin_code" class="sr-only">Kode Admin</label>
                        <input id="admin_code" name="admin_code" type="text" required
                            class="appearance-none relative block w-full px-3 py-3 border border-slate-300 placeholder-slate-400 text-slate-900 bg-white rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Kode Admin (Verifikasi)">
                    </div>
                    <div>
                        <div x-data="{ show: false }" class="relative">
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" :type="show ? 'text' : 'password'"
                                autocomplete="new-password" required
                                class="appearance-none relative block w-full px-3 py-3 border border-slate-300 placeholder-slate-400 text-slate-900 bg-white rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-colors"
                                placeholder="Password">
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <div x-data="{ show: false }" class="relative">
                            <label for="password_confirmation" class="sr-only">Konfirmasi Password</label>
                            <input id="password_confirmation" name="password_confirmation"
                                :type="show ? 'text' : 'password'" autocomplete="new-password" required
                                class="appearance-none relative block w-full px-3 py-3 border border-slate-300 placeholder-slate-400 text-slate-900 bg-white rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-colors"
                                placeholder="Konfirmasi Password">
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all transform hover:scale-105 shadow-lg shadow-cyan-500/30 uppercase tracking-wide">
                        Daftar sebagai Admin
                    </button>
                </div>
            </form>
            <div class="text-center mt-4 space-y-2">
                <p class="text-sm text-slate-600">
                    Sudah punya akun admin?
                    <a href="/admin/login" class="font-medium text-cyan-600 hover:text-cyan-700 transition-colors">
                        Masuk Admin
                    </a>
                </p>
                <p class="text-sm text-slate-600">
                    Bukan admin?
                    <a href="/register" class="font-medium text-slate-500 hover:text-slate-900 transition-colors">
                        Daftar Penyewa
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection

