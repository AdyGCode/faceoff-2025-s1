<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
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
        $validated = $request->validate([
            'given_name' => ['nullable', 'min:2', 'max:255', 'string', 'required_without:family_name'],
            'family_name' => ['nullable', 'min:2', 'max:255', 'string', 'required_without:given_name'],
            'name' => ['nullable', 'min:2', 'max:255', 'string'],
            'preferred_pronouns' => ['required', 'min:2', 'max:10', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class,],
            'password' => ['required', 'confirmed', 'min:4', 'max:255', Password::defaults(),],
            'profile_photo' => ['nullable', 'file', 'mimes:jpg,png,jpeg', 'max:51200'],
        ]);

        /**
         * Check if name is not provided use given / family name as default
         */
        if (empty($request->name)) {
            if ($validated['given_name'] != null) {
                $validated['name'] = $validated['given_name'];
            } else {
                $validated['name'] = $validated['family_name'];
            }
        }

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validated['profile_photo'] = $path;
        } else {
            $validated['profile_photo'] = "avatar.png";
        }

        $user = User::create($validated);
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard.index', absolute: false));
    }
}
