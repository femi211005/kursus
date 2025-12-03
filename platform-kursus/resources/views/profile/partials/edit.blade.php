<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Role Information and Update Role Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">Role Information</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Your current role: <strong>{{ ucfirst(auth()->user()->role) }}</strong>
                    </p>

                    @if (auth()->user()->role === 'student' || auth()->user()->role === 'teacher')
                        <form action="{{ route('update.role') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                @if (auth()->user()->role === 'student')
                                    Become a Teacher
                                @else
                                    Become a Student
                                @endif
                            </button>
                        </form>
                    @endif
                    
                    @if (session('error'))
                        <div class="mt-4 text-red-600">{{ session('error') }}</div>
                    @endif
                </div>
            </div>
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">Profile Picture</h3>
                    <div class="mt-2 mb-4">
                        <!-- Menampilkan gambar profil -->
                        <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" 
                        class="w-24 h-24 rounded-full object-cover">                   
                    </div>
            
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="profile_picture" class="block text-sm font-medium text-gray-700">Upload Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" 
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    
                        <div class="mt-4">
                            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                            <textarea name="bio" id="bio" rows="3" 
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ auth()->user()->bio }}</textarea>
                        </div>
                    
                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Update Profile
                        </button>
                    </form>
            
                    <form action="{{ route('profile.delete-picture') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600">
                            Delete Profile Picture
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
