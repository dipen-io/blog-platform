<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Posts
                </a>
            </div>

            <!-- Post Card -->
            <article class="bg-white overflow-hidden shadow-lg rounded-lg">

                <!-- Cover Image -->
                @if($post->thumbnail)
                    <div class="w-full h-64 md:h-96 overflow-hidden">
                        <img src="{{ $post->thumbnail_url }}"
                             alt="{{ $post->title }}"
                             class="w-full h-full object-cover">
                    </div>
                @endif

                <!-- Post Content -->
                <div class="p-6 md:p-8">

                    <!-- Category & Meta -->
                    <div class="flex items-center justify-between mb-4">
                        @if($post->category)
                            <span class="bg-blue-100 text-blue-600 text-sm font-semibold px-3 py-1 rounded-full">
                                {{ $post->category->name }}
                            </span>
                        @endif
                        <span class="text-gray-500 text-sm">{{ $post->reading_time }} min read</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        {{ $post->title }}
                    </h1>

                    <!-- Author Info -->
                    <div class="flex items-center justify-between py-4 border-b border-gray-200 mb-6">
                        <div class="flex items-center space-x-3">
                            <img src="{{ $post->user->avatar_url }}"
                                 alt="{{ $post->user->name }}"
                                 class="w-10 h-10 rounded-full border border-gray-300">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $post->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $post->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <!-- Edit/Delete (if owner) -->
                        @if(auth()->id() === $post->user_id)
                            <div class="flex space-x-2 ">
                                <a href="{{ route('posts.edit', $post) }}"
                                   class="text-blue-600 mt-0.5 bg-blue-100 border px-2 rounded-md hover:bg-blue-300 hover:text-blue-800 text-sm font-medium">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 border px-2 rounded-md hover:bg-blue-300 hover:text-red-800 text-sm font-medium"
                                            onclick="return confirm('Delete this post?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <!-- Post Body (HTML from TinyMCE) -->
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! $post->body !!}
                    </div>

                    <!-- Actions Bar -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">

                        <!-- Like Button -->
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span>Like</span>
                        </button>

                        <!-- Bookmark Button -->
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            <span>Bookmark</span>
                        </button>

                        <!-- Share -->
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            <span>Share</span>
                        </button>
                    </div>

                </div>
            </article>
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Comments Section -->
            <div class="mt-8 bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    Comments ({{ $post->comments->count()}})
                </h3>

                @auth
            <form method="POST" action="{{ route('comments.store', $post) }}" class="mb-6">
                    @csrf
                    <div class="mb-2">
                        <textarea name="body" rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                            placeholder="Write a comment...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                            onclick="this.disabled=true; this.form.submit();"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Post Comment
                    </button>
                </form>
                @else
                    <p class="text-gray-500 mb-4">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> to comment
                    </p>
                @endauth

                <!-- Comments List -->
                <div class="space-y-4">
                    @forelse($post->comments as $comment)
                        <div class="border-b border-gray-100 pb-4">
                            <div class="flex items-center space-x-2 mb-2">
                                <img src="{{ $comment->user->avatar_url }}" class="w-8 h-8 rounded-full">
                                <span class="font-medium text-sm">{{ $comment->user->name }}</span>
                                <span class="text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        @auth
                        @if(auth()->id() === $comment->user_id || auth()->id() === $post->user_id)
                        <form method="POST" action="{{ route('comments.destroy', $comment)}}"
                            onsubmit="return confirm('Delete this comment?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">
                                Delete
                            </button>

                        </form>
                        @endif
                        @endauth
                            <!-- Delete Button -->
  <p class="text-gray-700">{{ $comment->body }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500">No comments yet. Be the first!</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
