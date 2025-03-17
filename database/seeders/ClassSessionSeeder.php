<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassSession;
use App\Models\Cluster;
use App\Models\User;

class ClassSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clusters = Cluster::all();
        $staff = User::where('role', 'staff')->get();

        foreach ($clusters as $cluster) {
            ClassSession::create([
                'cluster_id' => $cluster->id,
                'user_id' => $staff->random()->id,
            ]);
        }
    }
}

