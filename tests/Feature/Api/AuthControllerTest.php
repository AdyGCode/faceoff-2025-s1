<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('new users can register', function () {
    $response = $this->post('/api/v1/auth/register', [
        'given_name' => 'John',
        'family_name' => 'Doe',
        'preferred_pronouns' => 'he/him',
        'email' => 'john.doe@example.com',
        'password' => 'Password1',
        'password_confirmation' => 'Password1',
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'user' => ['id', 'name', 'email'],
                'token',
            ],
            'message',
        ]);

    $this->assertDatabaseHas('users', [
        'email' => 'john.doe@example.com',
    ]);
});

test('users can authenticate using the login endpoint', function () {
    $user = User::factory()->create([
        'password' => Hash::make('Password1'),
    ]);

    $response = $this->post('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'Password1',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'user' => ['id', 'name', 'email'],
                'token',
            ],
            'message',
        ]);
});

test('users cannot authenticate with invalid password', function () {
    $user = User::factory()->create([
        'password' => Hash::make('Password1'),
    ]);

    $response = $this->postJson('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'WrongPassword',
    ]);

    $response->assertStatus(401)
        ->assertJson([
            'message' => 'The provided credentials are incorrect.',
        ]);
});

test('users can logout', function () {
    $user = User::factory()->create([
        'password' => Hash::make('Password1'),
    ]);

    $token = $user->createToken('TestToken')->plainTextToken;

    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->postJson('/api/v1/auth/logout');

    $response->assertStatus(200)
        ->assertJson([
            'message' => 'You are logged out.',
        ]);
});

test('registration fails with missing required fields', function () {
    $response = $this->postJson('/api/v1/auth/register', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors([
            'preferred_pronouns',
            'email',
            'password',
        ]);
});
