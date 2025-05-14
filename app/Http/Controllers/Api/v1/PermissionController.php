<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StorePermissionRequest;
use App\Http\Requests\v1\UpdatePermissionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\ApiResponse;

class PermissionController extends Controller
{
    /**
     * Display a listing of the permissions.
     */
    public function index(): JsonResponse
    {
        return APIResponse::success(
            Permission::all(),
            'Permissions retrieved successfully.'
        );
    }

    /**
     * Store a newly created permission in storage.
     */
    public function store(StorePermissionRequest $request): JsonResponse
    {
        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return APIResponse::success(
            $permission,
            'Permission created successfully.',
            201
        );
    }

    /**
     * Display the specified permission.
     */
    public function show(Permission $permission): JsonResponse
    {
        return ApiResponse::success(
            $permission,
            'Permission retrieved successfully.',
        );
    }

    /**
     * Update the specified permission in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): JsonResponse
    {
        $request->update([
            'name' => $request->name,
        ]);

        return APIResponse::success(
            $permission,
            'Permission updated successfully.',
        );
    }

    /**
     * Remove the specified permission from storage.
     */
    public function destroy(Permission $permission): JsonResponse
    {
        $permission->delete();

        return ApiResponse::success(
            [],
            'Permission deleted successfully.',
            204
        );
    }
}
