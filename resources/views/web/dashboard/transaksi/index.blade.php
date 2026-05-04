@extends('web.dashboard.layout.main')

@php($title = 'Detail Transaksi')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div class="bg-green-100 border border-green-200 text-green-800 rounded-2xl p-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-200 text-red-800 rounded-2xl p-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-6">
            <h1 class="text-3xl font-bold text-gray-900">Detail Transaksi</h1>
            <p class="text-gray-600 mt-1">No. Transaksi: #{{ $transaction->transaksi_id }}</p>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                    <div class="flex flex-col items-start gap-2">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Status Transaksi</p>
                            {{-- <h2 class="text-2xl font-bold text-gray-900">{{ $transaction->status }}</h2> --}}
                        </div>

                        @if ($transaction->status == 'PENDING')
                            <div class="w-full p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <p class="text-sm text-yellow-800 mb-2"><i class="fas fa-info-circle"></i> <strong>Menunggu
                                        Pembayaran</strong></p>
                                <p class="text-sm text-yellow-700">Silakan lakukan pembayaran untuk melanjutkan pesanan
                                    Anda.</p>

                                @if ($transaction->payment && $transaction->payment->snap_token)
                                    <button type="button" id="pay-button"
                                        class="mt-4 w-full bg-[#7A1F1F] text-white py-2 rounded-lg font-semibold hover:bg-[#5A0F0F] transition cursor-pointer">
                                        Bayar Dengan Midtrans
                                    </button>
                                @else
                                    <form action="{{ route('payment.createSnap', $transaction->transaksi_id) }}"
                                        method="POST" class="mt-4">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-[#7A1F1F] text-white py-2 rounded-lg font-semibold hover:bg-[#5A0F0F] transition cursor-pointer">
                                            Buat Pembayaran Midtrans
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @elseif ($transaction->status == 'PAID')
                            <div class="w-full p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-sm text-blue-800 mb-2"><i class="fas fa-check-circle"></i> <strong>Pesanan
                                        telah terbayar</strong></p>
                                <p class="text-sm text-blue-700">Pesanan Anda sedang diproses.</p>
                            </div>
                        @elseif($transaction->status == 'PACKED')
                            <div class="w-full p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-sm text-blue-800 mb-2"><i class="fas fa-box"></i> <strong>Pesanan
                                        Dikemas</strong></p>
                                <p class="text-sm text-blue-700">Pesanan Anda sedang dikemas dan akan segera dikirim.</p>
                            </div>
                        @elseif($transaction->status == 'SHIPPED' && $transaction->trackingResi->no_resi)
                            <div class="w-full p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <p class="text-sm text-blue-800 mb-2"><i class="fas fa-shipping-fast"></i> <strong>Pesanan
                                        Sedang Dikirim</strong></p>
                                <p class="text-sm text-blue-700">Nomor Resi:
                                    <strong>{{ $transaction->trackingResi->no_resi }}</strong>
                                </p>
                                <div class="flex justify-between mt-2">
                                    <div>
                                        <button id="cek-resi-btn" type="button"
                                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm hover:cursor-pointer">Cek
                                        Status Pengiriman</button>
                                    <div id="tracking-result" class="mt-3 text-sm text-blue-900"></div>
                                    </div>
                                    <form method="POST"
                                        action="{{ route('dashboard.transaction.receive', $transaction->transaksi_id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition text-sm font-medium hover:cursor-pointer">
                                            Pesanan Diterima
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <script>
                                document.getElementById('cek-resi-btn').addEventListener('click', function() {
                                    const resultDiv = document.getElementById('tracking-result');
                                    resultDiv.innerHTML = 'Memuat status pengiriman...';
                                    fetch('/tracking/{{ $transaction->tracking_id }}')
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.status_terakhir) {
                                                let html = `<b>Status Terakhir:</b> ${data.status_terakhir}<br>`;
                                                if (data.histories && data.histories.length > 0) {
                                                    html += '<b>Riwayat:</b><ul style="margin-left:1em">';
                                                    data.histories.slice(0, 5).forEach(h => {
                                                        html +=
                                                            `<li>${h.waktu ? h.waktu.substring(0, 16).replace('T', ' ') : ''} - <b>${h.status}</b> ${h.deskripsi ? ('- ' + h.deskripsi) : ''} ${h.lokasi ? ('@' + h.lokasi) : ''}</li>`;
                                                    });
                                                    html += '</ul>';
                                                }
                                                resultDiv.innerHTML = html;
                                            } else {
                                                resultDiv.innerHTML = 'Status pengiriman tidak tersedia.';
                                            }
                                        })
                                        .catch(() => {
                                            resultDiv.innerHTML = 'Gagal mengambil status pengiriman.';
                                        });
                                });
                            </script>
                        @elseif ($transaction->status == 'DELIVERED')
                            <div class="w-full p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm text-green-800 mb-2"><i class="fas fa-check-circle"></i>
                                            <strong>Pesanan
                                                Selesai</strong>
                                        </p>
                                        <p class="text-sm text-green-700">Terima kasih telah berbelanja di Murnisaji!</p>
                                    </div>

                                    <a href="{{ route('dashboard.reviews') }}"
                                        class="inline-flex items-center bg-[#7A1F1F] text-white px-4 py-2 h-fit rounded-lg hover:bg-[#5A0F0F] transition text-sm font-medium hover:cursor-pointer">
                                        Ulasan
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if ($transaction->payment && $transaction->payment->snap_token)
                            <script
                                src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
                                data-client-key="{{ config('services.midtrans.client_key') }}"></script>
                            <script>
                                const snapToken = @json($transaction->payment->snap_token);
                                const shouldOpenSnap = @json(session('open_snap', false));
                                const payButton = document.getElementById('pay-button');

                                function openSnapPopup() {
                                    if (!window.snap || !snapToken) {
                                        return;
                                    }

                                    window.snap.pay(snapToken, {
                                        onSuccess: function() {
                                            window.location.reload();
                                        },
                                        onPending: function() {
                                            window.location.reload();
                                        },
                                        onError: function() {
                                            alert('Pembayaran gagal diproses, silakan coba lagi.');
                                        },
                                        onClose: function() {
                                            // User closed popup without finishing payment.
                                        }
                                    });
                                }

                                if (payButton) {
                                    payButton.addEventListener('click', openSnapPopup);
                                }

                                if (shouldOpenSnap) {
                                    openSnapPopup();
                                }
                            </script>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Barang yang Dipesan</h3>
                    <div class="space-y-4 mb-4 pb-4 border-b border-gray-200">
                        @foreach ($transaction->items as $item)
                            <div class="flex justify-between items-start gap-3">
                                <div class="w-12 h-16 bg-gray-100 rounded-lg overflow-hidden">
                                    <img class="w-12" src="{{ asset('storage/' . $item->produk->gambar) }}"
                                        alt="">
                                </div>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $item->produk->nama_produk ?? '-' }}</p>
                                    <p class="text-sm text-gray-600">{{ $item->quantity }} x
                                        Rp{{ number_format($item->harga_saat_beli, 0, ',', '.') }}</p>
                                </div>
                                <p class="font-semibold text-gray-900">
                                    Rp{{ number_format($item->quantity * $item->harga_saat_beli, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($transaction->total_harga_produk, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkir ({{ strtoupper($transaction->kurir) }})</span>
                            <span>Rp{{ number_format($transaction->ongkir, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold text-gray-900 pt-2 border-t border-gray-200">
                            <span>Total</span>
                            <span>Rp{{ number_format($transaction->total_bayar, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Pengiriman</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-gray-600">Penerima</p>
                            <p class="font-medium text-gray-900">{{ $transaction->nama_penerima }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Alamat</p>
                            <p class="font-medium text-gray-900">{{ $transaction->detail }},
                                {{ $transaction->kecamatan }}, {{ $transaction->kabupaten }},
                                {{ $transaction->provinsi }} {{ $transaction->kodepos }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Nomor Telepon</p>
                            <p class="font-medium text-gray-900">{{ $transaction->no_telepon }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal</span>
                            <span class="font-medium">{{ $transaction->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Item</span>
                            <span class="font-medium">{{ $transaction->items->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Jumlah</span>
                            <span class="font-medium">{{ $transaction->items->sum('quantity') }} produk</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
