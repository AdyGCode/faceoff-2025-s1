<?php

namespace Database\Seeders;

use App\Models\Cluster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClustersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cluster::factory(49)->create();

        Cluster::factory()->create([
            'code' => 'INNOPRJ1',
            'title' => 'Innovation Project (Part 1)',
            'qualification' => 'ICT50220',
            'qs_code' => 'AC21',
        ]);

    }
}
