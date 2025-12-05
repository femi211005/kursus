<nav x-data="{ open: false, dropdown: false }" class="fixed top-0 w-full z-50 transition-colors duration-300"
     style="background-color: #FCF8F8; border-bottom: 1px solid #F9DFDF;">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-700 hover:text-[#F5AFAF] transition-colors" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-mono">
                    <x-nav-link :href="url('/')" :active="request()->is('/')">
                        {{ __('Home') }}
                    </x-nav-link>
                    
                    <x-nav-link href="#codemy" id="nav-link-codemy">
                        {{ __('About') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('class')" :active="request()->routeIs('class*')">
                        {{ __('Class') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent font-mono text-sm leading-4 font-semibold rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                    style="background-color: #FCF8F8;"> <div class="flex items-center gap-2">
                                    <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" 
                                         class="w-8 h-8 rounded-full object-cover border"
                                         style="border-color: #F9DFDF;">
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                
                                <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="#">
                                {{ Auth::user()->name }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route(auth()->user()->role . '.home')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <button onclick="window.location.href='{{ route('login') }}'" 
                            class="text-gray-600 text-sm font-medium border-2 py-2 px-4 rounded-lg mr-4 transition-all duration-300"
                            style="border-color: #F5AFAF; background-color: transparent;"
                            onmouseover="this.style.backgroundColor='#FBEFEF'; this.style.color='#333';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#4B5563';">
                        {{ __('Login') }}
                    </button>
                    
                    <a href="{{ route('register') }}" 
                       class="text-white text-sm font-medium py-2 px-4 rounded-lg inline-block shadow-md hover:shadow-lg transition-transform transform hover:scale-105"
                       style="background-color: #F5AFAF;">
                        {{ __('Register') }}
                    </a>                
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none transition duration-150 ease-in-out"
                        style="background-color: transparent;"
                        onmouseover="this.style.backgroundColor='#FBEFEF'"
                        onmouseout="this.style.backgroundColor='transparent'">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden border-t" style="background-color: #FCF8F8; border-color: #F9DFDF;">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="url('/')" :active="request()->is('/')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('/about')" :active="request()->is('about')">
                {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('class')" :active="request()->routeIs('class*')">
                {{ __('Class') }}
            </x-responsive-nav-link>
        </div>

        @auth
            <div class="pt-4 pb-1 border-t" style="border-color: #F9DFDF;">
                <div class="px-4 flex items-center mb-2">
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
                    <x-responsive-nav-link :href="route(auth()->user()->role . '.home')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t" style="border-color: #F9DFDF;">
                <div class="px-4 space-y-3 pb-3">
                    <button onclick="window.location.href='{{ route('login') }}'" 
                        class="w-full text-gray-700 text-sm font-medium border-2 py-2 px-4 rounded-lg"
                        style="border-color: #F5AFAF; background-color: white;">
                        {{ __('Login') }}
                    </button>
                    
                    <a href="{{ route('register') }}" 
                       class="block text-center text-white text-sm font-medium py-2 px-4 rounded-lg"
                       style="background-color: #F5AFAF;">
                        {{ __('Register') }}
                    </a>
                </div>
            </div>
        @endauth
    </div>
</nav>

<style>
    html {
        scroll-behavior: smooth;
    }
    /* Kelas active yang ditambahkan oleh JS untuk link "About" */
    #nav-link-codemy.active {
        color: #F5AFAF;
        border-bottom: 2px solid #F5AFAF;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLink = document.getElementById('nav-link-codemy');
        const section = document.getElementById('codemy');

        // Pastikan section ada sebelum menjalankan logika scroll
        if (section && navLink) {
            window.addEventListener('scroll', function () {
                const sectionTop = section.offsetTop - 100; // Adjustment offset
                const sectionHeight = section.offsetHeight;
                const scrollPosition = window.scrollY;

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    navLink.classList.add('active');
                } else {
                    navLink.classList.remove('active');
                }
            });
        }
    });
</script>