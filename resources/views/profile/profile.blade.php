<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Profile Header -->
                    <div class="flex items-center space-x-6">
                        <img src="{{ $user->avatar_url }}"
                             class="w-24 h-24 rounded-full border-4 border-blue-500">

                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                            <p class="text-gray-600">{{ $user->email }}</p>

                            @if($user->bio)
                                <p class="mt-2 text-gray-700">{{ $user->bio }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="mt-8 grid grid-cols-3 gap-4 text-center">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <span class="block text-2xl font-bold">{{ $user->posts->count() }}</span>
                            <span class="text-gray-500">Posts</span>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <span class="block text-2xl font-bold">{{ $user->comments->count() }}</span>
                            <span class="text-gray-500">Comments</span>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <span class="block text-2xl font-bold">{{ $user->likedPosts->count() }}</span>
                            <span class="text-gray-500">Likes</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
