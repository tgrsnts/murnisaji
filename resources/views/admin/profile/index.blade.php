@extends('admin.layout.main')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-red-800">Profile Admin</h2>
        </div>

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

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

        <div class="mb-8 flex items-center gap-6">
            @if ($user->gambar)
                <img src="{{ asset('storage/' . $user->gambar) }}" alt="{{ $user->name }}"
                    class="w-24 h-24 object-cover rounded-full border-4 border-red-100">
            @else
                <div
                    class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center text-red-800 font-bold text-3xl border-4 border-red-200">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <h3 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h3>
                <p class="text-gray-600">{{ $user->email }}</p>
                <span class="inline-block px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold mt-2">
                    Admin
                </span>
            </div>
        </div>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <div class="mb-6">
                        <label class="block text-red-800 font-medium mb-2">Nama Lengkap*</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            placeholder="Nama lengkap"
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
                        <label class="block text-red-800 font-medium mb-2">No. Telepon</label>
                        <input type="text" name="telp" value="{{ old('telp', $user->telp) }}"
                            placeholder="08123456789" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg">
                    </div>

                    <div class="mb-6">
                        <label class="block text-red-800 font-medium mb-2">Password Baru</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                            class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg">
                        <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter, kosongkan jika tidak ingin mengubah</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-red-800 font-medium mb-2">Foto Profil</label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg"
                            onchange="previewImage(event)">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                        
                        <div id="preview-container" class="mt-3 hidden">
                            <img id="preview" class="w-32 h-32 object-cover rounded-lg border-2 border-gray-200">
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t pt-6 mt-6">
                <h3 class="text-lg font-bold text-red-800 mb-4">Informasi Akun</h3>

                <div class="grid md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Role</p>
                        <p class="text-xl font-bold text-red-800">Administrator</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Terdaftar Sejak</p>
                        <p class="text-lg font-bold text-red-800">{{ $user->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Terakhir Update</p>
                        <p class="text-lg font-bold text-red-800">{{ $user->updated_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8">
                <button type="submit" class="px-8 py-3 bg-red-800 text-white rounded-lg hover:bg-red-900 font-medium">
                    SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('preview-container');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
@endsection
