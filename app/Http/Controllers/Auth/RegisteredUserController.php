<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nickname' => 'required',
            'gender' => 'required|in:male,female',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create new user
        $user = User::create([
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'seeking' => null, // Set seeking to null explicitly or provide a default value
            'age' => null, // Set age to null explicitly or provide a default value
            'country' => null, // Set country to null explicitly or provide a default value
            'i_speak' => null, // Set i_speak to null explicitly or provide a default value
            'whatsapp' => null, // Set whatsapp to null explicitly or provide a default value
            'photos' => null, // Set photos to null explicitly or provide a default value
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect(RouteServiceProvider::HOME);
        Auth::login($user);
        event(new Registered($user));
    }
}
