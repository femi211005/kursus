<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#F5AFAF] leading-tight">
            {{ __('Add User') }}
        </h2>
    </x-slot>

    <div class="bg-[#FCF8F8] overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-6 bg-[#FBEFEF] border border-[#F9DFDF] rounded-lg">

                <form method="POST" action="{{ route('admin.user.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">

                        <div>
                            <label for="name" class="block text-sm font-medium text-[#F5AFAF]">
                                {{ __('Name') }}
                            </label>
                            <input id="name" 
                                class="block mt-1 w-full border-[#F9DFDF] bg-[#FCF8F8] rounded-md shadow-sm focus:ring-[#F5AFAF] focus:border-[#F5AFAF]"
                                type="text" name="name" value="{{ old('name') }}" required autofocus />
                            @error('name')
                                <x-message :message="$message" type="error" />
                             @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-[#F5AFAF]">
                                {{ __('Email') }}
                            </label>
                            <input id="email" 
                                class="block mt-1 w-full border-[#F9DFDF] bg-[#FCF8F8] rounded-md shadow-sm focus:ring-[#F5AFAF] focus:border-[#F5AFAF]"
                                type="email" name="email" value="{{ old('email') }}" required />
                            @error('email')
                                <x-message :message="$message" type="error" />
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-[#F5AFAF]">
                                {{ __('Password') }}
                            </label>
                            <input id="password" 
                                class="block mt-1 w-full border-[#F9DFDF] bg-[#FCF8F8] rounded-md shadow-sm focus:ring-[#F5AFAF] focus:border-[#F5AFAF]"
                                type="password" name="password" required autocomplete="new-password" />
                            @error('password')
                                <x-message :message="$message" type="error" />
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-[#F5AFAF]">
                                {{ __('Confirm Password') }}
                            </label>
                            <input id="password_confirmation" 
                                class="block mt-1 w-full border-[#F9DFDF] bg-[#FCF8F8] rounded-md shadow-sm focus:ring-[#F5AFAF] focus:border-[#F5AFAF]"
                                type="password" name="password_confirmation" required />
                            @error('password_confirmation')
                                <x-message :message="$message" type="error" />
                            @enderror
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-[#F5AFAF]">
                                {{ __('Role') }}
                            </label>
                            <select id="role" 
                                name="role" 
                                class="block mt-1 w-full border-[#F9DFDF] bg-[#FCF8F8] rounded-md shadow-sm focus:ring-[#F5AFAF] focus:border-[#F5AFAF]">
                                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            </select>
                            @error('role')
                                <x-message :message="$message" type="error" />
                            @enderror
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" 
                            class="py-2.5 px-5 text-sm font-medium text-white bg-[#F5AFAF] rounded-full hover:bg-[#e28e8e] transition">
                            {{ __('Add User') }}
                        </button>
                    </div>
                </form>

                <a href="{{ route('admin.user.index') }}" 
                    class="inline-flex items-center mt-4 py-2.5 px-5 text-sm font-medium text-white bg-[#F5AFAF] rounded-full hover:bg-[#e28e8e] transition">

                    <svg class="w-6 h-6 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                    </svg>                       

                    Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
