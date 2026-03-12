<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Website - Murnisaji</title>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<style>
    body {
        font-family: 'Libre Baskerville', serif;
    }
</style>

<body>

    <div class="min-h-screen bg-[#FCFBF5]">

        <!-- Navbar -->
        @include('web.layouts.partials.navbar')        

        <div class="mt-[120px]">
            @yield('content')
        </div>

        @include('web.layouts.partials.footer')
    </div>
</body>

</html>
