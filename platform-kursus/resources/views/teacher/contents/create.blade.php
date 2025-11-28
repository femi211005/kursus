### FILE: resources/views/teacher/contents/create.blade.php
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Content - {{ $course->title }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('teacher.contents.store', $course) }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Lesson Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Order</label>
                            <input type="number" name="order_index" value="{{ old('order_index', $maxOrder + 1) }}" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('order_index')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" rows="12" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('content') }}</textarea>
                            <p class="mt-1 text-sm text-gray-500">You can use HTML formatting</p>
                            @error('content')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('teacher.contents.index', $course) }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">Create Content</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>