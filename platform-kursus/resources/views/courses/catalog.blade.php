<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold mb-2">Course Catalog</h1>
                <p class="text-gray-600">Browse all available courses</p>
            </div>

            <!-- Search and Filter -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <form method="GET" action="{{ route('courses.catalog') }}" class="flex flex-col md:flex-row gap-4">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search courses..." 
                            value="{{ request('search') }}"
                            class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                        <select 
                            name="category" 
                            class="md:w-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
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
                        @if(request('search') || request('category'))
                            <a href="{{ route('courses.catalog') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Results Count -->
            <div class="mb-4">
                <p class="text-gray-600">
                    Found {{ $courses->total() }} course(s)
                    @if(request('search'))
                        for "{{ request('search') }}"
                    @endif
                    @if(request('category'))
                        in {{ $categories->firstWhere('id', request('category'))->name ?? 'selected category' }}
                    @endif
                </p>
            </div>

            <!-- Course Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @forelse($courses as $course)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <div class="mb-3">
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">
                                    {{ $course->category->name ?? 'Uncategorized' }}
                                </span>
                            </div>
                            
                            <h3 class="text-xl font-semibold mb-2 line-clamp-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $course->description }}</p>
                            
                            <div class="border-t pt-4 mb-4">
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                        </svg>
                                        <span>{{ $course->teacher->name }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                        </svg>
                                        <span>{{ $course->students_count }} students</span>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="{{ route('courses.show', $course) }}" class="block text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                                View Details
                            </a>

                            @auth
                                @if(auth()->user()->isStudent() && $course->isEnrolledBy(auth()->id()))
                                    <div class="mt-2 text-center">
                                        <span class="text-sm text-green-600 font-medium">✓ Enrolled</span>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No courses found</h3>
                        <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                        <div class="mt-6">
                            <a href="{{ route('courses.catalog') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                View All Courses
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
</x-app-layout>