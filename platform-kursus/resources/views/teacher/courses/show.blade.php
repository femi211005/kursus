### FILE: resources/views/teacher/courses/show.blade.php
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $course->title }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl font-bold mb-2">{{ $course->title }}</h1>
                            <p class="text-gray-600">{{ $course->description }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('teacher.courses.edit', $course) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Edit</a>
                            <a href="{{ route('teacher.contents.index', $course) }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Manage Contents</a>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-6">
                        <div class="bg-gray-50 p-4 rounded">
                            <div class="text-sm text-gray-600">Students</div>
                            <div class="text-2xl font-bold">{{ $course->students->count() }}</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <div class="text-sm text-gray-600">Contents</div>
                            <div class="text-2xl font-bold">{{ $course->contents->count() }}</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded">
                            <div class="text-sm text-gray-600">Status</div>
                            <div class="text-lg font-semibold {{ $course->is_active ? 'text-green-600' : 'text-red-600' }}">{{ $course->is_active ? 'Active' : 'Inactive' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-4">Enrolled Students</h2>
                    @if($course->students->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead><tr><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th><th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th></tr></thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($course->students as $student)
                                    <tr><td class="px-6 py-4">{{ $student->name }}</td><td class="px-6 py-4">{{ $student->email }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">No students enrolled yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>