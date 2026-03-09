@extends('admin.layout.main')

@section('content')
    <div class="bg-white rounded-lg shadow-lg">
        <div class="flex justify-between items-center p-4 border-b border-gray-200">
            <h2 class="font-bold text-gray-800">Daftar Customer</h2>
        </div>

        @if (session('success'))
            <div class="p-4 text-green-700 bg-green-100 border-b border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="p-4 text-red-700 bg-red-100 border-b border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-red-800 text-white text-center">
                        <th class="py-2 px-3 text-xs">NO</th>
                        <th class="py-2 px-3 text-xs">NAMA</th>
                        <th class="py-2 px-3 text-xs">USERNAME</th>
                        <th class="py-2 px-3 text-xs">EMAIL</th>
                        <th class="py-2 px-3 text-xs">TELP</th>
                        {{-- <th class="py-2 px-3 text-xs">ROLE</th> --}}
                        <th class="py-2 px-3 text-xs">ALAMAT</th>
                        <th class="py-2 px-3 text-xs">TRANSAKSI</th>
                        <th class="py-2 px-3 text-xs">TOTAL SPENT</th>
                        <th class="py-2 px-3 text-xs">LAST SPENT</th>
                        <th class="py-2 px-3 text-xs">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="py-2 px-3 text-xs text-center">
                                {{ $users->firstItem() + $index }}
                            </td>

                            <td class="py-2 px-3 text-xs">
                                <div class="flex items-center gap-2">
                                    @if ($user->gambar)
                                        <img src="{{ asset('storage/' . $user->gambar) }}" alt="{{ $user->name }}"
                                            class="w-10 h-10 object-cover rounded-full">
                                    @else
                                        <div
                                            class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-800 font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="font-semibold text-gray-800">{{ $user->name }}</span>
                                </div>
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-600">
                                {{ $user->username }}
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-600">
                                {{ $user->email }}
                            </td>

                            <td class="py-2 px-3 text-xs text-gray-600">
                                {{ $user->telp }}
                            </td>

                            {{-- <td class="py-2 px-3 text-xs text-center">
                                @if ($user->role == 1)
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                                        Admin
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                        Customer
                                    </span>
                                @endif
                            </td> --}}

                            <td class="py-2 px-3 text-xs text-center text-gray-600">
                                {{ $user->alamats_count }}
                            </td>

                            <td class="py-2 px-3 text-xs text-center text-gray-600">
                                {{ $user->transaksis_count }}
                            </td>

                            <td class="py-2 px-3 text-xs text-right text-gray-800 font-semibold">
                                Rp {{ number_format($user->transaksis_sum_total_bayar ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="py-2 px-3 text-xs text-center text-gray-600">
                                @if ($user->transaksis->first())
                                    {{ $user->transaksis->first()->created_at->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="py-2 px-3">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.users.show', $user->user_id) }}"
                                        class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs"
                                        title="Lihat detail">
                                        Detail
                                    </a>

                                    {{-- <a href="{{ route('admin.users.edit', $user->user_id) }}"
                                        class="px-2 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-xs"
                                        title="Edit customer">
                                        Edit
                                    </a>

                                    @if ($user->role != 1)
                                        <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus customer ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs"
                                                title="Hapus customer">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif --}}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-gray-500">
                                Belum ada customer
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="p-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
