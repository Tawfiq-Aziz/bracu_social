<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function toggleLike(Request $request, $postId)
    {
        $userId = auth()->id();
        $post = Post::findOrFail($postId);
        
        // Check if user already liked or disliked this post
        $existingLike = Like::where('user_id', $userId)
                           ->where('post_id', $postId)
                           ->first();

        if ($existingLike) {
            if ($existingLike->type === 'like') {
                // User already liked, remove the like
                $existingLike->delete();
            } else {
                // User disliked, change to like
                $existingLike->update(['type' => 'like']);
            }
        } else {
            // No existing interaction, create a new like
            Like::create([
                'user_id' => $userId,
                'post_id' => $postId,
                'type' => 'like'
            ]);
        }

        return redirect()->back();
    }

    public function toggleDislike(Request $request, $postId)
    {
        $userId = auth()->id();
        $post = Post::findOrFail($postId);
        
        // Check if user already liked or disliked this post
        $existingLike = Like::where('user_id', $userId)
                           ->where('post_id', $postId)
                           ->first();

        if ($existingLike) {
            if ($existingLike->type === 'dislike') {
                // User already disliked, remove the dislike
                $existingLike->delete();
            } else {
                // User liked, change to dislike
                $existingLike->update(['type' => 'dislike']);
            }
        } else {
            // No existing interaction, create a new dislike
            Like::create([
                'user_id' => $userId,
                'post_id' => $postId,
                'type' => 'dislike'
            ]);
        }

        return redirect()->back();
    }

    public function addComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        $userId = auth()->id();
        $post = Post::findOrFail($postId);

        Comment::create([
            'user_id' => $userId,
            'post_id' => $postId,
            'comment' => $request->comment
        ]);

        return redirect()->back();
    }
}
