<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'email' => strtolower($validated['email']),
            'password' => Hash::make($validated['password']),
            'role' => 'anggota',
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'anggota') {
            return redirect('/anggota/dashboard');
        }

        return redirect('/anggota/dashboard');
    }
}