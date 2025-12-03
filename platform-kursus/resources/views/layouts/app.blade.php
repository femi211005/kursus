<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- Cek halaman dan role, tampilkan navbar yang sesuai --}}
          {{-- @if (request()->routeIs('dashboard.admin.home') || request()->routeIs('admin.*'))
                @include('layouts.navbar.navigation') <!-- Navbar untuk admin -->
            @elseif (request()->routeIs('dashboard.teacher.home') || request()->routeIs('teacher.*'))
                @include('layouts.navbar.teacher') <!-- Navbar untuk teacher -->
            @else
                @include('layouts.navbar') <!-- Navbar default untuk halaman lain -->
            @endif --}}

            @if (auth()->check() && auth()->user()->role === 'admin' && request()->is('admin*'))
                @include('layouts.navbar.navigation') <!-- Navbar untuk admin -->
            @elseif (auth()->check() && auth()->user()->role === 'teacher' && request()->is('teacher*'))
                @include('layouts.navbar.teacher') <!-- Navbar untuk teacher -->
            @elseif (auth()->check() && auth()->user()->role === 'student' && request()->is('student*'))
                @include('layouts.navbar.student') <!-- Navbar untuk teacher -->
            @else
                @include('layouts.navbar') <!-- Navbar default untuk halaman lain -->
            @endif


            <!-- Page Heading -->
            @isset($header)
                <header class="bg-gray-200 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    
        {{-- <script src="https://cdn.tiny.cloud/1/8zddtp5s9al63hzts3peio7qeoqe5hf0vkuetoo68tn6n20h/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.0/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: '#description', // ID of the textarea
                plugins: 'lists link image table code textcolor colorpicker',
                toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link image | code',
                menubar: false, // Hide the menu bar for a simpler interface
                height: 400, // Height of the editor
                branding: false, // Remove "Powered by TinyMCE" branding
            });

            // document.querySelector('form').addEventListener('submit', function(e) {
            //     // Ambil konten dari TinyMCE
            //     let content = tinymce.get('description').getContent();

            //     // Konversi ke string (tanpa HTML)
            //     let plainTextContent = tinymce.get('description').getContent({ format: 'text' });

            //     console.log('Plain Text Content:', plainTextContent); // Debug untuk melihat hasilnya

            //     // Simpan hasilnya di textarea jika perlu
            //     document.getElementById('description').value = plainTextContent;

            //     // Lanjutkan pengiriman form
            //     tinymce.triggerSave();
            // });


        </script>

        


    

    </body>
</html>
