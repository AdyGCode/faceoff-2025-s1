<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'System-Configuration',
            'Manage-Roles',
            'Manage-Domains',
            'User Management',
            'Backup Management',
            'Import/Export',
            'Class-Session-Management',
            'Approve-Changes',
            'View-All-Class-Sessions',
            'View-Own-Class-Sessions',
            'Edit-Own-Profile',
            'Request-Changes'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
