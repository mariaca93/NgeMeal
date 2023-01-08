<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_ingredient')->insert([
            [
                'item_id' => 1,
                'ingredient_id' => 1,
                'quantity' => '200'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 2,
                'quantity' => '1'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 3,
                'quantity' => '1'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 4,
                'quantity' => '2'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 5,
                'quantity' => '2'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 6,
                'quantity' => '1/2'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 7,
                'quantity' => '100'
            ],
            


            [
                'item_id' => 2,
                'ingredient_id' => 8,
                'quantity' => '1'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 9,
                'quantity' => '500'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 10,
                'quantity' => '200'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 11,
                'quantity' => '10'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 12,
                'quantity' => '2'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 5,
                'quantity' => '2'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 6,
                'quantity' => '2'
            ]
            ]);
    }
}
