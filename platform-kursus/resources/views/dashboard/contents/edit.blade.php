<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Content
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form id="form" method="POST" action="{{ route(Auth::user()->role.'.contents.update', $content->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            class="w-full p-3 border rounded" 
                            value="{{ old('title', $content->title) }}" 
                            required>
                        @error('title')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                        <select 
                            id="course_id" 
                            name="course_id" 
                            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-200 focus:border-indigo-300" 
                            required>
                            <option value="" disabled>Select a course</option>
                            @foreach($courses as $course)
                                <option 
                                    value="{{ $course->id }}" 
                                    {{ old('course_id', $content->course_id) == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="video_url" class="block text-gray-700 font-bold mb-2">Video URL</label>
                        <input 
                            type="url" 
                            name="video_url" 
                            id="video_url" 
                            class="w-full p-3 border rounded" 
                            value="{{ old('video_url', $content->video_url) }}">
                        @error('video_url')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="body" class="block text-gray-700 font-bold mb-2">Body</label>
                        <textarea 
                            id="description" 
                            name="body" 
                            class="w-full p-3 border rounded" 
                            rows="5" 
                            required>{{ old('body', $content->body) }}</textarea>
                        @error('body')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button 
                            id="submitBtn" 
                            type="submit" 
                            class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-sky-950 rounded-full border border-gray-200 hover:bg-gray-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100">
                            Update Content
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
    <script>
    
        document.querySelector('#submitBtn').addEventListener('click', function(e) {
            // Ambil konten TinyMCE sebagai teks biasa
            let plainTextContent = tinymce.get('description').getContent({ format: 'text' });

            // Update nilai textarea dengan teks biasa
            document.getElementById('description').value = plainTextContent;

            // Trigger save agar konten TinyMCE disalin ke textarea
            tinymce.triggerSave();

            // Submit form secara eksplisit
            document.querySelector('form').submit();
        });
    </script>
</x-app-layout>
