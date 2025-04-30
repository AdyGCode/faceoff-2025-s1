<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * Retrieves all users from the database, orders them by ID in descending order,
     * paginates the results to a maximum of 10 users per page, and returns them
     * as a success API response with a status code of 200.
     *
     * @return ApiResponse
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return ApiResponse::success($users, 'Users retrieved successfully.', 200);
    }

    /**
     * Store a newly created user in storage.
     *
     * Validates incoming data, handles default name generation,
     * uploads a profile photo if provided, and creates a new user record.
     *
     * @param  Request  $request
     * @return ApiResponse
     */
    public function store(Request $request)
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

        // Generate default name if not provided
        if (empty($request->name)) {
            if ($validated['given_name'] != null) {
                $validated['name'] = $validated['given_name'];
            } else {
                $validated['name'] = $validated['family_name'];
            }
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validated['profile_photo'] = $path;
        } else {
            $validated['profile_photo'] = "avatar.png";
        }

        $user = User::create($validated);

        return ApiResponse::success($user, 'User created successfully!', 201);
    }

    /**
     * Display the specified user.
     *
     * Retrieves a user record based on the provided ID.
     * Returns a 404 response if the user is not found.
     *
     * @param  string  $id
     * @return ApiResponse
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return ApiResponse::sendResponse(null, 'User not found', 404);
        }

        return ApiResponse::success($user, 'User retrieved successfully', 200);
    }

    /**
     * Update the specified user in storage.
     *
     * Validates incoming data, handles default name generation,
     * uploads a profile photo if provided, and updates the user record.
     *
     * @param  Request  $request
     * @param  string  $id
     * @return ApiResponse
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'given_name' => ['nullable', 'min:2', 'max:255', 'string'],
            'family_name' => ['nullable', 'min:2', 'max:255', 'string'],
            'name' => ['nullable', 'min:2', 'max:255', 'string'],
            'preferred_pronouns' => ['nullable', 'min:2', 'max:10', 'string'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['nullable', 'confirmed', 'min:4', 'max:255', Password::defaults()],
            'profile_photo' => ['nullable', 'string', 'min:4', 'max:255'],
        ]);

        $user = User::find($id);

        if (!$user) {
            return ApiResponse::sendResponse(null, 'User not found', 404);
        }

        // Hash password if provided
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Generate default name if not provided and existing name is null
        if (empty($request->name) && $user['name'] === null) {
            if ($validated['given_name'] != null) {
                $validated['name'] = $validated['given_name'];
            } else {
                $validated['name'] = $validated['family_name'];
            }
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validated['profile_photo'] = $path;
        } else {
            $validated['profile_photo'] = "avatar.png";
        }

        $user->update($validated);

        return ApiResponse::success($user, 'User updated successfully!', 200);
    }

    /**
     * Remove the specified user from storage.
     *
     * Deletes the user record based on the provided ID.
     * Returns a 404 response if the user is not found.
     *
     * @param  string  $id
     * @return ApiResponse
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return ApiResponse::sendResponse(null, 'User not found', 404);
        }

        $user->delete();

        return ApiResponse::sendResponse(null, 'User deleted successfully', 200);
    }
}
