<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\userController;

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
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get(); 
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