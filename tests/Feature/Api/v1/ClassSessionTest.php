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
    $this->basePath = '/api/v1/class-sessions';
    $this->staff = User::factory()->create(['role' => 'staff']);
    $this->targetStudents = 5;
    $this->students = User::factory()->count($this->targetStudents)->create(['role' => 'student']);
    $this->cluster = Cluster::factory()->create();
    $this->actingAs($this->staff, 'sanctum');
    $this->targetCounts = 21;
});

// Helper function to create class sessions for tests that need them
function createClassSessions($count = 1) {
    $sessions = ClassSession::factory()->count($count)->create();
    return $count === 1 ? $sessions->first() : $sessions;
}

/**
 * Test that the API returns a 404 response when no class sessions are found.
 *
 * GET /api/v1/class-sessions
 */
test('api returns 404 when no class sessions are found', function () {
    // No class sessions created here, so the database should be empty for sessions
    $this->getJson($this->basePath)
        ->assertStatus(404)
        ->assertJson(['message' => 'No class sessions found']);
});


/**
 * Test that the API returns all class sessions in JSON format.
 * 
 * GET /api/v1/class-sessions
 */
test('api returns all class sessions', function () {
    createClassSessions($this->targetCounts);
    $response = $this->getJson($this->basePath)
        ->assertOk()
        ->assertJsonStructure(['success', 'data', 'message']);

    expect(count($response->json('data')))->toBe($this->targetCounts);
});



/**
 * Test that a new class session is stored successfully via API with valid data, including student IDs.
 * 
 * POST /api/v1/class-sessions
 */
test('api stores a new class session with students', function () {
    $response = $this->postJson($this->basePath, [
        'title' => 'API Session',
        'cluster_id' => $this->cluster->id,
        'user_id' => $this->staff->id,
        'start_date' => '2025-07-01',
        'end_date' => '2025-12-31',
        'students' => $this->students->pluck('id')->toArray(),
    ]);

    $response->assertCreated()
        ->assertJsonFragment([
            'title' => 'API Session',
            'cluster_id' => $this->cluster->id,
            'user_id' => $this->staff->id,
        ])->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'title',
                'cluster',
                'staff',
                'students',
                'start_date',
                'end_date'
            ],
            'message',
        ]);
});


/**
 * Test that validation errors are returned if required fields are missing when storing a class session.
 *  
 * POST /api/v1/class-sessions
 */
test('api fails to store with invalid input', function () {
    $this->postJson($this->basePath, [])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['title', 'cluster_id', 'user_id', 'start_date', 'end_date']);
});


/**
 * Test that a specific class session can be retrieved successfully by ID.
 * 
 * GET /api/v1/class-sessions/{id}
 */
test('api shows a specific class session', function () {
    $classSession = createClassSessions();
    $this->getJson($this->basePath . '/' . $classSession->id)
        ->assertOk()
        ->assertJsonFragment(['id' => $classSession->id]);
});


/**
 * Test that a 404 response is returned if trying to access a non-existent class session.
 * 
 * GET /api/v1/class-sessions/{id}
 */
test('api returns 404 when class session is not found', function () {
    $this->getJson($this->basePath . '/-1')
        ->assertStatus(404);
});


/**
 * Test that a class session is updated successfully with valid input via API.
 * 
 * PUT /api/v1/class-sessions/{id}
 */
test('api updates a class session successfully', function () {
    $classSession = createClassSessions();
    $this->putJson($this->basePath . '/' . $classSession->id, [
        'title' => 'Updated API Title',
        'cluster_id' => $this->cluster->id,
        'user_id' => $this->staff->id,
        'start_date' => '2025-08-01',
        'end_date' => '2025-08-10',
        'students' => $this->students->pluck('id')->toArray(),
    ])
        ->assertOk()
        ->assertJsonFragment(['title' => 'Updated API Title']);
});


/**
 * Test that a class session is updated successfully with valid input via API.
 * 
 * PUT /api/v1/class-sessions/{id}
 */
test('api fails to update with invalid data', function () {
    $classSession = createClassSessions();
    $this->putJson($this->basePath . '/' . $classSession->id, [])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['title', 'cluster_id', 'user_id', 'start_date', 'end_date']);
});


/**
 * Test that a class session is deleted successfully via API.
 * 
 * DELETE /api/v1/class-sessions/{id}
 */
test('api deletes a class session successfully', function () {
    $classSession = createClassSessions();
    $this->deleteJson($this->basePath . '/' . $classSession->id,)
        ->assertOk()
        ->assertJson(['message' => 'Class session deleted successfully']);
    
        $this->assertDatabaseMissing('class_sessions', [
    'id' => $classSession->id,]);
});


/**
 * Test that a 404 response is returned if trying to delete a non-existent class session.
 * 
 * DELETE /api/v1/class-sessions/{id}
 */
test('api returns 404 if trying to delete non-existent session', function () {
    $this->deleteJson($this->basePath . '/-1')
        ->assertStatus(404);
});
