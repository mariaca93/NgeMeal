<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cuisines')->insert([
            [
                'cuisine_name' => 'American',
                'image' => 'us-flag.jpg',
                'is_available' => 1,
                'slug' => 'american'
            ],
            [
                'cuisine_name' => 'Chinese',
                'image' => 'cn-flag.jpeg',
                'is_available' => 1,
                'slug' => 'chinese'
            ],
            [
                'cuisine_name' => 'Indian',
                'image' => 'in-flag.jpeg',
                'is_available' => 1,
                'slug' => 'indian'
            ],
            [
                'cuisine_name' => 'Indonesian',
                'image' => 'id-flag.png',
                'is_available' => 1,
                'slug' => 'indonesian'
            ],
            [
                'cuisine_name' => 'Italian',
                'image' => 'it-flag.jpeg',
                'is_available' => 1,
                'slug' => 'italian'
            ],
            [
                'cuisine_name' => 'Japanese',
                'image' => 'jp-flag.png',
                'is_available' => 1,
                'slug' => 'japanese'
            ],
            [
                'cuisine_name' => 'Korean',
                'image' => 'kr-flag.jpeg',
                'is_available' => 1,
                'slug' => 'korean'
            ]
            ]);
    }
}
