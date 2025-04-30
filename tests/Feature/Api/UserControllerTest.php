<?php

use App\Models\User;

// Index()
test('authenticated user can fetch paginated users', function () {
    $user = User::factory()->create();
    User::factory()->count(15)->create();

    $response = $this->actingAs($user, 'sanctum')->getJson('/api/v1/users');

    $response->assertOk()
        ->assertJsonStructure(['data']);
});
