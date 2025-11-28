### FILE: resources/views/teacher/courses/index.blade.php
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Courses</h2>
            <a href="{{ route('teacher.courses.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Create New Course</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $course)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded mb-2">{{ $course->category->name ?? 'Uncategorized' }}</span>
                            <h3 class="text-xl font-semibold mb-2">{{ $course->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($course->description, 100) }}</p>
                            <div class="flex justify-between text-sm text-gray-500 mb-4">
                                <span>{{ $course->students_count }} students</span>
                                <span class="px-2 rounded {{ $course->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ $course->is_active ? 'Active' : 'Inactive' }}</span>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('teacher.courses.show', $course) }}" class="flex-1 text-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">View</a>
                                <a href="{{ route('teacher.contents.index', $course) }}" class="flex-1 text-center bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 text-sm">Contents</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-gray-500">No courses yet. Create your first course!</p>
                @endforelse
            </div>
            <div class="mt-6">{{ $courses->links() }}</div>
        </div>
    </div>
</x-app-layout>