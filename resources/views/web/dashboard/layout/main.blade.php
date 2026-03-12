<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        @include('web.dashboard.layout.partials.sidebar')

        <div class="w-64"></div>

        <div class="flex-1 flex flex-col gap-6 h-fit overflow-y-auto no-scrollbar">
            @include('web.dashboard.layout.partials.header')
            @yield('content')
        </div>
    </div>
</body>
</html>
