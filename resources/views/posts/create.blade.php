<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Create New Post</h2>

                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" id="category_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Cover Image</label>
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Reading Time -->
                        <div>
                            <label for="reading_time" class="block text-sm font-medium text-gray-700">Reading Time (minutes)</label>
                            <input type="number" name="reading_time" id="reading_time" value="{{ old('reading_time', 5) }}" min="1"
                                class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Body with TinyMCE -->
                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="body" id="body" rows="10" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('body') }}</textarea>
                            @error('body')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publish Toggle -->
                        <div class="flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" value="1" checked
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_published" class="ml-2 block text-sm text-gray-900">
                                Publish immediately
                            </label>
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium">
                                Create Post
                            </button>
                            <a href="{{ route('posts.index') }}" class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50 font-medium text-gray-700">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TinyMCE CDN -->
    <script src="https://cdn.tiny.cloud/1/37ocefcebu7f8twq76nrtq1jf88ep2antflyqeygtkucjbw1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#body',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 400,
        });
    </script>
</x-app-layout>
