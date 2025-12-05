<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnify</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    {{-- Vite (Laravel 12) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    {{-- Navbar hanya ditampilkan jika rute bukan content.show --}}
    @if (!request()->routeIs('content.show'))
        @if (!request()->routeIs('forum.index'))
            @include('layouts.navbar')

            <div class="pt-4 mt-4">
                @yield('container')
            </div>

            @include('layouts.footer')
        @else
            @include('layouts.navbar')
            @yield('container')
        @endif
    @else
        @yield('container')
    @endif

    {{-- Hapus Mix karena Laravel 12 tidak pakai Laravel Mix --}}
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>
</html>
