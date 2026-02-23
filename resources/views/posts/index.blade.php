<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-900">All Blog Posts</h1>

                @auth
                    <a href="{{ route('posts.create') }}"
                       class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Write New Post
                    </a>
                @endauth
            </div>

            <!-- Posts Grid -->
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">

                            <!-- Thumbnail -->
                            <a href="{{ route('posts.show', $post) }}">
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ $post->thumbnail_url }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                            </a>

                            <!-- Content -->
                            <div class="p-5">
                                <!-- Category -->
                                @if($post->category)
                                    <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide">
                                        {{ $post->category->name }}
                                    </span>
                                @endif

                                <!-- Title -->
                                <h2 class="mt-2 text-xl font-bold text-gray-900 line-clamp-2 hover:text-blue-600">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <p class="mt-2 text-gray-600 text-sm line-clamp-3">
                                    {{ $post->excerpt }}
                                </p>

                                <!-- Meta -->
                                <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        @if($post->user)  <!-- This checks if user relationship exists -->
                                            <img src="{{ $post->user->avatar_url }}"
                                                 class="w-6 h-6 rounded-full">
                                            <span>{{ $post->user->name }}</span>  <!-- This gets the name from users table -->
                                        @else
                                            <span>Unknown Author</span>
                                        @endif
                                    </div>
                                    <span>{{ $post->reading_time }} min read</span>
                                </div>

                                <!-- Footer -->
                                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-xs text-gray-400">
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>

                                    <a href="{{ route('posts.show', $post) }}"
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Read More →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No posts yet</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new post.</p>

                    @auth
                        <div class="mt-6">
                            <a href="{{ route('posts.create') }}"
                               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                New Post
                            </a>
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
