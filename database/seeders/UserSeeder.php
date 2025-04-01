<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /* From Class-Tracker group work  and Adrian Gould's ChatGPT conversation */
        $roleSuperAdmin = Role::whereName('Super Admin')->get();
        $roleAdmin = Role::whereName('Admin')->get();
        $roleStaff = Role::whereName('Staff')->get();
        $roleStudent = Role::whereName('Student')->get();

        $superAdmin = User::create([
            'given_name' => 'Thomas',
            'family_name' => 'Nicholas',
            'name' => 'Thom',
            'preferred_pronouns' => 'he/him',
            'email' => 'thomas@example.com',
            'profile_photo' => "avatar.png",
            'password' => Hash::make('Password1'),
            'role' => 'super-admin',
            'email_verified_at'=>now(),
        ]);
        $superAdmin->assignRole([$roleSuperAdmin]);

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
        $user->assignRole([$roleStudent]);

        $user = User::create([
            'given_name' => 'Staff',
            'family_name' => 'Member',
            'name' => 'SM',
            'preferred_pronouns' => 'he/him',
            'email' => 'staff.member@example.com',
            'profile_photo' => "avatar.png",
            'password' => Hash::make('Password1'),
            'role' => 'staff',
        ]);
        $user->assignRole([$roleStaff]);
    }
}
