@extends('web.layouts.app')

@section('content')
    <section class="bg-white px-20 py-12 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Keranjang Belanja</h1>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if (count($cartItems) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach ($cartItems as $item)
                            <div class="bg-white border border-gray-200 rounded-lg p-6 flex gap-6">
                                <!-- Product Image -->
                                <div class="w-32 h-32 bg-gray-100 rounded-lg shrink-0">
                                    @if ($item['produk']->gambar)
                                        <img src="{{ asset('storage/' . $item['produk']->gambar) }}"
                                            alt="{{ $item['produk']->nama_produk }}"
                                            class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <img src="/images/Abon Sapi.png" alt="{{ $item['produk']->nama_produk }}"
                                            class="w-full h-full object-contain rounded-lg">
                                    @endif
                                </div>

                                <!-- Product Info -->
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                        {{ $item['produk']->nama_produk }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-2">{{ $item['produk']->kategori }}</p>
                                    <p class="text-xl font-bold text-[#7A1F1F] mb-4">
                                        Rp {{ number_format($item['produk']->harga, 0, ',', '.') }}
                                    </p>

                                    <div class="flex items-center justify-between">
                                        <!-- Quantity Controls -->
                                        <form action="{{ route('cart.updateItem', $item['produk']->produk_id) }}"
                                            method="POST" class="flex items-center gap-3">
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" onclick="decreaseQty{{ $item['produk']->produk_id }}()"
                                                class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-100 cursor-pointer">
                                                <i class="fas fa-minus text-xs text-gray-600"></i>
                                            </button>
                                            <input type="number" name="qty" id="qty{{ $item['produk']->produk_id }}"
                                                value="{{ $item['qty'] }}" min="1"
                                                max="{{ $item['produk']->stok }}"
                                                class="w-16 text-center border border-gray-300 rounded py-1"
                                                onchange="this.form.submit()">
                                            <button type="button" onclick="increaseQty{{ $item['produk']->produk_id }}()"
                                                class="w-8 h-8 border border-gray-300 rounded hover:bg-gray-100 cursor-pointer">
                                                <i class="fas fa-plus text-xs text-gray-600"></i>
                                            </button>
                                        </form>

                                        <!-- Remove Button -->
                                        <form action="{{ route('cart.removeItem', $item['produk']->produk_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-800 flex items-center gap-1 cursor-pointer">
                                                <i class="fas fa-trash"></i>
                                                <span class="text-sm">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Subtotal -->
                                <div class="text-right">
                                    <p class="text-sm text-gray-500 mb-1">Subtotal</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <script>
                                function increaseQty{{ $item['produk']->produk_id }}() {
                                    const input = document.getElementById('qty{{ $item['produk']->produk_id }}');
                                    const max = parseInt(input.max);
                                    const current = parseInt(input.value);
                                    if (current < max) {
                                        input.value = current + 1;
                                        input.form.submit();
                                    }
                                }

                                function decreaseQty{{ $item['produk']->produk_id }}() {
                                    const input = document.getElementById('qty{{ $item['produk']->produk_id }}');
                                    const min = parseInt(input.min);
                                    const current = parseInt(input.value);
                                    if (current > min) {
                                        input.value = current - 1;
                                        input.form.submit();
                                    }
                                }
                            </script>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 sticky top-4">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>

                            <!-- Price Summary -->
                            <div class="border-t border-gray-200 pt-4 space-y-2 mb-6">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Subtotal Produk</span>
                                    <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-lg font-bold border-t pt-2">
                                    <span>Total</span>
                                    <span class="text-[#7A1F1F]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <a href="{{ route('checkout.index') }}"
                                class="block w-full bg-[#7A1F1F] text-white py-3 rounded-lg font-semibold hover:bg-[#5A0F0F] transition text-center cursor-pointer">
                                Checkout
                            </a>

                            <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit"
                                    class="w-full border-2 border-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-50 transition text-sm cursor-pointer">
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-shopping-cart text-gray-300 text-6xl mb-4"></i>
                    <h2 class="text-2xl font-semibold text-gray-700 mb-2">Keranjang Kosong</h2>
                    <p class="text-gray-500 mb-6">Belum ada produk yang ditambahkan ke keranjang</p>
                    <a href="{{ route('menu.index') }}"
                        class="inline-block bg-[#7A1F1F] text-white px-6 py-3 rounded-lg hover:bg-[#5A0F0F] transition cursor-pointer">
                        Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection