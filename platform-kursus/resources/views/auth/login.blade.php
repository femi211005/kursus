<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="('Email')" class="text-gray-700" />
            
            <x-text-input id="email" 
                class="block mt-1 w-full bg-[#FCF8F8] border-[#F9DFDF] text-gray-700 focus:border-[#F5AFAF] focus:ring-[#F5AFAF] rounded-md shadow-sm" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required autofocus autocomplete="username" />
            
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#F5AFAF]" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="('Password')" class="text-gray-700" />

            <x-text-input id="password" 
                class="block mt-1 w-full bg-[#FCF8F8] border-[#F9DFDF] text-gray-700 focus:border-[#F5AFAF] focus:ring-[#F5AFAF] rounded-md shadow-sm"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#F5AFAF]" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" 
                    class="rounded border-[#F9DFDF] text-[#F5AFAF] shadow-sm focus:ring-[#F5AFAF] bg-[#FCF8F8]" 
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#F5AFAF] hover:text-[#F9DFDF] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#F5AFAF]" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 !bg-[#F5AFAF] hover:!bg-[#F9DFDF] !text-white focus:!bg-[#F5AFAF] active:!bg-[#F5AFAF] border-none">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="text-[#F5AFAF] hover:text-[#F9DFDF] font-semibold transition-colors duration-200">
                {{ __('Register here') }}
            </a>
        </p>
    </div>
</x-guest-layout>