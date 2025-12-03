<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="grid grid-cols-1 gap-6">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">
                                        {{ __('Name') }}
                                    </label>
                                    <input id="name" 
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" 
                                        type="text" name="name" 
                                        value="{{ old('name', $category->name) }}" 
                                        required autofocus />
                                </div>

                              
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-sky-950 rounded-full border border-gray-200 hover:bg-gray-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100">
                                {{ __('Update Category') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('admin.categories.index') }}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-sky-950 rounded-full border border-gray-200 hover:bg-gray-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100">
                    <svg class="w-6 h-6 text-white inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                    </svg>                      
                    Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
