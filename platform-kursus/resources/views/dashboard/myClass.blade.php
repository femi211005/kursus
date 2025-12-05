<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Classes') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen" style="background-color: #FCF8F8;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl border text-green-700 bg-green-50 border-green-200 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-transparent overflow-hidden">
                <div class="text-gray-900">
                    @php
                        $enrolledCourses = Auth::user()->enrolledCourses()->with('contents')->get();
                    @endphp

                    @if($enrolledCourses->isEmpty())
                        <div class="flex flex-col items-center justify-center py-20 text-center bg-white rounded-3xl border border-dashed" style="border-color: #F9DFDF;">
                            <div class="p-6 rounded-full bg-[#FBEFEF] mb-4">
                                <svg class="w-12 h-12 text-[#F5AFAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">No classes yet</h3>
                            <p class="text-gray-500 mt-2">You haven't enrolled in any courses. Check the dashboard to start learning!</p>
                            <a href="{{ route('student.home') }}" class="mt-6 px-6 py-2 rounded-full text-white font-bold shadow-md hover:shadow-lg transition transform hover:-translate-y-1" style="background-color: #F5AFAF;">Browse Courses</a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($enrolledCourses as $course)
                                <div class="bg-white border rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full overflow-hidden group"
                                     style="border-color: #F9DFDF;">
                                    
                                    <div class="p-6 pb-4 flex-grow">
                                        <h3 class="font-bold text-xl mb-2 text-gray-800 group-hover:text-[#F5AFAF] transition-colors">
                                            <a href="{{ route('contents.index', ['course' => $course->id])}}">
                                                {{ $course->name }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-500 text-sm mb-6 line-clamp-3 leading-relaxed">
                                            {{ $course->description }}
                                        </p>
                                        
                                        @php
                                            $totalContents = $course->contents->count();
                                            $completedContents = $course->contents->filter(function($content) {
                                                return Auth::user()->contentProgress()->where('content_id', $content->id)->first()?->is_completed;
                                            })->count();

                                            $progressPercentage = $totalContents > 0 ? ($completedContents / $totalContents) * 100 : 0;
                                        @endphp

                                        <div class="mb-6 bg-[#FCF8F8] p-4 rounded-xl border" style="border-color: #FBEFEF;">
                                            <div class="flex justify-between items-end mb-2">
                                                <strong class="text-xs uppercase tracking-wider text-gray-500">Progress</strong>
                                                <span class="text-sm font-bold" style="color: #F5AFAF;">{{ round($progressPercentage) }}%</span>
                                            </div>
                                            <div class="w-full rounded-full h-2.5" style="background-color: #FBEFEF;">
                                                <div class="h-2.5 rounded-full transition-all duration-1000 ease-out" 
                                                     style="width: {{ max(0, min(100, round($progressPercentage, 2))) }}%; background-color: #F5AFAF;">
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <h4 class="font-bold text-sm text-gray-800 uppercase tracking-wide mb-3 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-[#F5AFAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                                Course Content
                                            </h4>
                                            
                                            <ul class="space-y-3">
                                                @foreach($course->contents->take(3) as $index => $content)
                                                    @php
                                                        $progress = Auth::user()->contentProgress()->where('content_id', $content->id)->first();
                                                        $previousContent = $index > 0 ? $course->contents[$index - 1] : null;
                                                        $previousContentCompleted = $previousContent ? Auth::user()->contentProgress()->where('content_id', $previousContent->id)->first()?->is_completed : true;
                                                        $isCompleted = $progress && $progress->is_completed;
                                                    @endphp
                                                    
                                                    <li class="flex items-start text-sm">
                                                        <div class="flex-shrink-0 mt-0.5 mr-3">
                                                            @if($isCompleted)
                                                                <div class="w-5 h-5 rounded-full flex items-center justify-center text-white" style="background-color: #F5AFAF;">
                                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                                </div>
                                                            @elseif($previousContent && !$previousContentCompleted)
                                                                <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center">
                                                                    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                                </div>
                                                            @else
                                                                <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center" style="border-color: #F9DFDF;">
                                                                    <div class="w-2 h-2 rounded-full" style="background-color: #FBEFEF;"></div>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        @if($previousContent && !$previousContentCompleted)
                                                            <span class="text-gray-400 italic cursor-not-allowed">{{ $content->title }}</span>
                                                        @else
                                                            <a href="{{ route('content.show', $content->id) }}" 
                                                               class="text-gray-600 hover:text-[#F5AFAF] transition-colors font-medium">
                                                                {{ $content->title }}
                                                            </a>
                                                        @endif
                                                    </li>
                                                @endforeach
                                                
                                                @if($course->contents->count() > 3)
                                                    <li class="pl-8 text-xs text-gray-400 italic">
                                                        + {{ $course->contents->count() - 3 }} more lessons...
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="p-6 pt-0 mt-auto">
                                        @if(round($progressPercentage, 2) == 100)
                                            <form action="{{ route('certificate.generate', ['courseId' => $course->id]) }}" method="GET">
                                                <button type="submit" 
                                                        class="w-full flex items-center justify-center py-3 px-4 rounded-xl text-white font-bold shadow-md transition-all transform hover:-translate-y-1 hover:shadow-lg"
                                                        style="background-color: #F5AFAF;">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Get Certificate
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('contents.index', ['course' => $course->id])}}" 
                                               class="w-full flex items-center justify-center py-3 px-4 bg-white border-2 rounded-xl font-bold transition-colors hover:text-white group-hover:border-transparent"
                                               style="border-color: #F5AFAF; color: #F5AFAF;"
                                               onmouseover="this.style.backgroundColor='#F5AFAF'; this.style.color='white';"
                                               onmouseout="this.style.backgroundColor='white'; this.style.color='#F5AFAF';">
                                                Continue Learning
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>