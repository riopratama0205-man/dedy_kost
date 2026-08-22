@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-slate-900 py-20 px-4">
        <div class="max-w-md w-full space-y-8 bg-slate-950 p-8 rounded-2xl border border-slate-800 shadow-2xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white uppercase tracking-wider">Reset Password</h2>
                <p class="mt-2 text-sm text-slate-400">
                    Buat password baru untuk akun Anda
                </p>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 px-4 py-3 rounded-lg text-sm text-center">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none relative block w-full px-3 py-3 border border-slate-700 placeholder-slate-500 text-white bg-slate-900 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Email address" value="{{ $email ?? old('email') }}">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password Baru</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="appearance-none relative block w-full px-3 py-3 border border-slate-700 placeholder-slate-500 text-white bg-slate-900 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Password Baru">
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Konfirmasi Password Baru</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            autocomplete="new-password" required
                            class="appearance-none relative block w-full px-3 py-3 border border-slate-700 placeholder-slate-500 text-white bg-slate-900 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Konfirmasi Password Baru">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all transform hover:scale-105 shadow-lg shadow-cyan-500/30 uppercase tracking-wide">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

