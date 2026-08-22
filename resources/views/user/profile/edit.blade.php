@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-slate-50 pt-12 pb-12">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-8 font-medium">
                    <a href="{{ route('user.dashboard') }}" class="hover:text-cyan-600 transition-colors">Dashboard</a>
                    <span class="text-slate-300">/</span>
                    <span class="text-cyan-600 font-bold">Profil Saya</span>
                </div>
                <h1 class="text-3xl font-bold text-slate-900 mb-8">Edit Profil</h1>

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm">
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Personal Info -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-slate-900 border-b border-slate-200 pb-2">Informasi Pribadi
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-slate-600 text-sm font-medium mb-2">Nama Lengkap</label>
                                    <input type="text" name="namapenyewa"
                                        value="{{ old('namapenyewa', auth('web')->user()->namapenyewa) }}"
                                        class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:outline-none focus:border-cyan-500 transition-colors">
                                </div>
                                <div>
                                    <label class="block text-slate-600 text-sm font-medium mb-2">Email</label>
                                    <input type="email" name="email" value="{{ old('email', auth('web')->user()->email) }}"
                                        class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:outline-none focus:border-cyan-500 transition-colors">
                                </div>
                            </div>

                            <div>
                                <label class="block text-slate-600 text-sm font-medium mb-2">Nomor HP</label>
                                <input type="text" name="telp" value="{{ old('telp', auth('web')->user()->telp) }}"
                                    class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 text-slate-900 focus:outline-none focus:border-cyan-500 transition-colors">
                            </div>
                        </div>

                        <!-- Password Change -->
                        <div class="space-y-4 pt-4">
                            <h3 class="text-lg font-medium text-slate-900 border-b border-slate-200 pb-2">Ganti Password
                            </h3>
                            <p class="text-slate-500 text-sm">Kosongkan jika tidak ingin mengganti password.</p>

                            <div>
                                <label class="block text-slate-600 text-sm font-medium mb-2">Password Lama</label>
                                <div class="relative">
                                    <input type="password" id="current_password" name="current_password"
                                        class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 pr-12 text-slate-900 focus:outline-none focus:border-cyan-500 transition-colors">
                                    <button type="button" onclick="togglePassword('current_password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                        <svg id="eye-current_password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="eye-slash-current_password" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-slate-600 text-sm font-medium mb-2">Password Baru</label>
                                <div class="relative">
                                    <input type="password" id="new_password" name="new_password"
                                        class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 pr-12 text-slate-900 focus:outline-none focus:border-cyan-500 transition-colors">
                                    <button type="button" onclick="togglePassword('new_password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                        <svg id="eye-new_password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="eye-slash-new_password" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-slate-600 text-sm font-medium mb-2">Konfirmasi Password
                                    Baru</label>
                                <div class="relative">
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                        class="w-full bg-white border border-slate-300 rounded-lg px-4 py-3 pr-12 text-slate-900 focus:outline-none focus:border-cyan-500 transition-colors">
                                    <button type="button" onclick="togglePassword('new_password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                        <svg id="eye-new_password_confirmation" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <svg id="eye-slash-new_password_confirmation" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 rounded-lg transition-all shadow-lg shadow-cyan-500/30">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            const eyeIcon = document.getElementById('eye-' + fieldId);
            const eyeSlashIcon = document.getElementById('eye-slash-' + fieldId);
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }
    </script>
@endsection