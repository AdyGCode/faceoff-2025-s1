<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cluster>
 */
class ClusterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper(fake()->regexify('[A-Z]{4,8}[0-9]{1,2}')),

            'title' => implode(' ', fake()->words(rand(2, 10))),

            'qualification' => strtoupper(fake()->regexify('[A-Z]{3}[0-9]{5}')),

            'qs_code' => strtoupper(fake()->regexify('[A-Z]{2}[0-9]{2}')),
        ];
    }
}
