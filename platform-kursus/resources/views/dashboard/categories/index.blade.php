<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <x-message :message="session('success')" type="success" />
            @endif
            <div class="flex items-center justify-between space-x-4">
                <!-- Tombol Add categories -->
                <a href="{{ route('admin.categories.create') }}" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-white bg-sky-950 rounded-full hover:bg-gray-800">
                    Add Categories</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-gray-800">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr class="border-b">
                                <td class="px-6 py-4 text-center">{{ $category->name }}</td>
                                <td class="px-6 py-4 flex justify-center items-center space-x-4">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="font-medium text-blue-800 hover:underline">Edit</a>
                                
                                    <!-- Tombol Hapus -->
                                    <button class="font-medium text-red-800 hover:underline" onclick="document.getElementById('deleteModal{{ $category->id }}').classList.remove('hidden')">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    @foreach($categories as $category)
    <div id="deleteModal{{ $category->id }}" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h2 class="text-lg font-bold text-gray-800">Konfirmasi Penghapusan</h2>
            <p class="text-sm text-gray-600 mt-2">Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak dapat dibatalkan.</p>

            <div class="mt-4 flex justify-end space-x-2">
                <!-- Tombol Batal -->
                <button class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300" onclick="document.getElementById('deleteModal{{ $category->id }}').classList.add('hidden')">
                    Batal
                </button>

                <!-- Tombol Konfirmasi Hapus -->
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
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
