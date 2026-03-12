@extends('web.layouts.app')

@section('content')
    <section class="bg-white px-20 py-32 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full">
            <div class="bg-white border border-gray-200 rounded-lg p-8 shadow-sm">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Login</h1>
                <p class="text-gray-600 mb-6">Masuk ke akun Anda untuk melanjutkan</p>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('auth.login') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:border-red-500"
                            placeholder="Masukkan username">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:border-red-500"
                            placeholder="Masukkan password">
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember" class="rounded">
                        <label for="remember" class="text-sm text-gray-600">Ingat saya</label>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#7A1F1F] text-white py-2 rounded-lg font-medium hover:bg-[#5A0F0F] transition">
                        Login
                    </button>
                </form>

                <p class="text-center text-sm text-gray-600 mt-6">
                    Belum punya akun? <a href="{{ route('auth.register') }}" class="text-red-600 font-medium hover:underline">Daftar di sini</a>
                </p>

                <p class="text-center text-sm text-gray-600 mt-2">
                    atau <a href="{{ route('checkout.index') }}" class="text-red-600 font-medium hover:underline">lanjutkan sebagai guest</a>
                </p>
            </div>
        </div>
    </section>
@endsection
