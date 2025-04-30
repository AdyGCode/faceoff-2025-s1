<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    /**
     * Register a new user.
     *
     * Validates the incoming request data, assigns a default name if not provided,
     * handles profile photo upload, creates the user, and returns an authentication token.
     *
     * @param  Request  $request
     * @return ApiResponse 
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'given_name' => ['required_without:family_name', 'min:2', 'max:255', 'string'],
            'family_name' => ['required_without:given_name', 'min:2', 'max:255', 'string'],
            'name' => ['nullable', 'min:2', 'max:255', 'string'],
            'preferred_pronouns' => ['required', 'min:2', 'max:10', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', 'min:4', 'max:255', Password::defaults()],
            'profile_photo' => ['nullable', 'string', 'min:4', 'max:255'],
        ]);

        // Hash password if provided
        $validated['password'] = Hash::make($validated['password']);

        // Generate default name if not provided
        if (empty($request->name)) {
            if ($validated['given_name'] != null) {
                $validated['name'] = $validated['given_name'];
            } else {
                $validated['name'] = $validated['family_name'];
            }
        }

        // Handle profile photo set default
        $validated['profile_photo'] = "avatar.png";

        $user = User::create($validated);

        $token = $user->createToken($request->email);


        return ApiResponse::success([
            'user' => $user,
            'token' => $token->plainTextToken
        ], 'You are registered successfully!', 201);
    }

    /**
     * Authenticate a user and issue an access token.
     *
     * Validates the provided credentials, checks for user existence, and returns
     * an authentication token upon successful authentication.
     *
     * @param  Request  $request 
     * @return ApiResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::defaults(),]
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return ApiResponse::error(null, 'The provided credentials are incorrect.', 401);
        }


        $token = $user->createToken($user->email);


        return ApiResponse::success([
            'user' => $user,
            'role' => $user->roles,
            'token' => $token->plainTextToken
        ], 'You are logged in.', 200);
    }

    /**
     * Log out the authenticated user.
     *
     * Revokes all tokens associated with the authenticated user, effectively logging them out.
     *
     * @param  Request  $request
     * @return ApiResponse
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return ApiResponse::success(null, 'You are logged out.', 200);
    }
}
