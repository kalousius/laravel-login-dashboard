<?php

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', [PageController::class, 'home']);
Route::get('/login', [PageController::class, 'login']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Look up user by username
    $user = User::where('username', $username)->first();

    // Verify user exists and password is correct
    if ($user && Hash::check($password, $user->password)) {
        // Save session and redirect to dashboard
        $request->session()->put('username', $user->username);
        return redirect()->route('dashboard')->with('login_status', 'Login successful!');
    } else {
        return redirect()->route('login')->with('login_status', 'Login failed. Invalid username or password.');
    }
})->name('login.submit');


Route::post('/register', function (Illuminate\Http\Request $request) {
    // Just returning data to simulate saving for now
    return redirect('/login')->with('login_status', 'Registration submitted for ' . $request->input('username'));
})->name('register.submit');

Route::get('/dashboard', function () {
    $username = session('username');
    return view('dashboard', compact('username'));
})->name('dashboard');

Route::post('/logout', function (Request $request) {
    // Add your logout logic (session destroy, etc.)
    return redirect('/login')->with('login_status', 'You have been logged out.');
})->name('logout');

Route::post('/register', function (Request $request) {
    // Validate
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'username' => 'required|string|max:50|unique:users,username',
        'password' => 'required|string|min:6',
    ]);

    // Save to DB
    $user = User::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'username' => $request->username,
        'password' => Hash::make($request->password),
    ]);

    // Store in session & redirect
    $request->session()->put('username', $user->username);

    return redirect()->route('dashboard')->with('login_status', 'Registration successful!');
})->name('register.submit');
