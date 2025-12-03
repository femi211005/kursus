<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Contents') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <x-message :message="session('success')" type="success" />
        @endif
            <div class="flex items-center justify-between space-x-4 mb-6">
                <!-- Tombol Add Content -->
                <a href="{{ route(Auth::user()->role.'.contents.create') }}" class="py-2.5 px-5 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800">
                    Add Content
                </a>
            </div>

            <!-- Card Container -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($contents as $content)
                    <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg cursor-pointer">
                        <div class="p-6">
                            <!-- Menampilkan Title -->
                            <h3 class="text-lg font-bold text-gray-800 mb-2 hover:text-blue-500" onclick="document.getElementById('showModal{{ $content->id }}').classList.remove('hidden')">
                                {{ $content->title }}
                            </h3>
                            <!-- Menampilkan Course Name -->
                            <p class="text-sm text-gray-600 mb-4">{{ $content->course->name ?? 'Uncategorized' }}</p>
                            <!-- Menampilkan Body -->
                            <p class="text-sm text-gray-600">
                                {{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($content->body)), 100) }}
                            </p>                            
                            <div class="mt-4 text-sm text-gray-500">
                                <p><strong>Created At:</strong> {{ $content->created_at->format('Y-m-d') }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-300 px-6 py-4 flex justify-between">
                            <a href="{{ route(Auth::user()->role.'.contents.edit', $content->id) }}" class="text-blue-800 hover:underline">Edit</a>
                            <button class="text-red-800 hover:underline" onclick="event.stopPropagation(); document.getElementById('deleteModal{{ $content->id }}').classList.remove('hidden')">Hapus</button>
                        </div>
                    </div>

                    <!-- Modal Show Content -->
                    <div id="showModal{{ $content->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden" role="dialog" aria-modal="true" aria-labelledby="modalTitle{{ $content->id }}">
                        <div class="bg-white rounded-lg p-6 w-full max-w-2xl relative overflow-y-auto max-h-screen">
                            <h2 id="modalTitle{{ $content->id }}" class="text-xl font-bold text-gray-800 mb-4">{{ $content->title }}</h2>
                            <p class="text-sm text-gray-600 mb-4"><strong>Course:</strong> {{ $content->course->name ?? 'Uncategorized' }}</p>
                            <!-- Menampilkan konten body di modal -->
                            <p class="text-sm text-gray-600 mb-4"><strong>Body of Content:</strong> {!! $content->body !!}</p>
                            <p class="text-sm text-gray-600 mb-4"><strong>Created Date:</strong> {{ $content->created_at ? $content->created_at->format('Y-m-d') : 'N/A' }}</p>

                            <!-- Tombol Tutup -->
                            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl font-bold" onclick="document.getElementById('showModal{{ $content->id }}').classList.add('hidden')">
                                &times;
                            </button>
                        </div>
                    </div>

                    <!-- Modal Konfirmasi Hapus -->
                    <div id="deleteModal{{ $content->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden" role="dialog" aria-modal="true">
                        <div class="bg-white rounded-lg p-6 w-full max-w-md text-center">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Delete Confirmation</h2>
                            <p class="text-gray-600 mb-6">Are you sure you want to delete the content <strong>{{ $content->title }}</strong>?</p>

                            <form action="{{ route(Auth::user()->role.'.contents.destroy', $content->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="flex justify-center space-x-4">
                                    <!-- Tombol Konfirmasi -->
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
                                    <!-- Tombol Batal -->
                                    <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300" onclick="document.getElementById('deleteModal{{ $content->id }}').classList.add('hidden')">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-span-3">
                        <p>No contents found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
