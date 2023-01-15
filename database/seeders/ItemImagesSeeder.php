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
                'image' => 'beef-burger-1.jpg',
            ],
            [
                'item_id' => 1,
                'image' => 'beef-burger-2.jpg',
            ],
            [
                'item_id' => 1,
                'image' => 'beef-burger-3.jpg',
            ],
            [
                'item_id' => 2,
                'image' => 'chicken-burger-1.jpg',
            ],
            [
                'item_id' => 2,
                'image' => 'chicken-burger-2.jpg',
            ],
            [
                'item_id' => 2,
                'image' => 'chicken-burger-3.jpg',
            ],
            [
                'item_id' => 3,
                'image' => 'black-bean-burger-1.jpg',
            ],
            [
                'item_id' => 3,
                'image' => 'black-bean-burger-2.jpg',
            ],
            [
                'item_id' => 3,
                'image' => 'black-bean-burger-3.jpg',
            ],
            [
                'item_id' => 4,
                'image' => 'fried-chicken-1.jpg',
            ],
            [
                'item_id' => 4,
                'image' => 'fried-chicken-2.jpg',
            ],
            [
                'item_id' => 4,
                'image' => 'fried-chicken-3.jpg',
            ],
            [
                'item_id' => 5,
                'image' => 'chicken-noodle-soup-1.jpg',
            ],
            [
                'item_id' => 5,
                'image' => 'chicken-noodle-soup-2.jpg',
            ],
            [
                'item_id' => 5,
                'image' => 'chicken-noodle-soup-3.jpg',
            ],
            [
                'item_id' => 6,
                'image' => 'chicken-pot-pie-1.jpg',
            ],
            [
                'item_id' => 6,
                'image' => 'chicken-pot-pie-2.jpg',
            ],
            [
                'item_id' => 6,
                'image' => 'chicken-pot-pie-3.jpg',
            ],
            [
                'item_id' => 7,
                'image' => 'dan-dan-mian-1.jpeg',
            ],
            [
                'item_id' => 7,
                'image' => 'dan-dan-mian-2.jpeg',
            ],
            [
                'item_id' => 7,
                'image' => 'dan-dan-mian-3.jpeg',
            ],
            [
                'item_id' => 8,
                'image' => 'chow-mein-1.jpg',
            ],
            [
                'item_id' => 8,
                'image' => 'chow-mein-2.jpeg',
            ],
            [
                'item_id' => 8,
                'image' => 'chow-mein-3.jpg',
            ],
            [
                'item_id' => 9,
                'image' => 'mee-hoon-1.jpg',
            ],
            [
                'item_id' => 9,
                'image' => 'mee-hoon-2.jpeg',
            ],
            [
                'item_id' => 9,
                'image' => 'mee-hoon-3.jpg',
            ],
            [
                'item_id' => 19,
                'image' => 'fried-rice-1.jpg',
            ],
            [
                'item_id' => 19,
                'image' => 'fried-rice-2.jpg',
            ],
            [
                'item_id' => 19,
                'image' => 'fried-rice-3.jpg',
            ],
            [
                'item_id' => 25,
                'image' => 'pizza-1.jpg',
            ],
            [
                'item_id' => 25,
                'image' => 'pizza-2.jpg',
            ],
            [
                'item_id' => 25,
                'image' => 'pizza-3.jpg',
            ]
            ]);
    }
}
