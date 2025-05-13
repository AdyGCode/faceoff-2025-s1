<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\ApiResponse;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Permission::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $request->name]);

        return ApiResponse::success(
            $permission,
            'Permission created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return ApiResponse::success(
            $permission,
            'Permission retrieved successfully.',
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update(['name' => $request->name]);

        return ApiResponse::success(
            $permission,
            'Permission updated successfully.',
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return ApiResponse::success(
            [],
            'Permission deleted successfully.',
            204
        );
    }
}
