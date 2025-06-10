<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{postJson, getJson, putJson, deleteJson, patchJson};

/**
 * This will reset this database after each of those tests so that data from a previous test does
 * not interfere with subsequent tests.
 * 
 * https://laravel.com/docs/12.x/database-testing
 */
uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

/**
 * Function to create the Permission to be used in the testing,
 * allows for testing of test were Permission aren't needed. (i.e error handling)
 */
function createRoles() {
    // Creats the following roles
    $roles = [
        'Super Admin',
        'Admin',
        'Staff',
        'Student'
    ];

    foreach ($roles as $role) {
        Role::firstOrCreate(['name' => $role]);
    }
}

/**
 * Tests that all Roles are displayed,
 * with the correct structure and Api response.
 */
test('Displays all Roles', function () {
    getJson('/api/v1/roles')
        ->assertOk()
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Roles retrieved successfully.',
        ])
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'guard_name', 'created_at', 'updated_at',
                    'permissions' => [
                        '*' => ['id', 'name', 'guard_name', 'created_at', 'updated_at',
                            'pivot' => [ 'role_id', 'permission_id'],
                        ],
                    ],
                ],
            ],
        ]);
});