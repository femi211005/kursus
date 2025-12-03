<nav x-data="{ open: false, dropdown: false }" class="fixed top-0 w-full bg-white border-b border-gray-100 z-50">
    <div class="flex items-center justify-center bg-sky-950 p-2">
        <p class="text-white text-sm font-medium italic" style="font-family: 'Inter', sans-serif;">
            Eat, Sleep, and Learn Code at Codemy
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Branding -->
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
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

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent font-mono text-sm leading-4 font-semibold rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div><img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full"></div>
                                {{-- <div>{{ Auth::user()->profile_picture }}</div> --}}
                                <svg class="ms-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
                <button onclick="window.location.href='{{ route('login') }}'" class="text-gray-700 text-sm font-medium hover:bg-zinc-200 hover:text-gray-900 border-2 border-gray-700 py-2 px-4 rounded-lg mr-4">
                    {{ __('Login') }}
                </button>
                
                <a href="{{ route('register') }}" class="text-white text-sm font-medium bg-sky-950 hover:bg-sky-800 py-2 px-4 rounded-lg inline-block">
                    {{ __('Register') }}
                </a>                
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden">
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

        <!-- Responsive User Dropdown -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
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
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <button onclick="window.location.href='{{ route('login') }}'" class="text-gray-700 text-sm font-medium hover:bg-zinc-200 hover:text-gray-900 border-2 border-gray-700 py-2 px-4 rounded-lg w-full">
                        {{ __('Login') }}
                    </button>
                </div>
                <div class="mt-3 px-4">
                    <a href="{{ route('register') }}" class="text-white text-center text-sm font-medium bg-sky-950 hover:bg-sky-800 py-2 px-4 rounded-lg w-full inline-block">
                        {{ __('Register') }}
                    </a>
                </div>
            </div>
        @endauth
    </div>
</nav>
 <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navLink = document.getElementById('nav-link-codemy');
            const section = document.getElementById('codemy');
        
            window.addEventListener('scroll', function () {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const scrollPosition = window.scrollY + window.innerHeight / 2;
        
                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    navLink.classList.add('active');
                } else {
                    navLink.cla                    html {
                        scroll-behavior: smooth;
                    }ssList.remove('active');
                }
            });
        });
 </script>

 <style>
        html {
        scroll-behavior: smooth;
    }
 </style>
