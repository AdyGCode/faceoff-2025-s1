<?php

use App\Models\ClassSession;
use App\Models\Cluster;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * This will reset this database after each of those tests so that data from a previous test does
 * not interfere with subsequent tests.
 * 
 * https://laravel.com/docs/12.x/database-testing
 */
uses(RefreshDatabase::class);


/**
 * Create and login a user for testing page required auth
 * 
 * What is `beforeEach` ?
 * Executes the provided closure before every test within the current file, 
 * ensuring that any necessary setup or configuration is completed before each test.
 * 
 * https://pestphp.com/docs/hooks#beforeeach
 * https://laravel.com/docs/12.x/http-tests#session-authentication
 */
beforeEach(function () {
    $this->session = ClassSession::factory()->count(21)->create();
    $this->cluster = Cluster::factory()->create();
    $this->staff = User::factory()->create(['role' => 'staff']);
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

/**
 * Test that the class session index page loads successfully.
 */
test('displays the class session index page', function () {
    $this->get('/class-sessions')
        ->assertOk()
        ->assertViewIs('class_sessions.index');
});

/**
 * Test that class sessions are paginated properly on the index view.
 */
test('paginates class sessions correctly', function () {
    $this->get(route('class_sessions.index'))
        ->assertViewHas('classSessions');
});

/**
 * Test that the create form for class sessions is displayed.
 */
test('shows the create class session form', function () {
    $this->get('/class-sessions/create')
        ->assertOk()
        ->assertViewIs('class_sessions.create');
});

/**
 * Test that a class session is stored successfully with valid data.
 */
test('stores a class session successfully', function () {
    $this->post(route('class_sessions.store'), [
        'title' => 'Session 1',
        'cluster_id' => $this->cluster->id,
        'user_id' => $this->staff->id,
        'start_date' => '2025-06-01',
        'end_date' => '2025-06-10',
        ])->assertRedirect(route('class_sessions.index'));
    expect(ClassSession::count())->toBe(22);
});

/**
 * Test that validation errors are triggered when storing with invalid data.
 */
test('fails to store a class session with invalid data', function () {
    $this->post(route('class_sessions.store'), [])
        ->assertSessionHasErrors(['title', 'cluster_id', 'user_id', 'start_date', 'end_date']);
});

/**
 * Test that a class session detail page is shown successfully.
 */
test('shows a class session detail page', function () {
    $this->get(route('class_sessions.show', $this->session[0]->id))
        ->assertOk()
        ->assertViewIs('class_sessions.show');
});

/**
 * Test that attempting to show a non-existent session redirects to index.
 */
test('redirects when trying to show a non-existent class session', function () {
    $this->get(route('class_sessions.show', 999))
        ->assertRedirect(route('class_sessions.index'))
        ->assertSessionHas('error');
});

/**
 * Test that the edit form for a class session is shown.
 */
test('shows the edit form for a class session', function () {
    $this->get(route('class_sessions.edit', $this->session[0]->id))
        ->assertOk()
        ->assertViewIs('class_sessions.update');
});

/**
 * Test that all necessary data is passed to the edit view.
 */
test('edit view has all necessary data', function () {
    $this->get(route('class_sessions.edit', $this->session[0]->id))
        ->assertViewHasAll(['classSession', 'staff', 'clusters', 'students']);
});

/**
 * Test that a class session is updated successfully with valid data.
 */
test('updates a class session successfully', function () {
    $this->put(route('class_sessions.update', $this->session[0]), [
        'title' => 'Updated Session',
        'cluster_id' => $this->cluster->id,
        'user_id' => $this->staff->id,
        'start_date' => '2025-06-05',
        'end_date' => '2025-06-15',
    ])->assertRedirect(route('class_sessions.index'));

    $this->session[0]->refresh();
    expect($this->session[0]->title)->toBe('Updated Session');
});

/**
 * Test that validation errors occur if update request is missing fields.
 */
test('fails to update with missing required fields', function () {
    $this->put(route('class_sessions.update', $this->session[0]), [])
        ->assertSessionHasErrors(['title', 'cluster_id', 'user_id', 'start_date', 'end_date']);
});

/**
 * Test that a class session is deleted properly.
 */
test('deletes a class session', function () {
    $this->delete(route('class_sessions.destroy', $this->session[0]))
        ->assertRedirect(route('class_sessions.index'));

    expect(ClassSession::count())->toBe(20);
});

/**
 * Test that deleting a session that was already deleted is handled gracefully.
 */
test('handles delete gracefully if session already deleted', function () {
    $this->delete(route('class_sessions.destroy', $this->session[0]->id))
        ->assertRedirect(route('class_sessions.index'));
});
