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


public function createPost(Request $request) {
    // Determine if this is a poll post
    $isPollPost = $request->has('has_poll') && $request->poll_question && !empty(trim($request->poll_question));
    
    // Set validation rules based on post type
    $validationRules = [
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'anonymous' => 'nullable|boolean',
        'lost_and_found' => 'nullable|boolean',
        'has_poll' => 'nullable|boolean',
        'poll_question' => 'nullable|string|max:255',
        'poll_options' => 'nullable|array|max:6',
        'poll_options.*' => 'nullable|string|max:255',
        'poll_multiple_choice' => 'nullable|boolean'
    ];
    
    if ($isPollPost) {
        // For poll posts, title and body are optional
        $validationRules['title'] = 'nullable|string|max:255';
        $validationRules['body'] = 'nullable|string';
        $validationRules['poll_question'] = 'required|string|max:255';
        $validationRules['poll_options'] = 'required|array|min:2|max:6';
    } else {
        // For regular posts, title and body are required
        $validationRules['title'] = 'required|string|max:255';
        $validationRules['body'] = 'required|string';
    }
    
    $incomingFields = $request->validate($validationRules);

    // Process title and body based on post type
    if ($isPollPost) {
        // For poll posts, title and body are optional
        $incomingFields['title'] = $request->title ? strip_tags($request->title) : null;
        $incomingFields['body'] = $request->body ? strip_tags($request->body) : null;
    } else {
        // For regular posts, title and body are required (already validated above)
        $incomingFields['title'] = strip_tags($request->title);
        $incomingFields['body'] = strip_tags($request->body);
    }

    $incomingFields['user_id'] = auth()->id();
    $incomingFields['anonymous'] = $request->has('anonymous');
    $incomingFields['lost_and_found'] = $request->has('lost_and_found');

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $incomingFields['image'] = 'images/' . $imageName;
    }

    try {
        $post = DB::transaction(function () use ($incomingFields, $request, $isPollPost) {
            $post = Post::create($incomingFields);

            if ($isPollPost) {
                $poll = Poll::create([
                    'post_id' => $post->id,
                    'question' => strip_tags($request->poll_question),
                    'multiple_choice' => $request->has('poll_multiple_choice'),
                ]);

                // Filter out empty poll options and create them
                $validOptions = array_filter($request->poll_options ?? [], function($option) {
                    return !empty(trim($option));
                });
                
                foreach ($validOptions as $optionText) {
                    PollOption::create([
                        'poll_id' => $poll->id,
                        'option_text' => strip_tags(trim($optionText)),
                    ]);
                }
            }
            
            return $post;
        });

        return redirect('/dashboard')->with('success', 'Post created successfully!');
    } catch (\Exception $e) {
        \Log::error('Post creation failed: ' . $e->getMessage());
        return redirect('/dashboard')->with('error', 'Failed to create post: ' . $e->getMessage());
    }
}


    public function markAsResolved(Post $post) {
        if (auth()->user()->id != $post['user_id']) {
            return redirect('/dashboard');
        }
        
        $post->update(['resolved' => true]);
        return redirect('/dashboard');
    }
}
