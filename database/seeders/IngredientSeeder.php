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
                'id' =>1,
                'ingredient_name' => 'White rice',
                'measurement' => 'gram'
            ],
            [
                'id' =>2,
                'ingredient_name' => 'Carrot',
                'measurement' => 'pcs'
            ],
            [
                'id' =>3,
                'ingredient_name' => 'Bell pepper',
                'measurement' => 'pcs'
            ],
            [
                'id' =>4,
                'ingredient_name' => 'Sweet Soy Sauce',
                'measurement' => 'tsp'
            ],
            [
                'id' =>5,
                'ingredient_name' => 'Egg(s)',
                'measurement' => 'pcs'
            ],
            [
                'id' =>6,
                'ingredient_name' => 'Onion',
                'measurement' => 'pcs'
            ],
            [
                'id' =>7,
                'ingredient_name' => 'Peas',
                'measurement' => 'gram'
            ],
            [
                'id' =>8,
                'ingredient_name' => 'Pizza Dough',
                'measurement' => 'pcs'
            ],
            [
                'id' =>9,
                'ingredient_name' => 'Tomato Sauce',
                'measurement' => 'gram'
            ],
            [
                'id' =>10,
                'ingredient_name' => 'Mozarella',
                'measurement' => 'gram'
            ],
            [
                'id' =>11,
                'ingredient_name' => 'Basil',
                'measurement' => 'pcs'
            ],
            [
                'id' =>12,
                'ingredient_name' => 'Oregano',
                'measurement' => 'tsp'
            ],
            [
                'id' =>13,
                'ingredient_name' => 'Ground Beef',
                'measurement' => 'gram'
            ],
            [
                'id' =>14,
                'ingredient_name' => 'Cheddar Cheese',
                'measurement' => 'slice'
            ],
            [
                'id' =>15,
                'ingredient_name' => 'Burger Bun',
                'measurement' => 'pcs'
            ],
            [
                'id' =>16,
                'ingredient_name' => 'Lettuce',
                'measurement' => 'pcs'
            ],
            [
                'id' =>17,
                'ingredient_name' => 'Tomato',
                'measurement' => 'pcs'
            ],
            [
                'id' =>18,
                'ingredient_name' => 'Ground Chicken',
                'measurement' => 'gram'
            ],
            [
                'id' =>19,
                'ingredient_name' => 'Breadcrumbs',
                'measurement' => 'gram'
            ],
            [
                'id' =>20,
                'ingredient_name' => 'Mayonaise',
                'measurement' => 'tbsp'
            ],
            [
                'id' =>21,
                'ingredient_name' => 'Garlic',
                'measurement' => 'clove'
            ],
            [
                'id' =>22,
                'ingredient_name' => 'Black bean',
                'measurement' => 'gram'
            ],
            [
                'id' =>23,
                'ingredient_name' => 'Cumin',
                'measurement' => 'tsp'
            ],
            [
                'id' =>24,
                'ingredient_name' => 'Thai chili sauce',
                'measurement' => 'tsp'
            ],
            [
                'id' =>25,
                'ingredient_name' => 'All purpose flour',
                'measurement' => 'gram'
            ],
            [
                'id' =>26,
                'ingredient_name' => 'Paprika powder',
                'measurement' => 'tsp'
            ],
            [
                'id' =>27,
                'ingredient_name' => 'Poultry Seasoning',
                'measurement' => 'tsp'
            ],
            [
                'id' =>28,
                'ingredient_name' => 'Chicken Thigh',
                'measurement' => 'gram'
            ],
            [
                'id' =>29,
                'ingredient_name' => 'Chicken Breast',
                'measurement' => 'gram'
            ],
            [
                'id' =>30,
                'ingredient_name' => 'Celery',
                'measurement' => 'pcs'
            ],
            [
                'id' =>31,
                'ingredient_name' => 'Egg Noodle',
                'measurement' => 'gram'
            ],
            [
                'id' =>32,
                'ingredient_name' => 'Chicken Broth',
                'measurement' => 'mL'
            ],
            [
                'id' =>33,
                'ingredient_name' => 'Milk',
                'measurement' => 'mL'
            ],
            [
                'id' =>34,
                'ingredient_name' => 'Pastry Crust',
                'measurement' => 'sheet'
            ],
            [
                'id' =>35,
                'ingredient_name' => 'Sesame Paste',
                'measurement' => 'tbsp'
            ],
            [
                'id' =>36,
                'ingredient_name' => 'Soy Sauce',
                'measurement' => 'tsp'
            ],
            [
                'id' =>37,
                'ingredient_name' => 'Vinegar',
                'measurement' => 'tsp'
            ],
            [
                'id' =>38,
                'ingredient_name' => 'Sichuan peppercorn',
                'measurement' => 'tsp'
            ],
            [
                'id' =>39,
                'ingredient_name' => 'Ground pork',
                'measurement' => 'gram'
            ],
            [
                'id' =>40,
                'ingredient_name' => 'Ginger',
                'measurement' => 'tbsp'
            ],
            [
                'id' =>41,
                'ingredient_name' => 'Shaoxing wine',
                'measurement' => 'tbsp'
            ],
            [
                'id' =>42,
                'ingredient_name' => 'Chili Oil',
                'measurement' => 'tbsp'
            ],
            [
                'id' =>43,
                'ingredient_name' => 'Cabagge',
                'measurement' => 'gram'
            ],
            [
                'id' =>44,
                'ingredient_name' => 'Spring onion',
                'measurement' => 'pcs'
            ],
            [
                'id' =>45,
                'ingredient_name' => 'Oyster sauce',
                'measurement' => 'tbsp'
            ],
            [
                'id' =>46,
                'ingredient_name' => 'Sesame oil',
                'measurement' => 'tsp'
            ],
            [
                'id' =>47,
                'ingredient_name' => 'Bok choy',
                'measurement' => 'gram'
            ],
            ]);
    }
}
