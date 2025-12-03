<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codemy</title>
    {{-- <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script> --}}

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body>
    {{-- Navbar hanya ditampilkan jika rute bukan content.show --}}
    @if (!request()->routeIs('content.show'))
        @if(!request()->routeIs('forum.index'))
            @include('layouts.navbar')
            <div class="pt-10 mt-10">
                @yield('container')
            </div>
            @include('layouts.footer')
        @else
            @include('layouts.navbar')
            @yield('container')
        @endif
    @elseif(request()->routeIs('content.show'))
        @yield('container')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
