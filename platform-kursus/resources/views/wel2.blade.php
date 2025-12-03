@extends('layouts.master')

@section('container')
<div class="relative w-full">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
        <div class="order-2 md:order-1">
            <section class="bg-white mt-10">
                <div class="py-8 px-6 mx-auto max-w-screen-md text-left lg:py-16">
                    <h1 class="mb-6 text-2xl font-mono font-bold text-gray-900 md:text-3xl lg:text-4xl">Learn Coding the Easy Way with Codemy!</h1>
                    <p class="mb-8 text-base text-gray-600 lg:text-lg sm:px-0">Start your journey to a tech career with our interactive e-courses!</p>
                    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-start sm:space-y-0">
                        <a href="{{route('class')}}" class="inline-flex justify-center items-center py-3 px-6 text-sm font-medium text-center text-white rounded-lg bg-sky-950 hover:bg-sky-700 focus:ring-4 focus:ring-sky-600">
                            Take Course Right Now
                            <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a> 
                    </div>
                </div>
            </section>        
        </div>
        <div class="order-1 md:order-2">
            <img class="w-full h-auto" src="https://dicoding-web-img.sgp1.cdn.digitaloceanspaces.com/original/commons/homepage-hero.png" alt="Learn Coding with Codemy">
        </div>
    </div>

    <div id="codemy" class="bg-zinc-50 py-12 mt-10">
        <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 px-6 lg:px-12">
            <!-- Gambar -->
            <div class="flex justify-center items-center">
                <div class="bg-sky-950 rounded-lg shadow-lg p-6 transform transition duration-500 hover:scale-105">
                    <img class="h-auto w-auto rounded-lg" src="{{ asset('/images/logowhite.png') }}" alt="Codemy Logo">
                </div>
            </div>
    
            <!-- Teks -->
            <div class="flex flex-col justify-center text-left space-y-6">
                <h2 class="text-4xl font-bold font-mono text-gray-800 tracking-wide mb-4">What is Codemy?</h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Codemy is a platform designed to help you develop coding skills through structured, hands-on learning. With real-world projects and personalized learning paths, you can enhance your career and achieve your professional goals.
                </p>
            </div>        
        </div>
    </div>
    

