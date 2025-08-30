<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'department' => ['required' , 'min:3', 'max:50'],
            'student_id' => ['required', 'min:8', 'max:9', 'unique:users'],
            'password' => ['required', 'min:3', 'max:200']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        User::create($incomingFields);

        return redirect('/login');
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($incomingFields)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function searchUsers(Request $request){
        $query = $request->get('query');
        
        if (empty($query)) {
            return response()->json([]);
        }

        $users = User::where('name', 'LIKE', "%{$query}%")
                    ->where('id', '!=', auth()->id()) // Exclude current user
                    ->select('id', 'name', 'department', 'student_id')
                    ->limit(10)
                    ->get();

        return response()->json($users);
    }

    public function showUserProfile($userId){
        $user = User::findOrFail($userId);
        $posts = $user->userPosts()->orderBy('created_at', 'desc')->get();
        
        return view('user-profile', ['user' => $user, 'posts' => $posts]);
    }
}
