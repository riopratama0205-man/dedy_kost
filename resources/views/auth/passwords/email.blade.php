@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-slate-900 py-20 px-4">
        <div class="max-w-md w-full space-y-8 bg-slate-950 p-8 rounded-2xl border border-slate-800 shadow-2xl">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white uppercase tracking-wider">Lupa Password</h2>
                <p class="mt-2 text-sm text-slate-400">
                    Masukkan email Anda untuk menerima link reset password
                </p>
            </div>

            @if (session('status'))
                <div class="bg-green-500/10 border border-green-500/50 text-green-500 px-4 py-3 rounded-lg text-sm text-center">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 text-red-500 px-4 py-3 rounded-lg text-sm text-center">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none relative block w-full px-3 py-3 border border-slate-700 placeholder-slate-500 text-white bg-slate-900 rounded-lg focus:outline-none focus:ring-cyan-500 focus:border-cyan-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Email address" value="{{ old('email') }}">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-full text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all transform hover:scale-105 shadow-lg shadow-cyan-500/30 uppercase tracking-wide">
                        Kirim Link Reset Password
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="/login" class="font-medium text-slate-400 hover:text-white transition-colors text-sm">
                        Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

