<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment.
     */
    public function store(Request $request, Post $post): RedirectResponse
    {
        $validated = $request->validate([
            'body' => 'required|string|min:2|max:1000',
        ]);

        /* dd($validated); */
        /* echo $validated; */

        /* $comment = Comment::create([ */
        /*     'post_id' => $post->id, */
        /*     /* 'user_id' => auth()->id(), */
        /*     'user_id' => Auth::id(), */
        /*     'body' => $validated['body'], */
        /* ]); */
        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->body = $validated['body'];
        $comment->save();


        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment added successfully!');
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        // Check if user owns the comment or owns the post
        if ($comment->user_id !== Auth::id() && $comment->post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $postId = $comment->post_id;
        $comment->delete();

        return redirect()->route('posts.show', $postId)
            ->with('success', 'Comment deleted successfully!');
    }
}
