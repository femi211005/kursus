<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <x-message :message="session('success')" type="success" />
        @endif
            <div class="flex items-center space-x-4 mb-6">
                <a href="{{ route(Auth::user()->role . '.courses.index', ['status' => 'all']) }}"
                   class="py-2.5 px-5 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800">
                    All Courses
                </a>
                <a href="{{ route(Auth::user()->role . '.courses.index', ['status' => 'ongoing']) }}"
                   class="py-2.5 px-5 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800">
                    On-Going
                </a>
                <a href="{{ route(Auth::user()->role . '.courses.index', ['status' => 'expired']) }}"
                   class="py-2.5 px-5 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800">
                    Expired
                </a>
                <!-- Tombol Tambah Kursus -->
                <a href="{{ route(Auth::user()->role . '.courses.create') }}"
                   class="py-2.5 items-end px-5 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800">
                    Add Courses
                </a>
            </div>

            <!-- Card Container -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $course)
                <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg cursor-pointer">
                    <!-- Course Image -->
                    <div class="overflow-hidden rounded-t-lg">
                        <img src="{{ Storage::url($course->course_picture) }}" alt="{{ $course->name }}" class="w-full h-32 object-cover">
                    </div>
                    
                    <!-- Course Details -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2 hover:text-blue-500" onclick="document.getElementById('showModal{{ $course->id }}').classList.remove('hidden')">{{ $course->name }}</h3>
                        <p class="text-sm text-gray-600 mb-4">{{ $course->category->name }}</p>
                        <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($course->description), 100) }}</p>
                        <div class="mt-4 text-sm text-gray-500">
                            <p><strong>Teacher:</strong> {{ $course->teacher->name }}</p>
                            <p><strong>Created At:</strong> {{ $course->created_at->format('Y-m-d') }}</p>
                            <p><strong>End At:</strong> {{ \Carbon\Carbon::parse($course->end_date)->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="border-t border-gray-300 px-6 py-4 flex justify-between">
                        <a href="{{ route(Auth::user()->role.'.courses.edit', $course->id) }}" class="text-blue-800 hover:underline">Edit</a>
                        <button class="text-red-800 hover:underline" onclick="event.stopPropagation(); document.getElementById('deleteModal{{ $course->id }}').classList.remove('hidden')">Hapus</button>
                    </div>
                </div>

<!-- Modal Show Course -->
<div id="showModal{{ $course->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modalTitle{{ $course->id }}">
    <div class="bg-white rounded-lg p-6 w-full max-w-2xl relative overflow-y-auto max-h-screen">
        <h2 id="modalTitle{{ $course->id }}" class="text-xl font-bold text-gray-800 mb-4">{{ $course->name }}</h2>
        <p class="text-sm text-gray-600 mb-4"><strong>Category:</strong> {{ $course->category->name }}</p>
        <p class="text-sm text-gray-600 mb-4"><strong>Teacher:</strong> {{ $course->teacher->name }}</p>
        <p class="text-sm text-gray-600 mb-4"><strong>Description:</strong> {!! $course->description !!}</p>
        <p class="text-sm text-gray-600 mb-4"><strong>Created Date:</strong> {{ $course->created_at ? $course->created_at->format('Y-m-d') : 'N/A' }}</p>
        <p><strong>End At:</strong> {{ \Carbon\Carbon::parse($course->end_date)->format('Y-m-d') }}</p>

        <!-- Daftar Peserta -->
        <h3 class="text-lg font-bold text-gray-800 mt-6">Participants</h3>
        <ul class="text-sm text-gray-600 space-y-2 mt-4">
            @foreach($course->participants as $participant)
            <li class="flex items-center justify-between space-x-2">
                <div class="flex items-center space-x-2">
                    <!-- Gambar Profil -->
                    <div class="w-8 h-8 rounded-full bg-gray-300 flex-shrink-0 overflow-hidden">
                        <img src="{{ Storage::url($participant->profile_picture) }}" alt="{{ $participant->name }}" class="w-full h-full object-cover">
                    </div>
                    <!-- Nama dan Email -->
                    <span>{{ $participant->name }} ({{ $participant->email }})</span>
                </div>
                
                <!-- Progress -->
                <div class="text-sm text-gray-500">
                    <strong>Progress:</strong> 
                    @if(isset($participant->progressPercentage))
                    {{ number_format($participant->progressPercentage, 2) }}% completed
                @else
                    <!-- Jika progres tidak tersedia -->
                @endif
                
                </div>
            </li>
        @endforeach
        
        </ul>

        <!-- Tombol Tutup -->
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl font-bold" onclick="document.getElementById('showModal{{ $course->id }}').classList.add('hidden')">
            &times;
        </button>
    </div>
</div>


                

                <!-- Modal Konfirmasi Hapus -->
                <div id="deleteModal{{ $course->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden" role="dialog" aria-modal="true">
                    <div class="bg-white rounded-lg p-6 w-full max-w-md text-center">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Delete Confirmation</h2>
                        <p class="text-gray-600 mb-6">Are you sure you want to delete the course <strong>{{ $course->name }}</strong>?</p>

                        <form action="{{ route(Auth::user()->role.'.courses.destroy', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="flex justify-center space-x-4">
                                <!-- Tombol Konfirmasi -->
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
                                <!-- Tombol Batal -->
                                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300" onclick="document.getElementById('deleteModal{{ $course->id }}').classList.add('hidden')">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center col-span-3">
                    <p>No courses found.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
