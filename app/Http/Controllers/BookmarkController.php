<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class BookmarkController extends Controller
{
    public function toggle(Post $post): RedirectResponse
    {
        // make sure user is logged
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $bookmark = Bookmark::where('post_id', $post->id)
        ->where('user_id', Auth::id())
        ->first();
        if ($bookmark) {
            $bookmark->delete();
        } else {
            Bookmark::create([
                'post_id' => $post->id,
                'user_id' => Auth::id(),
            ]);
        }
        return redirect()->back();
    }

    /* fetchting bookmartks */
    public function bookmarks()
    {
        $bookmarkedPosts = auth()->user()
            ->bookmarks() // assuming a bookmarks() relationship on User
            ->with('post.user', 'post.category')
            ->latest()
            ->get()
            ->pluck('post'); // only get the posts

        return view('bookmarks.index', compact('bookmarkedPosts'));
    }

}
