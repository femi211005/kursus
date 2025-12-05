<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Content
        </h2>
    </x-slot>

    <div class="py-12" style="background-color:#FCF8F8;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="shadow-md rounded-lg p-6"
                 style="background-color:#FBEFEF; border:1px solid #F9DFDF;">

                <form id="form" method="POST" action="{{ route(Auth::user()->role.'.contents.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">

                        <!-- Title -->
                        <div>
                            <label class="block text-gray-800 font-semibold mb-2">Title</label>
                            <input
                                id="title"
                                name="title"
                                type="text"
                                value="{{ old('title') }}"
                                required
                                class="w-full p-3 rounded shadow-sm focus:ring-2 focus:ring-[#F5AFAF]"
                                style="border:1px solid #F9DFDF; background-color:#FCF8F8;"
                            />
                            @error('title')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Course -->
                        <div>
                            <label class="block text-gray-800 font-semibold mb-2">Course</label>
                            <select
                                id="course_id"
                                name="course_id"
                                class="w-full p-3 rounded shadow-sm focus:ring-2 focus:ring-[#F5AFAF]"
                                style="border:1px solid #F9DFDF; background-color:#FCF8F8;"
                            >
                                <option value="" disabled selected>Select a course</option>

                                @foreach($courses as $course)
                                    @if (Auth::user()->role == 'admin' || Auth::id() == $course->teacher_id)
                                        <option
                                            value="{{ $course->id }}"
                                            {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endif
                                @endforeach

                            </select>

                            @error('course_id')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Video URL -->
                        <div>
                            <label class="block text-gray-800 font-semibold mb-2">Video URL</label>
                            <input
                                id="video_url"
                                name="video_url"
                                type="url"
                                value="{{ old('video_url') }}"
                                required
                                class="w-full p-3 rounded shadow-sm focus:ring-2 focus:ring-[#F5AFAF]"
                                style="border:1px solid #F9DFDF; background-color:#FCF8F8;"
                            />
                            @error('video_url')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Body -->
                        <div>
                            <label class="block text-gray-800 font-semibold mb-2">Body</label>
                            <textarea
                                id="description"
                                name="body"
                                class="w-full p-3 rounded shadow-sm focus:ring-2 focus:ring-[#F5AFAF]"
                                style="border:1px solid #F9DFDF; background-color:#FCF8F8;"
                                required>{{ old('body') }}</textarea>

                            @error('body')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-4">
                        <button
                            id="submitBtn"
                            type="submit"
                            class="py-2.5 px-5 text-sm font-medium text-white rounded-full transition"
                            style="background-color:#F5AFAF; border:1px solid #F9DFDF;"
                            onmouseover="this.style.backgroundColor='#F9DFDF'"
                            onmouseout="this.style.backgroundColor='#F5AFAF'">
                            Create Content
                        </button>
                    </div>

                </form>

                <!-- Back Button -->
                <a
                    href="{{ route(Auth::user()->role.'.contents.index') }}"
                    class="py-2.5 px-5 inline-block mt-4 text-sm font-medium text-white rounded-full transition"
                    style="background-color:#F5AFAF; border:1px solid #F9DFDF;"
                    onmouseover="this.style.backgroundColor='#F9DFDF'"
                    onmouseout="this.style.backgroundColor='#F5AFAF'">

                    <svg class="w-6 h-6 text-white inline-block mr-2"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m15 19-7-7 7-7"/>
                    </svg>

                    Back
                </a>

            </div>
        </div>
    </div>

    <!-- TinyMCE handler -->
    <script>
        document.querySelector('#submitBtn').addEventListener('click', function() {
            let text = tinymce.get('description').getContent({ format: 'text' });
            document.getElementById('description').value = text;
            tinymce.triggerSave();
            document.querySelector('form').submit();
        });
    </script>

</x-app-layout>
