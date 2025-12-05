<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    {{-- Wrapper Background --}}
    <div class="py-8" style="background-color:#FCF8F8;">
        <div class="max-w-4xl mx-auto overflow-hidden shadow-lg sm:rounded-lg" style="background-color:#FBEFEF;">
            
            <div class="p-6 border-b border-gray-200">

                {{-- Messages --}}
                @if(session('success'))
                    <x-message :message="session('success')" type="success" />
                @elseif(session('error'))
                    <x-message :message="session('error')" type="error" />
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-5">

                        {{-- Name --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Name</label>
                            <input id="name" 
                                type="text" name="name"
                                value="{{ old('name', $user->name) }}"
                                required autofocus
                                class="block mt-1 w-full border rounded-md shadow-sm focus:ring focus:ring-pink-200 focus:border-pink-300"
                                style="border-color:#F9DFDF; background-color:#FCF8F8;" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Email</label>
                            <input id="email" 
                                type="email" name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                class="block mt-1 w-full border rounded-md shadow-sm focus:ring focus:ring-pink-200 focus:border-pink-300"
                                style="border-color:#F9DFDF; background-color:#FCF8F8;" />
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">
                                New Password (Leave blank if not changing)
                            </label>
                            <input id="password"
                                type="password" name="password"
                                class="block mt-1 w-full border rounded-md shadow-sm focus:ring focus:ring-pink-200 focus:border-pink-300"
                                style="border-color:#F9DFDF; background-color:#FCF8F8;" />
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Confirm New Password</label>
                            <input id="password_confirmation"
                                type="password" name="password_confirmation"
                                class="block mt-1 w-full border rounded-md shadow-sm focus:ring focus:ring-pink-200 focus:border-pink-300"
                                style="border-color:#F9DFDF; background-color:#FCF8F8;" />
                        </div>

                        {{-- Role --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Role</label>
                            <select id="role" name="role"
                                class="block mt-1 w-full border rounded-md shadow-sm focus:ring focus:ring-pink-200 focus:border-pink-300"
                                style="border-color:#F9DFDF; background-color:#FCF8F8;">
                                <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>
                                    Student
                                </option>
                                <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>
                                    Teacher
                                </option>
                            </select>
                        </div>

                        {{-- SUBMIT BUTTON --}}
                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="py-2.5 px-6 text-sm font-medium rounded-full border transition text-gray-700"
                                style="background-color:#F5AFAF; border-color:#F9DFDF;"
                                onmouseover="this.style.backgroundColor='#F9DFDF'"
                                onmouseout="this.style.backgroundColor='#F5AFAF'">
                                Update User
                            </button>
                        </div>

                    </div>
                </form>

                {{-- BACK BUTTON --}}
                <a href="{{ route('admin.user.index') }}"
                    class="py-2.5 px-6 mt-6 inline-block text-sm font-medium rounded-full border transition text-gray-700"
                    style="background-color:#F5AFAF; border-color:#F9DFDF;"
                    onmouseover="this.style.backgroundColor='#F9DFDF'"
                    onmouseout="this.style.backgroundColor='#F5AFAF'">

                    <svg class="w-5 h-5 inline-block mr-2 text-gray-700"
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
