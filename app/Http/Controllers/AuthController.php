<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('register_error', 'Please resolve the errors.')
                ->with('open_register', true); // Flag to repoen modal
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        
        // Sync session cart to DB
        \App\Http\Controllers\CartController::syncSession($user->id);

        return redirect()->route('home')->with('success', 'Registration successful! Welcome to Nurah Perfumes.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Sync session cart to DB
            \App\Http\Controllers\CartController::syncSession(Auth::id());

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->with('open_login', true); // Flag to reopen modal
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            \Illuminate\Support\Facades\Log::info('Google Callback Started');
            
            // Bypass SSL verification for local development (cURL error 77 fix)
            $driver = \Laravel\Socialite\Facades\Socialite::driver('google');
            $driver->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));
            $googleUser = $driver->user();
            
            \Illuminate\Support\Facades\Log::info('Google User retrieved', ['email' => $googleUser->getEmail(), 'id' => $googleUser->getId()]);
        
            $user = User::where('google_id', $googleUser->getId())->first();
        
            if (!$user) {
                \Illuminate\Support\Facades\Log::info('User by Google ID not found. Checking by Email.');
                
                // Check if user exists with same email, link account if so
                $user = User::where('email', $googleUser->getEmail())->first();
        
                if ($user) {
                    \Illuminate\Support\Facades\Log::info('User found by email. Updating Google ID.');
                    $user->update(['google_id' => $googleUser->getId()]);
                } else {
                    \Illuminate\Support\Facades\Log::info('Creating new user.');
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'password' => Hash::make(\Illuminate\Support\Str::random(16)), // Random password
                        'email_verified_at' => now(), // Auto-verify Google users
                    ]);
                    \Illuminate\Support\Facades\Log::info('New user created.');
                }
            }
        
            Auth::login($user);
            \Illuminate\Support\Facades\Log::info('User logged in.');
            
            // Sync session cart to DB
            \App\Http\Controllers\CartController::syncSession(Auth::id());
        
            return redirect()->route('home')->with('success', 'Logged in with Google successfully!');
        
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Google Login Error: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error($e->getTraceAsString());
            return redirect()->route('home')->with('error', 'Google Login failed: ' . $e->getMessage());
        }
    }
}
