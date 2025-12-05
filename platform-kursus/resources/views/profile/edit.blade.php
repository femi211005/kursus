<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen" style="background-color: #FCF8F8;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg border" style="border-color: #F9DFDF;">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg border" style="border-color: #F9DFDF;">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg border" style="border-color: #F9DFDF;">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

                <div class="space-y-6">

                    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg border" style="border-color: #F9DFDF;">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4" style="border-color: #F9DFDF;">
                            Profile Picture
                        </h3>

                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <img src="{{ Storage::url($user->profile_picture) }}" 
                                     alt="Profile Picture" 
                                     class="w-32 h-32 rounded-full object-cover border-4 shadow-md"
                                     style="border-color: #FBEFEF;">
                            </div>
                        </div>

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PATCH')
                            
                            <div>
                                <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-1">Change Photo</label>
                                <input type="file" name="profile_picture" id="profile_picture" 
                                       class="block w-full text-sm text-gray-500
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-full file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-[#FBEFEF] file:text-gray-700
                                       hover:file:bg-[#F9DFDF]
                                       focus:outline-none cursor-pointer">
                            </div>

                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                                <textarea name="bio" id="bio" rows="4" 
                                          class="block w-full rounded-md shadow-sm border-gray-300 focus:ring focus:ring-opacity-50 transition"
                                          style="focus:border-color: #F5AFAF; focus:ring-color: #F5AFAF;"
                                          placeholder="Tell us about yourself...">{{ auth()->user()->bio }}</textarea>
                            </div>

                            <button type="submit" 
                                    class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 focus:outline-none focus:ring transition ease-in-out duration-150 shadow-md"
                                    style="background-color: #F5AFAF;">
                                Save Changes
                            </button>
                        </form>

                        <div class="mt-4 pt-4 border-t" style="border-color: #F9DFDF;">
                            <form action="{{ route('profile.delete-picture') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 bg-white">
                                    Remove Photo
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-lg border" style="border-color: #F9DFDF;">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Role Information</h3>
                        
                        <div class="p-3 rounded-md mb-4 flex items-center justify-between" style="background-color: #FBEFEF;">
                            <span class="text-sm text-gray-600">Current Role:</span>
                            <span class="font-bold text-gray-800 bg-white px-3 py-1 rounded-full border shadow-sm" style="border-color: #F9DFDF;">
                                {{ ucfirst(auth()->user()->role) }}
                            </span>
                        </div>

                        @if (auth()->user()->role === 'student' || auth()->user()->role === 'teacher')
                            <form action="{{ route('update.role') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                        class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150 shadow-md"
                                        style="background-color: #F5AFAF; hover:background-color: #e09898;">
                                    @if (auth()->user()->role === 'student')
                                        Switch to Teacher
                                    @else
                                        Switch to Student
                                    @endif
                                </button>
                            </form>
                        @endif
                        
                        @if (session('error'))
                            <div class="mt-3 text-sm text-red-600 bg-red-50 p-2 rounded border border-red-100">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>