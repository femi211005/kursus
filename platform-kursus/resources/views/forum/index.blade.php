@extends('layouts.master')

@section('container')
    <div class="flex flex-col min-h-screen">
        <!-- Konten Utama -->
        <div class="flex-grow overflow-y-auto">
            <!-- Judul Course yang tetap di atas -->
            <h1 class="sticky top-0 mt-14 pt-14 text-3xl font-semibold text-gray-800 bg-white z-10">{{ $course->name }}</h1>

            <!-- Menampilkan postingan utama -->
            <div class="forum-posts mt-6 space-y-4">
                @foreach ($forumPosts as $post)
                    <!-- Menampilkan hanya posting utama yang tidak memiliki parent_id -->
                    @if ($post->parent_id == null)
                        <div class="forum-post flex items-start gap-4 mt-6 {{ $post->user->id === auth()->id() ? 'flex-row-reverse' : '' }}">
                            <!-- Foto profil -->
                            <img class="w-10 h-10 rounded-full" src="{{ Storage::url($post->user->profile_picture) }}" alt="{{ $post->user->name }} image">

                            <!-- Konten postingan -->
                            <div class="flex flex-col w-full max-w-lg p-4 border-gray-200 bg-gray-100 rounded-lg shadow-md {{ $post->user->id === auth()->id() ? 'bg-sky-100' : 'bg-gray-100' }}">
                                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                    <span class="text-sm font-semibold text-gray-900">{{ $post->user->name }}</span>
                                    @if($post->user->id === $course->teacher_id)
                                    <span class="text-sm font-semibold text-gray-900">(Teacher)</span>
                                    @else
                                        <span class="text-sm font-semibold text-gray-900">(Student)</span>
                                    @endif
                                    <span class="text-sm font-normal text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-sm font-normal py-2.5 text-gray-900">{{ e($post->post_content) }}</p>
                                <span class="text-sm font-normal text-gray-500">Delivered</span>
                            </div>

                            <!-- Tombol Reply -->
                            <button onclick="setParentId({{ $post->id }})" class="text-blue-500 hover:text-blue-700 mt-2">Klik untuk Reply</button>

                            <!-- Tombol Lihat Balasan hanya tampil jika ada balasan -->
                            @if ($post->replies->isNotEmpty())
                                <button onclick="toggleReplies({{ $post->id }})" class="text-blue-500 hover:text-blue-700 mt-2">Lihat Balasan</button>
                            @endif

                            <!-- Daftar balasan -->
                            <div id="replies-{{ $post->id }}" class="replies mt-4 hidden">
                                @foreach ($post->replies as $reply)
                                    <div class="flex items-start gap-4 {{ $reply->user->id === auth()->id() ? 'ml-auto bg-sky-100' : 'bg-gray-100' }} p-4 rounded-lg shadow-md w-3/4 {{ $reply->user->id === auth()->id() ? 'flex-row-reverse' : '' }} reply-bubble">
                                        <img class="w-10 h-10 rounded-full" src="{{ Storage::url($reply->user->profile_picture) }}" alt="{{ $reply->user->name }} image">
                                        <div class="flex flex-col w-full">
                                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                                <span class="text-sm font-semibold text-gray-900">{{ $reply->user->name }}</span>
                                                <span class="text-sm font-normal text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-sm font-normal py-2.5 text-gray-900">{{ e($reply->post_content) }}</p>
                                            <div class="text-sm text-gray-500">
                                                Replying to: <span class="font-semibold">{{ $post->user->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Formulir untuk menulis postingan atau balasan -->
        <div class="mt-auto sticky bottom-0 w-full p-4 bg-white border-t-2">
            <div class="flex flex-col w-full p-4 border-gray-200 bg-gray-100 rounded-lg shadow-md">
                <form action="{{ route('forum.store', ['course_id' => $course->id]) }}" method="POST" class="flex items-end gap-4">
                    @csrf
                    <input type="hidden" name="parent_id" id="parent_id" value="">
                    <textarea id="post_content" name="post_content" cols="80" rows="3" class="flex-1 p-3 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your post or reply..."></textarea>
                    
                    <!-- Tombol Kirim -->
                    <button type="submit" class="p-3 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                        <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                        </svg>
                        <span class="sr-only">Send message</span>
                    </button>

                    <!-- Tombol Batalkan Reply -->
                    <button type="button" onclick="cancelReply()" class="flex items-center gap-2 p-3 text-red-600 rounded-full cursor-pointer hover:bg-red-100">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.3 5.7a1 1 0 0 0-1.4 0L12 10.6 7.1 5.7a1 1 0 0 0-1.4 1.4l4.9 4.9-4.9 4.9a1 1 0 0 0 1.4 1.4L12 13.4l4.9 4.9a1 1 0 0 0 1.4-1.4l-4.9-4.9 4.9-4.9a1 1 0 0 0 0-1.4Z" />
                        </svg>
                        <span>Cancel Reply</span>
                    </button>

                </form>
            </div>
        </div>

        <script>
            function setParentId(postId) {
                document.getElementById('parent_id').value = postId;
                document.getElementById('post_content').placeholder = "Write your reply...";
            }

            function cancelReply() {
                document.getElementById('parent_id').value = '';
                document.getElementById('post_content').placeholder = "Write your post or reply...";
            }

            function toggleReplies(postId) {
                const replies = document.getElementById('replies-' + postId);
                replies.classList.toggle('hidden');
            }
        </script>
    </div>
@endsection
