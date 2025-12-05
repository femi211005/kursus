<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Contents') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen" style="background-color: #FCF8F8;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 rounded-lg border text-green-700 bg-green-50 border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between space-x-4 mb-8">
                <a href="{{ route(Auth::user()->role.'.contents.create') }}" 
                   class="py-2.5 px-6 text-sm font-bold text-white rounded-full shadow-md transform transition hover:-translate-y-0.5 hover:shadow-lg"
                   style="background-color: #F5AFAF;">
                   + Add Content
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($contents as $content)
                    <div class="bg-white border rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden"
                         style="border-color: #F9DFDF;">
                        
                        <div class="p-6">
                            <div class="mb-3">
                                <span class="px-3 py-1 text-xs font-semibold text-gray-600 rounded-full"
                                      style="background-color: #FBEFEF;">
                                    {{ $content->course->name ?? 'Uncategorized' }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-800 mb-3 cursor-pointer transition-colors duration-200"
                                style="color: #333;"
                                onmouseover="this.style.color='#F5AFAF'"
                                onmouseout="this.style.color='#333'"
                                onclick="document.getElementById('showModal{{ $content->id }}').classList.remove('hidden')">
                                {{ $content->title }}
                            </h3>

                            <p class="text-sm text-gray-500 mb-4 leading-relaxed">
                                {{ Str::limit(str_replace('&nbsp;', ' ', strip_tags($content->body)), 100) }}
                            </p>
                            
                            <div class="text-xs text-gray-400 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $content->created_at->format('d M Y') }}
                            </div>
                        </div>

                        <div class="px-6 py-4 flex justify-between items-center border-t" style="background-color: #FCF8F8; border-color: #F9DFDF;">
                            <a href="{{ route(Auth::user()->role.'.contents.edit', $content->id) }}" 
                               class="text-sm font-medium text-gray-600 hover:text-gray-900 flex items-center gap-1 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </a>
                            
                            <button class="text-sm font-medium text-red-500 hover:text-red-700 flex items-center gap-1 transition-colors" 
                                    onclick="event.stopPropagation(); document.getElementById('deleteModal{{ $content->id }}').classList.remove('hidden')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus
                            </button>
                        </div>
                    </div>

                    <div id="showModal{{ $content->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden transition-opacity duration-300">
                        <div class="absolute inset-0 bg-gray-900 opacity-40" onclick="document.getElementById('showModal{{ $content->id }}').classList.add('hidden')"></div>
                        
                        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-2xl relative z-10 mx-4 border" style="border-color: #F9DFDF;">
                            <div class="border-b pb-4 mb-4" style="border-color: #F9DFDF;">
                                <h2 class="text-2xl font-bold text-gray-800">{{ $content->title }}</h2>
                                <span class="text-sm text-gray-500 mt-1 block">Course: {{ $content->course->name ?? 'Uncategorized' }}</span>
                            </div>
                            
                            <div class="prose max-w-none text-gray-600 mb-6 max-h-[60vh] overflow-y-auto custom-scrollbar">
                                {!! $content->body !!}
                            </div>

                            <div class="text-xs text-gray-400 mt-4 pt-4 border-t" style="border-color: #FCF8F8;">
                                Created Date: {{ $content->created_at ? $content->created_at->format('d F Y') : 'N/A' }}
                            </div>

                            <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors" onclick="document.getElementById('showModal{{ $content->id }}').classList.add('hidden')">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div id="deleteModal{{ $content->id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                        <div class="absolute inset-0 bg-gray-900 opacity-40" onclick="document.getElementById('deleteModal{{ $content->id }}').classList.add('hidden')"></div>
                        
                        <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-sm text-center relative z-10 border" style="border-color: #F9DFDF;">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus Konten?</h3>
                            <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus konten <strong>"{{ $content->title }}"</strong>? Tindakan ini tidak dapat dibatalkan.</p>

                            <form action="{{ route(Auth::user()->role.'.contents.destroy', $content->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="flex justify-center gap-3">
                                    <button type="button" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium text-sm transition-colors" onclick="document.getElementById('deleteModal{{ $content->id }}').classList.add('hidden')">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium text-sm shadow-md transition-colors">
                                        Ya, Hapus
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-12 text-center">
                        <div class="bg-white p-6 rounded-full shadow-sm mb-4" style="background-color: #FBEFEF;">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada konten</h3>
                        <p class="text-gray-500 mt-1">Mulai dengan menambahkan konten baru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>