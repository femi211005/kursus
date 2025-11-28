<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <!-- Course Header -->
                    <div class="mb-6">
                        <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded mb-2">
                            {{ $course->category->name ?? 'Uncategorized' }}
                        </span>
                        <h1 class="text-3xl font-bold mb-2">{{ $course->title }}</h1>
                        <p class="text-gray-600 mb-4">{{ $course->description }}</p>
                        
                        <div class="flex items-center gap-6 text-sm text-gray-600">
                            <div>
                                <strong>Teacher:</strong> {{ $course->teacher->name }}
                            </div>
                            <div>
                                <strong>Duration:</strong> {{ $course->start_date->format('M d, Y') }} - {{ $course->end_date->format('M d, Y') }}
                            </div>
                            <div>
                                <strong>Students:</strong> {{ $course->students->count() }}
                            </div>
                        </div>
                    </div>

                    <!-- Enrollment Button -->
                    @auth
                        @if(auth()->user()->isStudent())
                            @if($isEnrolled)
                                <div class="mb-6">
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                        You are enrolled in this course! Progress: {{ number_format($progress, 1) }}%
                                    </div>
                                    <form method="POST" action="{{ route('courses.unenroll', $course) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-md hover:bg-red-700" onclick="return confirm('Are you sure you want to unenroll?')">
                                            Unenroll from Course
                                        </button>
                                    </form>
                                </div>
                            @else
                                <form method="POST" action="{{ route('courses.enroll', $course) }}" class="mb-6">
                                    @csrf
                                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                                        Enroll Now
                                    </button>
                                </form>
                            @endif
                        @endif
                    @else
                        <div class="mb-6">
                            <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700">
                                Login to Enroll
                            </a>
                        </div>
                    @endauth

                    <!-- Course Contents -->
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Course Contents</h2>
                        
                        @if($course->contents->count() > 0)
                            <div class="space-y-2">
                                @foreach($course->contents as $content)
                                    <div class="border rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="font-semibold">{{ $content->order_index }}. {{ $content->title }}</h3>
                                            </div>
                                            @if($isEnrolled)
                                                <a href="{{ route('lessons.show', [$course, $content]) }}" class="text-indigo-600 hover:text-indigo-800">
                                                    Start Learning →
                                                </a>
                                            @else
                                                <span class="text-gray-400">🔒 Locked</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No content available yet.</p>
                        @endif
                    </div>

                    <!-- Contact Teacher -->
                    <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold mb-2">Have questions?</h3>
                        <p class="text-gray-600 text-sm mb-2">Contact the teacher: {{ $course->teacher->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>