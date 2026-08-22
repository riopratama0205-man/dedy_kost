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

        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Tambah Unit Baru</h1>
        <p class="text-slate-500 mt-1 font-medium">Input informasi detail untuk penambahan unit kamar atau villa ke sistem.
        </p>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 p-8 max-w-3xl">
        <form action="{{ route('admin.rooms.store') }}" method="POST" class="space-y-8">
            @csrf

            {{-- Visual Type Selector --}}
            <div class="space-y-4">
                <label class="text-sm font-bold text-slate-700 ml-1">Pilih Tipe Unit</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Kost Card --}}
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="tipeunit" value="kost" class="peer sr-only" checked>
                        <div
                            class="p-5 rounded-2xl border-2 border-slate-100 bg-slate-50 peer-checked:border-cyan-500 peer-checked:bg-cyan-50 transition-all group-hover:border-slate-200">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-white flex items-center justify-center shadow-sm text-slate-400 peer-checked:text-cyan-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">Kamar Kost</h4>
                                    <p class="text-xs text-slate-500 font-medium">Unit hunian bulanan/tahunan.</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute top-4 right-4 text-cyan-500 opacity-0 peer-checked:opacity-100 transition-opacity">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </label>

                    {{-- Villa Card --}}
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="tipeunit" value="villa" class="peer sr-only">
                        <div
                            class="p-5 rounded-2xl border-2 border-slate-100 bg-slate-50 peer-checked:border-cyan-500 peer-checked:bg-cyan-50 transition-all group-hover:border-slate-200">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-white flex items-center justify-center shadow-sm text-slate-400 peer-checked:text-cyan-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-900">Villa</h4>
                                    <p class="text-xs text-slate-500 font-medium">Penginapan mewah / rekreasi.</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="absolute top-4 right-4 text-cyan-500 opacity-0 peer-checked:opacity-100 transition-opacity">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </label>
                </div>
            </div>

            <hr class="border-slate-100">

            {{-- Name Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="namaunit" id="nameLabel" class="text-sm font-bold text-slate-700 ml-1">Nama Kamar</label>
                    <input type="text" name="namaunit" id="namaunit"
                        class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all font-medium text-slate-900"
                        placeholder="Contoh: Kamar VIP 01, Villa Puncak..." required>
                </div>

                <div class="space-y-2">
                    <label for="hargasewa" class="text-sm font-bold text-slate-700 ml-1">Harga Sewa</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">Rp</span>
                        <input type="number" name="hargasewa" id="hargasewa"
                            class="w-full bg-slate-50 border-slate-200 rounded-xl pl-12 pr-4 py-3 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all font-medium text-slate-900"
                            required placeholder="0">
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label for="deskripsi" class="text-sm font-bold text-slate-700 ml-1">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3"
                    class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/10 transition-all font-medium text-slate-900 resize-none"
                    placeholder="Jelaskan detail singkat tentang unit ini..."></textarea>
            </div>

            {{-- Fasilitas Checkbox --}}
            <div class="space-y-3">
                <label class="text-sm font-bold text-slate-700 ml-1">Fasilitas</label>
                @php
                    $fasilitasList = [
                        ['id' => 'ac', 'label' => 'AC', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
                        ['id' => 'wifi', 'label' => 'WiFi', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/>'],
                        ['id' => 'parkir', 'label' => 'Parkir', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>'],
                        ['id' => 'km_dalam', 'label' => 'KM Dalam', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                        ['id' => 'lemari', 'label' => 'Lemari', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v18M19 3v18M3 3h18v18H3V3zM12 3v18"/>'],
                        ['id' => 'kasur', 'label' => 'Kasur', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12v6h18v-6M3 12V8a2 2 0 012-2h14a2 2 0 012 2v4M3 12h18"/>'],
                        ['id' => 'dapur', 'label' => 'Dapur', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/>'],
                        ['id' => 'tv', 'label' => 'TV', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
                        ['id' => 'kolam_renang', 'label' => 'Kolam Renang', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12.5l1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1M4.5 16.5l1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1 1.5-1 1.5 1M3 8l9-5 9 5"/>'],
                        ['id' => 'listrik', 'label' => 'Listrik', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>'],
                        ['id' => 'air_panas', 'label' => 'Air Panas', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"/>'],
                        ['id' => 'security', 'label' => 'Keamanan 24 Jam', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>'],
                        ['id' => 'meja_kursi', 'label' => 'Meja & Kursi', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>'],
                    ];
                @endphp
                <input type="hidden" name="fasilitas" id="fasilitasInput" value="{{ old('fasilitas') }}">
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" id="fasilitasGrid">
                    @foreach($fasilitasList as $fas)
                        <label
                            class="fasilitas-item relative flex items-center gap-3 p-3 border-2 border-slate-100 bg-slate-50 rounded-xl cursor-pointer hover:border-cyan-400 hover:bg-cyan-50 transition-all">
                            <input type="checkbox" value="{{ $fas['label'] }}" class="fasilitas-check sr-only">
                            <div
                                class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center flex-shrink-0 text-slate-400 check-icon transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">{!! $fas['icon'] !!}</svg>
                            </div>
                            <span class="text-xs font-semibold text-slate-700">{{ $fas['label'] }}</span>
                            <div
                                class="absolute top-2 right-2 w-4 h-4 bg-cyan-500 rounded-full items-center justify-center hidden check-badge">
                                <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </label>
                    @endforeach
                </div>
                <p class="text-xs text-slate-400 ml-1">Klik untuk memilih fasilitas yang tersedia di unit ini.</p>
            </div>
            <script>
                (function () {
                    function initFasilitas() {
                        const hiddenInput = document.getElementById('fasilitasInput');
                        const checks = document.querySelectorAll('.fasilitas-check');
                        // Restore old value
                        const oldVal = hiddenInput.value || '';
                        const oldItems = oldVal.split(',').map(s => s.trim()).filter(Boolean);
                        checks.forEach(cb => {
                            const item = cb.closest('.fasilitas-item');
                            const badge = item.querySelector('.check-badge');
                            const iconBox = item.querySelector('.check-icon');
                            if (oldItems.includes(cb.value)) {
                                cb.checked = true;
                                item.classList.add('border-cyan-500', 'bg-cyan-50');
                                item.classList.remove('border-slate-100', 'bg-slate-50');
                                iconBox.classList.add('bg-cyan-500', 'border-cyan-500', 'text-white');
                                iconBox.classList.remove('bg-white', 'border-slate-200', 'text-slate-400');
                                badge.classList.remove('hidden');
                                badge.classList.add('flex');
                            }
                            cb.addEventListener('change', () => {
                                if (cb.checked) {
                                    item.classList.add('border-cyan-500', 'bg-cyan-50');
                                    item.classList.remove('border-slate-100', 'bg-slate-50');
                                    iconBox.classList.add('bg-cyan-500', 'border-cyan-500', 'text-white');
                                    iconBox.classList.remove('bg-white', 'border-slate-200', 'text-slate-400');
                                    badge.classList.remove('hidden');
                                    badge.classList.add('flex');
                                } else {
                                    item.classList.remove('border-cyan-500', 'bg-cyan-50');
                                    item.classList.add('border-slate-100', 'bg-slate-50');
                                    iconBox.classList.remove('bg-cyan-500', 'border-cyan-500', 'text-white');
                                    iconBox.classList.add('bg-white', 'border-slate-200', 'text-slate-400');
                                    badge.classList.add('hidden');
                                    badge.classList.remove('flex');
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
                    Tambah Unit
                </button>
                <a href="{{ route('admin.rooms.index') }}"
                    class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-8 py-3.5 rounded-xl font-bold transition-all active:scale-95">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipeRadios = document.querySelectorAll('input[name="tipeunit"]');
            const nameLabel = document.getElementById('nameLabel');
            const nameInput = document.getElementById('namaunit');

            function updateUI() {
                const selectedType = document.querySelector('input[name="tipeunit"]:checked').value;
                nameLabel.textContent = selectedType === 'kost' ? 'Nama Kamar' : 'Nama Villa';
                nameInput.placeholder = selectedType === 'kost' ? 'Contoh: Kamar VIP 01...' : 'Contoh: Villa Puncak...';
            }

            tipeRadios.forEach(radio => radio.addEventListener('change', updateUI));
            updateUI(); // Initial load
        });
    </script>
@endsection