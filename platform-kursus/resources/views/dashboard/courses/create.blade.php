<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Course') }}
        </h2>
    </x-slot>

    <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color:#FCF8F8;">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-6" style="background-color:#FBEFEF; border-bottom:1px solid #F9DFDF;">
                
                <form id="form" method="POST" action="{{ route(Auth::user()->role . '.courses.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">

                        <!-- Course Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="name">Course Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                   required autofocus
                                   class="block mt-1 w-full rounded-md shadow-sm"
                                   style="border:1px solid #F9DFDF; background-color:#FCF8F8;" />
                            @error('name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="category_id">Category</label>
                            <select id="category_id" name="category_id"
                                    class="block mt-1 w-full rounded-md shadow-sm"
                                    style="border:1px solid #F9DFDF; background-color:#FCF8F8;"
                                    required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Teacher (Admin Only) -->
                        @if (Auth::user()->role == 'admin')
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="teacher_id">Teacher</label>
                            <select id="teacher_id" name="teacher_id"
                                    class="block mt-1 w-full rounded-md shadow-sm"
                                    style="border:1px solid #F9DFDF; background-color:#FCF8F8;"
                                    required>
                                <option value="" disabled selected>Select a teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="description">Description</label>
                            <textarea id="desc" name="description" required
                                      class="block mt-1 w-full rounded-md shadow-sm"
                                      style="border:1px solid #F9DFDF; background-color:#FCF8F8;">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Created Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="created_date">Created Date</label>
                            <input id="created_date" type="date" name="created_date"
                                   value="{{ old('created_date', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                   disabled
                                   class="block mt-1 w-full rounded-md shadow-sm"
                                   style="border:1px solid #F9DFDF; background-color:#FCF8F8;" />
                        </div>

                        <!-- End Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="end_date">End Date</label>
                            <input id="end_date" type="date" name="end_date"
                                   value="{{ old('end_date') }}"
                                   class="block mt-1 w-full rounded-md shadow-sm"
                                   style="border:1px solid #F9DFDF; background-color:#FCF8F8;" />
                            @error('end_date')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Course Picture -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700" for="course_picture">Course Picture</label>
                            <input id="course_picture" type="file" name="course_picture" accept="image/*"
                                   class="block mt-1 w-full rounded-md shadow-sm"
                                   style="border:1px solid #F9DFDF; background-color:#FCF8F8;" />
                            @error('course_picture')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button id="submitBtn" type="submit"
                                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white rounded-full"
                                style="background-color:#F5AFAF; border:1px solid #F9DFDF;">
                            Create
                        </button>
                    </div>

                </form>

                <!-- Back Button -->
                <a href="{{ route(Auth::user()->role.'.contents.index') }}"
                   class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white rounded-full inline-flex items-center"
                   style="background-color:#F5AFAF; border:1px solid #F9DFDF;">
                    
                    <svg class="w-6 h-6 text-white inline-block mr-2"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m15 19-7-7 7-7"/>
                    </svg>

                    Back
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
