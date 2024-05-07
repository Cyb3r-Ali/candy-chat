<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Don't forget to import the User model
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all users ordered by creation date descending and send them to the index page
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'nickname' => 'required',
            'gender' => 'required|in:Male,Female,male,female',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create new user
        $user = new User();
        $user->nickname = $request->nickname;
        $user->gender = $request->gender;
        $user->seeking = $request->seeking ?? null;
        $user->age = $request->age ?? null;
        $user->country = $request->country ?? null;
        $user->i_speak = $request->i_speak ?? null;
        $user->whatsapp = $request->whatsapp ?? null;
        $user->photos = null; // Set photos to null explicitly or provide a default value
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'nickname' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'gender' => 'required|in:male,female,Male,Female',
            'seeking' => 'nullable',
            'age' => 'nullable|numeric',
            'country' => 'nullable',
            'i_speak' => 'nullable',
            'whatsapp' => 'nullable',
        ]);

        // Find the user
        $user = User::findOrFail($id);

        // Update user data
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->gender = $request->gender;
        $user->seeking = $request->seeking;
        $user->age = $request->age;
        $user->country = $request->country;
        $user->i_speak = $request->i_speak;
        $user->whatsapp = $request->whatsapp;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Delete user
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
