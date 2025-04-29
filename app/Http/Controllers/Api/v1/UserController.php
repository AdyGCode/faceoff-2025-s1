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
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return ApiResponse::success($users, 'Users retrieved successfully.', 200);
    }

    /**
     * Store a newly created resource in storage.
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

        return ApiResponse::success($user, 'User created successfully!', 201);
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
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

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        /**
         * Check if name is not provided use given / family name as default
         * If target user has their own name, it keeps previous value
         */
        if (empty($request->name) && $user['name'] === null) {
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

        $user->update($validated);

        return ApiResponse::success($user, 'User updated successfully!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
