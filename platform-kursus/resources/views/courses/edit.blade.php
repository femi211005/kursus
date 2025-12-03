<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="form" action="{{ route(Auth::user()->role.'.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Course Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $course->name) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required
                            >
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select 
                                id="category_id" 
                                name="category_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required
                            >
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id == $course->category_id) selected @endif>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea 
                                id="desc" 
                                name="description" 
                                rows="4" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                required
                            >{{ old('description', $course->description) }}</textarea>
                        </div>


                        <!-- Created Date (Non-editable) -->
                        <div>
                            <label for="created_date" class="block text-sm font-medium text-gray-700">{{ __('Created Date') }}</label>
                            <input id="created_date" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="date" name="created_date" 
                                value="{{ old('created_date', isset($course) ? $course->created_at->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d')) }}" disabled />
                            @error('created_date')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">{{ __('End Date') }}</label>
                            <input id="end_date" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="date" name="end_date" 
                                value="{{ old('end_date', isset($course) && $course->end_date ? \Carbon\Carbon::parse($course->end_date)->format('Y-m-d') : '') }}" />
                            @error('end_date')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Course Image -->
                        <div class="mb-4">
                            <label for="course_picture" class="block text-sm font-medium text-gray-700">Course Image</label>
                            <input 
                                type="file" 
                                id="course_picture" 
                                name="course_picture" 
                                accept="image/*" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            >
                            @if($course->course_picture && $course->course_picture !== 'course_pictures/defaultcourse.jpg')
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $course->course_picture) }}" alt="Current Course Image" class="w-32 h-32 object-cover">
                                </div>
                                <div class="mt-2">
                                    <label for="delete_photo" class="inline-flex items-center">
                                        <input type="checkbox" id="delete_photo" name="delete_photo" class="rounded text-blue-600" />
                                        <span class="ml-2 text-sm text-gray-600">Delete current photo</span>
                                    </label>
                                </div>
                            @endif
                        </div>

                        <!-- Save Button -->
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-sky-950 rounded-full border border-gray-200 hover:bg-gray-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100">
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </form>

                    <a href="{{ route(Auth::user()->role.'.courses.index') }}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-sky-950 rounded-full border border-gray-200 hover:bg-gray-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100">
                        <svg class="w-6 h-6 text-white inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                        </svg>                       
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
