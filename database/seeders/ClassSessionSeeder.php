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

        $staff = User::whereHas('roles', function($query) {
            $query->where('name', 'Staff');
        })->get();

        foreach ($clusters as $cluster) {
            $start = Carbon::now()->addDays(rand(1, 14))->setTime(rand(8, 15), 0);
            $end = (clone $start)->addHours(2);

            ClassSession::create([
                'cluster_id' => $cluster->id,
                'user_id' => $staff->random()->id,
                'start_date' => $start,
                'end_date' => $end,
            ]);
        }
    }
}

