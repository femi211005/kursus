@extends('layouts.master')

@section('container')
<div class="relative w-full overflow-hidden font-sans text-gray-700">
    
    {{-- Hero Section --}}
    <section class="relative py-20 md:py-28 px-6" style="background: linear-gradient(135deg, #FCF8F8 0%, #FBEFEF 100%);">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8 relative z-10">
                    <div class="inline-block px-4 py-2 rounded-full border border-[#F5AFAF]/30 bg-white shadow-sm">
                        <span class="text-sm font-semibold text-[#F5AFAF]">🚀 Start your journey in the tech world</span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">
                        Learn programming the
                        <span class="block text-transparent bg-clip-text" style="background-image: linear-gradient(to right, #F5AFAF, #e09898);">
                            Easy Way
                        </span>
                    </h1>
                    
                    <p class="text-lg md:text-xl text-gray-600 leading-relaxed max-w-xl">
                        Master coding with structured learning paths, real-world projects, and industry-recognized certificates.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{route('class')}}" 
                           class="group inline-flex items-center justify-center gap-3 px-8 py-4 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300"
                           style="background: linear-gradient(to right, #F5AFAF, #eda3a3);">
                            Get Started
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                        
                        <a href="javascript:void(0)" onclick="document.getElementById('codemy-info')?.scrollIntoView({behavior: 'smooth', block: 'start'})"
                           class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-white border-2 text-gray-700 font-bold rounded-2xl hover:bg-[#FCF8F8] transition-all duration-300"
                           style="border-color: #F5AFAF;">
                            Learn More
                        </a>
                    </div>
                </div>

                <div class="relative z-10">
                    <div class="absolute inset-0 transform translate-x-4 translate-y-4 rounded-3xl -z-10" style="background-color: #F9DFDF;"></div>
                    <img class="relative w-full h-auto rounded-3xl shadow-2xl transform hover:scale-[1.02] transition duration-500 border-4 border-white" 
                         src="https://png.pngtree.com/png-clipart/20221018/original/pngtree-studying-english-language-course-class-png-image_8703203.png" 
                         alt="Learn Coding with Learnify">
                </div>
            </div>
        </div>
    </section>

    {{-- What is Learnify Section --}}
    <section id="codemy-info" class="py-24 px-6 bg-white relative">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="flex justify-center lg:justify-start order-2 lg:order-1">
                    <div class="relative group">
                        <div class="absolute inset-0 rounded-3xl transform rotate-6 group-hover:rotate-12 transition duration-500" style="background: linear-gradient(to bottom right, #F9DFDF, #F5AFAF);"></div>
                        <div class="relative rounded-3xl shadow-2xl p-12 transform group-hover:scale-105 transition duration-500 flex items-center justify-center" style="background: linear-gradient(to bottom right, #F5AFAF, #F9DFDF);">
                            <img class="h-auto w-64 drop-shadow-md" 
                                 src="{{ asset('/images/logowhite.png') }}" 
                                 alt="Logo Learnify">
                        </div>
                    </div>
                </div>
                
                <div class="space-y-6 order-1 lg:order-2">
                    <div class="inline-block px-4 py-2 bg-[#FCF8F8] rounded-full border border-[#F5AFAF]/30">
                        <span class="text-sm font-semibold text-[#F5AFAF]">About Learnify</span>
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                        What is <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, #F5AFAF, #e09898);">Learnify</span>?
                    </h2>
                    
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Learnify is a comprehensive e-learning platform designed to transform beginners into professional developers through structured and hands-on learning experiences.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-6 pt-4">
                        <div class="space-y-2 p-6 bg-[#FCF8F8] rounded-2xl border border-[#F9DFDF] hover:shadow-md transition">
                            <div class="text-4xl font-extrabold text-transparent bg-clip-text" style="background-image: linear-gradient(to right, #F5AFAF, #e09898);">500+</div>
                            <div class="text-sm font-medium text-gray-600">Active Learners</div>
                        </div>
                        <div class="space-y-2 p-6 bg-[#FBEFEF] rounded-2xl border border-[#F9DFDF] hover:shadow-md transition">
                            <div class="text-4xl font-extrabold text-transparent bg-clip-text" style="background-image: linear-gradient(to right, #F5AFAF, #e09898);">50+</div>
                            <div class="text-sm font-medium text-gray-600">Expert Courses</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Learnify Section (Accordion) --}}
    <section class="py-24 px-6" style="background-color: #FCF8F8;">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-block px-4 py-2 bg-white rounded-full shadow-sm border border-[#F5AFAF]/20 mb-4">
                    <span class="text-sm font-semibold text-[#F5AFAF]">Our Advantages</span>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Why Choose <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, #F5AFAF, #e09898);">Learnify</span>?
                </h2>
                
                <p class="text-lg text-gray-600">
                    We provide industry-standard curriculum with practical projects and recognized certificates.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div class="space-y-4">
                    @php
                        $features = [
                            1 => ['title' => 'Structured Curriculum', 'desc' => 'Every course is systematically designed with learning paths adaptable to your skill level.'],
                            2 => ['title' => 'Practical Learning', 'desc' => 'Learn through real-world projects relevant to industry needs, not just theory.'],
                            3 => ['title' => 'Progress Tracking', 'desc' => 'Progress systems ensure in-depth learning with structured sequential modules.'],
                            4 => ['title' => 'Verified Certificates', 'desc' => 'Earn digital certificates recognized by companies to boost your professional credibility.']
                        ];
                    @endphp

                    @foreach($features as $key => $feature)
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-[#F9DFDF]">
                        <button type="button" 
                                class="flex items-center justify-between w-full p-6 text-left group focus:outline-none"
                                onclick="toggleAccordion({{ $key }})">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-md transition-transform group-hover:scale-110"
                                     style="background: linear-gradient(135deg, #F9DFDF 0%, #F5AFAF 100%);">
                                    {{ $key }}
                                </div>
                                <span class="text-lg font-bold text-gray-800 group-hover:text-[#F5AFAF] transition-colors">
                                    {{ $feature['title'] }}
                                </span>
                            </div>
                            <svg id="icon-{{ $key }}" class="w-6 h-6 text-[#F5AFAF] transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                        <div id="body-{{ $key }}" class="hidden px-6 pb-6">
                            <div class="pl-16">
                                <p class="text-gray-600 bg-[#FCF8F8] p-4 rounded-lg border border-[#F9DFDF]/50">
                                    {{ $feature['desc'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="sticky top-24 hidden lg:block">
                    <div class="relative">
                        <div class="absolute inset-0 rounded-3xl transform -rotate-3 translate-x-2 translate-y-2" style="background-color: #F9DFDF;"></div>
                        <img id="accordion-image" 
                             class="relative w-full h-auto rounded-3xl shadow-2xl transition-all duration-500 border-4 border-white object-cover aspect-[4/3]" 
                             src="https://images.pexels.com/photos/12662857/pexels-photo-12662857.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" 
                             alt="Why Choose Learnify">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Learning Path Section --}}
    <section class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-block px-4 py-2 bg-[#FCF8F8] rounded-full border border-[#F5AFAF]/20 mb-4">
                    <span class="text-sm font-semibold text-[#F5AFAF]">Choose Your Path</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, #F5AFAF, #e09898);">Learning</span> Paths
                </h2>
                <p class="text-lg text-gray-600">
                    Structured curriculum from beginner to expert.
                </p>
            </div>

            <div class="swiper swiper-container-path relative px-4 md:px-12">
                <div class="swiper-wrapper pb-12">
                    @foreach(['bp.png', 'web.png', 'pds.png', 'mobile.png', 'dbms.png'] as $index => $path)
                    <div class="swiper-slide">
                        <div class="group relative cursor-pointer">
                            <div class="absolute inset-0 rounded-2xl transform group-hover:scale-105 transition duration-300 opacity-0 group-hover:opacity-100 -z-10" 
                                 style="background: linear-gradient(135deg, #F9DFDF 0%, #F5AFAF 100%); margin: -4px;"></div>
                            <img class="relative w-full h-auto rounded-2xl shadow-lg group-hover:shadow-xl transition duration-300 bg-white" 
                                 src="{{ asset('/images/' . $path) }}" 
                                 alt="Learning Path {{ $index + 1 }}">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next !w-12 !h-12 !bg-white !rounded-full !shadow-lg after:!text-[#F5AFAF] after:!text-xl border !border-[#F5AFAF]/20 hover:!bg-[#FCF8F8]"></div>
                <div class="swiper-button-prev !w-12 !h-12 !bg-white !rounded-full !shadow-lg after:!text-[#F5AFAF] after:!text-xl border !border-[#F5AFAF]/20 hover:!bg-[#FCF8F8]"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    {{-- Top Courses Section --}}
    <section class="py-24 px-6" style="background: linear-gradient(180deg, #FCF8F8 0%, #FBEFEF 100%);">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 items-center">
                <div class="lg:col-span-2 space-y-6">
                    <div class="inline-block px-4 py-2 bg-white rounded-full shadow-sm border border-[#F5AFAF]/20">
                        <span class="text-sm font-semibold text-[#F5AFAF]">Popular Courses</span>
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900 leading-tight">
                        <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, #F5AFAF, #e09898);">Industry Standard</span> Courses
                    </h2>
                    <p class="text-lg text-gray-600">
                        From beginners to professionals, our courses are designed to meet global industry standards.
                    </p>
                    <a href="{{ route('class') }}" 
                       class="group inline-flex items-center gap-3 text-[#F5AFAF] font-bold text-lg hover:gap-5 transition-all duration-300">
                        <span>View All</span>
                        <div class="text-white p-3 rounded-full shadow-lg group-hover:shadow-xl transition-all"
                             style="background: linear-gradient(to right, #F9DFDF, #F5AFAF);">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
                            </svg>
                        </div>
                    </a>
                </div>
                
                <div class="lg:col-span-3 min-w-0">
                    <div class="swiper swiper-container-course px-2 py-4">
                        <div class="swiper-wrapper">
                            @forelse ($courses ?? [] as $course)
                            <div class="swiper-slide h-auto">
                                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-[#F9DFDF] h-full flex flex-col">
                                    <div class="relative overflow-hidden h-48 flex-shrink-0">
                                        <img src="{{ Storage::url($course->course_picture) }}" 
                                             alt="{{ $course->name }}" 
                                             class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                                        <div class="absolute top-4 right-4">
                                            <span class="px-3 py-1 text-white text-xs font-semibold rounded-full shadow-sm"
                                                  style="background: linear-gradient(to right, #F9DFDF, #F5AFAF);">
                                                {{ $course->category->name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="p-6 flex flex-col flex-grow">
                                        <h3 class="text-xl font-bold text-gray-900 line-clamp-2 mb-2">
                                            {{ $course->name }}
                                        </h3>
                                        <p class="text-sm text-gray-600 line-clamp-2 mb-4 flex-grow">
                                            {{ $course->description }}
                                        </p>
                                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                                            <span>👨‍🏫 {{ $course->teacher->name }}</span>
                                        </div>
                                        <div class="flex items-center justify-between pt-4 border-t border-[#FBEFEF] mt-auto">
                                            <div class="text-xs text-gray-500 flex items-center gap-4">
                                                <span class="flex items-center gap-1">
                                                    👥 {{ $course->participants_count }}
                                                </span>
                                                <span>
                                                    📅 {{ \Carbon\Carbon::parse($course->end_date)->format('M d, Y') }}
                                                </span>
                                            </div>
                                        </div>
                                        <a href="{{ route('contents.index', ['course' => $course->id]) }}" 
                                           class="mt-4 block text-center text-white font-bold px-6 py-3 rounded-xl hover:shadow-lg transition-all duration-300"
                                           style="background: linear-gradient(to right, #F5AFAF, #eda3a3);">
                                            View Course
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="swiper-slide">
                                <div class="bg-white rounded-2xl shadow-sm p-8 text-center border border-[#F9DFDF]">
                                    <p class="text-gray-500">No courses available yet.</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonial Section (Swiper) --}}
    <section class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-block px-4 py-2 bg-[#FCF8F8] rounded-full border border-[#F5AFAF]/20 mb-4">
                    <span class="text-sm font-semibold text-[#F5AFAF]">Success Stories</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    What <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(to right, #F5AFAF, #e09898);">Learners</span> Say
                </h2>
                <p class="text-lg text-gray-600">
                    Real experiences from students who transformed their careers.
                </p>
            </div>

            <div class="swiper swiper-container-testimonial max-w-5xl mx-auto relative px-4 md:px-12">
                <div class="swiper-wrapper pb-12">
                    @php
                    $testimonials = [
                        ['name' => 'Sittie Jennie Aulia', 'role' => 'Medical Student', 'company' => 'Universitas Udayana', 'quote' => 'I am very satisfied with the Learnify e-course! The material is easy to understand, and every step is explained very clearly.', 'img' => 't1.png'],
                        ['name' => 'Kento Ridwan', 'role' => 'Software Engineer', 'company' => 'Gojek', 'quote' => 'Learnify gave me more insights into coding. This course blends theory with practice which is very beneficial.', 'img' => 't2.png'],
                        ['name' => 'Kadri Murphy', 'role' => 'Data Scientist', 'company' => 'BRI', 'quote' => 'As an experienced developer, I was looking for a course that teaches advanced concepts, and Learnify successfully delivered that.', 'img' => 't3.png'],
                        ['name' => 'Lily Sari', 'role' => 'Marketing Specialist', 'company' => 'Galesong Group', 'quote' => 'Learnify courses allow me to learn coding in my free time. The materials can be accessed anytime.', 'img' => 't4.png'],
                    ];
                    @endphp

                    @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="bg-[#FCF8F8] rounded-3xl shadow-lg border border-[#F9DFDF] overflow-hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2">
                                <div class="p-8 md:p-12 flex flex-col justify-center space-y-6">
                                    <svg class="w-10 h-10 text-[#F5AFAF]" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                                    <p class="text-lg text-gray-700 italic">"{{ $testimonial['quote'] }}"</p>
                                    <div class="space-y-1 border-l-4 border-[#F5AFAF] pl-4">
                                        <p class="font-bold text-gray-900 text-lg">{{ $testimonial['name'] }}</p>
                                        <p class="text-sm text-gray-600">{{ $testimonial['role'] }}</p>
                                        <p class="text-sm font-semibold text-[#F5AFAF]">{{ $testimonial['company'] }}</p>
                                    </div>
                                </div>
                                <div class="relative h-64 md:h-auto">
                                    <img src="{{asset('/images/' . $testimonial['img'])}}" alt="{{ $testimonial['name'] }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(245, 175, 175, 0.2), transparent);"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="swiper-pagination-testimonial flex justify-center mt-4"></div>
            </div>
        </div>
    </section>
</div>

{{-- Styles khusus untuk halaman ini --}}
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    /* Custom pagination color */
    .swiper-pagination-bullet-active {
        background-color: #F5AFAF !important;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    html {
        scroll-behavior: smooth;
    }
</style>

{{-- Scripts --}}
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // 1. Learning Path Swiper
        new Swiper('.swiper-container-path', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 24 },
            },
        });

        // 2. Top Courses Swiper
        new Swiper('.swiper-container-course', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true, // Pastikan ada cukup slide agar loop berjalan mulus
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            breakpoints: {
                768: { slidesPerView: 1.5, spaceBetween: 24 },
                1024: { slidesPerView: 2.2, spaceBetween: 30 },
            },
        });

        // 3. Testimonial Swiper (Updated)
        new Swiper('.swiper-container-testimonial', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            effect: 'fade', // Efek fade agar transisi testimonial lebih elegan
            fadeEffect: { crossFade: true },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination-testimonial',
                clickable: true,
            },
        });
    });

    // Accordion Logic
    function toggleAccordion(num) {
        // Saya memperbaiki sedikit syntax JS di sini agar valid (menambahkan tanda petik/backtick)
        const body = document.getElementById(body-${num});
        const icon = document.getElementById(icon-${num});
        
        // Tutup yang lain
        for(let i = 1; i <= 4; i++) {
            if(i !== num) {
                const otherBody = document.getElementById(body-${i});
                const otherIcon = document.getElementById(icon-${i});
                if(otherBody && !otherBody.classList.contains('hidden')) {
                    otherBody.classList.add('hidden');
                    otherIcon.classList.remove('rotate-180');
                }
            }
        }
        
        // Toggle yang diklik
        body.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
        
        // Ganti Gambar
        const images = [
            "https://images.pexels.com/photos/12662857/pexels-photo-12662857.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
            "https://images.pexels.com/photos/7988747/pexels-photo-7988747.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
            "https://images.pexels.com/photos/10223855/pexels-photo-10223855.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2",
            "https://images.pexels.com/photos/1181671/pexels-photo-1181671.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
        ];
        
        const img = document.getElementById('accordion-image');
        if(img) {
            img.style.opacity = '0';
            img.style.transform = 'scale(0.95)';
            setTimeout(() => {
                img.src = images[num - 1];
                img.style.opacity = '1';
                img.style.transform = 'scale(1)';
            }, 300);
        }
    }
</script>
@endsection