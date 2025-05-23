<?php

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{actingAs, postJson, getJson, putJson, deleteJson};

/**
 * This will reset this database after each of those tests so that data from a previous test does
 * not interfere with subsequent tests.
 * 
 * https://laravel.com/docs/12.x/database-testing
 */
uses(RefreshDatabase::class);

/**
 * permissions - checks that the following are created:
 *       $permissions = [
 *         'System-Configuration',
 *         'Manage-Roles',
 *         'Manage-Domains',
 *         'User Management',
 *         'Backup Management',
 *         'Import/Export',
 *         'Class-Session-Management',
 *         'Approve-Changes',
 *         'View-All-Class-Sessions',
 *         'View-Own-Class-Sessions',
 *         'Edit-Own-Profile',
 *         'Request-Changes'
 *      ];
 * 
 * (check for display, message & status code)
 * 
 * index - displays all Permissions
 * 
 * store - stores a newly created Permission
 *         uses the StorePremissionRequest file
 * 
 * show - displays the selected Permission, via the ID
 * 
 * update - retrives the selected Permission, 
 *          receives the user input for the update to the Permission,
 *          saves/stores the update
 * 
 * destroy - removes the selected Permission, via the ID
 */

beforeEach(function () {
    $this->user = User::factory()->create(['role' => 'super-admin']);
    $this->actingAs($this->user);

    // Checks that all permission are created
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

    foreach($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }
});

test('Displays all Permissions', function() {
    getJson('/api/v1/permissions')
        ->assertOk()
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Permissions retrieved successfully.',
        ])
        ->assertJsonStructure([
            'data' => [['id', 'name', 'guard_name', 'created_at', 'updated_at']],
        ]);
});
