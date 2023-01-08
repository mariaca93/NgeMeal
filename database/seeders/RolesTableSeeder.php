<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'label' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2020-04-15 08:28:19',
                'updated_at' => '2020-04-15 08:28:19',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'user',
                'label' => 'User',
                'guard_name' => 'web',
                'created_at' => '2020-04-15 08:28:19',
                'updated_at' => '2020-04-15 08:28:19',
            ),
        ));
        
        
    }
}