<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showAll()
    {
        $users = User::get();
        return view('users', compact('users'));
    }

    public function store()
    {
        return view('regist');
    }

    public function Register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('posts.index')->with('success', 'Registered successfully');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $creds = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($creds)) {
            $request->session()->regenerate();
            return redirect()->route('posts.index')->with('success', 'Logged in successfully');
        }

        return back()->withErrors([
            'email' => 'Wrong Creds',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('users.login.view')->with('success', 'Logout successfully');
    }
}
