@extends('web.dashboard.layout.main')

@php($title = 'Profile')

@section('content')
        <div class="space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
                <h1 class="text-3xl font-bold text-gray-900">Profile</h1>
                <p class="text-gray-600 mt-1">Kelola informasi akun Anda</p>
            </div>

            @if (session('success'))
                <div class="p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-8">
                <form method="POST" action="{{ route('dashboard.profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                                class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:outline-none focus:border-red-500">
                            @error('name')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:outline-none focus:border-red-500">
                            @error('email')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                            <input type="text" value="{{ Auth::user()->username }}" disabled class="w-full border border-gray-300 rounded-lg p-3 text-sm bg-gray-100 text-gray-600">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" name="telp" value="{{ old('telp', Auth::user()->telp) }}" required
                                class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:outline-none focus:border-red-500">
                            @error('telp')
                                <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <button type="submit" class="bg-[#7A1F1F] text-white px-6 py-2 rounded-lg hover:bg-[#5A0F0F] transition font-medium">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection
