<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                
                <!-- Menampilkan pesan success atau error jika ada -->
                @if(session('success'))
                    <x-message :message="session('success')" type="success" />
                @elseif(session('error'))
                    <x-message :message="session('error')" type="error" />
                @endif
                
                <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
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
                                        value="{{ old('name', $user->name) }}" 
                                        required autofocus />
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        {{ __('Email') }}
                                    </label>
                                    <input id="email" 
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" 
                                        type="email" name="email" 
                                        value="{{ old('email', $user->email) }}" 
                                        required />
                                </div>
                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        {{ __('New Password (Leave blank if not changing)') }}
                                    </label>
                                    <input id="password" 
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" 
                                        type="password" name="password"/>
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                        {{ __('Confirm New Password') }}
                                    </label>
                                    <input id="password_confirmation" 
                                        class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" 
                                        type="password" name="password_confirmation" />
                                </div>

                                <div>
                                    <label for="role" class="block text-sm font-medium text-gray-700">{{ __('Role') }}</label>
                                    <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
                                        <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                                        <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-sky-950 rounded-full border border-gray-200 hover:bg-gray-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100">
                                {{ __('Update User') }}
                            </button>
                        </div>
                    </div>
                </form>
                <a href="{{ route('admin.user.index') }}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-sky-950 rounded-full border border-gray-200 hover:bg-gray-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100">
                    <svg class="w-6 h-6 text-white inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                    </svg>                       
                    Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
