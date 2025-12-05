@extends('layouts.master')

@section('container')
<div class="relative bg-cover bg-center sm:h-96 md:h-[500px] lg:h-96" 
style="background-image: url('{{ Storage::url($course->course_picture) }}');">
<div class="absolute inset-0 bg-gray-200 opacity-65"></div>

<!-- Tombol Back -->
<div class="absolute left-2 sm:left-4 top-4 sm:top-6">
   <a href="{{ route('class') }}" 
      class="flex items-center bg-gray-900 text-white py-2 px-4 rounded-full shadow-md hover:bg-gray-700 transition duration-200 ease-in-out">
       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
       </svg>
       Back
   </a>
</div>            

<!-- Grid Layout -->
<div class="container mx-auto py-8 sm:py-16 md:py-20 px-4 sm:px-6 lg:px-8 relative">
   <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">

       <!-- Kolom 1: Foto -->
       <div class="flex justify-center items-center">
           <img src="{{ Storage::url($course->course_picture) }}" alt="{{ $course->name }}" 
                class="w-72 h-52 rounded-md object-cover shadow-2xl border-gray-600 ">
       </div>

       <!-- Kolom 2: Informasi dan Tombol -->
       <div class="space-y-6">
           <!-- Baris Pertama: Informasi -->
           <div class="text-center md:text-left space-y-2">
               <h2 class="text-3xl font-bold text-black">{{ $course->name }}</h2>
               <p class="text-lg text-black">Teacher: {{ optional($course->teacher)->name ?? 'Unknown' }}</p>
               <p class="text-lg text-black">Start At: {{ $course->created_at->format('M d, Y') }}</p>
               <p class="text-lg text-black">End At: {{ $course->end_date ? \Carbon\Carbon::parse($course->end_date)->format('M d, Y') : 'N/A' }}</p>
               <p class="text-lg text-black">Participants: {{ $course->participants_count }}</p>
           </div>

           <!-- Baris Kedua: Tombol -->
           <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
               @auth
               <form action="{{ route('course.enroll', $course->id) }}" method="POST">
                   @csrf
                   <button type="submit" 
                           class="bg-sky-900 py-2 px-6 hover:bg-sky-800 text-white py-2 px-6 rounded-lg transform transition-transform duration-200 ease-in-out hover:scale-105">
                       Take Course
                   </button>
               </form>
               @php
               $isTeacher = auth()->user()->id === $course->teacher->id;
               $isEnrolled = $course->participants->contains('id', auth()->user()->id);
           @endphp
       
           @if($isTeacher || $isEnrolled)
               <a href="{{ route('forum.index', $course->id) }}" 
                  class="bg-sky-900 py-2 px-6 text-white rounded-lg hover:bg-sky-800">
                   See Forum
               </a>
           @endif           
                <button onclick="document.getElementById('information').scrollIntoView({ behavior: 'smooth' });"
                        class="bg-gray-200 text-black py-2 px-6 rounded-lg hover:bg-gray-300 transform transition-transform duration-200 ease-in-out hover:scale-105">
                    Class Information
                </button>
               @if(session('success'))
                   <div class="bg-green-500 text-white p-4 rounded mb-4">
                       {{ session('success') }}
                   </div>
               @endif
               @endauth

               @guest
               <button onclick="window.location.href='{{ route('login') }}'" 
                       class="bg-sky-900 hover:bg-sky-800 text-white py-2 px-6 rounded-lg transform transition-transform duration-200 ease-in-out hover:scale-105">
                   Take Course
               </button>
               <button onclick="document.getElementById('information').scrollIntoView({ behavior: 'smooth' });"
                        class="bg-gray-200 text-black py-2 px-6 rounded-lg hover:bg-gray-300 transform transition-transform duration-200 ease-in-out hover:scale-105">
                    Class Information
                </button>
               @endguest
           </div>
       </div>
   </div>
</div>
</div>

@if(session('error'))
<x-message :message="session('error')" type="error" />
@endif

    <!-- Course Description Section -->
<div>
    <div id="information" class="grid grid-cols-1 lg:grid-cols-3 gap-6 m-20">
        <!-- Left Column: Course Description and Modules (2/3 width) -->
        <div class="col-span-2 p-6" style="max-height: 500px; overflow-y: auto; scrollbar-width: none;">
            <div class="bg-white shadow-lg rounded-lg p-6 mb-7">
                <h3 class="text-xl font-bold mb-2">Course Description</h3>
                <p class="text-gray-700 mb-4">{!! $course->description !!}</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-2">Modules</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    @foreach ($contents as $content)
                        <li>{{ $content->title }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Right Column: Teacher Biodata (1/3 width) -->
        <div class="col-span-1 bg-white shadow-lg rounded-lg p-6">
            <!-- Foto Profil Guru -->
            <div class="flex justify-center mb-4">
                <img src="{{ Storage::url($course->teacher->profile_picture ?? 'default_profile.jpg') }}" 
                     alt="{{ $course->teacher->name }} Profile Picture" 
                     class="w-32 h-32 object-cover rounded-full shadow-lg border-4 border-gray-200">
            </div>
            <h2 class="text-2xl font-bold mb-4 text-center">Teacher Biodata</h2>
            <div class="flex flex-col items-center">
                <p class="text-gray-700 mb-2"><strong>Name:</strong> {{ $course->teacher->name ?? 'Unknown' }}</p>
                <p class="text-gray-700 mb-4 text-justify"><strong>Bio:</strong> {{ $course->teacher->bio ?? 'No bio available.' }}</p>
            </div>
        </div>
    </div>
</div>

    
@endsection