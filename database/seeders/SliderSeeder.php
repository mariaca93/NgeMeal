<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('slider')->insert([
        [
            'id' => 1,
            'title' => 'Today\'s specials',
            'description' => 'Fresh and organic salad bowls',
            'image' => 'slider1.jpg'
        ],
        [
            'id' => 2,
            'title' => 'Don\'t miss amazing deals!',
            'description' => 'Get 30% off on your first order',
            'image' => 'slider2.jpg'
        ]
        ]);
    }
}
