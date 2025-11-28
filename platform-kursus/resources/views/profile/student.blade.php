### FILE: resources/views/profile/student.blade.php
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
                            <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">Student</span>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Edit Profile</a>
                    </div>
                </div>
            </div>

            <!-- Enrolled Courses -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4">My Courses</h3>
                    
                    @if($enrolledCourses->count() > 0)
                        <div class="space-y-4">
                            @foreach($enrolledCourses as $course)
                                <div class="border rounded-lg p-4 hover:bg-gray-50">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-semibold text-lg">{{ $course->title }}</h4>
                                            <p class="text-sm text-gray-600">By {{ $course->teacher->name }}</p>
                                        </div>
                                        <a href="{{ route('courses.show', $course) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">
                                            Continue Learning
                                        </a>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="mt-4">
                                        <div class="flex justify-between text-sm text-gray-600 mb-1">
                                            <span>Progress</span>
                                            <span>{{ number_format($course->progress_percentage, 1) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $course->progress_percentage }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">You haven't enrolled in any courses yet.</p>
                            <a href="{{ route('courses.catalog') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                                Browse Courses
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>