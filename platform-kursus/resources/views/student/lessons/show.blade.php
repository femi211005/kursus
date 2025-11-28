<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Sidebar - Content List -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                        <div class="p-6">
                            <h3 class="font-bold mb-4">Course Contents</h3>
                            <div class="space-y-2">
                                @foreach($contents as $item)
                                    <a href="{{ route('lessons.show', [$course, $item]) }}" 
                                       class="block p-2 rounded {{ $item->id === $content->id ? 'bg-indigo-100 text-indigo-800' : 'hover:bg-gray-100' }}">
                                        <div class="flex items-center gap-2">
                                            @if($item->isCompletedBy(auth()->id()))
                                                <span class="text-green-600">✓</span>
                                            @else
                                                <span class="text-gray-400">○</span>
                                            @endif
                                            <span class="text-sm">{{ $item->order_index }}. {{ Str::limit($item->title, 25) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            
                            <!-- Progress Bar -->
                            <div class="mt-6">
                                <div class="text-sm text-gray-600 mb-2">Progress: {{ number_format($progressPercentage, 1) }}%</div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $progressPercentage }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <!-- Breadcrumb -->
                            <div class="mb-4 text-sm text-gray-600">
                                <a href="{{ route('courses.show', $course) }}" class="hover:text-indigo-600">{{ $course->title }}</a>
                                <span class="mx-2">›</span>
                                <span>{{ $content->title }}</span>
                            </div>

                            <!-- Lesson Title -->
                            <h1 class="text-3xl font-bold mb-6">{{ $content->title }}</h1>

                            @if(!$canAccess)
                                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                                    Please complete the previous lesson first before accessing this content.
                                </div>
                            @else
                                <!-- Lesson Content -->
                                <div class="prose max-w-none mb-8">
                                    {!! $content->content !!}
                                </div>

                                <!-- Mark as Completed Button -->
                                @if(!$isCompleted)
                                    <form method="POST" action="{{ route('lessons.complete', [$course, $content]) }}" class="mb-6">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700">
                                            Mark as Completed
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                                        ✓ You have completed this lesson
                                    </div>
                                @endif

                                <!-- Navigation Buttons -->
                                <div class="flex justify-between items-center pt-6 border-t">
                                    <div>
                                        @if($previousContent)
                                            <a href="{{ route('lessons.show', [$course, $previousContent]) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                                ← Previous
                                            </a>
                                        @endif
                                    </div>
                                    <div>
                                        @if($nextContent && $isCompleted)
                                            <a href="{{ route('lessons.show', [$course, $nextContent]) }}" 
                                               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                                Next →
                                            </a>
                                        @elseif($nextContent && !$isCompleted)
                                            <span class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-500 rounded-md cursor-not-allowed">
                                                Next → (Complete this lesson first)
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>