@extends('layouts.admin')

@section('admin-content')
    <div class="mb-8">
        {{-- Back Button --}}
        <a href="{{ route('admin.messages.index') }}"
            class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium mb-4 group transition-all">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Pesan Masuk
        </a>

        <h1 class="text-3xl font-bold text-slate-900">Detail Pesan</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Message Info & Content -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm">
                <div class="flex items-center space-x-6 mb-8 border-b border-slate-100 pb-8">
                    <div
                        class="w-20 h-20 bg-cyan-600 rounded-full flex items-center justify-center text-white font-bold text-3xl flex-shrink-0">
                        {{ substr($message->nama, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">{{ $message->nama }}</h2>
                        <p class="text-slate-500">{{ $message->email }}</p>
                        <div class="mt-2 text-sm text-slate-400">
                            {{ $message->tgl->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $message->judul }}</h3>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        {!! nl2br(e($message->isi)) !!}
                    </div>
                </div>
            </div>

            <!-- Balasan Section -->
            <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm">
                <h3 class="text-xl font-bold text-slate-900 mb-6">Balasan</h3>
                @if($message->balasan)
                    <div class="bg-green-50 border border-green-200 rounded-xl p-6 relative">
                        <div class="absolute top-4 right-4">
                            <span class="bg-green-200 text-green-800 text-xs font-bold px-2 py-1 rounded">TERKIRIM</span>
                        </div>
                        <p class="text-slate-800 leading-relaxed mb-2">{!! nl2br(e($message->balasan)) !!}</p>
                        <p class="text-xs text-slate-500 mt-4 border-t border-green-200 pt-2">
                            Dibalas oleh Admin pada {{ $message->tglbalas->format('d M Y, H:i') }}
                        </p>
                    </div>
                @else
                    <form action="{{ route('admin.messages.reply', $message->kdpesan) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-slate-700 font-medium mb-2">Tulis Balasan</label>
                            <textarea name="balasan" rows="5"
                                class="w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Ketik balasan untuk penyewa..."></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                Kirim Balasan
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-slate-200 p-6 sticky top-6 shadow-sm">
                <h3 class="font-bold text-slate-800 mb-4">Informasi Tambahan</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs text-slate-500 uppercase font-bold">Status Pesan</label>
                        <div class="mt-1">
                            @if($message->status == 'pending')
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-bold">Baru</span>
                            @elseif($message->status == 'read')
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm font-bold">Dibaca</span>
                            @elseif($message->status == 'replied')
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-bold">Dibalas</span>
                            @endif
                        </div>
                    </div>
                    @if($message->telp)
                        <div>
                            <label class="block text-xs text-slate-500 uppercase font-bold">Nomor Telepon</label>
                            <p class="text-slate-900 font-medium">{{ $message->telp }}</p>
                        </div>
                    @endif

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <form action="{{ route('admin.messages.destroy', $message->kdpesan) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-50 hover:bg-red-100 text-red-600 text-sm font-bold py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection