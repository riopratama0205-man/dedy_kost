@extends('layouts.app', ['hideNavbar' => true])

@section('content')
    <div class="min-h-screen bg-slate-50 pt-24 pb-12">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-8 font-medium">
                    <a href="{{ route('user.dashboard') }}" class="hover:text-cyan-600 transition-colors">Dashboard</a>
                    <span class="text-slate-300">/</span>
                    <a href="{{ route('user.messages.index') }}" class="hover:text-cyan-600 transition-colors">Pesan
                        Saya</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-cyan-600 font-bold">Detail Pesan</span>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-100">
                        <div class="flex justify-between items-start mb-4">
                            <h1 class="text-2xl font-bold text-slate-900">{{ $message->subject }}</h1>
                            <span class="text-sm text-slate-500">{{ $message->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Anda</p>
                                <p class="text-sm text-slate-500">{{ $message->email }}</p>
                            </div>
                        </div>
                        <div class="bg-slate-50 rounded-lg p-6 text-slate-700 leading-relaxed whitespace-pre-wrap">
                            {{ $message->message }}
                        </div>
                    </div>

                    @if ($message->reply)
                        <div class="p-8 bg-cyan-50/50">
                            <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                                <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                </svg>
                                Balasan Admin
                            </h3>
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-10 h-10 bg-cyan-600 rounded-full flex items-center justify-center text-white font-bold">
                                        A
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <div class="bg-white border border-cyan-100 rounded-lg p-6 shadow-sm">
                                        <div class="flex justify-between items-center mb-4">
                                            <span class="font-bold text-slate-900">Admin</span>
                                            <span
                                                class="text-sm text-slate-500">{{ $message->replied_at->format('d M Y H:i') }}</span>
                                        </div>
                                        <div class="text-slate-700 leading-relaxed whitespace-pre-wrap">
                                            {{ $message->reply }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-8 text-center bg-slate-50/50">
                            <p class="text-slate-500 italic">Belum ada balasan dari admin.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection