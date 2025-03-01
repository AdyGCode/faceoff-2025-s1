<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'national_code' => strtoupper(fake()->regexify('[A-Z]{3,5}[0-9]{3,5}')),

            'title' => implode(' ', fake()->words(rand(2, 10))),

            'tga_status' => fake()->randomElement(['Current', 'Replaced', 'Expired']),

            'status_code' => strtoupper(fake()->lexify('???') . fake()->randomNumber('2', true)),

            'nominal_hours' => fake()->randomNumber(3, true),
        ];
    }
}
