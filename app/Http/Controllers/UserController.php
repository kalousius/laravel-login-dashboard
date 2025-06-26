<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display list of users
    public function index()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    // Show form to edit a specific user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update user info
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'role' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'phone', 'username', 'role'));

        return redirect()->route('users.list')->with('success', 'User updated successfully!');
    }

    // Delete a user
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.list')->with('success', 'User deleted successfully!');
    }
}
