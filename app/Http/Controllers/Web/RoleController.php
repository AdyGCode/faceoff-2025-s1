<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::with('permissions')->orderBy('id', 'ASC')->paginate(5);
        $permissions = Permission::all();

        return view('roles.index', compact('roles', 'permissions'));
    }

    public function show(Role $role){
        $rolePermissions = $role->permissions()->get();
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function create(){
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create([
            'name' => $request->name
        ]);

        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }

        return redirect()->route('roles.index')->with('status', 'Role created successfully');
    }

    public function edit(Role $role){
        $permissions = Permission::all();
        $rolePermissions = $role->permissions()->pluck('id')->toArray();

        return view('roles.update', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $id,
            'permission' => 'array',
            'permission.*' => 'exists:permissions,id'
        ]);

        $role = Role::findOrFail($id);

        $role->update(['name' => $request->name]);

        if ($request->has('permission')) {
            $role->permissions()->sync($request->permission);
        } else {
            $role->permissions()->detach();
        }

        return redirect()->route('roles.show', $role->id)->with('status', 'Role updated successfully');
    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('roles.index')->with('status', 'Role deleted successfully');
    }

}
