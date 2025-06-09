<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\{get, post, put, delete, actingAs};

beforeEach(function () {
    $this->user = User::factory()->create(['role' => 'admin']);
    $this->students = User::factory()->count(10)->create(['role' => 'student']);
    actingAs($this->user);
});

it('displays user index page', function () {
    $this->get('/users')
        ->assertOk()
        ->assertViewIs('users.index');
});

it('displays create user form', function () {
    $this->get('/users/create')
        ->assertOk()
        ->assertViewIs('users.create');
});

it('stores a new user with valid data', function () {
    $data = [
        'given_name' => 'Jane',
        'family_name' => 'Doe',
        'preferred_pronouns' => 'she/her',
        'email' => 'jane@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'profile_photo' => UploadedFile::fake()->image('avatar.jpg'),
        'role' => 'student',
    ];

    $response = post(route('users.store'), $data);
    $response->assertRedirect(route('users.index'));
    expect(User::count())->toBe(11);
});

it('shows a specific user', function () {
    $this->get(route('users.show', $this->students[0]->id))
        ->assertOk()
        ->assertViewIs('users.show');
});

it('displays edit form for a user', function () {
    $this->get(route('users.update', $this->students[0]->id))
        ->assertOk()
        ->assertViewIs('users.update');
});

it('updates a user with valid data', function () {
    $this->put(route('users.update', $this->students[0]), [
        'given_name' => 'Updated',
        'family_name' => 'User',
        'preferred_pronouns' => 'they/them',
        'email' => 'updated@example.com',
        'role' => 'student',
    ])->assertRedirect(route('users.index'));

    $this->students[0]->refresh();
    expect($this->students[0]->given_name)->toBe('Updated');
});

it('deletes a user', function () {
    $this->delete(route('users.destroy', $this->students[0]))
        ->assertRedirect(route('users.index'));

    expect(User::count())->toBe(9);
});
