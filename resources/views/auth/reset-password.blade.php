@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 to-cyan-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-slate-900">Reset Password</h2>
                    <p class="mt-2 text-sm text-slate-600">
                        Masukkan password baru Anda
                    </p>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input id="email" type="email" value="{{ $email }}" disabled
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg bg-slate-50 text-slate-600">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password Baru</label>
                        <input id="password" type="password" name="password" required
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-slate-500">Minimal 8 karakter</p>
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi
                            Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all">
                    </div>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-all transform hover:scale-105 shadow-lg">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection