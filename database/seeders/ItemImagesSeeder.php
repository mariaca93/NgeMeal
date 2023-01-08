<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_images')->insert([
            [
                'item_id' => 1,
                'image' => 'fried-rice-1.jpg',
            ],
            [
                'item_id' => 1,
                'image' => 'fried-rice-2.jpg',
            ],
            [
                'item_id' => 1,
                'image' => 'fried-rice-3.jpg',
            ],
            [
                'item_id' => 2,
                'image' => 'pizza-1.jpg',
            ],
            [
                'item_id' => 2,
                'image' => 'pizza-2.jpg',
            ],
            [
                'item_id' => 2,
                'image' => 'pizza-3.jpg',
            ]
            ]);
    }
}
