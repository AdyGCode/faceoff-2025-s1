<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Unit;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::factory(99)->create();

        Unit::factory()->create([
            'national_code' => 'ICTSS00145',
            'title' => 'Back End Web Development for Intermediate Roles Skill Set',
            'tga_status' => 'Current',
            'status_code' => 'AUW95',
            'nominal_hours' => '65',
        ]);
    }
}
