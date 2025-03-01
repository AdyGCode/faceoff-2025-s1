<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'national_code' => strtoupper(fake()->lexify('???')),
            'title' => implode(' ', fake()->words(4)),
            'tga_status' => fake()->randomElement(['Current', 'Replaced', 'Expired']),
        ];
    }
}
