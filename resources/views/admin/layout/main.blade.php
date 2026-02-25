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
        html, body {
            font-family: 'Inter', sans-serif;
        }
        .bg-pattern {
            background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen font-sans relative overflow-x-hidden">

    <div class="fixed top-0 left-0 w-full h-[300px] bg-[#8B0000] z-0 shadow-lg bg-pattern"></div>

    <div class="relative z-10 flex gap-6 p-6 h-screen">
        
        @include('admin.layout.partials.sidebar')

        <div class="w-64">

        </div>

        <div class="flex-1 flex flex-col gap-6 h-fit overflow-y-auto no-scrollbar">
            
            @include('admin.layout.partials.header')

            @yield('content')
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