<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="md:flex">
        <!-- Left: Blog Image -->
        <div class="md:w-1/2">
            <img src="{{ asset('images/laravel.jpg') }}"
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
                </div>

            <a href="https://laravel.com/docs"
               target="_blank"
               rel="noopener noreferrer"
               class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                Read More →
            </a>
            </div>
        </div>
    </div>
</div>
