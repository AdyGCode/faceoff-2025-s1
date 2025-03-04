<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Course;
use App\Models\Cluster;
use App\Models\Unit;

class PivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Gets 1-5 random clusterIds and attaches them to a Course
         */
        foreach (Course::all() as $course) {
            $course->cluster()->attach(
                Cluster::inRandomOrder()->limit(rand(1, 5))->pluck('id')->toArray()
            );
        }

        /**
         * Gets 5-10 random unitIds and attaches them to a Course
         */
        foreach (Course::all() as $course) {
            $course->unit()->attach(
                Unit::inRandomOrder()->limit(rand(5, 20))->pluck('id')->toArray()
            );
        }

        /**
         * Gets 1-5 random unitIds and attaches them to a Cluster
         */
        foreach (Cluster::all() as $course) {
            $course->unit()->attach(
                Unit::inRandomOrder()->limit(rand(1, 5))->pluck('id')->toArray()
            );
        }
    }
}
