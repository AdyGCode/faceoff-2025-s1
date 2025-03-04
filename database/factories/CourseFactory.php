<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'package_id' => Package::inRandomOrder()->first(),

            'national_code' => strtoupper(fake()->lexify('???') . fake()->randomNumber('5', true)),

            'aqf_level' => fake()->randomElement(['Certificate I in', 'Certificate II in', 'Certificate II in', 'Certificate III in', 'Certificate IV in', 'Diploma of', 'Advanced Diploma of', 'Graduate Diploma of', 'Graduate Certificate In']),

            'title' => implode(' ', fake()->words(rand(1, 4))),

            'tga_status' => fake()->randomElement(['Current', 'Replaced', 'Expired']),

            'status_code' => strtoupper(fake()->lexify('???') . fake()->randomNumber('1', true)),

            'nominal_hours' => fake()->randomNumber(3, true),
        ];
    }
}
