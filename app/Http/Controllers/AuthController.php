<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return Auth::user()->isOwner()
                ? redirect()->route('owner.dashboard')
                : redirect()->route('home');
        }

        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if (Auth::user()->isOwner()) {
                return redirect()->intended(route('owner.dashboard'))->with('success', 'Welcome back, '.Auth::user()->name.'!');
            }

            return redirect()->intended(route('home'))->with('success', 'Welcome back, '.Auth::user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'phone' => ['required', 'string', 'max:25'],
            'address' => ['nullable', 'string', 'max:500'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'] ?? null,
            'role' => 'customer',
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Account created successfully! Welcome to Foodie Express.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('info', 'You have been logged out.');
    }

    /**
     * Demo login helper for rapid presentation switching
     */
    public function demoLogin(string $role): RedirectResponse
    {
        $email = $role === 'owner' ? 'owner@fooddelivery.com' : 'customer@fooddelivery.com';
        $user = User::where('email', $email)->first();

        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();

            if ($user->isOwner()) {
                return redirect()->route('owner.dashboard')->with('success', 'សូមស្វាគមន៍មកកាន់ផ្ទាំងគ្រប់គ្រង! (Welcome back, '.$user->name.')');
            }

            return redirect()->route('home')->with('success', 'សូមស្វាគមន៍មកកាន់ភោជនីយដ្ឋាន! (Welcome back, '.$user->name.')');
        }

        return redirect()->route('login')->with('error', 'Demo user not found. Please run seeders.');
    }
}
