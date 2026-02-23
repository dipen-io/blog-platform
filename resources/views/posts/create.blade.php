<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Create New Post</h2>

                    <form method="POST" action="{{ route('posts.store') }}"
                          enctype="multipart/form-data"
                          onsubmit="return validateForm();">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
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
                        <div class="mb-4">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700">Cover Image</label>
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Reading Time -->
                        <div class="mb-4">
                            <label for="reading_time" class="block text-sm font-medium text-gray-700">Reading Time (minutes)</label>
                            <input type="number" name="reading_time" id="reading_time" value="{{ old('reading_time', 5) }}" min="1"
                                class="mt-1 block w-32 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <!-- Body - NO REQUIRED ATTRIBUTE -->
                        <div class="mb-4">
                            <label for="body" class="block text-sm font-medium text-gray-700">Content *</label>
                            <textarea name="body" id="body" rows="10"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('body') }}</textarea>
                            @error('body')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p id="body-error" class="mt-1 text-sm text-red-600 hidden">Content is required</p>
                        </div>

                        <!-- Publish Toggle -->
                        <div class="mb-6 flex items-center">
                            <input type="checkbox" name="is_published" id="is_published" value="1" checked
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_published" class="ml-2 block text-sm text-gray-900">
                                Publish immediately
                            </label>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center space-x-4">
                            <button type="submit" id="submit-btn" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium flex items-center">
                                <span id="btn-text">Create Post</span>
                                <svg id="spinner" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>

                            <a href="{{ route('posts.index') }}" id="cancel-btn" class="border border-gray-300 px-6 py-2 rounded-lg hover:bg-gray-50 font-medium text-gray-700">
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
    // Initialize TinyMCE
    tinymce.init({
        selector: '#body',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 400,

        setup: function (editor) {
            editor.on('change input blur', function () {
                editor.save();
            });
        }
    });

    // Validation with loading state
    function validateForm() {
        tinymce.triggerSave();

        var bodyContent = document.getElementById('body').value.trim();

        if (!bodyContent) {
            document.getElementById('body-error').classList.remove('hidden');
            tinymce.get('body').focus();
            return false;
        }

        document.getElementById('body-error').classList.add('hidden');

        // Show spinner, disable button
        document.getElementById('btn-text').textContent = 'Creating...';
        document.getElementById('spinner').classList.remove('hidden');
        document.getElementById('submit-btn').disabled = true;
        document.getElementById('submit-btn').classList.add('opacity-75', 'cursor-not-allowed');
        document.getElementById('cancel-btn').classList.add('pointer-events-none', 'opacity-50');

        return true; // Allow submit
    }
</script>
</x-app-layout>/x-app-layout>



    <!-- <script src="https://cdn.tiny.cloud/1/37ocefcebu7f8twq76nrtq1jf88ep2antflyqeygtkucjbw1/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
