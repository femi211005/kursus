<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Student Dashboard') }}
            </h2>
            <div class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#F9DFDF] to-[#F5AFAF] text-white rounded-lg shadow-md">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                </svg>
                <span class="text-sm font-semibold">Student Panel</span>
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
                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold">You're logged in as Student! 👋</h3>
                            <p class="text-white/90 mt-1">Selamat datang kembali, <strong class="font-bold">{{ auth()->user()->name }}</strong></p>
                        </div>
                    </div>
                    <p class="text-white/80 text-sm">Mari lanjutkan perjalanan belajarmu dan raih kesuksesan!</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Enrolled Courses -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-[#F5AFAF]/20 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-gradient-to-br from-[#FCF8F8] to-[#FBEFEF] p-3 rounded-xl">
                            <svg class="w-8 h-8 text-[#F5AFAF]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-gray-500 text-sm font-medium mb-1">Enrolled Courses</h4>
                    <p class="text-3xl font-bold bg-gradient-to-r from-[#F5AFAF] to-[#F9DFDF] bg-clip-text text-transparent">8</p>
                    <p class="text-xs text-gray-400 mt-2">Active enrollments</p>
                </div>

                <!-- Completed Courses -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-[#F5AFAF]/20 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-gradient-to-br from-[#FCF8F8] to-[#FBEFEF] p-3 rounded-xl">
                            <svg class="w-8 h-8 text-[#F5AFAF]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-gray-500 text-sm font-medium mb-1">Completed</h4>
                    <p class="text-3xl font-bold bg-gradient-to-r from-[#F5AFAF] to-[#F9DFDF] bg-clip-text text-transparent">3</p>
                    <p class="text-xs text-gray-400 mt-2">Courses finished</p>
                </div>

                <!-- Certificates -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-[#F5AFAF]/20 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-gradient-to-br from-[#FCF8F8] to-[#FBEFEF] p-3 rounded-xl">
                            <svg class="w-8 h-8 text-[#F5AFAF]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-gray-500 text-sm font-medium mb-1">Certificates</h4>
                    <p class="text-3xl font-bold bg-gradient-to-r from-[#F5AFAF] to-[#F9DFDF] bg-clip-text text-transparent">3</p>
                    <p class="text-xs text-gray-400 mt-2">Earned certificates</p>
                </div>

                <!-- Learning Hours -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-[#F5AFAF]/20 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-gradient-to-br from-[#FCF8F8] to-[#FBEFEF] p-3 rounded-xl">
                            <svg class="w-8 h-8 text-[#F5AFAF]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <h4 class="text-gray-500 text-sm font-medium mb-1">Learning Hours</h4>
                    <p class="text-3xl font-bold bg-gradient-to-r from-[#F5AFAF] to-[#F9DFDF] bg-clip-text text-transparent">42h</p>
                    <p class="text-xs text-gray-400 mt-2">Total time spent</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-[#F5AFAF]/20 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[#F5AFAF]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"/>
                    </svg>
                    Quick Actions
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('student.myClass') }}" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-[#FCF8F8] to-[#FBEFEF] rounded-xl border border-[#F5AFAF]/20 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <div class="bg-gradient-to-br from-[#F9DFDF] to-[#F5AFAF] p-3 rounded-lg text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">My Courses</h4>
                            <p class="text-xs text-gray-500">Continue learning</p>
                        </div>
                    </a>

                    <a href="{{ route('class') }}" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-[#FCF8F8] to-[#FBEFEF] rounded-xl border border-[#F5AFAF]/20 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <div class="bg-gradient-to-br from-[#F9DFDF] to-[#F5AFAF] p-3 rounded-lg text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Browse Courses</h4>
                            <p class="text-xs text-gray-500">Explore new courses</p>
                        </div>
                    </a>

                    <a href="#" 
                       class="flex items-center gap-4 p-4 bg-gradient-to-r from-[#FCF8F8] to-[#FBEFEF] rounded-xl border border-[#F5AFAF]/20 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <div class="bg-gradient-to-br from-[#F9DFDF] to-[#F5AFAF] p-3 rounded-lg text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Certificates</h4>
                            <p class="text-xs text-gray-500">View & download</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Learning Progress Card -->
            <div class="bg-gradient-to-r from-[#FCF8F8] to-[#FBEFEF] rounded-2xl shadow-lg p-6 border-l-4 border-[#F5AFAF]">
                <div class="flex items-start gap-4">
                    <div class="bg-[#F5AFAF]/20 p-3 rounded-full">
                        <svg class="w-6 h-6 text-[#F5AFAF]" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Keep Up the Great Work! 🎯</h4>
                        <p class="text-gray-600 text-sm">Anda telah menyelesaikan <strong>3 dari 8 course</strong>. Teruskan semangat belajarmu dan raih lebih banyak sertifikat!</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span>Overall Progress</span>
                                <span class="font-bold text-[#F5AFAF]">37.5%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-gradient-to-r from-[#F9DFDF] to-[#F5AFAF] h-3 rounded-full shadow-md" style="width: 37.5%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
