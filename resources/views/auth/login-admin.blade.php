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

        {{-- Animated Background --}}
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-10 w-96 h-96 bg-cyan-500 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 1s;"></div>
        </div>

        <div class="max-w-md w-full space-y-8 relative z-10">
            {{-- Card --}}
            <div class="bg-white/95 backdrop-blur-sm p-8 rounded-2xl shadow-2xl">
                <div class="text-center mb-8">
                    <h2
                        class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                        Admin Login
                    </h2>
                    <p class="text-slate-600">Masuk ke dashboard Admin DEDY KOST</p>
                </div>

                @if (session('error'))
                    <div
                        class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-xl p-4 mb-6 shadow-md animate-shake">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-red-800">
                                    {{ session('error') }}
                                </p>
                            </div>
                            <button onclick="this.parentElement.parentElement.remove()"
                                class="flex-shrink-0 ml-4 text-red-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <style>
                        @keyframes shake {

                            0%,
                            100% {
                                transform: translateX(0);
                            }

                            10%,
                            30%,
                            50%,
                            70%,
                            90% {
                                transform: translateX(-5px);
                            }

                            20%,
                            40%,
                            60%,
                            80% {
                                transform: translateX(5px);
                            }
                        }

                        .animate-shake {
                            animation: shake 0.5s ease-in-out;
                        }
                    </style>
                @endif

                <form class="space-y-6" action="/admin/login" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email Admin</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                            placeholder="admin@dedykost.com">
                    </div>

                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <input id="password" name="password" :type="show ? 'text' : 'password'"
                                autocomplete="current-password" required
                                class="w-full px-4 py-3 border border-slate-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                                placeholder="••••••••">
                            <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600">
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

                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-slate-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-slate-700">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-semibold rounded-xl transition-all transform hover:scale-105 shadow-lg shadow-purple-500/30">
                        Masuk sebagai Admin
                    </button>
                </form>

                <div class="mt-6">
                    <p class="text-center text-sm text-slate-600">
                        Bukan admin?
                        <a href="/login" class="font-medium text-purple-600 hover:text-purple-700">
                            Login Penyewa
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Handle CSRF Token Expiration --}}
    <script>
        // Intercept form submission to handle CSRF errors
        document.querySelector('form').addEventListener('submit', function (e) {
            // Store form data
            const formData = new FormData(this);
            const email = formData.get('email');
            const password = formData.get('password');

            // If form has been open for a while, refresh to get new token
            if (document.hidden || performance.now() > 3600000) { // 1 hour
                e.preventDefault();
                location.reload();
                return false;
            }
        });

        // Auto-refresh page if it's been inactive for too long
        let inactiveTime = 0;
        setInterval(function () {
            inactiveTime++;
            // Refresh after 55 minutes of inactivity (before session expires)
            if (inactiveTime > 55) {
                location.reload();
            }
        }, 60000); // Check every minute

        // Reset timer on user activity
        document.addEventListener('mousemove', function () { inactiveTime = 0; });
        document.addEventListener('keypress', function () { inactiveTime = 0; });
    </script>
@endsection

