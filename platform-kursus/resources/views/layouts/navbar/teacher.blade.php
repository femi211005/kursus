<nav x-data="{ open: false }" class="border-b transition-colors duration-300" 
     style="background-color: #FCF8F8; border-color: #F9DFDF;">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/kursus.png') }}" 
                             alt="Logo" 
                             class="block h-14 w-auto object-contain filter invert opacity-80 hover:opacity-100 transition"> 
                             </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="url('teacher/home')" :active="request()->fullUrlIs(url('teacher/home'))">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <div @mouseenter="open = true" @mouseleave="open = false" x-data="{ open: false }" class="relative flex items-center">
                        <x-nav-link :href="url('teacher/myClass')" :active="request()->fullUrlIs(url('teacher/courses*')) || request()->fullUrlIs(url('teacher/contents*'))"
                            class="cursor-pointer">
                            {{ __('Teaching') }}
                            <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </x-nav-link>
                        
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute left-0 top-full z-10 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 border"
                             style="border-color: #F9DFDF; margin-top: -5px;"> <x-dropdown-link :href="url('teacher/courses')">
                                {{ __('Make Course') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="url('teacher/contents')">
                                {{ __('Make Content') }}
                            </x-dropdown-link>
                        </div>
                    </div>

                    <x-nav-link :href="url('teacher/myClass')" :active="request()->fullUrlIs(url('teacher/myClass*'))">
                        {{ __('Learning') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent font-mono text-sm leading-4 font-semibold rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                style="background-color: transparent;">
                            <div class="flex items-center gap-2">
                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" 
                                     class="w-8 h-8 rounded-full object-cover border"
                                     style="border-color: #F9DFDF;">
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="ms-1 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b text-xs text-gray-400" style="border-color: #F9DFDF;">
                            Teacher Account
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none transition duration-150 ease-in-out"
                        style="background-color: transparent;"
                        onmouseover="this.style.backgroundColor='#FBEFEF'"
                        onmouseout="this.style.backgroundColor='transparent'">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" class="sm:hidden border-t" style="background-color: #FCF8F8; border-color: #F9DFDF;">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="url('teacher/home')" :active="request()->fullUrlIs('teacher/home')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <div x-data="{ subOpen: false }" class="relative">
                <button @click="subOpen = !subOpen" class="w-full flex items-center justify-between pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-[#FBEFEF] hover:border-[#F9DFDF] transition duration-150 ease-in-out focus:outline-none">
                    <span>{{ __('Teaching') }}</span>
                    <svg :class="{'rotate-180': subOpen}" class="w-4 h-4 transform transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="subOpen" class="space-y-1 pl-4 bg-white/50">
                    <x-responsive-nav-link :href="url('teacher/courses')" class="text-sm">
                        {{ __('Make Course') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="url('teacher/contents')" class="text-sm">
                        {{ __('Make Content') }}
                    </x-responsive-nav-link>
                </div>
            </div>

            <x-responsive-nav-link :href="url('teacher/myClass')" :active="request()->fullUrlIs(url('teacher/myClass*'))">
                {{ __('Learning') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t" style="border-color: #F9DFDF;">
            <div class="px-4 flex items-center">
                <div class="shrink-0 mr-3">
                    <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full object-cover border" style="border-color: #F9DFDF;">
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>