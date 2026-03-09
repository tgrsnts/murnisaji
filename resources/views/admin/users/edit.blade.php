@extends('admin.layout.main')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-red-800">Edit Customer</h2>
            <a href="{{ route('admin.users.index') }}"
                class="px-4 py-2 border border-red-800 text-red-800 rounded-lg hover:bg-red-50">
                Kembali
            </a>
        </div>

        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-6">
                        <label class="block text-red-800 font-medium mb-2">Nama Lengkap*</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            placeholder="Nama lengkap customer"
                            class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-red-800 font-medium mb-2">Username*</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}"
                            placeholder="Username untuk login"
                            class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-red-800 font-medium mb-2">Email*</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            placeholder="email@example.com"
                            class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg" required>
                    </div>
                </div>

                <div>
                    <div class="mb-6">
                        <label class="block text-red-800 font-medium mb-2">No. Telepon*</label>
                        <input type="text" name="telp" value="{{ old('telp', $user->telp) }}"
                            placeholder="08123456789" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg"
                            required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-red-800 font-medium mb-2">Role*</label>
                        <select name="role" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg" required>
                            <option value="0" {{ old('role', $user->role) == 0 ? 'selected' : '' }}>Customer</option>
                            <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>Admin</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Pilih role untuk user ini</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-red-800 font-medium mb-2">Password</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                            class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                    </div>
                </div>
            </div>

            <div class="border-t pt-6 mt-6">
                <h3 class="text-lg font-bold text-red-800 mb-4">Informasi Tambahan</h3>

                <div class="grid md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Total Alamat</p>
                        <p class="text-2xl font-bold text-red-800">{{ $user->alamats->count() }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Total Transaksi</p>
                        <p class="text-2xl font-bold text-red-800">{{ $user->transaksis->count() }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Terdaftar Sejak</p>
                        <p class="text-lg font-bold text-red-800">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('admin.users.index') }}"
                    class="px-8 py-2 border border-red-800 text-red-800 rounded-lg hover:bg-red-50">
                    BATAL
                </a>

                <button type="submit" class="px-8 py-2 bg-red-800 text-white rounded-lg hover:bg-red-900">
                    PERBARUI
                </button>
            </div>
        </form>
    </div>
@endsection
