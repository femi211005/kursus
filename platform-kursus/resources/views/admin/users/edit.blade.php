<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password (leave blank to keep current)</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" id="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>Teacher</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" {{ $user->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                <span class="ml-2 text-sm text-gray-600">Active</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>