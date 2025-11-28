### FILE: resources/views/teacher/contents/index.blade.php
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Contents - {{ $course->title }}</h2>
            <a href="{{ route('teacher.contents.create', $course) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Add Content</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($contents as $content)
                        <div class="border rounded-lg p-4 mb-4 hover:bg-gray-50">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">{{ $content->order_index }}. {{ $content->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit(strip_tags($content->content), 150) }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('teacher.contents.edit', [$course, $content]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('teacher.contents.destroy', [$course, $content]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">No contents yet. Add your first lesson!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>