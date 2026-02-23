<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
/* use Illuminate\Container\Attributes\Auth; */
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
/* use Illuminate\Http\RedirectResponse; */

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //show all post (public)
    public function index(): View
    {
        $posts = Post::with(['user','category'])
            ->where('is_published', true)
            ->latest()
            ->paginate(9);

        return view('posts.index', compact('posts'));
    }

    //show single post (public)
    public function show(Post $post): View
    {
        $post->load(['user', 'category','comments.user']);
        return view('posts.show', compact('post'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'body' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'reading_time' => 'nullable|integer|min:1',
            'is_published' => 'boolean',
        ]);
        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // Set defaults
        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published', true);

        // Check for unique slug
        $originalSlug = $validated['slug'];
        $count = 1;
        while (Post::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $count++;
        }

        $post = Post::create($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    /* public function show(string $id) */
    /* { */
    /*     // */
    /* } */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        if ($post->user_id != Auth::id()){
            abort(403);
        }
        // delete
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post Deleted Successfully');
    }
}