{{-- untuk why should codemy --}}
    <section class="mt-10 bg-gradient-to-tr from-sky-100 via-white to-white">
        <div class="py-8 px-4 max-w-screen-xl text-center lg:py-16 mx-auto mt-10">
            <h1 class="mb-4 text-4xl font-mono font-bold tracking-tight leading-none text-gray-800 md:text-5xl lg:text-3xl">Why Should Codemy?</h1>
            <p class="mb-8 text-lg font-normal text-gray-600 lg:text-xl sm:px-16 lg:px-48"> 
                Codemy stands out by providing a curriculum tailored to your career goals, with real-world projects and a strong focus on practical coding skills. Our platform ensures continuous progress with structured learning paths and certificates recognized by top companies.
            </p>
        </div>
    
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center px-20">
            <div class="order-2 md:order-1">
                <div id="accordion-flush" data-accordion="collapse" data-active-classes="text-gray-900" data-inactive-classes="text-gray-500">
                    <!-- Accordion 1 -->
                    <h2 id="accordion-flush-heading-1">
                        <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-700 border-b border-gray-200 gap-3  rounded-lg" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1" onclick="changeImage(1)">
                            <span>Kuriculum yang Terstruktur dan Personalizable</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                        <div class="py-5 border-b border-gray-200 ">
                            <p class="mb-2 text-gray-500">Codemy menawarkan kurikulum yang dirancang secara sistematis, memungkinkan pengguna untuk mengikuti jalur pembelajaran (learning path) yang sesuai dengan tingkat kemampuan dan tujuan karier mereka. Setiap kursus disusun agar mudah diikuti, dengan progres yang terukur.</p>
                        </div>
                    </div>
    
                    <!-- Accordion 2 -->
                    <h2 id="accordion-flush-heading-2">
                        <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-700 border-b border-gray-200 gap-3  rounded-lg" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2" onclick="changeImage(2)">
                            <span>Fokus pada Pembelajaran Praktis</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                        <div class="py-5 border-b border-gray-200">
                            <p class="mb-2 text-gray-500">Tidak hanya teori, Codemy menekankan pembelajaran berbasis proyek. Peserta akan mengerjakan proyek nyata yang sesuai dengan kebutuhan industri, sehingga siap menghadapi tantangan dunia kerja.</p>
                        </div>
                    </div>
    
                    <!-- Accordion 3 -->
                    <h2 id="accordion-flush-heading-3">
                        <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-700 border-b border-gray-200 gap-3  rounded-lg" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3" onclick="changeImage(3)">
                            <span>Fitur Pelacakan Progres yang Inovatif</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                        <div class="py-5 border-b border-gray-200 ">
                            <p class="mb-2 text-gray-500">Sistem Codemy memandu peserta kursus dengan fitur progres modul yang canggih. Siswa hanya dapat melanjutkan modul berikutnya setelah menyelesaikan modul sebelumnya, memastikan pembelajaran mendalam dan berurutan.</p>
                        </div>
                    </div>
    
                    <!-- Accordion 4 -->
                    <h2 id="accordion-flush-heading-4">
                        <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-700 border-b border-gray-200 gap-3  rounded-lg" data-accordion-target="#accordion-flush-body-4" aria-expanded="false" aria-controls="accordion-flush-body-4" onclick="changeImage(4)">
                            <span>Pemberian Sertifikat Otomatis yang Terverifikasi</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-flush-body-4" class="hidden" aria-labelledby="accordion-flush-heading-4">
                        <div class="py-5 border-b border-gray-200 ">
                            <p class="mb-2 text-gray-500">Setelah menyelesaikan kursus, peserta akan menerima sertifikat digital yang dapat diverifikasi dan diakui oleh banyak perusahaan, meningkatkan nilai jual di pasar kerja.</p>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="order-1 md:order-2">
                <img id="accordion-image" class="w-full h-auto rounded-md transition-opacity duration-500" src="https://images.pexels.com/photos/12662857/pexels-photo-12662857.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Learn Coding with Codemy">
            </div>
        </div>
    </section>
    
    <script>
        function changeImage(accordionNumber) {
            const imageElement = document.getElementById("accordion-image");
            imageElement.classList.add("opacity-0"); // Mulai dengan transparan
    
            setTimeout(() => {
                switch (accordionNumber) {
                    case 1:
                        imageElement.src = "https://images.pexels.com/photos/12662857/pexels-photo-12662857.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2";
                        break;
                    case 2:
                        imageElement.src = "https://images.pexels.com/photos/7988747/pexels-photo-7988747.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2";
                        break;
                    case 3:
                        imageElement.src = "https://images.pexels.com/photos/10223855/pexels-photo-10223855.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2";
                        break;
                    case 4:
                        imageElement.src = "https://images.pexels.com/photos/1181671/pexels-photo-1181671.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2";
                        break;
                }
    
                // Menambahkan transparansi kembali
                setTimeout(() => {
                    imageElement.classList.remove("opacity-0");
                }, 100);
            }, 500); // Menunggu transisi selesai sebelum mengganti gambar
        }
    </script>
    
    
    

