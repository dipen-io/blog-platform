<!-- resources/views/welcome.blade.php or any .blade.php file -->
<!DOCTYPE html>
<html lang="en">
    <head>
        @vite('resources/css/app.css')
        <title>My Blog</title>
    </head>
    <body class="bg-gray-100">

        <!-- Navigation -->
        <nav class="bg-gray-800 shadow-lg p-4 m-2 rounded-md">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold text-blue-600">Blog Platform</h1>

                <div class="space-x-4 flex items-center">
                    @auth
                    <!-- LOGGED IN: Show Profile Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-white font-medium hover:text-blue-600 focus:outline-none py-2">
                            <img src="{{ Auth::user()->avatar_url }}" class="w-8 h-8 rounded-full border border-gray-300">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="absolute right-0 top-full w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block border border-gray-200">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-red-600">
                                    Logout
                                </button>
                            </form>

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Add Blog
                            </a>
                        </div>
                    </div>

                    @else
                    <!-- LOGGED OUT: Show Login & Register -->
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium">
                        Register
                    </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Main Content -->
<!-- Main Content -->
<main class="container mx-auto mt-8 px-4 space-y-8">

    <!-- SECTION 1: Featured Blog Post (Image Left, Content Right) -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="md:flex">
            <!-- Left: Blog Image -->
            <div class="md:w-1/2">
                <img src="{{ asset('images/blog-featured.jpg') }}"
                     alt="Featured Blog"
                     class="w-full h-64 md:h-full object-cover">
            </div>

            <!-- Right: Blog Content -->
            <div class="md:w-1/2 p-6 md:p-8 flex flex-col justify-center">
                <div class="flex items-center space-x-2 mb-4">
                    <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">
                        Technology
                    </span>
                    <span class="text-gray-400 text-sm">5 min read</span>
                </div>

                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                    Building Modern APIs with Laravel and Best Practices
                </h2>

                <p class="text-gray-600 mb-6 line-clamp-3">
                    Learn how to create scalable, maintainable APIs using Laravel's latest features.
                    We'll cover authentication, rate limiting, API resources, and testing strategies
                    that will make your backend robust and developer-friendly.
                </p>

                <!-- Author Info -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/author-avatar.jpg') }}"
                             class="w-10 h-10 rounded-full border border-gray-200">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Sarah Johnson</p>
                            <p class="text-xs text-gray-500">Posted on Feb 22, 2025</p>
                        </div>
                    </div>

                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        Read More →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION 2: List of Blog Cards -->
    <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">Latest Posts</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Blog Card 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <img src="{{ asset('images/blog-1.jpg') }}"
                     alt="Blog Title"
                     class="w-full h-48 object-cover">

                <div class="p-4">
                    <h4 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                        Getting Started with Tailwind CSS
                    </h4>

                    <!-- Author -->
                    <div class="flex items-center space-x-2 mt-3">
                        <img src="{{ asset('images/user-1.jpg') }}"
                             class="w-6 h-6 rounded-full">
                        <span class="text-sm text-gray-600">Mike Chen</span>
                    </div>
                </div>
            </div>

            <!-- Blog Card 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <img src="{{ asset('images/blog-2.jpg') }}"
                     alt="Blog Title"
                     class="w-full h-48 object-cover">

                <div class="p-4">
                    <h4 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                        Docker for PHP Developers
                    </h4>

                    <div class="flex items-center space-x-2 mt-3">
                        <img src="{{ asset('images/user-2.jpg') }}"
                             class="w-6 h-6 rounded-full">
                        <span class="text-sm text-gray-600">Alex Rivera</span>
                    </div>
                </div>
            </div>

            <!-- Blog Card 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <img src="{{ asset('images/blog-3.jpg') }}"
                     alt="Blog Title"
                     class="w-full h-48 object-cover">

                <div class="p-4">
                    <h4 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                        Vue.js 3 Composition API Deep Dive
                    </h4>

                    <div class="flex items-center space-x-2 mt-3">
                        <img src="{{ asset('images/user-3.jpg') }}"
                             class="w-6 h-6 rounded-full">
                        <span class="text-sm text-gray-600">Emma Wilson</span>
                    </div>
                </div>
            </div>

            <!-- Blog Card 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <img src="{{ asset('images/blog-4.jpg') }}"
                     alt="Blog Title"
                     class="w-full h-48 object-cover">

                <div class="p-4">
                    <h4 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                        Database Optimization Techniques
                    </h4>

                    <div class="flex items-center space-x-2 mt-3">
                        <img src="{{ asset('images/user-4.jpg') }}"
                             class="w-6 h-6 rounded-full">
                        <span class="text-sm text-gray-600">David Park</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>

    </body>
</html>
