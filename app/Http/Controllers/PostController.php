<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function updatePost(Post $post, Request $request) {
        //first argu gives us post we want to update, 2nd gives incoming form data
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/dashboard');
        }
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect('/dashboard');
    }

    
    public function showEditScreen(Post $post) {
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/dashboard');
        }
        return view('edit-post', ['post'=>$post]);
    }


    public function creatPost(Request $request) {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        
        Post::create($incomingFields);
        return redirect('/dashboard');
    }
}