{{-- untuk learning path --}}
    <section class="bg-white bg-gradient-to-br from-sky-100 via-white to-white">
        <div class="py-8 px-4  max-w-screen-xl text-center lg:py-16">
            <h1 class="mb-4 text-4xl font-mono font-bold tracking-tight leading-none text-gray-800 md:text-5xl lg:text-3xl">Learning Path</h1>
            <p class="mb-8 text-lg font-normal text-gray-600 lg:text-xl sm:px-16 lg:px-48">
            Explore Codemy's Learning Path! A structured curriculum designed to sharpen your skills, from beginner to expert. Choose the learning path that fits your career goals and achieve success with us.
        </p>

        </div>

        <div class="swiper-container relative">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="mx-auto max-w-[380px] h-auto object-contain rounded-sm transition-opacity duration-300 opacity-75 hover:opacity-100" 
                        src="{{ asset('/images/bp.png') }}" alt="Image 1">
                </div>
                <div class="swiper-slide">
                    <img class="mx-auto max-w-[380px] h-auto object-contain rounded-sm transition-opacity duration-300 opacity-75 hover:opacity-100" 
                        src="{{ asset('/images/web.png') }}" alt="Image 2">
                </div>
                <div class="swiper-slide">
                    <img class="mx-auto max-w-[380px] h-auto object-contain rounded-sm transition-opacity duration-300 opacity-75 hover:opacity-100" 
                        src="{{ asset('/images/pds.png') }}" alt="Image 3">
                </div>
                <div class="swiper-slide">
                    <img class="mx-auto max-w-[380px] h-auto object-contain rounded-sm transition-opacity duration-300 opacity-75 hover:opacity-100" 
                        src="{{ asset('/images/mobile.png') }}" alt="Image 4">
                </div>
                <div class="swiper-slide">
                    <img class="mx-auto max-w-[380px] h-auto object-contain rounded-sm transition-opacity duration-300 opacity-75 hover:opacity-100" 
                        src="{{ asset('/images/dbms.png') }}" alt="Image 4">
                </div>
            </div>
        
            <!-- Tombol Navigasi -->
            <div class="swiper-button-next absolute top-1/2 right-4 transform -translate-y-1/2 text-white p-2 rounded-full z-10 hover:bg-opacity-80"></div>
            <div class="swiper-button-prev absolute top-1/2 left-4 transform -translate-y-1/2 text-white p-2 rounded-full z-10 hover:bg-opacity-80"></div>
        </div>
    </section>

