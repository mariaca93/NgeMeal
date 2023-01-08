<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcuisines')->insert([
            [
                'cuisine_id' => '1',
                'subcuisine_name' => 'Burger',
                'is_available' => 1,
                'is_deleted' => 0
            ],
            [
                'cuisine_id' => '1',
                'subcuisine_name' => 'Cuisine Amrik 2',
                'is_available' => 1,
                'is_deleted' => 0
            ],
            [
                'cuisine_id' => '2',
                'subcuisine_name' => 'Mian',
                'is_available' => 1,
                'is_deleted' => 0
            ],
            [
                'cuisine_id' => '3',
                'subcuisine_name' => 'Curry',
                'is_available' => 1,
                'is_deleted' => 0
            ],
            [
                'cuisine_id' => '4',
                'subcuisine_name' => 'Fried Rice',
                'is_available' => 1,
                'is_deleted' => 0
            ],
            [
                'cuisine_id' => '5',
                'subcuisine_name' => 'Pizza',
                'is_available' => 1,
                'is_deleted' => 0
            ],
            [
                'cuisine_id' => '6',
                'subcuisine_name' => 'Sushi',
                'is_available' => 1,
                'is_deleted' => 0
            ],
            [
                'cuisine_id' => '7',
                'subcuisine_name' => 'Stew',
                'is_available' => 1,
                'is_deleted' => 0
            ]
            ]);
    }
}
