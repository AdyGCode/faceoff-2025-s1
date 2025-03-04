<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Course;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory(99)->create();

        Course::factory()->create([
            'national_code' => 'ICT50115',
            'package_id' => '10',
            'aqf_level' => 'Diploma of',
            'title' => 'Information Technology',
            'tga_status' => 'Expired',
            'status_code' => 'AWF1',
            'nominal_hours' => '610',
        ]);
    }
}
