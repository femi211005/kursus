@extends('layouts.master')

@section('container')
    <!-- Header -->
    <div class="fixed top-0 left-0 w-full bg-sky-950 text-white py-2 z-50 shadow-lg">
        <div class="container mx-auto">
            <div class="flex items-center justify-between">
                <a href="{{ route(Auth::user()->role.'.myClass') }}" class="flex items-center text-gray-800 dark:text-white hover:underline">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                    </svg>
                    <span class="ml-2">Back to Course</span>
                </a>
                <h1 class="text-2xl font-bold text-center flex-grow">{{ $content->title }}</h1>
            </div>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container mx-auto py-8 mt-20 bg-white h-screen flex flex-col">
        <!-- Layout Dua Kolom -->
        <div class="flex flex-col lg:flex-row lg:space-x-8 flex-1 h-full">
            <!-- Kolom Kiri: Konten Utama -->
            <div class="flex-1 overflow-y-auto pr-0 lg:pr-4">
                <h2 class="text-3xl font-bold mb-4 text-sky-950">{{ $content->title }}</h2>
                
                <!-- Status Penyelesaian -->
                @if($progress && $progress->is_completed)
                    <p class="text-green-600 font-semibold mb-4">Konten ini telah selesai.</p>
                @endif

                <!-- Nama Kursus -->
                <p class="text-gray-600 text-lg mb-4">Bagian dari kursus: <span class="font-semibold">{{ $content->course->name }}</span></p>

                <!-- Video Jika Ada -->
                @if($content->video_url)
                    <div class="mb-6">
                        @if(Str::contains($content->video_url, 'youtube.com') || Str::contains($content->video_url, 'youtu.be'))
                            <iframe 
                                class="w-full h-64 lg:h-96 rounded-lg shadow-lg"
                                src="{{ Str::contains($content->video_url, 'watch?v=') ? str_replace('watch?v=', 'embed/', $content->video_url) : str_replace('youtu.be/', 'www.youtube.com/embed/', $content->video_url) }}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        @else
                            <video controls class="w-full h-64 lg:h-96 rounded-lg shadow-lg">
                                <source src="{{ $content->video_url }}" type="video/mp4">
                                Browser Anda tidak mendukung pemutar video.
                            </video>
                        @endif
                    </div>
                @endif

                <style>
                    .prose ol {
                        list-style-type: decimal;
                        margin-left: 1.5rem;
                    }
                
                    .prose ul {
                        list-style-type: disc;
                        margin-left: 1.5rem;
                    }
                
                    .prose li {
                        margin-bottom: 0.5rem;
                    }
                </style>

                <div class="prose max-w-none text-gray-700">
                    {!! $content->body !!}
                </div>

                <!-- Tombol Tandai Selesai -->
                <form action="{{ route('content.complete', $content->id) }}" method="POST" class="inline mt-6">
                    @csrf
                    <input type="hidden" name="is_completed" value="1">
                    <button class="bg-teal-600 text-white py-2 px-6 rounded-lg hover:bg-teal-700 transition duration-200 mb-11">
                        Mark as done
                    </button>
                </form>
            </div>

            <!-- Kolom Kanan: Daftar Konten -->
            <div class="w-full lg:w-1/3 mt-8 lg:mt-0">
                <h3 class="text-xl font-semibold mb-4 text-sky-950">List of Content</h3>
                <div class="space-y-4">
                    @foreach($courseContents as $contentItem)
                        @if($contentItem->is_accessible)
                            <!-- Tambahkan kondisi untuk menandai konten yang sedang diakses -->
                            <a href="{{ route('content.show', $contentItem->id) }}" 
                               class="block text-gray-700 hover:text-blue-500">
                                <div class="p-4 border rounded-lg shadow-sm transition duration-200 
                                            @if($contentItem->id === $content->id) bg-blue-100 border-blue-500 @else hover:bg-gray-100 @endif">
                                    <h4 class="text-lg font-medium text-sky-950">{{ $contentItem->title }}</h4>
                                    <p class="text-sm text-gray-500 mt-2">{!! Str::limit($contentItem->body, 100) !!}</p>
                                </div>
                            </a>
                        @else
                            <div class="block text-gray-500 cursor-not-allowed">
                                <div class="p-4 border rounded-lg shadow-sm bg-gray-200">
                                    <h4 class="text-lg font-medium">{{ $contentItem->title }}</h4>
                                    <p class="text-sm text-gray-500 mt-2">Selesaikan konten sebelumnya untuk mengakses ini.</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="fixed bottom-0 left-0 w-full bg-zinc-200 border-t-2 text-black py-1 z-50">
        <div class="container mx-auto flex justify-between items-center">
            @if($prevContent)
                <a href="{{ route('content.show', $prevContent->id) }}" 
                   class="text-gray-800 py-2 px-4 rounded-lg hover:bg-gray-300 transition duration-200 flex items-center space-x-2">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                    </svg>
                    <span><strong>Back</strong></span>
                </a>
            @else
                <span class="text-gray-400 py-2 px-4"></span>
            @endif

            @if($nextContent && $progress && $progress->is_completed)
                <a href="{{ route('content.show', $nextContent->id) }}" 
                   class="text-text-gray-800  py-2 px-4 rounded-lg text-gray-800 hover:bg-gray-300 transition duration-200 flex items-center space-x-2">
                    <span><strong>Continue</strong></span>
                    <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                    </svg>
                </a>
            @elseif($nextContent)
                <span class="text-gray-800 py-2 px-4">Finish this content to continue</span>
            @else
                <span class="text-gray-400 py-2 px-4"></span>
            @endif
        </div>
    </div>
@endsection
