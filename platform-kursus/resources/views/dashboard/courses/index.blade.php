<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Courses') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen" style="background-color: #FCF8F8;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg border text-green-700 bg-green-50 border-green-200 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
                
                <div class="inline-flex bg-white rounded-full p-1 shadow-sm border" style="border-color: #F9DFDF;">
                    @php
                        $currentStatus = request('status', 'all');
                        $activeClass = 'text-white shadow-md';
                        $activeStyle = 'background-color: #F5AFAF;';
                        $inactiveClass = 'text-gray-600 hover:bg-[#FBEFEF]';
                    @endphp

                    <a href="{{ route(Auth::user()->role . '.courses.index', ['status' => 'all']) }}"
                       class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $currentStatus == 'all' ? $activeClass : $inactiveClass }}"
                       style="{{ $currentStatus == 'all' ? $activeStyle : '' }}">
                        All
                    </a>
                    <a href="{{ route(Auth::user()->role . '.courses.index', ['status' => 'ongoing']) }}"
                       class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $currentStatus == 'ongoing' ? $activeClass : $inactiveClass }}"
                       style="{{ $currentStatus == 'ongoing' ? $activeStyle : '' }}">
                        On-Going
                    </a>
                    <a href="{{ route(Auth::user()->role . '.courses.index', ['status' => 'expired']) }}"
                       class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $currentStatus == 'expired' ? $activeClass : $inactiveClass }}"
                       style="{{ $currentStatus == 'expired' ? $activeStyle : '' }}">
                        Expired
                    </a>
                </div>

                <a href="{{ route(Auth::user()->role . '.courses.create') }}"
                   class="inline-flex items-center px-6 py-2.5 text-sm font-bold text-white rounded-full shadow-md transform transition hover:-translate-y-0.5 hover:shadow-lg"
                   style="background-color: #F5AFAF;">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Course
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($courses as $course)
                <div class="bg-white border rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden flex flex-col h-full"
                     style="border-color: #F9DFDF;">
                    
                    <div class="relative h-48 overflow-hidden group">
                        <img src="{{ Storage::url($course->course_picture) }}" 
                             alt="{{ $course->name }}" 
                             class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-0 transition duration-300"></div>
                        
                        <span class="absolute top-4 left-4 px-3 py-1 text-xs font-bold text-gray-700 rounded-full shadow-sm backdrop-blur-sm bg-white/90">
                            {{ $course->category->name }}
                        </span>
                    </div>
                    
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 cursor-pointer transition-colors duration-200 hover:text-[#F5AFAF]" 
                            onclick="document.getElementById('showModal{{ $course->id }}').classList.remove('hidden')">
                            {{ $course->name }}
                        </h3>
                        
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2 flex-grow">
                            {{ Str::limit(strip_tags($course->description), 100) }}
                        </p>

                        <div class="mt-auto space-y-2 pt-4 border-t" style="border-color: #FBEFEF;">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-2 text-[#F5AFAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                {{ $course->teacher->name }}
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <span>Start: {{ $course->created_at->format('d M Y') }}</span>
                                <span>End: {{ \Carbon\Carbon::parse($course->end_date)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="px-6 py-4 flex justify-between items-center" style="background-color: #FCF8F8;">
                        <a href="{{ route(Auth::user()->role.'.courses.edit', $course->id) }}" 
                           class="text-sm font-medium text-gray-600 hover:text-[#F5AFAF] transition-colors flex items-center gap-1">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                           Edit
                        </a>
                        <button class="text-sm font-medium text-red-400 hover:text-red-600 transition-colors flex items-center gap-1" 
                                onclick="event.stopPropagation(); document.getElementById('deleteModal{{ $course->id }}').classList.remove('hidden')">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </div>
                </div>

                <div id="showModal{{ $course->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50" onclick="document.getElementById('showModal{{ $course->id }}').classList.add('hidden')"></div>
                    
                    <div class="bg-white rounded-2xl shadow-2xl p-0 w-full max-w-2xl relative z-10 overflow-hidden mx-4 flex flex-col max-h-[90vh]">
                        <div class="p-6 border-b flex justify-between items-start" style="background-color: #FCF8F8; border-color: #F9DFDF;">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">{{ $course->name }}</h2>
                                <span class="text-sm text-gray-500">{{ $course->category->name }} • By {{ $course->teacher->name }}</span>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600 transition" onclick="document.getElementById('showModal{{ $course->id }}').classList.add('hidden')">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <div class="p-6 overflow-y-auto">
                            <div class="mb-6">
                                <h4 class="text-sm font-bold text-gray-800 uppercase tracking-wide mb-2">Description</h4>
                                <div class="text-gray-600 prose text-sm">
                                    {!! $course->description !!}
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                                <div class="p-3 rounded-lg border" style="background-color: #FCF8F8; border-color: #FBEFEF;">
                                    <span class="block text-xs text-gray-400">Created Date</span>
                                    <span class="font-medium text-gray-700">{{ $course->created_at ? $course->created_at->format('d M Y') : 'N/A' }}</span>
                                </div>
                                <div class="p-3 rounded-lg border" style="background-color: #FCF8F8; border-color: #FBEFEF;">
                                    <span class="block text-xs text-gray-400">End Date</span>
                                    <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($course->end_date)->format('d M Y') }}</span>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-sm font-bold text-gray-800 uppercase tracking-wide mb-3 flex items-center justify-between">
                                    Participants 
                                    <span class="bg-[#FBEFEF] text-gray-600 px-2 py-0.5 rounded-full text-xs">{{ $course->participants->count() }}</span>
                                </h4>
                                
                                <div class="space-y-3 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                    @forelse($course->participants as $participant)
                                    <div class="flex items-center justify-between p-3 rounded-xl border hover:bg-[#FCF8F8] transition" style="border-color: #F9DFDF;">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden border-2 border-white shadow-sm">
                                                <img src="{{ Storage::url($participant->profile_picture) }}" alt="{{ $participant->name }}" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-800">{{ $participant->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $participant->email }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="text-right">
                                            @if(isset($participant->progressPercentage))
                                                <span class="block text-sm font-bold" style="color: #F5AFAF;">{{ number_format($participant->progressPercentage, 0) }}%</span>
                                                <div class="w-16 h-1.5 bg-gray-100 rounded-full mt-1 overflow-hidden">
                                                    <div class="h-full rounded-full" style="width: {{ $participant->progressPercentage }}%; background-color: #F5AFAF;"></div>
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-400">0%</span>
                                            @endif
                                        </div>
                                    </div>
                                    @empty
                                        <p class="text-sm text-gray-500 italic">No participants yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="deleteModal{{ $course->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                    <div class="absolute inset-0 bg-gray-900 opacity-50" onclick="document.getElementById('deleteModal{{ $course->id }}').classList.add('hidden')"></div>
                    
                    <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-sm text-center relative z-10 border" style="border-color: #F9DFDF;">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 mb-2">Delete Course?</h3>
                        <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete <strong>{{ $course->name }}</strong>? This cannot be undone.</p>

                        <form action="{{ route(Auth::user()->role.'.courses.destroy', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="flex justify-center space-x-3">
                                <button type="button" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium text-sm transition" onclick="document.getElementById('deleteModal{{ $course->id }}').classList.add('hidden')">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium text-sm shadow-md transition">
                                    Yes, Delete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @empty
                <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                    <div class="bg-white p-6 rounded-full shadow-sm mb-4" style="background-color: #FBEFEF;">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No Courses Found</h3>
                    <p class="text-gray-500 mt-1">Try adjusting your filters or add a new course.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>