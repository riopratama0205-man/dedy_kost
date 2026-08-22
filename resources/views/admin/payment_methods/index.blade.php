@extends('layouts.admin')

@section('admin-content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Metode Pembayaran</h1>
        <p class="text-slate-600">Atur informasi rekening dan kode QR untuk pembayaran.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-3xl">
        <form action="{{ route('admin.payment-methods.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Section 1: Informasi Rekening -->
            <div class="mb-8">
                <h3 class="font-bold text-lg text-slate-800 mb-4 flex items-center pb-2 border-b border-slate-100">
                    <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                        </path>
                    </svg>
                    Informasi Rekening
                </h3>

                <div class="space-y-4">
                    <!-- Bank Name Bar -->
                    <div
                        class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Nama
                            Bank</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-hover:text-cyan-500 transition-colors" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <input type="text" name="namabank" value="{{ old('namabank', $paymentMethod->namabank) }}"
                                class="pl-10 block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm py-2.5 font-medium text-slate-700 bg-white shadow-sm"
                                placeholder="Contoh: BCA">
                        </div>
                        @error('bank_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Account Number Bar -->
                        <div
                            class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Nomor
                                Rekening</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-hover:text-cyan-500 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                </div>
                                <input type="text" name="norek" value="{{ old('norek', $paymentMethod->norek) }}"
                                    class="pl-10 block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm py-2.5 font-mono font-medium text-slate-700 bg-white shadow-sm"
                                    placeholder="Contoh: 1234567890">
                            </div>
                            @error('account_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Account Holder Bar -->
                        <div
                            class="bg-slate-50 p-5 rounded-xl border border-slate-200 transition-all hover:border-cyan-300 hover:shadow-sm group">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Atas
                                Nama</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 group-hover:text-cyan-500 transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="pemilikrek"
                                    value="{{ old('pemilikrek', $paymentMethod->pemilikrek) }}"
                                    class="pl-10 block w-full rounded-lg border-slate-300 focus:ring-cyan-500 focus:border-cyan-500 text-sm py-2.5 font-medium text-slate-700 bg-white shadow-sm"
                                    placeholder="Contoh: Dedy Kost">
                            </div>
                            @error('account_holder')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: QR Code -->
            <div class="mb-8">
                <h3 class="font-bold text-lg text-slate-800 mb-4 flex items-center pb-2 border-b border-slate-100">
                    <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                        </path>
                    </svg>
                    QR Code Pembayaran
                </h3>

                <div class="bg-slate-50 rounded-lg p-6 border border-slate-100">
                    <label class="block text-sm font-medium text-slate-700 mb-3">Preview QR Code</label>

                    <div class="flex flex-col md:flex-row items-start gap-6">
                        <!-- Preview Box -->
                        <div class="p-2 border border-slate-200 rounded-lg bg-white shadow-sm inline-block">
                            @if($paymentMethod->gambar_qr_code)
                                <img src="{{ Storage::url($paymentMethod->gambar_qr_code) }}" alt="QR Code"
                                    class="h-40 w-40 object-contain">
                            @else
                                <div
                                    class="h-40 w-40 flex items-center justify-center text-slate-400 text-sm text-center bg-slate-50">
                                    Belum ada<br>QR Code
                                </div>
                            @endif
                        </div>

                        <!-- Upload Input -->
                        <div class="flex-1 w-full">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Upload Baru</label>
                            <input type="file" name="gambar_qr_code" accept="image/*" class="block w-full text-sm text-slate-500
                                                file:mr-4 file:py-2.5 file:px-4
                                                file:rounded-lg file:border-0
                                                file:text-sm file:font-semibold
                                                file:bg-cyan-600 file:text-white
                                                hover:file:bg-cyan-700
                                                cursor-pointer bg-white border border-slate-300 rounded-lg">
                            <p class="text-xs text-slate-500 mt-2">Dukungan format: JPG, PNG. Ukuran maksimal: 2MB.</p>
                            @error('qr_code_image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 flex justify-end">
                <button type="submit"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2.5 px-6 rounded-lg transition-colors shadow-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection

