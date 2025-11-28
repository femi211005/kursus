<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-2">Welcome to Platform Kursus</h1>
                    <p class="text-gray-600">Discover thousands of courses and start learning today!</p>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <form method="GET" action="{{ route('courses.catalog') }}" class="flex gap-4">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search courses..." 
                            value="{{ request('search') }}"
                            class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                        <select 
                            name="category" 
                            class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                            Search
                        </button>
                    </form>
                </div>
            </div>

            <!-- Popular Courses -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Popular Courses</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($popularCourses as $course)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded mb-2">
                                    {{ $course->category->name ?? 'Uncategorized' }}
                                </span>
                                <h3 class="text-xl font-semibold mb-2">{{ $course->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span>By {{ $course->teacher->name }}</span>
                                    <span>{{ $course->students_count }} students</span>
                                </div>
                                <a href="{{ route('courses.show', $course) }}" class="block text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                    View Course
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-3 text-center text-gray-500">No courses available yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- All Courses -->
            <div>
                <h2 class="text-2xl font-bold mb-4">All Courses</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($courses as $course)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <span class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded mb-2">
                                    {{ $course->category->name ?? 'Uncategorized' }}
                                </span>
                                <h3 class="text-xl font-semibold mb-2">{{ $course->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span>By {{ $course->teacher->name }}</span>
                                </div>
                                <a href="{{ route('courses.show', $course) }}" class="block text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                    View Course
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-3 text-center text-gray-500">No courses found.</p>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>