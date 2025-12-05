<nav x-data="{ open: false }" class="border-b" style="background-color: #FCF8F8; border-color: #F9DFDF;">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <!-- Logo diubah warnanya menjadi aksen pink (#F5AFAF) agar kontras dengan background putih -->
                        <x-application-logo class="block h-9 w-auto fill-current" style="color: #F5AFAF;" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="url('admin/home')" :active="request()->fullUrlIs(url('admin/home'))">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="url('admin/user')" :active="request()->fullUrlIs(url('admin/user*'))">
                        {{ __('Users') }}
                    </x-nav-link>
                    <x-nav-link :href="url('admin/categories')" :active="request()->fullUrlIs(url('admin/categories*'))">
                        {{ __('Categories') }}
                    </x-nav-link>
                    <x-nav-link :href="url('admin/courses')" :active="request()->fullUrlIs(url('admin/courses*'))">
                        {{ __('Courses') }}
                    </x-nav-link>
                    <x-nav-link :href="url('admin/contents')" :active="request()->fullUrlIs(url('admin/contents*'))">
                        {{ __('Contents') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                style="background-color: #FCF8F8;">
                            
                            <div class="flex items-center gap-2">
                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" 
                                     alt="{{ Auth::user()->name }}" 
                                     class="w-8 h-8 rounded-full object-cover border"
                                     style="border-color: #F9DFDF;">
                                <span>{{ Auth::user()->name }}</span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Dropdown Header/Info -->
                        <div class="px-4 py-2 border-b text-xs text-gray-400" style="border-color: #F9DFDF;">
                            Managed Account
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-[#FBEFEF]">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="hover:bg-[#FBEFEF]">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 transition duration-150 ease-in-out"
                        style="background-color: transparent;"
                        onmouseover="this.style.backgroundColor='#FBEFEF'; this.style.color='#F5AFAF';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#6B7280';">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background-color: #FCF8F8; border-top: 1px solid #F9DFDF;">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('admin/user')" :active="request()->fullUrlIs(url('admin/user*'))">
                {{ __('Users') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('admin/categories')" :active="request()->fullUrlIs(url('admin/categories*'))">
                {{ __('Categories') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('admin/courses')" :active="request()->fullUrlIs(url('admin/courses*'))">
                {{ __('Courses') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="url('admin/contents')" :active="request()->fullUrlIs(url('admin/contents*'))">
                {{ __('Contents') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t" style="border-color: #F9DFDF;">
            <div class="px-4 flex items-center mb-3">
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

                <!-- Authentication -->
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