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
                'image' => 'american.jpg',
                'is_available' => 1,
                'is_deleted' => 2
            ],
            [
                'cuisine_name' => 'Chinese',
                'image' => 'chinese.jpg',
                'is_available' => 1,
                'is_deleted' => 2
            ],
            [
                'cuisine_name' => 'Indian',
                'image' => '',
                'is_available' => 1,
                'is_deleted' => 2
            ],
            [
                'cuisine_name' => 'Indonesian',
                'image' => '',
                'is_available' => 1,
                'is_deleted' => 2
            ],
            [
                'cuisine_name' => 'Italian',
                'image' => '',
                'is_available' => 1,
                'is_deleted' => 2
            ],
            [
                'cuisine_name' => 'Japanese',
                'image' => '',
                'is_available' => 1,
                'is_deleted' => 2
            ],
            [
                'cuisine_name' => 'Korean',
                'image' => '',
                'is_available' => 1,
                'is_deleted' => 2
            ]
            ]);
    }
}
