<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
}
