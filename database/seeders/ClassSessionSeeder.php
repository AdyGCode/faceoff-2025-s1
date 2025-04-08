<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassSession;
use App\Models\Cluster;
use App\Models\User;
use Carbon\Carbon;

class ClassSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clusters = Cluster::limit(10)->get();
        $students = User::where('role', 'student')->pluck('id');

        $staff = User::whereHas('roles', function($query) {
            $query->where('name', 'Staff');
        })->get();

        foreach ($clusters as $cluster) {
            $title = implode(' ', fake()->words(rand(2, 10)));
            $start = Carbon::now()->addDays(rand(1, 14))->setTime(rand(8, 15), 0);
            $end = (clone $start)->addHours(2);

            $classSession = ClassSession::create([
                'title' => $title,
                'cluster_id' => $cluster->id,
                'user_id' => $staff->random()->id,
                'start_date' => $start,
                'end_date' => $end,
            ]);

            $classSession->students()->attach($students->random(rand(5, 10)));
        }
    }
}

