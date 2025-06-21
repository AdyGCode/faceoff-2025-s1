<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($this->admin);

    $this->role = Role::create(['name' => 'staff']);
});

/**
 * Displays the user index page with paginated users.
 */
test('displays the user index page', function () {
    User::factory()->count(7)->create();

    $this->get(route('users.index'))
        ->assertOk()
        ->assertViewIs('users.index')
        ->assertViewHas('users');
});

/**
 * Displays the create user form.
 */
test('displays the create user form', function () {
    $this->get(route('users.create'))
        ->assertOk()
        ->assertViewIs('users.create')
        ->assertViewHas('roles');
});

/**
 * Stores a user with valid data.
 */
test('stores a new user successfully', function () {
    Storage::fake('public');
    $photo = UploadedFile::fake()->image('photo.jpg');

    $response = $this->post(route('users.store'), [
        'given_name' => 'John',
        'family_name' => 'Doe',
        'preferred_pronouns' => 'he/him',
        'email' => 'john@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'profile_photo' => $photo,
        'role' => $this->role->id,
    ]);

    $response->assertRedirect(route('users.index'));
    $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
});

/**
 * Fails to store user with invalid data.
 */
test('fails to store user with invalid data', function () {
    $this->post(route('users.store'), [])
        ->assertSessionHasErrors([
            'preferred_pronouns', 'email', 'password', 'role'
        ]);
});

/**
 * Shows the user detail page.
 */
test('shows the user detail page', function () {
    $user = User::factory()->create();

    $this->get(route('users.show', $user->id))
        ->assertOk()
        ->assertViewIs('users.show')
        ->assertViewHas('user');
});

/**
 * Redirects when showing a non-existent user.
 */
test('redirects when user not found on show', function () {
    $this->get(route('users.show', 999))
        ->assertRedirect(route('users.index'))
        ->assertSessionHas('warning');
});

/**
 * Shows the user edit form.
 */
test('shows the user edit form', function () {
    $user = User::factory()->create();

    $this->get(route('users.edit', $user->id))
        ->assertOk()
        ->assertViewIs('users.update')
        ->assertViewHasAll(['user', 'roles']);
});

/**
 * Fails to show edit form if user not found.
 */
test('redirects when editing non-existent user', function () {
    $this->get(route('users.edit', 999))
        ->assertRedirect(route('users.index'))
        ->assertSessionHas('error');
});

/**
 * Updates a user with valid data.
 */
test('updates a user successfully', function () {
    $user = User::factory()->create([
        'given_name' => 'Old',
        'email' => 'old@example.com',
        'preferred_pronouns' => 'he/him',
    ]);

    $response = $this->put(route('users.update', $user->id), [
        'given_name' => 'New',
        'family_name' => 'Name',
        'preferred_pronouns' => 'they/them',
        'email' => 'new@example.com',
        'role' => $this->role->id,
        'password' => '',
    ]);

    $response->assertRedirect(route('users.show', $user->id));
    $this->assertDatabaseHas('users', ['email' => 'new@example.com', 'given_name' => 'New']);
});

/**
 * Fails to update user with missing required fields.
 */
test('fails to update user with invalid data', function () {
    $user = User::factory()->create();

    $this->put(route('users.update', $user->id), [])
        ->assertSessionHasErrors(['preferred_pronouns', 'email', 'role']);
});

/**
 * Deletes a user successfully.
 */
test('deletes a user successfully', function () {
    $user = User::factory()->create();

    $this->delete(route('users.destroy', $user->id))
        ->assertRedirect(route('users.index'));

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

/**
 * Handles deletion of a non-existent user.
 */
test('gracefully handles deleting a non-existent user', function () {
    $this->delete(route('users.destroy', 999))
        ->assertRedirect()
        ->assertSessionHas('error');
});
