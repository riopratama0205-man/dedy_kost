@extends('layouts.admin')

@section('admin-content')
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Pesan Masuk</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <div class="p-6 border-b border-slate-200 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold text-slate-900">Daftar Pesan</h3>
                <p class="text-sm text-slate-500 mt-1">Total: {{ $messages->total() }} pesan</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-500 text-sm uppercase border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-medium">Pengirim</th>
                        <th class="px-6 py-4 font-medium">Subjek</th>
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">Status</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-600">
                    @forelse($messages as $message)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center font-bold">
                                        {{ substr($message->nama, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-slate-900 font-medium">{{ $message->nama }}</p>
                                        <p class="text-xs text-slate-400">{{ $message->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-slate-900 font-medium">{{ $message->judul }}</div>
                                <div class="text-xs text-slate-500 truncate max-w-xs">{{ Str::limit($message->isi, 30) }}</div>
                            </td>
                            <td class="px-6 py-4">{{ $message->tgl->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($message->status == 'pending')
                                    <span
                                        class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase tracking-wide">Baru</span>
                                @elseif($message->status == 'read')
                                    <span
                                        class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold uppercase tracking-wide">Dibaca</span>
                                @elseif($message->status == 'replied')
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wide">Dibalas</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.messages.show', $message->kdpesan) }}"
                                        class="text-cyan-600 hover:text-cyan-700 font-medium">Detail</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                Belum ada pesan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
@endsection