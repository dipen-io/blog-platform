<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Welcome Back, {{ auth()->user()->name }}!</h3>
                <p class="text-gray-700">Here's a quick overview of your dashboard and your bookmarked posts.</p>
            </div>

            <!-- Bookmarked Posts -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">My Bookmarked Posts</h3>

                @if($bookmarkedPosts->isEmpty())
                    <div class="text-gray-500 p-4 border rounded-md bg-gray-50">
                        You haven't bookmarked any posts yet.
                    </div>
                @else
                    <x-bookmarked-posts :bookmarked-posts="$bookmarkedPosts" />
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
