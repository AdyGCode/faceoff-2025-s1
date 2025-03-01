<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Package;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::factory(9)->create();

        Package::factory()->create([
            'national_code' => 'ICT',
            'title' => 'Information and Communications Technology',
            'tga_status' => 'Current',
        ]);
    }
}
