### FILE: resources/views/profile/teacher.blade.php
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Profile</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- User Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">{{ $user->name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            <span class="inline-block mt-2 px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full">Teacher</span>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Edit Profile</a>
                    </div>
                </div>
            </div>

            <!-- Teaching Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-600 mb-1">Total Courses</div>
                        <div class="text-3xl font-bold text-indigo-600">{{ $taughtCourses->count() }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-600 mb-1">Total Students</div>
                        <div class="text-3xl font-bold text-green-600">{{ $taughtCourses->sum('students_count') }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm text-gray-600 mb-1">Active Courses</div>
                        <div class="text-3xl font-bold text-blue-600">{{ $taughtCourses->where('is_active', true)->count() }}</div>
                    </div>
                </div>
            </div>

            <!-- My Courses -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold">My Courses</h3>
                        <a href="{{ route('teacher.courses.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Create New Course</a>
                    </div>
                    
                    @if($taughtCourses->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($taughtCourses as $course)
                                <div class="border rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-semibold">{{ $course->title }}</h4>
                                            <p class="text-sm text-gray-600">{{ $course->category->name ?? 'Uncategorized' }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded {{ $course->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm text-gray-600 mb-3">
                                        <span>{{ $course->students_count }} students</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('teacher.courses.show', $course) }}" class="flex-1 text-center bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700">View</a>
                                        <a href="{{ route('teacher.contents.index', $course) }}" class="flex-1 text-center bg-gray-600 text-white px-3 py-1 rounded text-sm hover:bg-gray-700">Contents</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">You haven't created any courses yet.</p>
                            <a href="{{ route('teacher.courses.create') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                                Create Your First Course
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
