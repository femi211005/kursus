<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
            <div class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#F9DFDF] to-[#F5AFAF] text-white rounded-lg shadow-md">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm font-semibold">Admin Panel</span>
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
                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold">Selamat datang, {{ auth()->user()->name }}! 👋</h3>
                            <p class="text-white/90 mt-1">Anda login sebagai <strong class="font-bold">Administrator</strong></p>
                        </div>
                    </div>
                    <p class="text-white/80 text-sm">Kelola platform e-learning dengan mudah dan efisien</p>
                </div>
            </div>

           
                    <a href="{{ route('admin.courses.create') }}" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-[#FCF8F8] to-[#FBEFEF] rounded-xl border border-[#F5AFAF]/20 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <div class="bg-gradient-to-br from-[#F9DFDF] to-[#F5AFAF] p-3 rounded-lg text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Add New Course</h4>
                            <p class="text-xs text-gray-500">Create course</p>
                        </div>
                    </a>

                    <a href="#" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-[#FCF8F8] to-[#FBEFEF] rounded-xl border border-[#F5AFAF]/20 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <div class="bg-gradient-to-br from-[#F9DFDF] to-[#F5AFAF] p-3 rounded-lg text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Manage Users</h4>
                            <p class="text-xs text-gray-500">View all users</p>
                        </div>
                    </a>
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
                        <h4 class="font-bold text-gray-900 mb-2">Platform Overview</h4>
                        <p class="text-gray-600 text-sm">Kelola semua aspek platform e-learning Anda dengan mudah. Anda dapat menambahkan course baru, mengelola user, dan memantau progress pembelajaran.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
