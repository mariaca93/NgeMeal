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
                'id' =>1,
                'cuisine_id' => 1,
                'subcuisine_name' => 'Burger',
                'is_available' => 1,
                'slug' => 'burger'
            ],
            [
                'id' =>2,
                'cuisine_id' => 1,
                'subcuisine_name' => 'Chicken',
                'is_available' => 1,
                'slug' => 'chicken'
            ],
            [
                'id' =>3,
                'cuisine_id' => 2,
                'subcuisine_name' => 'Mian',
                'is_available' => 1,
                'slug' => 'mian'
            ],
            [
                'id' =>4,
                'cuisine_id' => 2,
                'subcuisine_name' => 'Dim Sum',
                'is_available' => 1,
                'slug' => 'dim-sum'
            ],
            [
                'id' =>5,
                'cuisine_id' => 3,
                'subcuisine_name' => 'Curry',
                'is_available' => 1,
                'slug' => 'curry'
            ],
            [
                'id' =>6,
                'cuisine_id' => 3,
                'subcuisine_name' => 'Biryani & Naan',
                'is_available' => 1,
                'slug' => 'biryani-naan'
            ],
            [
                'id' =>7,
                'cuisine_id' => 4,
                'subcuisine_name' => 'Fried Rice',
                'is_available' => 1,
                'slug' => 'fried-rice'
            ],
            [
                'id' =>8,
                'cuisine_id' => 4,
                'subcuisine_name' => 'Bakso',
                'is_available' => 1,
                'slug' => 'bakso'
            ],
            [
                'id' =>9,
                'cuisine_id' => 5,
                'subcuisine_name' => 'Pizza',
                'is_available' => 1,
                'slug' => 'pizza'
            ],
            [
                'id' =>10,
                'cuisine_id' => 5,
                'subcuisine_name' => 'Pasta',
                'is_available' => 1,
                'slug' => 'pasta'
            ],
            [
                'id' =>11,
                'cuisine_id' => 6,
                'subcuisine_name' => 'Sushi',
                'is_available' => 1,
                'slug' => 'sushi'
            ],
            [
                'id' =>12,
                'cuisine_id' => 6,
                'subcuisine_name' => 'Ramen',
                'is_available' => 1,
                'slug' => 'ramen'
            ],
            [
                'id' =>13,
                'cuisine_id' => 7,
                'subcuisine_name' => 'Stew',
                'is_available' => 1,
                'slug' => 'stew'
            ],
            [
                'id' =>14,
                'cuisine_id' => 7,
                'subcuisine_name' => 'Korean Noodles',
                'is_available' => 1,
                'slug' => 'korean-noodles'
            ]
            ]);
    }
}
