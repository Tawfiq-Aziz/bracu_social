<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anonymous' => 'nullable|boolean',
            'lost_and_found' => 'nullable|boolean'
        ]);

        // If it's a poll post, make title and body optional
        if ($post->poll && !$post->title && !$post->body) {
            $incomingFields['title'] = $request->title ? strip_tags($request->title) : null;
            $incomingFields['body'] = $request->body ? strip_tags($request->body) : null;
        } else {
            // Regular post requires title and body
            if (empty($request->title) || empty($request->body)) {
                return redirect('/dashboard')->with('error', 'Post title and body are required for regular posts.');
            }
            $incomingFields['title'] = strip_tags($request->title);
            $incomingFields['body'] = strip_tags($request->body);
        }
        
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
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'anonymous' => 'nullable|boolean',
            'lost_and_found' => 'nullable|boolean',
            'has_poll' => 'nullable|boolean',
            'poll_question' => 'nullable|string|required_if:has_poll,1',
            'poll_options' => 'nullable|array|required_if:has_poll,1|min:2',
            'poll_options.*' => 'nullable|string|max:255',
            'poll_multiple_choice' => 'nullable|boolean'
        ]);

        // If it's a poll-only post, make title and body optional
        if ($request->has('has_poll') && $request->poll_question) {
            $incomingFields['title'] = $request->title ? strip_tags($request->title) : null;
            $incomingFields['body'] = $request->body ? strip_tags($request->body) : null;
        } else {
            // Regular post requires title and body
            if (empty($request->title) || empty($request->body)) {
                return redirect('/dashboard')->with('error', 'Post title and body are required for regular posts.');
            }
            $incomingFields['title'] = strip_tags($request->title);
            $incomingFields['body'] = strip_tags($request->body);
        }

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
        
        DB::transaction(function () use ($incomingFields, $request) {
            $post = Post::create($incomingFields);
            
            // Create poll if requested
            if ($request->has('has_poll') && $request->poll_question) {
                $poll = Poll::create([
                    'post_id' => $post->id,
                    'question' => strip_tags($request->poll_question),
                    'multiple_choice' => $request->has('poll_multiple_choice') ? true : false
                ]);
                
                // Create poll options
                if ($request->poll_options) {
                    foreach ($request->poll_options as $optionText) {
                        if (!empty(trim($optionText))) {
                            PollOption::create([
                                'poll_id' => $poll->id,
                                'option_text' => strip_tags(trim($optionText))
                            ]);
                        }
                    }
                }
            }
        });
        
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
