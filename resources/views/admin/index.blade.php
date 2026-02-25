@extends('admin.layout.main')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Income Money</p>
                <h2 class="text-xl font-black text-gray-800">Rp. 3.750.000</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Total Order</p>
                <h2 class="text-xl font-black text-gray-800">40</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Total Delivered</p>
                <h2 class="text-xl font-black text-gray-800">23</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-box"></i>
            </div>
        </div>
        <div class="bg-white p-5 rounded-3xl shadow-sm flex justify-between items-center">
            <div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Total Customer</p>
                <h2 class="text-xl font-black text-gray-800">23</h2>
            </div>
            <div class="bg-[#8B0000] p-3 rounded-xl text-white shadow-md">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white p-6 rounded-3xl shadow-sm">
            <p class="text-[10px] text-gray-400 font-bold uppercase">Orders</p>
            <h3 class="text-lg font-bold mb-4">Order Summary</h3>

            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="border border-gray-100 rounded-2xl p-3 text-center bg-gray-50/50">
                    <p class="text-[10px] text-gray-400 font-bold">TOTAL ORDER</p>
                    <p class="text-xl font-black">3</p>
                </div>
                <div class="border border-gray-100 rounded-2xl p-3 text-center bg-gray-50/50">
                    <p class="text-[10px] text-blue-500 font-bold">ON DELIVERY</p>
                    <p class="text-xl font-black">1</p>
                </div>
                <div class="border border-gray-100 rounded-2xl p-3 text-center bg-gray-50/50">
                    <p class="text-[10px] text-green-500 font-bold">DELIVERED</p>
                    <p class="text-xl font-black">2</p>
                </div>
            </div>
            <div class="h-40">
                <canvas id="donutChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm">
            <p class="text-[10px] text-gray-400 font-bold uppercase">Performance</p>
            <h3 class="text-lg font-bold mb-4 text-center">Total orders</h3>
            <div class="h-60">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm overflow-hidden mb-10">
        <div class="p-6 flex justify-between items-center">
            <h3 class="text-lg font-bold">Recent Order</h3>
            <button class="bg-[#8B0000] text-white px-5 py-1.5 rounded-xl text-xs font-bold uppercase">See All</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-[#8B0000] text-white text-[10px] uppercase">
                    <tr>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Customer Name</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Order Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-50">
                    @foreach (range(1, 5) as $i)
                        <tr>
                            <td class="px-6 py-4 font-bold text-[#8B0000]">#123123</td>
                            <td class="px-6 py-4 text-gray-400 text-xs">1 January 2025, 12.00AM</td>
                            <td class="px-6 py-4 font-medium">Agus</td>
                            <td class="px-6 py-4 font-bold">Rp. 90.000</td>
                            <td class="px-6 py-4">
                                <span
                                    class="bg-green-500 text-white text-[10px] font-bold px-3 py-1 rounded-lg block text-center uppercase">Delivered</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
