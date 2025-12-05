<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="('Email')" class="text-gray-700" />
            
            <x-text-input id="email" 
                class="block mt-1 w-full bg-[#FBEFEF] border-[#F9DFDF] text-gray-700 focus:border-[#F5AFAF] focus:ring-[#F5AFAF] rounded-md shadow-sm" 
                type="email" 
                name="email" 
                :value="old('email', $request->email)" 
                required autofocus autocomplete="username" />
            
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#F5AFAF]" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="('Password')" class="text-gray-700" />
            
            <x-text-input id="password" 
                class="block mt-1 w-full bg-[#FBEFEF] border-[#F9DFDF] text-gray-700 focus:border-[#F5AFAF] focus:ring-[#F5AFAF] rounded-md shadow-sm" 
                type="password" 
                name="password" 
                required autocomplete="new-password" />
            
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#F5AFAF]" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="('Confirm Password')" class="text-gray-700" />

            <x-text-input id="password_confirmation" 
                class="block mt-1 w-full bg-[#FBEFEF] border-[#F9DFDF] text-gray-700 focus:border-[#F5AFAF] focus:ring-[#F5AFAF] rounded-md shadow-sm"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-[#F5AFAF]" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4 !bg-[#F5AFAF] hover:!bg-[#F9DFDF] !text-gray-800 border border-[#F9DFDF] focus:bg-[#F9DFDF] active:bg-[#F5AFAF] transition ease-in-out duration-150">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>