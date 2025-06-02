<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\{getJson, postJson, putJson, deleteJson};

beforeEach(function () {
    // probably need sanctum auth user here
});

/** @test */
it('returns a paginated list of users', function () {
    User::factory()->count(12)->create();

    $response = getJson('/api/v1/users');

    $response->assertOk()
        ->assertJsonStructure([
            'success',
            'message',
            'data' => ['data', 'links', 'meta'],
        ]);
});

/** @test */
it('stores a new user', function () {
    $data = [
        'given_name' => 'John',
        'family_name' => 'Doe',
        'email' => 'john@example.com',
        'password' => 'secret123',
        'password_confirmation' => 'secret123',
        'preferred_pronouns' => 'he/him',
    ];

    $response = postJson('/api/v1/users', $data);

    $response->assertCreated()
        ->assertJson([
            'success' => true,
            'message' => 'User created successfully!',
        ]);

    expect(User::where('email', $data['email'])->exists())->toBeTrue();
});

/** @test */
it('returns a single user', function () {
    $user = User::factory()->create();

    $response = getJson("/api/v1/users/{$user->id}");

    $response->assertOk()
        ->assertJson([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => ['id' => $user->id],
        ]);
});

/** @test */
it('returns 404 when showing non-existent user', function () {
    $response = getJson('/api/v1/users/999999');

    $response->assertStatus(404)
        ->assertJson([
            'success' => false,
            'message' => 'User not found',
        ]);
});

/** @test */
it('updates a user', function () {
    $user = User::factory()->create();

    $update = [
        'given_name' => 'Jane',
        'family_name' => 'Smith',
        'email' => 'jane.smith@example.com',
        'preferred_pronouns' => 'she/her',
        'password' => 'newpass',
        'password_confirmation' => 'newpass',
    ];

    $response = putJson("/api/v1/users/{$user->id}", $update);

    $response->assertOk()
        ->assertJson([
            'success' => true,
            'message' => 'User updated successfully!',
        ]);

    expect(User::find($user->id)->email)->toBe($update['email']);
});

/** @test */
it('returns 404 when updating non-existent user', function () {
    $response = putJson('/api/v1/users/999999', [
        'email' => 'ghost@example.com',
    ]);

    $response->assertStatus(404)
        ->assertJson(['message' => 'User not found']);
});

/** @test */
it('deletes a user', function () {
    $user = User::factory()->create();

    $response = deleteJson("/api/v1/users/{$user->id}");

    $response->assertOk()
        ->assertJson(['message' => 'User deleted successfully']);

    expect(User::find($user->id))->toBeNull();
});

/** @test */
it('returns 404 when deleting non-existent user', function () {
    $response = deleteJson('/api/v1/users/999999');

    $response->assertStatus(404)
        ->assertJson(['message' => 'User not found']);
});

