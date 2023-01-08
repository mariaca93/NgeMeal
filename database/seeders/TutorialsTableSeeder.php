<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TutorialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('tutorials')->delete();
        
        DB::table('tutorials')->insert(array (
            0 => 
            array (
                'id' => 1,
                'image' => 'tutorial-62db77295a49c.jpg',
                'title' => 'Find the best price',
                'description' => 'There are many kinds of food available here',
                'created_at' => '2022-05-25 12:04:54',
                'updated_at' => '2022-07-23 18:20:57',
            ),
            1 => 
            array (
                'id' => 3,
                'image' => 'tutorial-62db7707748a2.jpg',
                'title' => 'Choose your favorite menu',
                'description' => 'There are many kinds of food available here',
                'created_at' => '2022-05-25 12:05:29',
                'updated_at' => '2022-07-23 18:20:23',
            ),
            2 => 
            array (
                'id' => 4,
                'image' => 'tutorial-62db75f228216.jpg',
                'title' => 'Your food is ready to be delivered',
                'description' => 'We will immediately send your food warm - warm',
                'created_at' => '2022-06-17 15:33:09',
                'updated_at' => '2022-07-23 18:15:46',
            ),
        ));
        
        
    }
}