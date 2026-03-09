@extends('admin.layout.main')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-sm text-[#D4AF5A] font-bold uppercase tracking-tighter">Income Money</p>
                <h2 class="text-xl font-black text-gray-800">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-sm text-[#D4AF5A] font-bold uppercase tracking-tighter">Total Order</p>
                <h2 class="text-xl font-black text-gray-800">{{ $totalOrders }}</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-sm text-[#D4AF5A] font-bold uppercase tracking-tighter">Total Delivered</p>
                <h2 class="text-xl font-black text-gray-800">{{ $totalDelivered }}</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-box"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-sm text-[#D4AF5A] font-bold uppercase tracking-tighter">Total Customer</p>
                <h2 class="text-xl font-black text-gray-800">{{ $totalCustomers }}</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-6 rounded-3xl shadow-sm">
            <p class="text-sm text-[#D4AF5A] font-bold uppercase">Orders</p>
            <h3 class="text-lg font-bold mb-4">Order Summary</h3>

            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="border border-gray-100 rounded-2xl p-3 text-center bg-gray-50/50">
                    <p class="text-sm text-[#D4AF5A] font-bold">TOTAL ORDER</p>
                    <p class="text-xl font-black">{{ $totalOrders }}</p>
                </div>
                <div class="border border-gray-100 rounded-2xl p-3 text-center bg-gray-50/50">
                    <p class="text-sm text-blue-500 font-bold">ON DELIVERY</p>
                    <p class="text-xl font-black">{{ $statusShipped }}</p>
                </div>
                <div class="border border-gray-100 rounded-2xl p-3 text-center bg-gray-50/50">
                    <p class="text-sm text-green-500 font-bold">DELIVERED</p>
                    <p class="text-xl font-black">{{ $statusDone }}</p>
                </div>
            </div>
            <div class="h-40">
                <canvas id="donutChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm">
            <p class="text-sm text-[#D4AF5A] font-bold uppercase">Performance</p>
            <h3 class="text-lg font-bold mb-4 text-center">Total orders</h3>
            <div class="h-60">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm overflow-hidden mb-10">
        <div class="p-6 flex justify-between items-center">
            <h3 class="text-lg font-bold">Recent Order</h3>
            <a href="{{ route('admin.transaksi.index') }}" class="bg-[#8B0000] text-white px-5 py-1.5 rounded-xl text-xs font-bold uppercase">See All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-[#8B0000] text-white text-sm uppercase">
                    <tr>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Customer Name</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Order Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-50">
                    @forelse ($recentOrders as $order)
                        <tr>
                            <td class="px-6 py-4 font-bold text-[#8B0000]">#{{ $order->transaksi_id }}</td>
                            <td class="px-6 py-4 text-[#D4AF5A] text-xs">{{ $order->created_at->format('d F Y, h:i A') }}</td>
                            <td class="px-6 py-4 font-medium">{{ $order->user->name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 font-bold">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if ($order->status == 'PENDING')
                                    <span class="w-fit bg-yellow-500 text-white text-sm font-bold px-4 py-2 rounded-lg block text-center uppercase">{{ $order->status }}</span>
                                @elseif ($order->status == 'PAID')
                                    <span class="w-fit bg-orange-500 text-white text-sm font-bold px-4 py-2 rounded-lg block text-center uppercase">{{ $order->status }}</span>
                                @elseif ($order->status == 'PACKED')
                                    <span class="w-fit bg-purple-500 text-white text-sm font-bold px-4 py-2 rounded-lg block text-center uppercase">{{ $order->status }}</span>
                                @elseif ($order->status == 'SHIPPED')
                                    <span class="w-fit bg-blue-500 text-white text-sm font-bold px-4 py-2 rounded-lg block text-center uppercase">{{ $order->status }}</span>
                                @elseif ($order->status == 'DONE')
                                    <span class="w-fit bg-green-500 text-white text-sm font-bold px-4 py-2 rounded-lg block text-center uppercase">{{ $order->status }}</span>
                                @else
                                    <span class="w-fit bg-red-500 text-white text-sm font-bold px-4 py-2 rounded-lg block text-center uppercase">{{ $order->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-[#D4AF5A]">
                                Belum ada transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Logika Donut Chart
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [{{ $statusDone }}, {{ $statusShipped }}, {{ $statusPending + $statusPaid + $statusPacked + $statusCancel }}],
                backgroundColor: ['#22c55e', '#3b82f6', '#ef4444'],
                borderWidth: 0,
                cutout: '70%'
            }]
        },
        options: { maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });

    // Logika Bar Chart - Order per bulan (dummy untuk saat ini)
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                data: [22, 18, 30, 20, 15, {{ $totalOrders }}],
                backgroundColor: '#8B0000',
                borderRadius: 20,
                barThickness: 10
            }]
        },
        options: { 
            maintainAspectRatio: false, 
            plugins: { legend: { display: false } },
            scales: { 
                y: { display: false }, 
                x: { grid: { display: false }, border: { display: false } } 
            }
        }
    });
</script>
@endpush
