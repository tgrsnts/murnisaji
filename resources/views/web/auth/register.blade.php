@extends('web.layouts.app')

@section('content')
    <section class="bg-white px-20 py-32 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full">
            <div class="bg-white border border-gray-200 rounded-lg p-8 shadow-sm">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Daftar Akun</h1>
                <p class="text-gray-600 mb-6">Buat akun baru untuk berbelanja</p>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('auth.register') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:border-red-500"
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:border-red-500"
                            placeholder="Masukkan email">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:border-red-500"
                            placeholder="Min 3 karakter">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="tel" name="telp" value="{{ old('telp') }}" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:border-red-500"
                            placeholder="Masukkan nomor telepon">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:border-red-500"
                            placeholder="Min 6 karakter">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:outline-none focus:border-red-500"
                            placeholder="Konfirmasi password">
                    </div>

                    <button type="submit"
                        class="w-full bg-[#7A1F1F] text-white py-2 rounded-lg font-medium hover:bg-[#5A0F0F] transition">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="text-center text-sm text-gray-600 mt-6">
                    Sudah punya akun? <a href="{{ route('auth.login') }}" class="text-red-600 font-medium hover:underline">Login di sini</a>
                </p>
            </div>
        </div>
    </section>
@endsection
