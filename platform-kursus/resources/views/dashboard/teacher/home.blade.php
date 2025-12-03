@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-8">
        <!-- Hero / Intro -->
        <div class="bg-blue-600 text-white rounded-lg p-8 shadow">
            <h1 class="text-3xl font-bold mb-4">Selamat Datang di Platform Kursus Daring</h1>
            <p class="mb-4">
                Platform pembelajaran interaktif yang menghubungkan guru dan siswa
                dengan pengalaman belajar terstruktur dan mudah digunakan.
            </p>

            <h2 class="font-semibold mt-4 mb-2">4 Peran Pengguna</h2>
            <ul class="list-disc list-inside space-y-1 text-sm">
                <li>Admin: mengelola pengguna, course, dan konten.</li>
                <li>Teacher: membuat dan mengelola course serta materi.</li>
                <li>Student: mengikuti course dan memantau progress belajar.</li>
                <li>Public User (Guest): melihat daftar dan detail course.</li>
            </ul>
        </div>

        <!-- Login panel / CTA -->
        <div class="bg-white rounded-lg p-8 shadow">
            <h2 class="text-2xl font-semibold mb-4">Masuk ke Akun Anda</h2>
            <p class="text-sm text-gray-600 mb-4">
                Login sebagai Admin, Teacher, atau Student untuk mengakses dashboard.
            </p>

            <a href="/login"
               class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded mb-3">
                Masuk
            </a>

            <p class="text-xs text-gray-600">
                Belum punya akun? Silakan daftar sebagai Teacher atau Student pada halaman register.
            </p>
        </div>
    </div>
</div>

<!-- Section: 5 Course Terpopuler -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <h2 class="text-xl font-semibold mb-4">Course Terpopuler</h2>
    <div class="grid md:grid-cols-3 gap-4">
        @forelse($popularCourses as $course)
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="font-semibold text-lg mb-1">{{ $course->name }}</h3>
                <p class="text-sm text-gray-600 mb-2">
                    {{ Str::limit($course->description, 100) }}
                </p>
                <p class="text-xs text-gray-500 mb-2">
                    Teacher: {{ $course->teacher->name ?? '-' }}<br>
                    Kategori: {{ $course->category->name ?? '-' }}
                </p>
                <a href="{{ route('courses.show', $course) }}"
                   class="text-sm text-blue-600 hover:underline">
                    Lihat Detail
                </a>
            </div>
        @empty
            <p class="text-sm text-gray-600">Belum ada course populer.</p>
        @endforelse
    </div>
</section>

<!-- Section: Catalog + Search & Filter -->
<section id="catalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-10">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
        <h2 class="text-xl font-semibold mb-2 md:mb-0">Katalog Kursus</h2>

        <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari course..."
                   class="border rounded px-3 py-1 text-sm w-full md:w-64">
            <select name="category_id" class="border rounded px-3 py-1 text-sm w-full md:w-48">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="bg-blue-600 text-white text-sm font-semibold px-4 py-1 rounded">
                Filter
            </button>
        </form>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        @foreach($courses as $course)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between">
                <div>
                    <h3 class="font-semibold text-lg mb-1">{{ $course->name }}</h3>
                    <p class="text-sm text-gray-600 mb-2">
                        {{ Str::limit($course->description, 120) }}
                    </p>
                    <p class="text-xs text-gray-500 mb-1">
                        Teacher: {{ $course->teacher->name ?? '-' }}
                    </p>
                    <p class="text-xs text-gray-500 mb-2">
                        Kategori: {{ $course->category->name ?? '-' }}
                    </p>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <a href="{{ route('courses.show', $course) }}"
                       class="text-sm text-blue-600 hover:underline">
                        Lihat Detail
                    </a>
                    <a href="/login"
                       class="text-xs bg-green-500 text-white px-3 py-1 rounded">
                        Ikuti Course
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $courses->withQueryString()->links() }}
    </div>
</section>
@endsection
