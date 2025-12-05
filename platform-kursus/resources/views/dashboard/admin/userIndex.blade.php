<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Users') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen" style="background-color: #FCF8F8;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 rounded-lg border text-green-700 bg-green-100 border-green-200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">

                <form method="GET" action="{{ url('admin/user') }}" class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">

                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="submit" name="role" value="" onclick="clearSearch()"
                            class="px-5 py-2.5 text-sm font-medium border rounded-l-lg transition-colors duration-200
                            {{ request('role') == '' 
                                ? 'bg-[#F5AFAF] text-white border-[#F5AFAF]' 
                                : 'bg-white text-gray-700 border-[#F9DFDF] hover:bg-[#FBEFEF]' }}">
                            All Roles
                        </button>

                        <button type="submit" name="role" value="student" onclick="clearSearch()"
                            class="px-5 py-2.5 text-sm font-medium border-t border-b border-r transition-colors duration-200
                            {{ request('role') == 'student' 
                                ? 'bg-[#F5AFAF] text-white border-[#F5AFAF]' 
                                : 'bg-white text-gray-700 border-[#F9DFDF] hover:bg-[#FBEFEF]' }}">
                            Students
                        </button>

                        <button type="submit" name="role" value="teacher" onclick="clearSearch()"
                            class="px-5 py-2.5 text-sm font-medium border-t border-b border-r rounded-r-lg transition-colors duration-200
                            {{ request('role') == 'teacher' 
                                ? 'bg-[#F5AFAF] text-white border-[#F5AFAF]' 
                                : 'bg-white text-gray-700 border-[#F9DFDF] hover:bg-[#FBEFEF]' }}">
                            Teachers
                        </button>
                    </div>

                    <div class="relative w-full md:w-64">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="block w-full p-2.5 pl-10 text-sm text-gray-900 border rounded-lg focus:ring-[#F5AFAF] focus:border-[#F5AFAF]"
                            style="background-color: white; border-color: #F9DFDF;"
                            placeholder="Search name/email...">
                    </div>

                    <button type="submit"
                        class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center transition-all shadow-sm"
                        style="background-color: #F5AFAF; hover:background-color: #e09898;">
                        Cari
                    </button>
                </form>

                <a href="{{ route('admin.user.create') }}"
                   class="flex items-center justify-center text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md transition-transform transform hover:scale-105"
                   style="background-color: #F5AFAF;">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add User
                </a>
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg border" style="border-color: #F9DFDF;">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase font-bold" style="background-color: #F9DFDF; color: #555;">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center">Name</th>
                            <th scope="col" class="px-6 py-4 text-center">Email</th>
                            <th scope="col" class="px-6 py-4 text-center">Role</th>
                            <th scope="col" class="px-6 py-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($users as $user)
                        <tr class="border-b transition duration-150 ease-in-out hover:bg-[#FBEFEF]" style="border-color: #FBEFEF;">
                            <td class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $user->role == 'admin' ? 'bg-red-100 text-red-600' : '' }}
                                    {{ $user->role == 'student' ? 'bg-blue-100 text-blue-600' : '' }}
                                    {{ $user->role == 'teacher' ? 'bg-green-100 text-green-600' : '' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center flex justify-center space-x-4">
                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                   class="font-medium text-blue-600 hover:text-blue-800 hover:underline">
                                    Edit
                                </a>

                                <button type="button"
                                    class="font-medium text-red-600 hover:text-red-800 hover:underline"
                                    onclick="openModal('{{ $user->id }}')">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @if($users->hasPages())
                <div class="p-4 bg-white border-t" style="border-color: #F9DFDF;">
                    {{ $users->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>

    @foreach($users as $user)
    <div id="deleteModal{{ $user->id }}"
         class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden transition-opacity duration-300">
        
        <div class="relative w-full max-w-md p-6 rounded-xl shadow-lg transform transition-all scale-100"
             style="background-color: #FCF8F8; border: 1px solid #F9DFDF;">
            
            <div class="text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-600">
                    Apakah Anda yakin ingin menghapus user <b>{{ $user->name }}</b>?
                </h3>
                
                <div class="flex justify-center gap-4">
                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-sm hover:shadow-md transition"
                            style="background-color: #F5AFAF;">
                            Ya, Hapus
                        </button>
                    </form>

                    <button type="button" onclick="closeModal('{{ $user->id }}')"
                        class="text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none rounded-lg border text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10"
                        style="border-color: #F9DFDF;">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        function openModal(id) {
            document.getElementById('deleteModal' + id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById('deleteModal' + id).classList.add('hidden');
        }

        function clearSearch() {
            // Opsional: Logika jika ingin membersihkan input search saat klik filter
            const searchInput = document.querySelector('input[name="search"]');
            if(searchInput) searchInput.value = '';
        }
    </script>
</x-app-layout>