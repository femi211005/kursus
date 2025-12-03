@extends('layouts.master')

@section('container')
    <div class="container mx-auto p-4 min-h-screen">
        <h1 class="text-center mb-6 text-3xl font-bold text-gray-800">Available Courses</h1>
        
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('class') }}" class="mb-6">
            <div class="flex items-center gap-4">
                <!-- Input Pencarian -->
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search courses..." 
                    class="w-full p-2 border border-gray-400 rounded-md">
                
                <!-- Dropdown Kategori -->
                <select 
                    name="category" 
                    class="p-2 border border-gray-400 rounded-md">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}" 
                                {{ request('category') == $cat->name ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                
                <!-- Tombol Submit -->
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-sky-950 text-white rounded-md hover:bg-sky-800">
                    Search
                </button>
            </div>
        </form>

        <!-- Daftar Courses -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @forelse($courses as $course)
                <a href="{{ route('contents.index', ['course' => $course->id]) }}" 
                   class="card flex flex-col h-auto bg-white border border-gray-400 rounded-md overflow-hidden shadow-md hover:shadow-lg transform transition-transform hover:scale-105 cursor-pointer">
                    
                    <!-- Baris 1: Gambar dan Informasi Course -->
                    <div class="flex bg-gray-100">
                        <img 
                            src="{{ Storage::url($course->course_picture) }}" 
                            alt="{{ $course->name }}" 
                            class="w-1/3 h-32 object-cover" />
                        <div class="p-4 flex-1">
                            <h5 class="text-lg font-semibold text-gray-800">{{ $course->name }}</h5>
                            <p class="text-gray-500 text-sm font-semibold">Teacher: {{ optional($course->teacher)->name ?? 'Unknown' }}</p>
                            <p class="text-gray-500 text-sm font-semibold">Created On: {{ $course->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Baris 2: Deskripsi Singkat -->
                    <div class="p-4">
                        <p class="text-gray-600 text-sm">{!! Str::limit($course->description, 150) !!}</p>
                    </div>

                    <!-- Baris 3: Jumlah Content dan Participant -->
                    <div class="p-4 bg-gray-100 flex justify-between items-center mt-auto">
                        <p class="text-gray-600 text-sm">Contents: {{ $course->contents_count ?? 0 }}</p>
                        <p class="text-gray-600 text-sm">Participants: {{ $course->participants_count ?? 0 }}</p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center">
                    <p class="text-gray-600">No courses available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
