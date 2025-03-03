<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\Cluster;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClusterUnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cluster_id' => Cluster::inRandomOrder()->first()->id,
            'unit_id' => Unit::inRandomOrder()->first()->id,
        ];
    }
}
