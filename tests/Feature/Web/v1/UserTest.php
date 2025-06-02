<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\{get, post, put, delete, actingAs};

beforeEach(function () {
    $this->admin = User::factory()->create();
    $this->admin->role = 'admin';
    actingAs($this->admin);
});

it('displays user index page', function () {
    $response = get(route('users.index'));
    $response->assertOk()->assertViewIs('users.index');
});

it('displays create user form', function () {
    Role::factory()->create();
    $response = get(route('users.create'));
    $response->assertOk()->assertViewIs('users.create');
});

it('stores a new user with valid data', function () {
    Storage::fake('public');
    $role = Role::factory()->create();

    $data = [
        'given_name' => 'Jane',
        'family_name' => 'Doe',
        'preferred_pronouns' => 'she/her',
        'email' => 'jane@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'profile_photo' => UploadedFile::fake()->image('avatar.jpg'),
        'role' => $role->id,
    ];

    $response = post(route('users.store'), $data);

    $response->assertRedirect(route('users.index'));
    $this->assertDatabaseHas('users', ['email' => 'jane@example.com']);
    Storage::disk('public')->assertExists('profile_photos/' . basename(User::latest()->first()->profile_photo));
});

it('shows a specific user', function () {
    $user = User::factory()->create();
    $response = get(route('users.show', $user->id));
    $response->assertOk()->assertViewIs('users.show');
});

it('displays edit form for a user', function () {
    $user = User::factory()->create();
    $response = get(route('users.edit', $user->id));
    $response->assertOk()->assertViewIs('users.update');
});

it('updates a user with valid data', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $role = Role::factory()->create();

    $data = [
        'given_name' => 'Updated',
        'family_name' => 'User',
        'preferred_pronouns' => 'they/them',
        'email' => 'updated@example.com',
        'role' => $role->id,
        'profile_photo' => UploadedFile::fake()->image('updated.jpg'),
    ];

    $response = put(route('users.update', $user->id), $data);

    $response->assertRedirect(route('users.show', $user->id));
    $this->assertDatabaseHas('users', ['email' => 'updated@example.com']);
    Storage::disk('public')->assertExists('profile_photos/' . basename(User::find($user->id)->profile_photo));
});

it('deletes a user', function () {
    $user = User::factory()->create();
    $response = delete(route('users.destroy', $user->id));
    $response->assertRedirect(route('users.index'));
    $this->assertModelMissing($user);
});
