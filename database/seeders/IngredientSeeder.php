<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //  measurements : gram, mL, L, tsp, tbsp, pcs
    public function run()
    {
        DB::table('ingredient')->insert([
            [
                'ingredient_name' => 'White rice',
                'measurement' => 'gram'
            ],
            [
                'ingredient_name' => 'Carrot',
                'measurement' => 'pcs'
            ],
            [
                'ingredient_name' => 'Bell pepper',
                'measurement' => 'pcs'
            ],
            [
                'ingredient_name' => 'Sweet Soy Sauce',
                'measurement' => 'tsp'
            ],
            [
                'ingredient_name' => 'Egg(s)',
                'measurement' => 'pcs'
            ],
            [
                'ingredient_name' => 'Onion',
                'measurement' => 'pcs'
            ],
            [
                'ingredient_name' => 'Peas',
                'measurement' => 'gram'
            ],
            [
                'ingredient_name' => 'Pizza Dough',
                'measurement' => 'pcs'
            ],
            [
                'ingredient_name' => 'Tomato Sauce',
                'measurement' => 'gram'
            ],
            [
                'ingredient_name' => 'Mozarella',
                'measurement' => 'gram'
            ],
            [
                'ingredient_name' => 'Basil',
                'measurement' => 'pcs'
            ],
            [
                'ingredient_name' => 'Oregano',
                'measurement' => 'tsp'
            ],
            ]);
    }
}
