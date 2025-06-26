<?php

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;

Route::get('/', [PageController::class, 'home']);
Route::get('/login', [PageController::class, 'login']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/users', [UserController::class, 'index'])->name('users.list');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

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

Route::get('/profile', function () {
    // ✅ Protect access: user must be logged in
    if (!session()->has('username')) {
        return redirect('/login')->with('login_status', 'Please log in to access your profile.');
    }

    $username = session('username');

    $user = \App\Models\User::where('username', $username)->first();

    if (!$user) {
        return redirect('/login')->with('login_status', 'Session expired. Please log in again.');
    }

    return view('profile', compact('user'));
})->name('profile');

Route::get('/profile/edit', function () {
    if (!session()->has('username')) {
        return redirect('/login')->with('login_status', 'Please log in first.');
    }

    $username = session('username');
    $user = User::where('username', $username)->first();

    return view('edit-profile', compact('user'));
})->name('profile.edit');
//Handle Update Submission //
Route::post('/profile/update', function (Request $request) {
    if (!session()->has('username')) {
        return redirect('/login')->with('login_status', 'Session expired. Log in again.');
    }

    $username = session('username');

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    $user = User::where('username', $username)->first();

    if ($user) {
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
    }

    return redirect()->route('profile')->with('login_status', 'Profile updated successfully!');
})->name('profile.update');
//create new users on the Dashboard.blade.php//
Route::get('/users', function () {
    if (!session()->has('username')) {
        return redirect('/login')->with('login_status', 'Login required.');
    }

    $currentUser = User::where('username', session('username'))->first();

    if (!$currentUser || $currentUser->role !== 'admin') {
        return redirect('/')->with('login_status', 'Only admins can view user list.');
    }

    $users = User::all();
    return view('users.index', compact('users'));
})->name('users.list');
