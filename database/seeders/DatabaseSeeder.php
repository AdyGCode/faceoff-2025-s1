<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();

        User::factory()->create([
            'name' => 'Test Name',
            'email' => 'test1@example.com',
            'given_name' => 'Tester Given',
            'family_name' => 'Tester Family',
            'preferred_pronouns' => 'He/Him',
            'profile_photo' => "avatar.png",
            'email_verified_at' => now(),
            'password' => Hash::make('Password1'),
            'role' => 'student'
        ]);

        $this->call([
            PackagesSeeder::class,
            CoursesSeeder::class,
            UnitsSeeder::class,
            ClustersSeeder::class,
            PivotSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            ClassSessionSeeder::class,
        ]);
    }

}
