<!-- resources/views/welcome.blade.php or any .blade.php file -->
<!DOCTYPE html>
<html lang="en">
    <head>
        @vite('resources/css/app.css')
        <title>My Blog</title>
    </head>
    <body class="bg-gray-100">

        <!-- Navigation -->
<!-- Navigation -->
<nav class="bg-white shadow-lg p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold text-blue-600">Blog Platform</h1>

        <div class="space-x-4 flex items-center">
            @auth
                <!-- LOGGED IN: Show Profile Dropdown -->
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 focus:outline-none py-2">
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
        <main class="container mx-auto mt-8 px-4">

            <!-- Card Example -->
            <div class="bg-white rounded-lg shadow-md p-6 max-w-md">
                <h2 class="text-xl font-semibold mb-2">User Profile</h2>

                <!-- Avatar with your custom attribute -->
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/default-avatar.png') }}"
                        class="w-16 h-16 rounded-full border-2 border-blue-500">
                    <div>
                        <p class="text-gray-800 font-medium">John Doe</p>
                        <p class="text-gray-500 text-sm">Developer</p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-4 flex space-x-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Follow
                    </button>
                    <button class="border border-gray-300 px-4 py-2 rounded hover:bg-gray-50">
                        Message
                    </button>
                </div>
            </div>

        </main>

    </body>
</html>
