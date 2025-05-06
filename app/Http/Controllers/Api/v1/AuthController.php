<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\LoginAuthRequest;
use App\Http\Requests\v1\RegisterAuthRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Register a new user.
     *
     * Validates the incoming request data, assigns a default name if not provided,
     * handles profile photo upload, creates the user, and returns an authentication token.
     *
     * @param  Request  $request
     * @return JsonResponse 
     */
    public function register(RegisterAuthRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Hash password if provided
        $validated['password'] = Hash::make($validated['password']);

        // Generate default name if not provided
        if (empty($validated['name'])) {
            $validated['name'] = $validated['given_name'] ?? $validated['family_name'];
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
     * @return JsonResponse
     */
    public function login(LoginAuthRequest $request): JsonResponse
    {
        $request->validated();

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
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return ApiResponse::success(null, 'You are logged out.', 200);
    }
}
