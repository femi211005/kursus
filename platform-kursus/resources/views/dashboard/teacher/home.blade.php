<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Teacher Dashboard') }}
            </h2>
            <div class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#F9DFDF] to-[#F5AFAF] text-white rounded-lg shadow-md">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
                <span class="text-sm font-semibold">Teacher Panel</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-[#FCF8F8] via-[#FBEFEF] to-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-[#F9DFDF] to-[#F5AFAF] overflow-hidden shadow-xl sm:rounded-2xl mb-8 transform hover:scale-[1.02] transition-all duration-300">
                <div class="p-8 text-white">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="bg-white/20 backdrop-blur-sm p-4 rounded-full">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold">You're logged in as Teacher! 👋</h3>
                            <p class="text-white/90 mt-1">Selamat datang kembali, <strong class="font-bold">{{ auth()->user()->name }}</strong></p>
                        </div>
                    </div>
                    <p class="text-white/80 text-sm">Kelola course dan monitor progress siswa dengan mudah</p>
                </div>
            </div>

            <!-- Info Card -->
            <div class="bg-gradient-to-r from-[#FCF8F8] to-[#FBEFEF] rounded-2xl shadow-lg p-6 border-l-4 border-[#F5AFAF]">
                <div class="flex items-start gap-4">
                    <div class="bg-[#F5AFAF]/20 p-3 rounded-full">
                        <svg class="w-6 h-6 text-[#F5AFAF]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Teaching Overview</h4>
                        <p class="text-gray-600 text-sm">Kelola course Anda, tambahkan konten pembelajaran, dan monitor progress siswa. Anda dapat membuat course baru dan mengelola materi yang sudah ada.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
