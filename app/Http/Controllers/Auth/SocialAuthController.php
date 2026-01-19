<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthController extends Controller
{

    // GitHub redirect
    public function redirectGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    // GitHub callback
    public function callbackGithub()
    {
        $githubUser = Socialite::driver('github')->stateless()->user();

       $user = User::where('email', $githubUser->email)->first();

        if ($user) {
            // Jika user sudah ada, update provider info
            $user->provider = 'github';
            $user->provider_id = $githubUser->id;
            $user->avatar = $githubUser->avatar;
            $user->save();
        } else {
            // Jika belum ada, buat user baru
            $user = User::create([
                'name' => $githubUser->name ?? $githubUser->nickname,
                'email' => $githubUser->email ?? $githubUser->id.'@github.com',
                'avatar' => $githubUser->avatar,
                'provider' => 'github',
                'provider_id' => $githubUser->id,
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(32)),
            ]);
        }

        Auth::login($user, true);
        request()->session()->regenerate();

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('dashboard'));
    }


    /**
     * Redirect ke Google OAuth
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback dari Google
     */
    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // 1️⃣ PRIORITAS: cari user berdasarkan EMAIL
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            // 2️⃣ USER LAMA → LINK GOOGLE
            $user->update([
                'provider'          => 'google',
                'provider_id'       => $googleUser->id,
                'avatar'            => $googleUser->avatar,
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
        } else {
            // 3️⃣ USER BARU → CREATE
            $user = User::create([
                'name'              => $googleUser->name ?? 'Google User',
                'email'             => $googleUser->email,
                'avatar'            => $googleUser->avatar,
                'provider'          => 'google',
                'provider_id'       => $googleUser->id,
                'email_verified_at' => now(),
                'password'          => Hash::make(Str::random(32)),
                'role'              => 'user',
            ]);
        }

        // 4️⃣ LOGIN + REGENERATE SESSION
        Auth::login($user, true);
        request()->session()->regenerate();

        return redirect()->intended('/dashboard');
    }
}
