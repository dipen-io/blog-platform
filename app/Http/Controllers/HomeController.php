<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // fetch four latest post
        $latestPosts = Post::with(['user', 'category'])
            ->where('is_published', true)
            ->latest()
            ->take(4)
            ->get();
        return view('welcome', compact('latestPosts'));
    }
}
