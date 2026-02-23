@props(['posts'])

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Latest Blogs</h2>
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                View All
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Posts Grid -->
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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
                        <div class="p-4">
                            <!-- Category -->
                            @if($post->category)
                                <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide">
                                    {{ $post->category->name }}
                                </span>
                            @endif

                            <!-- Title -->
                            <h3 class="mt-2 text-lg font-bold text-gray-900 line-clamp-2 hover:text-blue-600">
                                <a href="{{ route('posts.show', $post) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <!-- Excerpt -->
                            <!-- <p class="mt-2 text-gray-600 text-sm line-clamp-2"> -->
                            <!--     {{ $post->excerpt }} -->
                            <!-- </p> -->

                            <!-- Author & Date -->
                            <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
                                <div class="flex items-center space-x-2">
                                    @if($post->user)
                                        <img src="{{ $post->user->avatar_url }}" class="w-5 h-5 rounded-full">
                                        <span>{{ $post->user->name }}</span>
                                    @else
                                        <span>Unknown</span>
                                    @endif
                                </div>
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <p class="text-gray-500">No posts yet. Check back later!</p>
            </div>
        @endif

    </div>
</section>
