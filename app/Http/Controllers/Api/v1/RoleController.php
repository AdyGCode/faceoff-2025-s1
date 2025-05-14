<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreRoleRequest;
use App\Http\Requests\v1\UpdateRoleRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\ApiResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * Retrieves all roles with their corresponding permissions and returns
     * them in a success API response with a 200 status code.
     */
    public function index(): JsonResponse
    {
        $roles = Role::with('permissions')->get();

        return ApiResponse::success($roles, 'Roles retrieved successfully.', 200);
    }

    /**
     * Store a newly created role in storage.
     *
     * Validates incoming data using StoreRoleRequest, creates the role,
     * and attaches the specified permissions if provided.
     *
     * @param StoreRoleRequest $request
     * @return JsonResponse
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $role = Role::create(['name' => $validated['name']]);

        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return ApiResponse::success(
            $role->load('permissions'),
            'Role created successfully.',
            201
        );
    }

    /**
     * Display the specified role.
     *
     * Returns the given role along with its permissions in a success
     * API response.
     */
    public function show(Role $role): JsonResponse
    {
        return ApiResponse::success(
            $role->load('permissions'),
            'Role retrieved successfully',
            200
        );
    }

    /**
     * Update the specified role in storage.
     *
     * Validates data using UpdateRoleRequest, updates the role name if provided,
     * and syncs permissions if present.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $role->update($request->only('name'));

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return ApiResponse::success(
            $role->load('permissions'),
            'Role updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();

        return ApiResponse::sendResponse(null, 'Role deleted successfully.', 204);
    }
}
