<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <x-message :message="session('success')" type="success" />
        @endif
            <div class="flex items-center justify-between space-x-4">
                <!-- Form Filter Role -->
                <form method="GET" action="{{ url('admin/user') }}" class="space-x-4">
                    <!-- Filter Roles -->
                    <button type="submit" name="role" value="" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800" onclick="clearSearch()">All Roles</button>
                    <button type="submit" name="role" value="student" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800" onclick="clearSearch()">Students</button>
                    <button type="submit" name="role" value="teacher" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800" onclick="clearSearch()">Teachers</button>
                    
                    <!-- Search Field -->
                    <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}" class="py-2.5 px-4 w-60 text-sm border border-gray-300 rounded-lg">
                    
                    <!-- Search Button -->
                    <button type="submit" class="py-2.5 px-5 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800">Search</button>
                </form>
                
                <script>
                    // Fungsi untuk menghapus nilai pada search bar
                    function clearSearch() {
                        // Menetapkan nilai input search menjadi kosong
                        document.querySelector('input[name="search"]').value = '';
                    }
                </script>
                
        
                <!-- Tombol Add User -->
                <a href="{{ route('admin.user.create') }}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800">Add User</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-gray-800">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 text-center">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-center">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-center">{{ $user->role }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="font-medium text-blue-800 hover:underline">Edit</a>

                                    <!-- Tombol Hapus -->
                                    <button class="font-medium text-red-800 hover:underline" onclick="document.getElementById('deleteModal{{ $user->id }}').classList.remove('hidden')">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Konfirmasi Hapus -->
@foreach($users as $user)
<div id="deleteModal{{ $user->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <h2 class="text-lg font-bold text-gray-800">Konfirmasi Penghapusan</h2>
        <p class="text-sm text-gray-600 mt-2">Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.</p>

        <div class="mt-4 flex justify-end space-x-2">
            <!-- Tombol Batal -->
            <button class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300" onclick="document.getElementById('deleteModal{{ $user->id }}').classList.add('hidden')">
                Batal
            </button>

            <!-- Tombol Konfirmasi Hapus -->
            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endforeach


</x-app-layout>
