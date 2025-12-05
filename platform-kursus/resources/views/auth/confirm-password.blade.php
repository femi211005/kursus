<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="('Password')" class="text-gray-700" />

            <x-text-input id="password" 
                class="block mt-1 w-full bg-[#FBEFEF] border-[#F9DFDF] text-gray-700 focus:border-[#F5AFAF] focus:ring-[#F5AFAF] rounded-md shadow-sm"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#F5AFAF]" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="ms-4 !bg-[#F5AFAF] hover:!bg-[#F9DFDF] !text-gray-800 border border-[#F9DFDF] focus:bg-[#F9DFDF] active:bg-[#F5AFAF] transition ease-in-out duration-150">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>