<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google OAuth consent screen.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     * Creates the user if they don't exist, then logs them in.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            Log::error('Google OAuth error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect('/login')->withErrors(['email' => 'Google sign-in failed: ' . $e->getMessage()]);
        }

        try {
            // Find or create the user
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name'       => $googleUser->getName() ?: 'Student',
                    'password'   => bcrypt(Str::random(32)),
                    'department' => null,
                    'student_id' => null,
                ]
            );

            Auth::login($user, true);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            Log::error('Google User Creation Error: ' . $e->getMessage());
            return redirect('/login')->withErrors(['email' => 'Could not create account: ' . $e->getMessage()]);
        }
    }
}
