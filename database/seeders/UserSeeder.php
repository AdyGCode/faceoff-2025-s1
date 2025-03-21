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
            'name' => 'Thom',
            'preferred_pronouns' => 'he/him',
            'email' => 'thomas@example.com',
            'profile_photo' => "avatar.png",
            'password' => Hash::make('Password1'),
            'role' => 'super-admin',
        ]);
        $superAdmin->assignRole('Super Admin');

        $user = User::create([
            'given_name' => 'Test',
            'family_name' => 'Dummy',
            'name' => 'Td',
            'preferred_pronouns' => 'he/him',
            'email' => 'testdummy@example.com',
            'profile_photo' => "avatar.png",
            'password' => Hash::make('Password1'),
            'role' => 'admin',
        ]);
        $user->assignRole('Student');
    }
}
