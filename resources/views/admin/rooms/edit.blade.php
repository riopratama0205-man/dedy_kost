@extends('layouts.admin')

@section('admin-content')
    <div class="mb-8">
        <a href="{{ route('admin.rooms.index') }}"
            class="group inline-flex items-center text-sm font-semibold text-slate-500 hover:text-cyan-600 transition-colors mb-4">
            <svg class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Daftar Unit
        </a>

        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Ubah {{ $type === 'villa' ? 'Villa' : 'Kamar' }}</h1>
        <p class="text-slate-500 mt-1 font-medium">Perbarui informasi detail untuk unit ini.</p>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 p-8 max-w-3xl">
        <form
            action="{{ route('admin.rooms.update', [$type === 'villa' ? $room->kdvilla : $room->kdkamar, 'type' => $type]) }}"
            method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="namaunit" class="text-sm font-bold text-slate-700 ml-1">Nama
                    {{ $type === 'villa' ? 'Villa' : 'Kamar' }}</label>
                <input type="text" name="{{ $type === 'villa' ? 'namavilla' : 'namakamar' }}" id="namaunit"
                    value="{{ old($type === 'villa' ? 'namavilla' : 'namakamar', $type === 'villa' ? $room->namavilla : $room->namakamar) }}"
                    class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all font-medium text-slate-900"
                    required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Tipe Unit</label>
                    <input type="text" value="{{ ucfirst($type) }}"
                        class="w-full bg-slate-100 border-slate-200 rounded-xl px-4 py-3 font-bold text-slate-500 cursor-not-allowed"
                        readonly>
                </div>
                <div class="space-y-2">
                    <label for="hargasewa" class="text-sm font-bold text-slate-700 ml-1">Harga Sewa</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">Rp</span>
                        <input type="number" name="hargasewa" id="hargasewa"
                            value="{{ old('hargasewa', $room->hargasewa) }}"
                            class="w-full bg-slate-50 border-slate-200 rounded-xl pl-12 pr-4 py-3 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all font-medium text-slate-900"
                            required>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label for="deskripsi" class="text-sm font-bold text-slate-700 ml-1">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all font-medium text-slate-900 resize-none font-medium text-slate-900 resize-none">{{ old('deskripsi', $room->deskripsi) }}</textarea>
            </div>

            {{-- Fasilitas Checkbox --}}
            <div class="space-y-3">
                <label class="text-sm font-bold text-slate-700 ml-1">Fasilitas</label>
                @php
                    $fasilitasList = [
                        ['label' => 'AC', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
                        ['label' => 'WiFi', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>'],
                        ['label' => 'Parkir', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>'],
                        ['label' => 'KM Dalam', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                        ['label' => 'Lemari', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v18M19 3v18M3 3h18v18H3V3zM12 3v18"/>'],
                        ['label' => 'Kasur', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12v6h18v-6M3 12V8a2 2 0 012-2h14a2 2 0 012 2v4M3 12h18"/>'],
                        ['label' => 'Dapur', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/>'],
                        ['label' => 'TV', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
                        ['label' => 'Kolam Renang', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12.5l1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1M4.5 16.5l1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1M3 8l9-5 9 5"/>'],
                        ['label' => 'Listrik', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>'],
                        ['label' => 'Air Panas', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"/>'],
                        ['label' => 'Keamanan 24 Jam', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>'],
                        ['label' => 'Meja & Kursi', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>'],
                    ];
                    $existingFasilitas = old('fasilitas', $room->fasilitas ?? '');
                    $existingList = array_map('trim', explode(',', $existingFasilitas));
                @endphp
                <input type="hidden" name="fasilitas" id="fasilitasInput" value="{{ $existingFasilitas }}">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach($fasilitasList as $fas)
                        @php $isChecked = in_array($fas['label'], $existingList); @endphp
                        <label
                            class="fasilitas-item relative flex items-center gap-3 p-3 border-2 rounded-xl cursor-pointer transition-all {{ $isChecked ? 'border-cyan-500 bg-cyan-50' : 'border-slate-100 bg-slate-50 hover:border-cyan-400 hover:bg-cyan-50' }}">
                            <input type="checkbox" value="{{ $fas['label'] }}" class="fasilitas-check sr-only" {{ $isChecked ? 'checked' : '' }}>
                            <div
                                class="w-8 h-8 rounded-lg border flex items-center justify-center flex-shrink-0 check-icon transition-all {{ $isChecked ? 'bg-cyan-500 border-cyan-500 text-white' : 'bg-white border-slate-200 text-slate-400' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">{!! $fas['icon'] !!}</svg>
                            </div>
                            <span class="text-xs font-semibold text-slate-700">{{ $fas['label'] }}</span>
                            <div
                                class="absolute top-2 right-2 w-4 h-4 bg-cyan-500 rounded-full items-center justify-center check-badge {{ $isChecked ? 'flex' : 'hidden' }}">
                                <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </label>
                    @endforeach
                </div>
                <p class="text-xs text-slate-400 ml-1">Klik untuk memilih/batal pilih fasilitas.</p>
            </div>
            <script>
                (function () {
                    function initFasilitas() {
                        const hiddenInput = document.getElementById('fasilitasInput');
                        const checks = document.querySelectorAll('.fasilitas-check');
                        checks.forEach(cb => {
                            const item = cb.closest('.fasilitas-item');
                            const badge = item.querySelector('.check-badge');
                            const iconBox = item.querySelector('.check-icon');
                            cb.addEventListener('change', () => {
                                if (cb.checked) {
                                    item.classList.add('border-cyan-500', 'bg-cyan-50');
                                    item.classList.remove('border-slate-100', 'bg-slate-50');
                                    iconBox.classList.add('bg-cyan-500', 'border-cyan-500', 'text-white');
                                    iconBox.classList.remove('bg-white', 'border-slate-200', 'text-slate-400');
                                    badge.classList.remove('hidden'); badge.classList.add('flex');
                                } else {
                                    item.classList.remove('border-cyan-500', 'bg-cyan-50');
                                    item.classList.add('border-slate-100', 'bg-slate-50');
                                    iconBox.classList.remove('bg-cyan-500', 'border-cyan-500', 'text-white');
                                    iconBox.classList.add('bg-white', 'border-slate-200', 'text-slate-400');
                                    badge.classList.add('hidden'); badge.classList.remove('flex');
                                }
                                const selected = [...checks].filter(c => c.checked).map(c => c.value);
                                hiddenInput.value = selected.join(', ');
                            });
                        });
                    }
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', initFasilitas);
                    } else { initFasilitas(); }
                })();
            </script>

            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white px-8 py-3.5 rounded-xl font-bold shadow-lg shadow-cyan-200 transition-all active:scale-95">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.rooms.index') }}"
                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-8 py-3.5 rounded-xl font-bold transition-all active:scale-95">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection