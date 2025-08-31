<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\userController;
use App\Http\Controllers\InteractionController;

Route::get('/', function () {
    return view('home');
});



Route::post('/register', [userController::class, 'register']);



Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [userController::class, 'login']);



Route::get('/dashboard', function () {
    if (auth()->check()) {
        $posts = Post::with(['user', 'likes', 'comments.user'])->orderBy('created_at', 'desc')->get(); 
        // to show all posts from the db with user info, sorted by date
        return view('dashboard',['posts' => $posts]);
    }
    return redirect('/login');
});



Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
}); 


//Blog post route
Route::post('/create-post',[PostController::class, 'creatPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

// User profile route
Route::get('/profile', function (App\Models\User $user) {
    $posts = Post::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
    return view('profile', ['user' => $user, 'posts' => $posts]);
});

// Search and user profile routes
Route::get('/search-users', [userController::class, 'searchUsers']);
Route::get('/user/{userId}', [userController::class, 'showUserProfile']);


// Interaction routes
Route::post('/posts/{post}/like', [InteractionController::class, 'toggleLike']);
Route::post('/posts/{post}/dislike', [InteractionController::class, 'toggleDislike']);
Route::post('/posts/{post}/comment', [InteractionController::class, 'addComment']);