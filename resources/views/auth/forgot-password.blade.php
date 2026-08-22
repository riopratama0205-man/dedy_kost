@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 to-cyan-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-slate-900">Lupa Password?</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        Masukkan email Anda dan kami akan mengirimkan link untuk reset password.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-all transform hover:scale-105 shadow-lg">
                        Kirim Link Reset Password
                    </button>

                    <div class="mt-6 text-center">
                        <a href="{{ route('login') }}" class="text-sm text-cyan-600 hover:text-cyan-700 font-medium">
                            ← Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection