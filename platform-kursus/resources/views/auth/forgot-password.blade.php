<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="('Email')" class="text-gray-700" />
            
            <x-text-input id="email" 
                class="block mt-1 w-full bg-[#FBEFEF] border-[#F9DFDF] text-gray-700 focus:border-[#F5AFAF] focus:ring-[#F5AFAF] rounded-md shadow-sm" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required autofocus />
                
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#F5AFAF]" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="!bg-[#F5AFAF] hover:!bg-[#F9DFDF] !text-gray-800 border border-[#F9DFDF] focus:bg-[#F9DFDF] active:bg-[#F5AFAF] transition ease-in-out duration-150">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>