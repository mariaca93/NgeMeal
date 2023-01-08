<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contact')->delete();
        
        \DB::table('contact')->insert(array (
            0 => 
            array (
                'id' => 1,
                'firstname' => 'Jek',
                'lastname' => 'User',
                'email' => 'jek@yopmail.com',
                'message' => '121212121212122',
                'created_at' => '2022-11-19 08:00:11',
                'updated_at' => '2022-11-19 08:00:11',
            ),
        ));
        
        
    }
}