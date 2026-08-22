@extends('layouts.app', ['hideNavbar' => true])

@section('content')
    {{-- Toast Notification --}}
    @if(session('success') || session('error'))
        <div id="toast" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 transition-all duration-300 ease-in-out"
            x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4">

            @if(session('success'))
                <div class="bg-white rounded-xl shadow-2xl border-l-4 border-green-500 p-4 max-w-md">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-bold text-gray-900">Berhasil!</p>
                            <p class="text-sm text-gray-600 mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-white rounded-xl shadow-2xl border-l-4 border-red-500 p-4 max-w-md">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600">
                                !
                            </div>
                        </div>
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-bold text-gray-900">Error!</p>
                            <p class="text-sm text-gray-600 mt-1">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 pt-12 pb-12">
        {{-- Logo Header --}}
        <div class="container mx-auto px-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-2xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">DEDY
                        KOST</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-slate-600 font-medium">Dashboard Admin</span>
                </div>
            </div>
        </div>

        <div class="px-6">
            <div class="flex flex-col md:flex-row gap-8">
                {{-- Sidebar --}}
                <div class="w-full md:w-64 flex-shrink-0">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sticky top-24 shadow-lg">
                        <a href="{{ route('admin.settings.index') }}"
                            class="flex items-center space-x-4 mb-8 p-3 -mx-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 transition-all group shadow-md text-white">
                            <div
                                class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-cyan-600 font-bold text-xl shadow-sm">
                                {{ substr(auth('admin')->user()->namaadmin ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-bold">
                                    {{ auth('admin')->user()->namaadmin }}
                                </h3>
                                <p class="text-cyan-100 text-sm truncate">{{ auth('admin')->user()->email }}</p>
                            </div>
                        </a>
                        <nav class="space-y-2">
                            <a href="/admin/dashboard"
                                class="block px-4 py-2 {{ request()->is('admin/dashboard') ? 'bg-cyan-50 text-cyan-700 border-l-4 border-cyan-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg font-medium transition-all">
                                Dashboard
                            </a>
                            <!-- Pesan Masuk -->
                            <a href="{{ route('admin.messages.index') }}"
                                class="block px-4 py-2 {{ request()->is('admin/messages*') ? 'bg-cyan-50 text-cyan-700 border-l-4 border-cyan-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg font-medium transition-all flex justify-between items-center">
                                <span>Pesan Masuk</span>
                                @php
                                    $unreadCount = \App\Models\Pesan::where('status', 'pending')->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span
                                        class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unreadCount }}</span>
                                @endif
                            </a>
                            <a href="/admin/rooms"
                                class="block px-4 py-2 {{ request()->is('admin/rooms*') ? 'bg-cyan-50 text-cyan-700 border-l-4 border-cyan-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg font-medium transition-all">
                                Kelola Kamar & Villa
                            </a>
                            <a href="/admin/bookings"
                                class="block px-4 py-2 {{ request()->is('admin/bookings*') ? 'bg-cyan-50 text-cyan-700 border-l-4 border-cyan-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg font-medium transition-all flex justify-between items-center">
                                <span>Daftar Pesanan</span>
                                @php
                                    $pendingCount = \App\Models\Sewa::where('status', 'pending')->count();
                                @endphp
                                @if($pendingCount > 0)
                                    <span
                                        class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                                @endif
                            </a>
                            <a href="/admin/tenants"
                                class="flex items-center justify-between px-4 py-2 {{ request()->is('admin/tenants*') ? 'bg-cyan-50 text-cyan-700 border-l-4 border-cyan-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg font-medium transition-all">
                                <span>Data Penyewa</span>
                                @php
                                    $newTenantsCount = \App\Models\Penyewa::where('penyewa_baru', true)->count();
                                @endphp
                                @if($newTenantsCount > 0)
                                    <span
                                        class="bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $newTenantsCount }}</span>
                                @endif
                            </a>
                            <a href="{{ route('admin.reports.financial') }}"
                                class="block px-4 py-2 {{ request()->routeIs('admin.reports.financial') ? 'bg-cyan-50 text-cyan-700 border-l-4 border-cyan-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg font-medium transition-all">
                                Laporan Keuangan
                            </a>
                            <a href="{{ route('admin.payment-methods.index') }}"
                                class="block px-4 py-2 {{ request()->routeIs('admin.payment-methods.*') ? 'bg-cyan-50 text-cyan-700 border-l-4 border-cyan-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} rounded-lg font-medium transition-all">
                                Metode Pembayaran
                            </a>
                            <div class="pt-4 mt-4 border-t border-slate-200">
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-50 hover:text-red-600 rounded-lg transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex-grow">
                    @yield('admin-content')
                </div>
            </div>
        </div>
    </div>
@endsection