<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Course') }}
        </h2>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form id="form" method="POST" action="{{ route(Auth::user()->role . '.courses.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Course Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Course Name') }}</label>
                            <input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm " type="text" name="name" value="{{ old('name') }}" required autofocus />
                            @error('name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">{{ __('Category') }}</label>
                            <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Teacher (Only for Admin) -->
                        @if (Auth::user()->role == 'admin')
                            <div>
                                <label for="teacher_id" class="block text-sm font-medium text-gray-700">{{ __('Teacher') }}</label>
                                <select id="teacher_id" name="teacher_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" required>
                                    <option value="" disabled selected>Select a teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">{{ __('Description') }}</label>
                            <textarea id="desc" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" name="description" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Created Date (Optional, default to current date) -->
                        <div>
                            <label for="created_date" class="block text-sm font-medium text-gray-700">{{ __('Created Date') }}</label>
                            <input id="created_date" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="date" name="created_date" value="{{ old('created_date', \Carbon\Carbon::now()->format('Y-m-d')) }}" disabled />
                            @error('created_date')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">{{ __('End Date') }}</label>
                            <input id="end_date" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="date" name="end_date" value="{{ old('end_date') }}" />
                            @error('end_date')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Course Picture -->
                        <div>
                            <label for="course_picture" class="block text-sm font-medium text-gray-700">{{ __('Course Picture') }}</label>
                            <input id="course_picture" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="file" name="course_picture" accept="image/*">
                            @error('course_picture')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button id="submitBtn" type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-sky-950 rounded-full border border-gray-200 hover:bg-gray-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100">
                            {{ __('Create') }}
                        </button>
                    </div>
                </form>
                <a href="{{ route(Auth::user()->role.'.contents.index') }}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-sky-950 rounded-full border border-gray-200 hover:bg-gray-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100">
                    <svg class="w-6 h-6 text-white inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                    </svg>                      
                    Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
