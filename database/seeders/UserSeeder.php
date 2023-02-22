<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin
        $adminRoleId = Role::where('role_slug','admin')->first()->id;
        User::updateOrCreate([
            'role_id' => $adminRoleId,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'), // password
            'remember_token' => Str::random(10),
        ]);

        //create User
        $userRoleId = Role::where('role_slug','user')->first()->id;
        User::updateOrCreate([
            'role_id' => $userRoleId,
            'name' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
