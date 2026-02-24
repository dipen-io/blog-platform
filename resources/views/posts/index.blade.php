<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-900">
                    @if(request('search') || request('category'))
                        Search Results
                    @else
                        All Blog Posts
                    @endif
                </h1>

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

            <!-- 🔍 SEARCH BAR AT TOP -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col md:flex-row gap-4">

                    <!-- Search by Title -->
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Search posts by title..."
                               class="w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <!-- Filter by Category -->
                    <div class="md:w-56">
                        <select name="category"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Search Button -->
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 font-medium">
                        Search
                    </button>

                    <!-- Clear Button (only show if searching) -->
                    @if(request('search') || request('category'))
                        <a href="{{ route('posts.index') }}"
                           class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400 font-medium text-center">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <!-- Results Info (if searching) -->
            @if(request('search') || request('category'))
                <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-blue-800">
                        Found <strong>{{ $posts->total() }}</strong>
                        @if(request('search'))matching "{{ request('search') }}"@endif
                        @if(request('category'))in {{ $categories->firstWhere('id', request('category'))?->name }}@endif
                    </p>
                </div>
            @endif

            <!-- POSTS GRID (All posts OR Search results) -->
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">

                            <!-- Thumbnail (Clickable) -->
                            <a href="{{ route('posts.show', $post) }}">
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ $post->thumbnail_url }}"
                                         alt="{{ $post->title }}"
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                            </a>

                            <!-- Content -->
                            <div class="p-5">
                                <!-- Category Badge -->
                                @if($post->category)
                                    <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide">
                                        {{ $post->category->name }}
                                    </span>
                                @endif

                                <!-- Title (Clickable) -->
                                <h2 class="mt-2 text-xl font-bold text-gray-900 line-clamp-2 hover:text-blue-600">
                                    <a href="{{ route('posts.show', $post) }}">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <p class="mt-2 text-gray-600 text-sm line-clamp-3">
                                    {{ $post->excerpt }}
                                </p>

                                <!-- Author & Meta -->
                                <div class="mt-4 flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        @if($post->user)
                                            <img src="{{ $post->user->avatar_url }}" class="w-6 h-6 rounded-full">
                                            <span>{{ $post->user->name }}</span>
                                        @else
                                            <span>Unknown</span>
                                        @endif
                                    </div>
                                    <span>{{ $post->reading_time }} min</span>
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
                <div class="text-center py-12 bg-white rounded-lg shadow">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No posts found</h3>
                    <p class="mt-1 text-gray-500">
                        @if(request('search') || request('category'))
                            Try different search terms or
                            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline">view all posts</a>
                        @else
                            No posts yet. Check back later!
                        @endif
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
