<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ManageRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('manage_roles')->delete();
        
        \DB::table('manage_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Kitchen manager',
                'titles' => 'Report,POS',
                'modules' => '2,25',
                'is_available' => 2,
                'created_at' => '2022-06-14 14:21:34',
                'updated_at' => '2022-11-18 08:50:07',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'General Manager',
                'titles' => 'Orders,Report,Categories,Products,POS',
                'modules' => '1,2,7,10,25',
                'is_available' => 1,
                'created_at' => '2022-11-18 08:46:48',
                'updated_at' => '2022-11-18 08:46:48',
            ),
        ));
        
        
    }
}