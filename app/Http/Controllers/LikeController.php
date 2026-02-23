<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LikeController extends Controller
{
    public function toggle(Post $post): RedirectResponse
    {
        $user = Auth::user();

        // check if already liked
        $existingLikes = Like::where('user_id', $user->id)
        ->where('post_id', $post->id)
        ->first();

        if ($existingLikes) {
            // Unlike
            $existingLikes->delete();
            $message = 'Post Unliked!';
        } else {
            // Like
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
            $message = 'Post Liked!';
        }
        return back()->with('success', $message);
    }
}
