<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function deletePost(Post $post) {
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/dashboard');
        }
        $post->delete();
        return redirect('/dashboard');
    }


    public function updatePost(Post $post, Request $request) {
        //first argu gives us post we want to update, 2nd gives incoming form data
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/dashboard');
        }
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anonymous' => 'nullable|boolean',
            'lost_and_found' => 'nullable|boolean'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['anonymous'] = $request->has('anonymous') ? true : false;
        $incomingFields['lost_and_found'] = $request->has('lost_and_found') ? true : false;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $incomingFields['image'] = 'images/' . $imageName;
        }

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
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anonymous' => 'nullable|boolean',
            'lost_and_found' => 'nullable|boolean'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        $incomingFields['anonymous'] = $request->has('anonymous') ? true : false;
        $incomingFields['lost_and_found'] = $request->has('lost_and_found') ? true : false;
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $incomingFields['image'] = 'images/' . $imageName;
        }
        
        Post::create($incomingFields);
        return redirect('/dashboard');
    }

    public function markAsResolved(Post $post) {
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/dashboard');
        }
        
        $post->update(['resolved' => true]);
        return redirect('/dashboard');
    }
}
