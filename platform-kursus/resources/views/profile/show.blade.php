### FILE: resources/views/profile/show.blade.php
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">{{ $user->name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            <span class="inline-block mt-2 px-3 py-1 bg-purple-100 text-purple-800 text-sm font-semibold rounded-full">{{ ucfirst($user->role) }}</span>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>