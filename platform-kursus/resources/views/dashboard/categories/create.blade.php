<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Category') }}
        </h2>
    </x-slot>

    <div class="overflow-hidden shadow-sm sm:rounded-lg" style="background-color:#FCF8F8;">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-6 border-b border-gray-200" style="background-color:#FBEFEF;">

                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                {{ __('Name') }}
                            </label>

                            <input id="name"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm 
                                       focus:ring focus:ring-pink-200 focus:border-pink-300"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required autofocus />

                            @error('name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit"
                            class="py-2.5 px-5 text-sm font-medium text-gray-700 rounded-full border transition"
                            style="background-color:#F5AFAF; border-color:#F9DFDF;"
                            onmouseover="this.style.backgroundColor='#F9DFDF'"
                            onmouseout="this.style.backgroundColor='#F5AFAF'">
                            {{ __('Add Category') }}
                        </button>
                    </div>
                </form>

                <!-- Back Button -->
                <a href="{{ route('admin.categories.index') }}"
                    class="py-2.5 px-5 mt-4 inline-block text-sm font-medium text-gray-700 rounded-full border transition"
                    style="background-color:#F5AFAF; border-color:#F9DFDF;"
                    onmouseover="this.style.backgroundColor='#F9DFDF'"
                    onmouseout="this.style.backgroundColor='#F5AFAF'">

                    <svg class="w-6 h-6 text-gray-700 inline-block mr-2"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m15 19-7-7 7-7"/>
                    </svg>
                    Back
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
