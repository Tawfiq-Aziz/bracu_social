<?php

use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

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
        return view('dashboard');
    }
    return redirect('/login');
});

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
}); 