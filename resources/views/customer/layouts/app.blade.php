<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Murnisaji</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#f5f5f5] relative">

    {{-- BACKGROUND MERAH FULL --}}
    <div class="absolute top-0 left-0 w-full h-[300px] bg-[#7A1F1F] overflow-hidden">
        <img src="{{ asset('images/bg customer/bg.png') }}" class="w-full h-full object-cover opacity-30">
    </div>

    {{-- CONTENT --}}
    <div class="relative z-10">
        @yield('content')
    </div>

</body>

</html>