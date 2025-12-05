<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            {{ __('List of Categories') }}
        </h2>
    </x-slot>

    <div class="min-h-screen w-fullpy-12 " style="background-color: #FCF8F8;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <x-message :message="session('success')" type="success" />
            @endif

            <div class="flex items-center justify-between mb-4">
                <!-- Tombol Add -->
                <a href="{{ route('admin.categories.create') }}" 
                   class="py-2.5 px-5 text-sm font-medium text-white rounded-full transition"
                   style="background-color: #F5AFAF;">
                    Add Categories
                </a>
            </div>

            <div class="overflow-hidden shadow-sm sm:rounded-lg"
                 style="background-color: #FBEFEF;">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                    <table class="w-full text-sm text-gray-800">
                        <thead class="uppercase"
                               style="background-color: #F9DFDF; color: #444;">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left">Name</th>
                                <th scope="col" class="px-6 py-3 text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($categories as $category)
                            <tr class="border-b" style="border-color: #F5AFAF;">
                                <td class="px-6 py-4">{{ $category->name }}</td>

                                <td class="px-6 py-4 flex justify-center items-center space-x-4">

                                    <!-- Edit -->
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                       class="font-medium hover:underline"
                                       style="color: #E07A7A;">
                                        Edit
                                    </a>

                                    <!-- Hapus -->
                                    <button onclick="document.getElementById('deleteModal{{ $category->id }}').classList.remove('hidden')"
                                            class="font-medium hover:underline"
                                            style="color: #C74444;">
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
    <div id="deleteModal{{ $category->id }}" 
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50 hidden">

        <div class="rounded-lg p-6 w-full max-w-md"
             style="background-color: #FBEFEF;">

            <h2 class="text-lg font-bold text-gray-800">Konfirmasi Penghapusan</h2>
            <p class="text-sm text-gray-600 mt-2">
                Apakah Anda yakin ingin menghapus kategori ini? Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="mt-4 flex justify-end space-x-2">

                <!-- Batal -->
                <button onclick="document.getElementById('deleteModal{{ $category->id }}').classList.add('hidden')"
                        class="px-4 py-2 rounded-lg transition"
                        style="background-color: #F9DFDF; color: #333;">
                    Batal
                </button>

                <!-- Konfirmasi Hapus -->
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="px-4 py-2 text-white rounded-lg transition"
                            style="background-color: #F5AFAF;">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
    </div>
    @endforeach

</x-app-layout>
