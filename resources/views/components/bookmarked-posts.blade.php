<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if($bookmarkedPosts->isEmpty())
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-500">
            You haven't bookmarked any posts yet.
        </div>
        @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($bookmarkedPosts as $post)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group">
                @if($post->thumbnail)
                <img src="{{ $post->thumbnail_url }}" class="w-full h-40 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-900 mb-2">
                        <a href="{{ route('posts.show', $post) }}" class="hover:underline">{{ $post->title }}</a>
                    </h3>
                    <p class="text-sm text-gray-500 mb-2">
                        {{ $post->category->name ?? 'No Category' }}
                    </p>
                    <p class="text-xs text-gray-400">{{ $post->created_at->format('M d, Y') }}</p>
                </div>

                <!-- Remove Bookmark Button -->
                <form method="POST" action="{{ route('posts.bookmark', $post) }}" class="absolute top-2 right-2">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs">
                        Remove
                    </button>
                </form>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>