{{-- untuk top course --}}
    <section class="bg-white p-14 pt-8 mt-12 bg-gradient-to-tl from-sky-100 via-white to-white">
        <div class="container mx-auto max-w-screen-xl grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kolom Teks -->
            <div class="text-center md:text-left flex flex-col justify-center">
                <h2 class="text-3xl font-mono font-bold text-gray-800 mb-4">Belajar dengan kelas standar industri global</h2>
                <p class="text-lg text-gray-600">
                    Kelas di Dicoding Academy tersedia bagi yang belum memiliki kemampuan programming (dasar) hingga yang sudah profesional.
                </p>
                <a href="{{ route('class') }}" class="flex items-center space-x-2 text-gray-600 transform transition-transform duration-200 hover:scale-105">
                    <span>Lihat Semua Kelas</span>
                    <div class="bg-sky-950 text-white p-1 rounded-full">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
                        </svg>
                    </div>
                </a>
            </div>
    
            <!-- Kolom Card Carousel -->
            <div class="relative overflow-hidden">
                <div class="swiper-container-course">
                    <div class="swiper-wrapper">
                        @foreach ($courses as $course)
                        <div class="swiper-slide">
                            <div class="course-item bg-white shadow-md rounded-lg overflow-hidden flex flex-col justify-between w-[280px] mx-4 transform hover:scale-105 transition-transform">
                                <!-- Course Image -->
                                <img src="{{ Storage::url($course->course_picture) }}" 
                                     alt="{{ $course->name }}" 
                                     class="w-full h-[150px] object-cover">
                                
                                <!-- Course Details -->
                                <div class="p-3 flex flex-col justify-between h-full">
                                    <h3 class="text-base font-semibold text-gray-800 mb-2">{{ \Illuminate\Support\Str::limit($course->name, 30, '...') }}</h3>
                                    <p class="text-xs text-gray-600 mb-2">Category: <span class="font-medium">{{ $course->category->name }}</span></p>
                                    <p class="text-xs text-gray-600 mb-2">Teacher: <span class="font-medium">{{ $course->teacher->name }}</span></p>
                                    <p class="text-xs text-gray-500 mb-2">{{ \Illuminate\Support\Str::limit($course->description, 50, '...') }}</p>
                                    <p class="text-xs text-gray-600 mb-2">Participants: <span class="font-medium">{{ $course->participants_count }}</span></p>
                                    <p class="text-xs text-gray-600 mb-2">End Date: <span class="font-medium">{{ \Carbon\Carbon::parse($course->end_date)->format('d M Y') }}</span></p>
                                    <a href="{{ route('contents.index', ['course' => $course->id]) }}" class="mt-auto bg-sky-950 text-white text-center text-xs px-3 py-2 rounded-md hover:bg-sky-800 transition">View Course</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    
  {{-- testimoni  --}}
    <div class="px-11 bg-gradient-to-bl from-sky-100 via-white to-white">
        <h1 class="mb-4 text-4xl font-mono font-bold tracking-tight leading-none text-gray-800 md:text-5xl lg:text-3xl">Student Testimony</h1>

        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                
                <!-- Testimonial 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="bg-white flex flex-col md:flex-row items-center justify-between gap-6">
                        <!-- Text Column -->
                        <div class="flex-1 px-10">
                            <blockquote class="mt-2 text-gray-600">
                                "Saya sangat puas dengan e-course Codemy! Kursus ini sangat cocok untuk pemula seperti saya. Materinya mudah dipahami, dan setiap langkah dijelaskan dengan sangat jelas. Saya bisa mengikuti dengan lancar meskipun tidak memiliki latar belakang teknis."
                            </blockquote>
                            <hr class="my-4">
                            <p class="text-gray-600">Sittie Jennie Aulia</p>
                            <p class="text-gray-600">Mahasiswa Pendidikan Dokter Umum - <b>Universitas Udayana</b></p>
                        </div>

                        <!-- Image Column -->
                        <img src="{{asset('/images/t1.png')}}" alt="Student Photo" class="max-w-96 h-auto object-cover rounded-lg">
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="bg-white flex flex-col md:flex-row items-center justify-between gap-6">
                        <!-- Text Column -->
                        <div class="flex-1 px-10">
                            <blockquote class="mt-2 text-gray-600">
                                "Codemy memberikan saya lebih banyak wawasan tentang coding yang tidak saya dapatkan di tempat lain. Kursus ini memadukan teori dengan praktek yang sangat bermanfaat. Saya merasa lebih percaya diri dalam mengembangkan proyek saya sendiri setelah mengikuti kursus ini."
                            </blockquote>
                            <hr class="my-4">
                            <p class="text-gray-600">Kento Ridwan</p>
                            <p class="text-gray-600">Software Engineer - <b>Gojek</b></p>
                        </div>

                        <!-- Image Column -->
                        <img src="{{asset('/images/t2.png')}}" alt="Student Photo" class="max-w-96 h-auto object-cover rounded-lg">
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="bg-white flex flex-col md:flex-row items-center justify-between gap-6">
                        <!-- Text Column -->
                        <div class="flex-1 px-10">
                            <blockquote class="mt-2 text-gray-600">
                                "Sebagai seorang developer yang sudah berpengalaman, saya mencari kursus yang bisa mengajarkan konsep-konsep tingkat lanjut, dan Codemy berhasil memenuhi itu semua. Materinya sangat mendalam dan aplikatif, saya banyak belajar teknik baru yang saya terapkan dalam pekerjaan saya."
                            </blockquote>
                            <hr class="my-4">
                            <p class="text-gray-600">Kadri Murphy</p>
                            <p class="text-gray-600">Data Scientist - <b>BRI</b></p>
                        </div>

                        <!-- Image Column -->
                        <img src="{{asset('/images/t3.png')}}" alt="Student Photo" class="max-w-96 h-auto object-cover rounded-lg">
                    </div>
                </div>
                
                <!-- Testimonial 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <div class="bg-white flex flex-col md:flex-row items-center justify-between gap-6">
                        <!-- Text Column -->
                        <div class="flex-1 px-10">
                            <blockquote class="mt-2 text-gray-600">
                                "Kursus Codemy memungkinkan saya untuk belajar coding di waktu luang saya. Materinya bisa diakses kapan saja, dan saya bisa belajar sesuai kecepatan saya sendiri. Hal ini sangat membantu saya yang bekerja sambil belajar."
                            </blockquote>
                            <hr class="my-4">
                            <p class="text-gray-600">Lily Sari</p>
                            <p class="text-gray-600">Marketing - <b>Galesong Group</b></p>
                        </div>

                        <!-- Image Column -->
                        <img src="{{asset('/images/t4.png')}}" alt="Student Photo" class="max-w-96 h-auto object-cover rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Carousel controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>

            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </div>


    
    
    
    
    
    
    
    
    
    
    


    
