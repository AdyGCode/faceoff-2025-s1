<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'given_name' => 'Thomas',
            'family_name' => 'Nicholas',
            'name' => 'Thomas Nicholas',
            'preferred_pronouns' => 'he/him',
            'email' => 'thomas@example.com',
            'profile_photo' => "avatar.png",
            'email_verified_at' => now(),
            'password' => Hash::make('Password1'),
            'role' => 'super-admin',
        ]);
        $superAdmin->assignRole('Super Admin');

        $admin = User::create([
            'given_name' => 'Admin',
            'family_name' => 'Tafe',
            'name' => 'Admin Tafe',
            'preferred_pronouns' => 'he/him',
            'email' => 'admin@example.com',
            'profile_photo' => "avatar.png",
            'email_verified_at' => now(),
            'password' => Hash::make('Password1'),
            'role' => 'admin',
        ]);
        $admin->assignRole('Admin');

        $staff = User::create([
            'given_name' => 'Staff',
            'family_name' => 'Tafe',
            'name' => 'Staff Tafe',
            'preferred_pronouns' => 'he/him',
            'email' => 'staff@example.com',
            'profile_photo' => "avatar.png",
            'email_verified_at' => now(),
            'password' => Hash::make('Password1'),
            'role' => 'staff',
        ]);
        $staff->assignRole('Staff');

        $student = User::create([
            'given_name' => 'Student',
            'family_name' => 'Tafe',
            'name' => 'Student Tafe',
            'preferred_pronouns' => 'he/him',
            'email' => 'student@example.com',
            'profile_photo' => "avatar.png",
            'email_verified_at' => now(),
            'password' => Hash::make('Password1'),
            'role' => 'student',
        ]);
        $student->assignRole('Student');
    }
}
