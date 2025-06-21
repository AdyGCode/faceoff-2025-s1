<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\{getJson, postJson, putJson, deleteJson};

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create([
        'role'    => 'admin',
        'email'   => 'admin@example.com',
        'password'=> Hash::make('Password1'),
    ]);
    $this->actingAs($this->admin);
    User::factory()->count(12)->create();
});

/**
 *  INDEX – list users
 */
test('displays all users', function () {
    getJson('/api/v1/users')
        ->assertOk()
        ->assertJsonFragment([
            'success' => true,
            'message' => 'Users retrieved successfully.',
        ])
        ->assertJsonStructure([
            'data' => [
                'current_page',
                'data' => [[
                    'id',
                    'given_name',
                    'family_name',
                    'name',
                    'preferred_pronouns',
                    'email',
                    'profile_photo',
                ]],
            ],
        ]);
});

/**
 *  STORE – create a user
 */
test('stores a new user successfully', function () {
    postJson('/api/v1/users', [
        'given_name'            => 'Johnny',
        'family_name'           => 'Bravo',
        'preferred_pronouns'    => 'He/Him',
        'email'                 => 'johnny@example.com',
        'password'              => 'Password1',
        'password_confirmation' => 'Password1',
    ])
        ->assertCreated()
        ->assertJsonFragment(['success' => true]);

    expect(User::where('email', 'johnny@example.com')->exists())->toBeTrue();
});

test('does not store user with invalid data', function () {
    postJson('/api/v1/users', [
        'email'    => 'not‑an‑email',
        'password' => 'abc',               // too short & no confirmation
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors([
            'given_name',
            'family_name',
            'preferred_pronouns',
            'email',
            'password',
        ]);
});

/**
 *  SHOW – view a user
 */
test('shows a single user', function () {
    $user = User::whereKeyNot($this->admin)->first();

    getJson("/api/v1/users/{$user->id}")
        ->assertOk()
        ->assertJsonFragment(['id' => $user->id]);
});

/**
 *  UPDATE – change a user
 */
test('updates an existing user', function () {
    $user = User::factory()->create([
        'preferred_pronouns' => 'They/Them',
    ]);

    putJson("/api/v1/users/{$user->id}", [
        'given_name'         => 'Updated',
        'preferred_pronouns' => 'He/Him',
    ])
        ->assertOk()
        ->assertJsonFragment(['success' => true]);

    expect(User::find($user->id)->given_name)->toBe('Updated');
});

/**
 *  DESTROY – delete a user
 */
test('deletes a user', function () {
    $user = User::factory()->create();

    deleteJson("/api/v1/users/{$user->id}")
        ->assertOk()
        ->assertJsonFragment(['success' => true]);

    expect(User::find($user->id))->toBeNull();
});
