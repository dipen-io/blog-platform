<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Bookmarks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($bookmarkedPosts->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-500">
                    You haven't bookmarked any posts yet.
                </div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($bookmarkedPosts as $post)
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            @if($post->thumbnail)
                                <img src="{{ $post->thumbnail_url }}" class="w-full h-40 object-cover">
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold text-lg text-gray-900 mb-2">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    {{ $post->category->name ?? 'No Category' }}
                                </p>
                                <p class="text-xs text-gray-400">{{ $post->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
