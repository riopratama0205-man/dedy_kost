<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DEDY KOST - Hunian Nyaman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'fade-in': 'fadeIn 1s ease-out forwards',
                        'bounce-slow': 'bounce 3s infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .logo-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            letter-spacing: 0.08em;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #67e8f9 0%, #22d3ee 50%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 0 8px rgba(34, 211, 238, 0.4));
            transition: all 0.3s ease;
        }

        .logo-text:hover {
            filter: drop-shadow(0 0 12px rgba(34, 211, 238, 0.6));
            transform: scale(1.02);
        }

        .logo-icon {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, #22d3ee 0%, #06b6d4 100%);
            border-radius: 0.5rem;
            margin-right: 0.5rem;
            box-shadow: 0 4px 12px rgba(34, 211, 238, 0.3);
            transition: all 0.3s ease;
        }

        .logo-icon:hover {
            transform: rotate(5deg) scale(1.05);
            box-shadow: 0 6px 16px rgba(34, 211, 238, 0.5);
        }

        .nav-link {
            position: relative;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #06b6d4;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link.active {
            color: #22d3ee;
        }
    </style>
    @stack('styles')
</head>

<body class="antialiased bg-slate-50 text-slate-900 selection:bg-cyan-500 selection:text-white">
    <div class="min-h-screen flex flex-col">
        @unless((isset($hideNavbar) && $hideNavbar) || request()->is('rooms*') || request()->is('bookings*') || request()->routeIs('profile.edit'))
            <header class="absolute w-full z-50 bg-gradient-to-r from-slate-900 via-cyan-900 to-blue-900"
                x-data="{ open: false }">
                <nav class="container mx-auto px-6 py-6 flex justify-between items-center">
                    @php
                        $isDashboard = request()->is('dashboard*') || request()->is('admin*') || request()->is('profile*') || request()->is('messages*');
                    @endphp
                    @if($isDashboard)
                        {{-- No logo in navbar for admin/dashboard pages --}}
                    @else
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
                    @endif

                    @unless(request()->is('dashboard*') || request()->is('admin*') || request()->is('profile*') || request()->is('messages*'))

                        @unless(request()->is('login') || request()->is('register'))
                            <!-- Desktop Menu -->
                            <div class="hidden md:flex items-center space-x-8">
                                <a href="/"
                                    class="nav-link {{ request()->is('/') ? 'active' : 'text-white/90 hover:text-cyan-300' }} uppercase text-sm font-medium tracking-wide">
                                    Beranda
                                </a>
                                <a href="/kost"
                                    class="nav-link {{ request()->is('kost*') ? 'active' : 'text-white/90 hover:text-cyan-300' }} uppercase text-sm font-medium tracking-wide">
                                    Kamar
                                </a>
                                <a href="/villa"
                                    class="nav-link {{ request()->is('villa*') ? 'active' : 'text-white/90 hover:text-cyan-300' }} uppercase text-sm font-medium tracking-wide">
                                    Villa
                                </a>
                                <a href="/panduan"
                                    class="nav-link {{ request()->is('panduan*') ? 'active' : 'text-white/90 hover:text-cyan-300' }} uppercase text-sm font-medium tracking-wide">
                                    Panduan
                                </a>
                                <a href="/kontak"
                                    class="nav-link {{ request()->is('kontak*') ? 'active' : 'text-white/90 hover:text-cyan-300' }} uppercase text-sm font-medium tracking-wide">
                                    Kontak
                                </a>
                            </div>

                            <!-- Desktop Actions -->
                            <div class="hidden md:flex items-center space-x-4">
                                <a href="/login"
                                    class="px-6 py-2 text-white/90 hover:text-white border-2 border-white/30 hover:border-white/50 rounded-full font-medium transition-all">Login</a>
                                <a href="/register"
                                    class="px-6 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-full font-medium transition-all shadow-lg shadow-cyan-500/30">
                                    Daftar
                                </a>
                            </div>

                            <!-- Mobile Menu Button -->
                            <div class="md:hidden flex items-center">
                                <button @click="open = !open" class="text-slate-600 hover:text-slate-900 focus:outline-none">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"></path>
                                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        @endunless

                    @endunless
                </nav>

                @unless(request()->is('dashboard*') || request()->is('admin*') || request()->is('profile*') || request()->is('messages*'))
                    @unless(request()->is('login') || request()->is('register'))
                        <!-- Mobile Menu Dropdown -->
                        <div x-show="open" x-cloak @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute top-20 left-0 w-full bg-white border-b border-slate-200 shadow-xl md:hidden z-50">
                            <div class="flex flex-col px-6 py-4 space-y-4">
                                <a href="/"
                                    class="{{ request()->is('/') ? 'text-cyan-600' : 'text-slate-600' }} hover:text-cyan-600 transition-colors uppercase text-sm font-medium tracking-wide">BERANDA</a>
                                <a href="/kost"
                                    class="{{ request()->is('kost*') ? 'text-cyan-600' : 'text-slate-600' }} hover:text-cyan-600 transition-colors uppercase text-sm font-medium tracking-wide">KAMAR</a>
                                <a href="/villa"
                                    class="{{ request()->is('villa*') ? 'text-cyan-600' : 'text-slate-600' }} hover:text-cyan-600 transition-colors uppercase text-sm font-medium tracking-wide">VILLA</a>
                                <a href="/panduan"
                                    class="{{ request()->is('panduan*') ? 'text-cyan-600' : 'text-slate-600' }} hover:text-cyan-600 transition-colors uppercase text-sm font-medium tracking-wide">PANDUAN</a>
                                <a href="/kontak"
                                    class="{{ request()->is('kontak*') ? 'text-cyan-600' : 'text-slate-600' }} hover:text-cyan-600 transition-colors uppercase text-sm font-medium tracking-wide">KONTAK</a>
                                <div class="pt-4 border-t border-slate-200 flex flex-col space-y-4">
                                    <a href="/login"
                                        class="text-slate-600 hover:text-slate-900 transition-colors text-sm font-medium">Login</a>
                                    <a href="/register"
                                        class="px-6 py-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-md font-medium transition-all shadow-lg shadow-cyan-500/30 text-center">
                                        Daftar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endunless
                @endunless
            </header>
        @endunless

        <main class="flex-grow">
            @yield('content')
        </main>

        @php
            $isDisabled = request()->is('admin*') || request()->is('dashboard*') || request()->is('profile*') || request()->is('messages*') || request()->is('rooms*') || request()->is('bookings*');
        @endphp
        <footer class="bg-gradient-to-br from-slate-900 to-slate-800 py-12 border-t border-slate-700">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                    {{-- Company Info --}}
                    <div>
                        <h3
                            class="text-2xl font-bold mb-4 bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">
                            DEDY KOST</h3>
                        <p class="text-slate-400 mb-4">Hunian nyaman dan terjangkau untuk masa depan Anda.</p>
                        <div class="flex space-x-3">
                            <a href="https://wa.me/628127334976" target="_blank"
                                class="w-10 h-10 bg-slate-700 hover:bg-green-500 rounded-lg flex items-center justify-center text-slate-300 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/rintisundari2006?igsh=OHRocXpkMzd4eXRw" target="_blank"
                                class="w-10 h-10 bg-slate-700 hover:bg-pink-500 rounded-lg flex items-center justify-center text-slate-300 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01M7.8 21h8.4a5.5 5.5 0 005.5-5.5v-8.4a5.5 5.5 0 00-5.5-5.5H7.8a5.5 5.5 0 00-5.5 5.5v8.4a5.5 5.5 0 005.5 5.5z">
                                    </path>
                                </svg>
                            </a>
                            <a href="https://www.tiktok.com/@rintidedykost?_r=1&_t=ZS-91sgjPpramw" target="_blank"
                                class="w-10 h-10 bg-slate-700 hover:bg-cyan-500 rounded-lg flex items-center justify-center text-slate-300 hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div>
                        <h4 class="font-semibold mb-4 text-white">Quick Links</h4>
                        <ul class="space-y-2 text-slate-400">
                            <li><a href="/" class="hover:text-cyan-400 transition-colors @auth pointer-events-none opacity-50 cursor-not-allowed @endauth">Beranda</a></li>
                            <li><a href="/kost" class="hover:text-cyan-400 transition-colors @auth pointer-events-none opacity-50 cursor-not-allowed @endauth">Kamar</a></li>
                            <li><a href="/villa" class="hover:text-cyan-400 transition-colors @auth pointer-events-none opacity-50 cursor-not-allowed @endauth">Villa</a></li>
                            <li><a href="/panduan" class="hover:text-cyan-400 transition-colors @auth pointer-events-none opacity-50 cursor-not-allowed @endauth">Panduan</a></li>
                        </ul>
                    </div>

                    {{-- Contact Info --}}
                    <div>
                        <h4 class="font-semibold mb-4 text-white">Kontak Kami</h4>
                        <ul class="space-y-3 text-slate-400">
                            <li class="flex items-start space-x-2">
                                <svg class="w-5 h-5 text-cyan-400 mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm">Jl. Adityawarman No.28, The Hok - Jambi</span>
                            </li>
                            <li class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-cyan-400 flex-shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <div class="text-sm">
                                    <div>0812-7334-976</div>
                                    <div>0812-7491-7928</div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    {{-- Legal --}}
                    <div>
                        <h4 class="font-semibold mb-4 text-white">Legal</h4>
                        <ul class="space-y-2 text-slate-400">
                            <li><a href="/panduan" class="hover:text-cyan-400 transition-colors @auth pointer-events-none opacity-50 cursor-not-allowed @endauth">Privacy Policy</a></li>
                            <li><a href="/panduan" class="hover:text-cyan-400 transition-colors @auth pointer-events-none opacity-50 cursor-not-allowed @endauth">Terms of Service</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-700 text-center text-slate-400 text-sm">
                    <p>&copy; {{ date('Y') }} DEDY KOST. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts')

    {{-- Prevent Back Button Navigation for User Pages --}}
    @auth('web')
        @if(request()->is('dashboard*') || request()->is('messages*') || request()->is('profile*') || request()->is('rooms*') || request()->is('bookings*'))
            <script>
                    (function () {
                        // Mark that we're in user area
                        sessionStorage.setItem('inUserArea', 'true');

                        // Prevent back button
                        function preventBack() {
                            window.history.forward();
                        }

                        setTimeout(preventBack, 0);
                        window.onunload = function () {
                            // Don't clear if logging out
                            if (!sessionStorage.getItem('isLoggingOut')) {
                                sessionStorage.setItem('inUserArea', 'true');
                            }
                        };

                        // Replace entire history with current page
                        if (window.history && window.history.pushState) {
                            // Clear forward history and replace with current page
                            window.history.pushState('dummy', null, window.location.href);
                            window.history.pushState(null, null, window.location.href);

                            // Prevent popstate (back button) - use addEventListener for better persistence
                            window.addEventListener('popstate', function (event) {
                                window.history.pushState(null, null, window.location.href);
                                alert('Gunakan tombol Logout untuk keluar dari halaman penyewa.');
                                event.preventDefault();
                                return false;
                            }, false);
                        }

                        // Mark logout forms
                        document.querySelectorAll('form[action*="logout"]').forEach(form => {
                            form.addEventListener('submit', function () {
                                sessionStorage.setItem('isLoggingOut', 'true');
                                sessionStorage.removeItem('inUserArea');
                            });
                        });

                        // Prevent going back to login page
                        if (document.referrer.includes('/login')) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                    })();
            </script>
        @endif
    @endauth
</body>

</html>