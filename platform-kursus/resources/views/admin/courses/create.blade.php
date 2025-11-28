### FILE: resources/views/admin/courses/create.blade.php
<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Course</h2></x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.courses.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                            @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Teacher</label>
                            <select name="teacher_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('start_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" name="end_date" value="{{ old('end_date') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                @error('end_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>