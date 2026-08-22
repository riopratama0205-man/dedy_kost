@extends('layouts.app', ['hideNavbar' => true])

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-cyan-50 to-blue-50 pt-12 pb-12">
        {{-- Logo Header --}}
        <div class="container mx-auto px-6 mb-8">
            <div class="flex items-center justify-between">
                <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-2 group">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-2xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">DEDY
                        KOST</span>
                </a>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-sm text-slate-600 font-medium">Dashboard Penyewa</span>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar (Retained for navigation consistency) -->
                <div class="w-full md:w-80 flex-shrink-0">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 sticky top-12 shadow-lg">
                        <div class="text-center mb-6">
                            <div
                                class="w-24 h-24 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-slate-900">{{ auth('web')->user()->namapenyewa }}</h2>
                            <p class="text-cyan-600 font-medium">Penyewa</p>
                        </div>
                        <div class="space-y-3">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center justify-center space-x-2 w-full py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg font-medium transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Edit Profil</span>
                            </a>
                            <div
                                class="flex items-center justify-center space-x-2 w-full py-3 px-4 bg-cyan-100 text-cyan-700 rounded-lg font-medium transition-all border-l-4 border-cyan-600 cursor-default">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                <span>Pesan Saya</span>
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="block w-full">
                                @csrf
                                <button type="submit"
                                    class="flex items-center justify-center space-x-2 w-full py-3 px-4 border-2 border-red-200 text-red-600 hover:bg-red-50 hover:border-red-300 rounded-lg font-medium transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content (Matches Style of Uploaded Image) -->
                <div class="flex-grow">
                    {{-- Breadcrumb like link --}}
                    <div class="flex items-center space-x-2 text-sm text-slate-500 mb-6 font-medium">
                        <a href="{{ route('user.dashboard') }}" class="hover:text-cyan-600 transition-colors">Dashboard</a>
                        <span class="text-slate-300">/</span>
                        <span class="text-cyan-600 font-bold">Pesan Saya</span>
                    </div>

                    <div class="flex justify-between items-end mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-slate-900">Pesan Saya</h1>
                            <p class="text-slate-500 mt-2 text-lg">Riwayat pesan yang Anda kirim ke admin.</p>
                        </div>
                        <button onclick="toggleModal('createMessageModal')"
                            class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 px-6 rounded-lg transition-colors shadow-lg shadow-cyan-500/30 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                            Buat Pesan Baru
                        </button>
                    </div>

                    @if(session('success'))
                        <div
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- List Card Container -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                        @forelse($messages as $message)
                            <div class="p-6 border-b border-slate-100 last:border-0 hover:bg-slate-50 transition-colors group">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-cyan-600 transition-colors">
                                        {{ $message->judul }}
                                    </h3>
                                    <span class="text-xs text-slate-400 font-medium">{{ $message->tgl->format('d M Y') }}</span>
                                </div>

                                <p class="text-slate-500 text-sm mb-4 line-clamp-1">{{ $message->isi }}</p>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-2">
                                        @if($message->status == 'replied')
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-sm font-bold text-green-600">Sudah Dibalas</span>
                                        @else
                                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="text-sm font-medium text-slate-500">Menunggu Balasan</span>
                                        @endif
                                    </div>

                                    <button onclick='openDetailModal(@json($message))'
                                        class="text-cyan-600 hover:text-cyan-700 text-sm font-bold flex items-center group-hover:translate-x-1 transition-transform cursor-pointer">
                                        Lihat Detail
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center text-slate-500">
                                <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                <p class="text-lg font-medium">Belum ada riwayat pesan.</p>
                                <p class="text-sm mt-1">Silakan buat pesan baru untuk menghubungi admin.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($messages->hasPages())
                        <div class="mt-6">
                            {{ $messages->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Message -->
    <div id="createMessageModal"
        class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/50 backdrop-blur-sm transition-opacity"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg leading-6 font-bold text-slate-900" id="modal-title">Buat Pesan Baru</h3>
                        <button onclick="toggleModal('createMessageModal')" class="text-slate-400 hover:text-slate-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form action="{{ route('user.messages.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Subjek / Kategori</label>
                                <select name="judul" required
                                    class="w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500">
                                    <option value="" disabled selected>Pilih Kategori Pesan...</option>
                                    <option value="Pertanyaan Umum">Pertanyaan Umum</option>
                                    <option value="Laporan Kerusakan">Laporan Kerusakan</option>
                                    <option value="Keluhan Fasilitas">Keluhan Fasilitas</option>
                                    <option value="Masalah Pembayaran">Masalah Pembayaran</option>
                                    <option value="Konfirmasi Pembayaran">Konfirmasi Pembayaran</option>
                                    <option value="Permohonan Perpanjangan">Permohonan Perpanjangan</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Isi Pesan</label>
                                <textarea name="isi" required rows="4"
                                    class="w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500"
                                    placeholder="Jelaskan detail pesan Anda..."></textarea>
                            </div>
                        </div>
                        <div class="mt-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-cyan-600 text-base font-medium text-white hover:bg-cyan-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Kirim Pesan
                            </button>
                            <button type="button" onclick="toggleModal('createMessageModal')"
                                class="mt-3 w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Message -->
    <div id="detailMessageModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/50 backdrop-blur-sm"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-slate-900" id="detail-judul">Subject</h3>
                            <p class="text-slate-500 text-sm mt-1" id="detail-tanggal">Date</p>
                        </div>
                        <button onclick="toggleModal('detailMessageModal')"
                            class="bg-slate-100 p-2 rounded-full text-slate-500 hover:bg-slate-200 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 mb-6">
                        <p class="text-slate-700 leading-relaxed" id="detail-isi">Content goes here...</p>
                    </div>

                    <div id="detail-balasan-container" class="hidden">
                        <h4 class="font-bold text-slate-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                            Balasan Admin
                        </h4>
                        <div
                            class="bg-green-50 p-6 rounded-xl border border-green-100 text-slate-800 leading-relaxed relative">
                            <p id="detail-balasan">Reply content...</p>
                            <div
                                class="mt-4 pt-4 border-t border-green-200 text-xs text-green-800 font-bold uppercase tracking-wide">
                                Dibalas pada: <span id="detail-tglbalas">Date</span>
                            </div>
                        </div>
                    </div>
                    <div id="detail-pending-container"
                        class="hidden text-center py-6 bg-yellow-50 rounded-xl border border-yellow-100 border-dashed">
                        <p class="text-yellow-700 font-medium">Pesan ini belum dibalas oleh admin.</p>
                    </div>
                </div>
                <div class="bg-slate-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="toggleModal('detailMessageModal')"
                        class="w-full inline-flex justify-center rounded-lg border border-slate-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-slate-700 hover:bg-slate-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleModal(modalID) {
            document.getElementById(modalID).classList.toggle('hidden');
        }

        function openDetailModal(message) {
            document.getElementById('detail-judul').innerText = message.judul;
            // Format date manually if needed or use message.tgl string directly if available/formatted
            // Simple date string assignment for now
            const date = new Date(message.tgl);
            document.getElementById('detail-tanggal').innerText = date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });

            document.getElementById('detail-isi').innerText = message.isi;

            if (message.balasan) {
                document.getElementById('detail-balasan-container').classList.remove('hidden');
                document.getElementById('detail-pending-container').classList.add('hidden');
                document.getElementById('detail-balasan').innerText = message.balasan;

                const replyDate = new Date(message.tglbalas);
                document.getElementById('detail-tglbalas').innerText = replyDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
            } else {
                document.getElementById('detail-balasan-container').classList.add('hidden');
                document.getElementById('detail-pending-container').classList.remove('hidden');
            }

            toggleModal('detailMessageModal');
        }
    </script>
@endsection