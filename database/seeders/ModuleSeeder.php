<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleArray = [
            'Admin Dashboard',
            'Role Management',
            'Permission Management',
            'Module Management',
            'User Management',
            'Setting Management',
            'Backup Management',
        ];

        foreach($moduleArray as $module){
           Module::updateOrCreate([
            'module_name' =>$module,
            'module_slug' =>Str::slug($module),
           ]);
        }


    }
}
