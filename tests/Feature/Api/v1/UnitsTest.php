<?php

use App\Models\User;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{actingAs, postJson, getJson, putJson, deleteJson};

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create(['role' => 'admin']);
    $this->actingAs($this->user);
    Unit::factory()->count(10)->create();
});

/**
 * Displays all units
 */
test('displays all units', function () {
    getJson('/api/v1/units')
        ->assertOk()
        ->assertJsonFragment([
            'success' => true,
            'message' => 'All Units Found',
        ])
        ->assertJsonStructure([
            'data' => [['id', 'national_code', 'title', 'tga_status', 'status_code', 'nominal_hours']],
        ]);
});

/**
 * Stores a new unit with valid data
 */
test('stores a new unit successfully', function () {
    postJson('/api/v1/units', [
        'national_code' => 'ICTSS00145',
        'title' => 'Back End Web Development for Intermediate Roles Skill Set',
        'tga_status' => 'Current',
        'status_code' => 'AUW95',
        'nominal_hours' => 65,
    ])
        ->assertCreated()
        ->assertJsonFragment(['success' => true]);

    expect(Unit::where('national_code', 'ICTSS00145')->exists())->toBeTrue();
});

/**
 * Shows a single unit
 */
test('shows a single unit', function () {
    $unit = Unit::first();

    getJson("/api/v1/units/{$unit->id}")
        ->assertOk()
        ->assertJsonFragment(['id' => $unit->id]);
});

/**
 * Updates an existing unit
 */
test('updates an existing unit', function () {
    $unit = Unit::first();

    putJson("/api/v1/units/{$unit->id}", [
        'title' => 'Updated Title',
        'tga_status' => 'Replaced',
        'status_code' => 'NEW01',
        'nominal_hours' => 100,
    ])
        ->assertOk()
        ->assertJsonFragment(['success' => true]);

    expect(Unit::find($unit->id)->title)->toBe('Updated Title');
});

/**
 * Deletes a unit
 */
test('deletes a unit', function () {
    $unit = Unit::first();

    deleteJson("/api/v1/units/{$unit->id}")
        ->assertOk()
        ->assertJsonFragment(['success' => true]);

    expect(Unit::find($unit->id))->toBeNull();
});