</div>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper-container', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        slidesPerView: 1, // Gambar per baris pada perangkat kecil
        spaceBetween: 5, // Jarak antar gambar diperkecil
        loop: true, // Agar slider looping

        breakpoints: {
            640: {
                slidesPerView: 2, // 2 gambar per baris untuk perangkat menengah
                spaceBetween: 10, // Jarak antar gambar menengah
            },
            1024: {
                slidesPerView: 3, // 3 gambar per baris untuk perangkat besar
                spaceBetween: 15, // Jarak antar gambar besar
            },
        },
        autoplay: {
            delay: 3000,  // Matikan autoplay jika manual scroll/swipe diaktifkan
            disableOnInteraction: false,
        },
        speed:500,
    });

</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi Swiper
    const swiper2 = new Swiper('.swiper-container-course', {
        loop: true,
        spaceBetween: 20,
        slidesPerView: 2,
        freeMode: true,
        autoplay: {
            delay: 3000,  // Matikan autoplay jika manual scroll/swipe diaktifkan
            disableOnInteraction: false,
        },
        speed:500,
    });
    
    // Kontrol Manual untuk Animasi Scroll
    const wrapper = document.querySelector('.courses-wrapper-vertical');
    let position = 0;

    function moveCarousel() {
        position -= 0.05;  // Menurunkan kecepatan, makin kecil angka makin lambat
        wrapper.style.transform = `translateX(${position}%)`;

        if (position <= -800) {  // Reset posisi setelah mencapai batas
            position = 0;
        }

        requestAnimationFrame(moveCarousel); // Menggunakan requestAnimationFrame untuk animasi yang lebih halus
    }

    moveCarousel();  // Mulai pergerakan
});



</script>

<style>
/* Styling untuk Swiper Container */
.swiper-container {
    overflow: hidden; /* Mencegah scroll horizontal */
}
/* Styling untuk Swiper Container */
.swiper-container-course {
    overflow: hidden; /* Mencegah scroll horizontal */
}

/* Animasi untuk membuat card bergerak secara horizontal */
@keyframes scroll-carousel {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-800%);  /* Menambah jarak pergeseran yang lebih panjang */
    }
}

.courses-wrapper-vertical {
    display: flex;
    flex-direction: row;
    overflow-x: auto;
    scroll-snap-type: x mandatory;
    -webkit-overflow-scrolling: touch;
    gap: 20px;
    animation: scroll-carousel 600s linear infinite;  /* Durasi lebih panjang (600 detik) untuk memperlambat */
    animation-timing-function: ease-in-out;  /* Mengatur kecepatan animasi */
}

/* Menghentikan animasi saat hover pada kontainer */
.courses-wrapper-vertical:hover {
    animation-play-state: paused;  /* Hentikan animasi saat hover */
}

/* Styling Scrollbar */
.courses-wrapper-vertical::-webkit-scrollbar {
    height: 8px;
}

.courses-wrapper-vertical::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 4px;
}

/* Animasi Hover untuk Memperbesar Card */
.course-item:hover {
    transform: scale(1.05);
    animation-play-state: paused;  /* Hentikan animasi saat hover pada kartu */
}

/* Styling gambar pada card */
.course-item img {
    border-bottom: 2px solid #f3f4f6; /* Garis pemisah antara gambar dan teks */
}


</style>

@endsection
