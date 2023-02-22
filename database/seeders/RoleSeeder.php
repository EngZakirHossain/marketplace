<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermission = Permission::select('id')->get();
        //create admin role and assign all permission
        Role::updateOrCreate([
            'role_name' =>'Admin',
            'role_slug'=> 'admin',
            'role_note' =>'Admin has All Permission',
            'is_deleteable'=> false,
        ])->permissions()->sync($adminPermission->pluck('id'));
        
        //Create user Role
        Role::updateOrCreate([
            'role_name' =>'User',
            'role_slug'=> 'user',
            'role_note' =>'User has limited Permission',
            'is_deleteable'=> true,
        ]);
    }
}
