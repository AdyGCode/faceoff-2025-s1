<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::updateOrCreate(
            ['name' => 'Super Admin'],
            ['name' => 'Super Admin']
        );
        $admin = Role::updateOrCreate(
            ['name' => 'Admin'],
            ['name' => 'Admin']
        );
        $staff = Role::updateOrCreate(
            ['name' => 'Staff'],
            ['name' => 'Staff']
        );
        $student = Role::updateOrCreate(
            ['name' => 'Student'],
            ['name' => 'Student']
        );

        $superAdmin->givePermissionTo([
            'System-Configuration',
            'Manage-Roles',
            'Manage-Domains',
            'User Management',
            'Backup Management',
            'Import/Export',
            'Class-Session-Management',
            'Approve-Changes',
            'View-All-Class-Sessions',
            'Edit-Own-Profile',
            'Request-Changes'
        ]);

        $admin->givePermissionTo([
            'Manage-Domains',
            'User Management',
            'Backup Management',
            'Import/Export',
            'Class-Session-Management',
            'Approve-Changes',
            'View-All-Class-Sessions',
            'Edit-Own-Profile',
            'Request-Changes'
        ]);

        $staff->givePermissionTo([
            'Class-Session-Management',
            'Approve-Changes',
            'View-Own-Class-Sessions',
            'Edit-Own-Profile',
            'Request-Changes',
        ]);

        $student->givePermissionTo([
            'Edit-Own-Profile',
            'Request-Changes',
        ]);
    }
}
