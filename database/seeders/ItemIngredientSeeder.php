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
            //beef burger
            [
                'item_id' => 1,
                'ingredient_id' => 6,
                'quantity' => '1'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 13,
                'quantity' => '500'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 12,
                'quantity' => '1'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 5,
                'quantity' => '1'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 14,
                'quantity' => '4'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 15,
                'quantity' => '2'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 16,
                'quantity' => '4'
            ],
            [
                'item_id' => 1,
                'ingredient_id' => 17,
                'quantity' => '1/2'
            ],

            //chicken burger
            [
                'item_id' => 2,
                'ingredient_id' => 18,
                'quantity' => '500'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 19,
                'quantity' => '200'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 20,
                'quantity' => '2'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 6,
                'quantity' => '1/4'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 21,
                'quantity' => '1'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 3,
                'quantity' => '1/2'
            ],
            [
                'item_id' => 2,
                'ingredient_id' => 15,
                'quantity' => '2'
            ],

            //blackbean burger
            [
                'item_id' => 3,
                'ingredient_id' => 22,
                'quantity' => '450'
            ],
            [
                'item_id' => 3,
                'ingredient_id' => 3,
                'quantity' => '1/2'
            ],
            [
                'item_id' => 3,
                'ingredient_id' => 6,
                'quantity' => '1/2'
            ],
            [
                'item_id' => 3,
                'ingredient_id' => 21,
                'quantity' => '3'
            ],
            [
                'item_id' => 3,
                'ingredient_id' => 5,
                'quantity' => '1'
            ],
            [
                'item_id' => 3,
                'ingredient_id' => 23,
                'quantity' => '3'
            ],
            [
                'item_id' => 3,
                'ingredient_id' => 24,
                'quantity' => '2'
            ],
            [
                'item_id' => 3,
                'ingredient_id' => 19,
                'quantity' => '300'
            ],

            //fried chicken
            [
                'item_id' => 4,
                'ingredient_id' => 25,
                'quantity' => '500'
            ],
            [
                'item_id' => 4,
                'ingredient_id' => 26,
                'quantity' => '3'
            ],
            [
                'item_id' => 4,
                'ingredient_id' => 27,
                'quantity' => '2'
            ],
            [
                'item_id' => 4,
                'ingredient_id' => 5,
                'quantity' => '2'
            ],
            [
                'item_id' => 4,
                'ingredient_id' => 28,
                'quantity' => '650'
            ],

            //chicken noodle soup
            [
                'item_id' => 5,
                'ingredient_id' => 6,
                'quantity' => '1'
            ],
            [
                'item_id' => 5,
                'ingredient_id' => 30,
                'quantity' => '3'
            ],
            [
                'item_id' => 5,
                'ingredient_id' => 32,
                'quantity' => '750'
            ],
            [
                'item_id' => 5,
                'ingredient_id' => 29,
                'quantity' => '300'
            ],
            [
                'item_id' => 5,
                'ingredient_id' => 31,
                'quantity' => '250'
            ],
            [
                'item_id' => 5,
                'ingredient_id' => 2,
                'quantity' => '2'
            ],
            [
                'item_id' => 5,
                'ingredient_id' => 11,
                'quantity' => '5'
            ],

            //chicken pot pie
            [
                'item_id' => 6,
                'ingredient_id' => 2,
                'quantity' => '2'
            ],
            [
                'item_id' => 6,
                'ingredient_id' => 7,
                'quantity' => '300'
            ],
            [
                'item_id' => 6,
                'ingredient_id' => 30,
                'quantity' => '3'
            ],
            [
                'item_id' => 6,
                'ingredient_id' => 6,
                'quantity' => '1'
            ],
            [
                'item_id' => 6,
                'ingredient_id' => 32,
                'quantity' => '500'
            ],
            [
                'item_id' => 6,
                'ingredient_id' => 29,
                'quantity' => '300'
            ],
            [
                'item_id' => 6,
                'ingredient_id' => 25,
                'quantity' => '15'
            ],
            [
                'item_id' => 6,
                'ingredient_id' => 33,
                'quantity' => '200'
            ],
            [
                'item_id' => 6,
                'ingredient_id' => 34,
                'quantity' => '3'
            ],
            
            //dan dan mian
            [
                'item_id' => 7,
                'ingredient_id' => 35,
                'quantity' => '2'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 36,
                'quantity' => '3'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 37,
                'quantity' => '1'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 21,
                'quantity' => '5'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 6,
                'quantity' => '1/4'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 38,
                'quantity' => '2'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 39,
                'quantity' => '200'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 40,
                'quantity' => '1'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 41,
                'quantity' => '2'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 42,
                'quantity' => '3'
            ],
            [
                'item_id' => 7,
                'ingredient_id' => 31,
                'quantity' => '350'
            ],
            
            //chow mein
            [
                'item_id' => 8,
                'ingredient_id' => 31,
                'quantity' => '300'
            ],
            [
                'item_id' => 8,
                'ingredient_id' => 43,
                'quantity' => '150'
            ],
            [
                'item_id' => 8,
                'ingredient_id' => 2,
                'quantity' => '3'
            ],
            [
                'item_id' => 8,
                'ingredient_id' => 44,
                'quantity' => '2'
            ],
            [
                'item_id' => 8,
                'ingredient_id' => 21,
                'quantity' => '4'
            ],
            [
                'item_id' => 8,
                'ingredient_id' => 45,
                'quantity' => '3'
            ],
            [
                'item_id' => 8,
                'ingredient_id' => 36,
                'quantity' => '1 1/2'
            ],
            [
                'item_id' => 8,
                'ingredient_id' => 46,
                'quantity' => '2'
            ],
            [
                'item_id' => 8,
                'ingredient_id' => 32,
                'quantity' => '30'
            ],

            //chinese mee hoon
            [
                'item_id' => 9,
                'ingredient_id' => 32,
                'quantity' => '350'
            ],
            [
                'item_id' => 9,
                'ingredient_id' => 21,
                'quantity' => '3'
            ],
            [
                'item_id' => 9,
                'ingredient_id' => 40,
                'quantity' => '1'
            ],
            [
                'item_id' => 9,
                'ingredient_id' => 36,
                'quantity' => '1/2'
            ],
            [
                'item_id' => 9,
                'ingredient_id' => 41,
                'quantity' => '2'
            ],
            [
                'item_id' => 9,
                'ingredient_id' => 46,
                'quantity' => '1'
            ],
            [
                'item_id' => 9,
                'ingredient_id' => 31,
                'quantity' => '300'
            ],
            [
                'item_id' => 9,
                'ingredient_id' => 47,
                'quantity' => '150'
            ],
            
            //indonesian fried rice
            [
                'item_id' => 19,
                'ingredient_id' => 1,
                'quantity' => '200'
            ],
            [
                'item_id' => 19,
                'ingredient_id' => 25,
                'quantity' => '1'
            ],
            [
                'item_id' => 19,
                'ingredient_id' => 3,
                'quantity' => '1'
            ],
            [
                'item_id' => 19,
                'ingredient_id' => 4,
                'quantity' => '2'
            ],
            [
                'item_id' => 19,
                'ingredient_id' => 5,
                'quantity' => '2'
            ],
            [
                'item_id' => 19,
                'ingredient_id' => 6,
                'quantity' => '1/2'
            ],
            [
                'item_id' => 19,
                'ingredient_id' => 7,
                'quantity' => '100'
            ],
            

            //margharita pizza
            [
                'item_id' => 25,
                'ingredient_id' => 8,
                'quantity' => '1'
            ],
            [
                'item_id' => 25,
                'ingredient_id' => 9,
                'quantity' => '500'
            ],
            [
                'item_id' => 25,
                'ingredient_id' => 10,
                'quantity' => '200'
            ],
            [
                'item_id' => 25,
                'ingredient_id' => 11,
                'quantity' => '10'
            ],
            [
                'item_id' => 25,
                'ingredient_id' => 12,
                'quantity' => '2'
            ],
            [
                'item_id' => 25,
                'ingredient_id' => 5,
                'quantity' => '2'
            ],
            [
                'item_id' => 25,
                'ingredient_id' => 6,
                'quantity' => '2'
            ]
            ]);
    }
}
