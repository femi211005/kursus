@extends('layouts.master')

@section('container')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8" style="background-color: #FCF8F8;">
        
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Available Courses</h1>
                <p class="text-gray-500">Explore and grow your skills with our curated courses.</p>
            </div>
            
            <form method="GET" action="{{ route('class') }}" class="mb-10 max-w-4xl mx-auto">
                <div class="flex flex-col md:flex-row items-center gap-4 bg-white p-2 rounded-2xl shadow-sm border" style="border-color: #F9DFDF;">
                    
                    <div class="relative w-full flex-grow">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search courses..." 
                            class="block w-full pl-10 p-3 text-sm text-gray-900 border-none rounded-xl focus:ring-2 focus:ring-[#F5AFAF] bg-transparent"
                        >
                    </div>
                    
                    <div class="w-full md:w-1/3 border-l" style="border-color: #FBEFEF;">
                        <select 
                            name="category" 
                            class="block w-full p-3 text-sm text-gray-600 border-none rounded-xl focus:ring-2 focus:ring-[#F5AFAF] bg-transparent cursor-pointer"
                        >
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full md:w-auto px-8 py-3 text-sm font-bold text-white rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg"
                        style="background-color: #F5AFAF;">
                        Search
                    </button>
                </div>
            </form>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @forelse($courses as $course)
                    <a href="{{ route('contents.index', ['course' => $course->id]) }}" 
                       class="group flex flex-col md:flex-row bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border transform hover:-translate-y-1"
                       style="border-color: #F9DFDF;">
                        
                        <div class="w-full md:w-2/5 h-48 md:h-auto relative overflow-hidden">
                            <img 
                                src="{{ Storage::url($course->course_picture) }}" 
                                alt="{{ $course->name }}" 
                                class="w-full h-full object-cover transition duration-500 group-hover:scale-110" 
                            />
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition duration-300"></div>
                        </div>

                        <div class="w-full md:w-3/5 flex flex-col justify-between p-6">
                            <div>
                                <div class="flex justify-between items-start mb-2">
                                    <span class="px-3 py-1 text-xs font-bold text-gray-600 rounded-full" style="background-color: #FBEFEF;">
                                        {{ $course->category->name ?? 'General' }}
                                    </span>
                                    <span class="text-xs text-gray-400 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $course->created_at->format('d M Y') }}
                                    </span>
                                </div>

                                <h5 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-[#F5AFAF] transition-colors">
                                    {{ $course->name }}
                                </h5>
                                
                                <p class="text-sm text-gray-500 line-clamp-2 mb-4">
                                    {!! Str::limit(strip_tags($course->description), 120) !!}
                                </p>
                            </div>

                            <div class="mt-4 pt-4 border-t flex items-center justify-between" style="border-color: #FCF8F8;">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2 text-[#F5AFAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ optional($course->teacher)->name ?? 'Unknown' }}
                                </div>
                                
                                <div class="flex items-center gap-4 text-xs text-gray-400">
                                    <span class="flex items-center" title="Contents">
                                        <svg class="w-4 h-4 mr-1 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        {{ $course->contents_count ?? 0 }}
                                    </span>
                                    <span class="flex items-center" title="Participants">
                                        <svg class="w-4 h-4 mr-1 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        {{ $course->participants_count ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 text-center">
                        <div class="bg-white p-6 rounded-full inline-block shadow-sm mb-4" style="background-color: #FBEFEF;">
                            <svg class="w-12 h-12 text-[#F5AFAF]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">No courses available</h3>
                        <p class="text-gray-500 mt-1">Try adjusting your search or check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection