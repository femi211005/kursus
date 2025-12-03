<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Classes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <x-message :message="session('success')" type="success" />
        @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @php
                        $enrolledCourses = Auth::user()->enrolledCourses()->with('contents')->get();
                    @endphp

                    @if($enrolledCourses->isEmpty())
                        <p class="text-gray-600 text-lg">You have not enrolled in any courses yet.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($enrolledCourses as $course)
                            <div class="bg-white border border-gray-200 rounded-lg shadow p-4">
                                <h3 class="font-bold text-lg mb-2"><a href="{{ route('contents.index', ['course' => $course->id])}}">{{ $course->name }}</a></h3>
                                <p class="text-gray-700 mb-4">{{ $course->description }}</p>
                                
                                @php
                                    // Calculate the progress percentage
                                    $totalContents = $course->contents->count();
                                    $completedContents = $course->contents->filter(function($content) {
                                        return Auth::user()->contentProgress()->where('content_id', $content->id)->first()?->is_completed;
                                    })->count();

                                    $progressPercentage = $totalContents > 0 ? ($completedContents / $totalContents) * 100 : 0;
                                @endphp

                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <strong>Progress: </strong>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="h-2.5 rounded-full bg-sky-500" style="width: {{ max(0, min(100, round($progressPercentage, 2))) }}%"></div>
                                    </div>
                                    <div class="text-sm text-sky-500 mt-1">{{ round($progressPercentage, 2) }}%</div>
                                </div>

                                <h4 class="font-semibold text-md mb-2">Contents:</h4>
                                <ul class="list-disc list-inside">
                                    @foreach($course->contents as $index => $content)
                                        @php
                                            $progress = Auth::user()->contentProgress()->where('content_id', $content->id)->first();
                                            $previousContent = $index > 0 ? $course->contents[$index - 1] : null;
                                            $previousContentCompleted = $previousContent ? Auth::user()->contentProgress()->where('content_id', $previousContent->id)->first()?->is_completed : true;
                                        @endphp
                                        <li class="flex items-center mb-2">
                                            @if($previousContent && !$previousContentCompleted)
                                                <span class="text-gray-500 cursor-not-allowed">
                                                    Complete "{{ $previousContent->title }}" to access "{{ $content->title }}"
                                                </span>
                                            @else
                                                <input type="checkbox" class="mr-2"
                                                    @if($progress && $progress->is_completed) checked @endif
                                                    disabled>
                                                <a href="{{ route('content.show', $content->id) }}" 
                                                   class="text-blue-500 hover:underline">
                                                    {{ $content->title }}
                                                </a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- Button Get Certificate -->
                                @if(round($progressPercentage, 2) == 100)
                                    <form action="{{ route('certificate.generate', ['courseId' => $course->id]) }}" method="GET" class="mt-4">
                                        <button type="submit" class="bg-sky-950 hover:bg-sky-800 text-white font-bold py-2 px-4 rounded">
                                            Get Certificate
                                        </button>
                                    </form>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
