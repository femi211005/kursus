<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Learnify') }}</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- Tampilkan navbar berdasarkan user role dan route --}}
            @auth
                @if (auth()->user()->role === 'admin')
                    @include('layouts.navbar.navigation')
                @elseif (auth()->user()->role === 'teacher')
                    @include('layouts.navbar.teacher')
                @elseif (auth()->user()->role === 'student')
                    @include('layouts.navbar.student')
                @endif
            @else
                @include('layouts.navbar')
            @endauth

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
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.2.0/tinymce.min.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (!document.querySelector('#description')) {
                    return;
                }

                tinymce.init({
                    selector: '#description',
                    plugins: 'lists link image table code textcolor colorpicker',
                    toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link image | code',
                    menubar: false,
                    height: 400,
                    branding: false,
                });
            });

            // Carousel Testimonial
            function initTestimonialCarousel() {
                const carousel = document.getElementById('testimonial-carousel');
                if (!carousel) return;

                const items = carousel.querySelectorAll('[data-carousel-item]');
                const prevBtn = carousel.querySelector('[data-carousel-prev]');
                const nextBtn = carousel.querySelector('[data-carousel-next]');
                let currentIndex = 0;

                function showSlide(n) {
                    items.forEach(item => item.classList.add('hidden'));
                    items[n].classList.remove('hidden');
                }

                if (prevBtn) prevBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex - 1 + items.length) % items.length;
                    showSlide(currentIndex);
                });

                if (nextBtn) nextBtn.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % items.length;
                    showSlide(currentIndex);
                });

                showSlide(0);

                // Auto rotate every 5 seconds
                setInterval(() => {
                    currentIndex = (currentIndex + 1) % items.length;
                    showSlide(currentIndex);
                }, 5000);
            }

            document.addEventListener('DOMContentLoaded', initTestimonialCarousel);
        </script>
    </body>
</html>
