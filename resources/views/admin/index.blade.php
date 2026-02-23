<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Murnisaji Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .bg-pattern {
            background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen font-sans relative overflow-x-hidden">

    <div class="fixed top-0 left-0 w-full h-[300px] bg-[#8B0000] z-0 shadow-lg bg-pattern"></div>

    <div class="relative z-10 flex gap-6 p-6 h-screen">
        
        <aside class="w-64 bg-white rounded-3xl shadow-2xl flex flex-col overflow-hidden h-full fixed">
            <div class="p-8">
                <a href="/admin" class="flex justify-center items-center gap-2">
                    {{-- <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                        <span class="text-amber-800 font-bold text-xs">MS</span>
                    </div>
                    <h2 class="text-[#8B0000] text-2xl font-bold tracking-tight italic">Murnisaji</h2> --}}
                    <img class="h-8" src="{{ asset('images/Murnisaji Logo Red 2.png') }}" alt="">
                </a>
            </div>

            <nav class="mt-4 flex-1 px-4 space-y-2">
                <a href="#" class="flex items-center px-6 py-3 bg-gray-50 rounded-2xl text-[#8B0000] font-bold shadow-sm">
                    <i class="fas fa-home mr-4"></i> Dashboard
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-400 hover:text-[#8B0000] transition">
                    <i class="fas fa-shopping-cart mr-4"></i> Order
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-400 hover:text-[#8B0000] transition">
                    <i class="fas fa-comment-alt mr-4"></i> Review
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-400 hover:text-[#8B0000] transition">
                    <i class="fas fa-users mr-4"></i> Customer
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-400 hover:text-[#8B0000] transition">
                    <i class="fas fa-user mr-4"></i> Profile
                </a>
            </nav>

            <div class="p-8">
                <button class="w-full bg-[#8B0000] text-white py-3 rounded-xl font-bold hover:opacity-90 transition shadow-lg uppercase text-xs tracking-widest">
                    Logout
                </button>
            </div>
        </aside>

        <div class="w-64">

        </div>

        <div class="flex-1 flex flex-col gap-6 h-fit overflow-y-auto no-scrollbar">
            
            <header class="flex justify-between items-center text-[#8B0000] bg-white p-5 rounded-3xl">
                <h1 class="text-2xl font-bold tracking-wide">Dashboard</h1>
                <div class="flex items-center gap-2">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <span class="font-semibold text-sm">Admin</span>
                </div>
            </header>

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
                            @foreach(range(1,5) as $i)
                            <tr>
                                <td class="px-6 py-4 font-bold text-[#8B0000]">#123123</td>
                                <td class="px-6 py-4 text-gray-400 text-xs">1 January 2025, 12.00AM</td>
                                <td class="px-6 py-4 font-medium">Agus</td>
                                <td class="px-6 py-4 font-bold">Rp. 90.000</td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-500 text-white text-[10px] font-bold px-3 py-1 rounded-lg block text-center uppercase">Delivered</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Logika Donut Chart
        new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [2, 1, 3],
                    backgroundColor: ['#22c55e', '#3b82f6', '#ef4444'],
                    borderWidth: 0,
                    cutout: '70%'
                }]
            },
            options: { maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });

        // Logika Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    data: [22, 18, 30, 20, 15, 28],
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
</body>
</html>