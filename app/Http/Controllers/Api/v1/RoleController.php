<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\ApiResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Role::with('permissions')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return ApiResponse::success(
            $role->load('permissions'),
            'Role created successfully',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return ApiResponse::success(
            $role->load('permissions'),
            'Role retrieved successfully',
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'sometimes|unique:roles,name,' . $role->id,
            'permissions' => 'array'
        ]);

        $role->update($request->only('name'));

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return ApiResponse::success(
            $role->load('permissions'),
            'Role updated successfully',
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return ApiResponse::success([], 'Role deleted successfully.', 204);
    }
}
