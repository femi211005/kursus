<div class="py-8">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-[#FCF8F8] via-[#FBEFEF] to-[#F9DFDF]/40 shadow-md sm:rounded-2xl border border-[#F5AFAF]/20">
            <div class="p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    {{ __('Update Category') }}
                </h3>

                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Name') }}
                        </label>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name', $category->name) }}"
                               required autofocus
                               class="block w-full rounded-lg border border-[#F5AFAF]/40 bg-white/80 shadow-sm px-3 py-2 text-sm text-gray-800
                                      focus:outline-none focus:ring-2 focus:ring-[#F9DFDF] focus:border-[#F5AFAF] transition" />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('admin.categories.index') }}"
                           class="inline-flex items-center gap-2 rounded-full border border-[#F5AFAF]/40 bg-white text-sm font-medium text-[#F5AFAF] px-4 py-2
                                  hover:bg-[#FCF8F8] hover:border-[#F5AFAF] transition">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
                            </svg>
                            {{ __('Back') }}
                        </a>

                        <button type="submit"
                                class="inline-flex items-center rounded-full bg-gradient-to-r from-[#F5AFAF] to-[#F9DFDF] px-5 py-2 text-sm font-semibold text-white
                                       shadow-md hover:shadow-lg hover:from-[#F9DFDF] hover:to-[#F5AFAF] transition">
                            {{ __('Update Category') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
