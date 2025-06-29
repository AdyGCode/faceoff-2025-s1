<?php

namespace App\Http\Controllers\Api\v1;

use App\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\v1\StoreUserRequest;
use App\Http\Requests\v1\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * Retrieves all users from the database, orders them by ID in descending order,
     * paginates the results to a maximum of 10 users per page, and returns them
     * as a success API response with a status code of 200.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $authUser = Auth::user();

        if (!in_array($authUser->role, ['admin', 'super-admin'])) {
            return ApiResponse::error(false, 'You are not authorized to perform this action.', 403);
        }

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
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $authUser = Auth::user();

        if (!in_array($authUser->role, ['admin', 'super-admin'])) {
            return ApiResponse::error(false, 'You are not authorized to perform this action.', 403);
        }

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        // Generate default name if not provided
        if (empty($validated['name'])) {
            $validated['name'] = $validated['given_name'] ?? $validated['family_name'];
        }

        // Handle profile photo set default
        $validated['profile_photo'] = "avatar.png";

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
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $authUser = Auth::user();

        if (!in_array($authUser->role, ['admin', 'super-admin'])) {
            return ApiResponse::error(false, 'You are not authorized to perform this action.', 403);
        }

        $user = User::find($id);
        if (!$user) {
            return ApiResponse::error(null, 'User not found', 404);
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
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, string $id): JsonResponse
    {
        $authUser = Auth::user();
        $user = User::find($id);

        if (!$user) {
            return ApiResponse::error(null, 'User not found', 404);
        }

        if (!in_array($authUser->role, ['admin', 'super-admin']) && $authUser->id !== $user->id) {
            return ApiResponse::error(false, 'You are not authorized to perform this action.', 403);
        }

        $validated = $request->validated();

        // Hash password if provided
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Generate default name if not provided and user's current name is null
        if (empty($validated['name']) && $user->name === null) {
            $validated['name'] = $validated['given_name'] ?? $validated['family_name'];
        }

        // Handle profile photo upload
        if ($request->profile_photo == "") {
            unset($validated['profile_photo']);
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
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $authUser = Auth::user();
        $user = User::find($id);

        if (!$user) {
            return ApiResponse::error(null, 'User not found', 404);
        }
        
        if (!in_array($authUser->role, ['admin', 'super-admin']) && $authUser->id !== $user->id) {
            return ApiResponse::error(false, 'You are not authorized to perform this action.', 403);
        }
        



        $user->delete();

        return ApiResponse::sendResponse(null, 'User deleted successfully', 200);
    }
}
