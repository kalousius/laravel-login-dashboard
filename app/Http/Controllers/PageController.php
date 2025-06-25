<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;   // ✅ Required for Hash::check
use App\Models\User;                   // ✅ Required to use User model

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function login()
    {
        return view('login');
    }

    public function contact()
    {
        return view('contact');
    }

    public function submitContact(Request $request)
    {
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function submitLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            $request->session()->put('username', $user->username);
            return redirect()->route('dashboard')->with('login_status', 'Login successful!');
        } else {
            return redirect()->route('login')->with('login_status', 'Login failed. Invalid username or password.');
        }
    }
}
