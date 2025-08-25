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

        return 'HELLO FROM OUR CONTROLLER';
    }
}
