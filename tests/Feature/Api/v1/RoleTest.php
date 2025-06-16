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
    createRoles();

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

/**
 * Tests that a newly created Role is stored,
 * using the correct structure and Api response.
 */
test('Stores a newly created Role.', function() {
    postJson('/api/v1/roles', ['id' => '5', 'name' => 'Test Role'])
        ->assertCreated()
        ->assertJsonFragment([
                'success' => true,
                'message' => 'Role created successfully.',
                'name' => 'Test Role'
        ])
        ->assertStatus(201);
});

/**
 * Tests that a single Role can be retrieved,
 * using the correct structure and Api response.
 */
test('Displays a single Role', function() {
    createRoles();

    $role = Role::inRandomOrder()->first();

    getJson("/api/v1/roles/{$role->id}")
        ->assertOk()
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Role retrieved successfully.',
            'id' => $role->id,
            'name' => $role->name
        ])
        ->assertJsonStructure([
            'data' => ['id', 'name', 'guard_name', 'created_at', 'updated_at',
                'permissions' => [
                    '*' => ['id', 'name', 'guard_name', 'created_at', 'updated_at',
                        'pivot' => [ 'role_id', 'permission_id'],
                    ],
                ],
            ],
        ]);
});

/**
 * Tests that an existing Role can be Updated,
 * using the correct structure and Api response.
 */
test('Can updated an existing Role', function() {
   $role = Role::create(['name' => 'Old Role']);

    putJson("/api/v1/roles/{$role->id}", ['name' => 'New Role'])
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Role updated successfully.',
            'name' => 'New Role'
        ])
        ->assertOk();
});

/**
 * Tests that a single Role can be Deleted,
 * using the correct structure and Api response.
 */
test('Deletes a single Role', function() {
    createRoles();

    $role = Role::inRandomOrder()->first();

    deleteJson("/api/v1/roles/{$role->id}")
        ->assertStatus(204)   
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Role deleted successfully.',
        ]);
});