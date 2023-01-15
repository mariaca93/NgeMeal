<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addons')->insert([
            [
                'id' => 1,
                'name' => 'Salt',
                'measurement' => 'tsp',
                'price' => '10',
                
            ],
            [
                'id' =>2,
                'name' => 'Vegetable Oil',
                'measurement' => 'tsp',
                'price' => '20',
                
            ],
            [
                'id' =>3,
                'name' => 'Sugar',
                'measurement' => 'tsp',
                'price' => '15',
                
            ],
            [
                'id' =>4,
                'name' => 'Black pepper',
                'measurement' => 'tsp',
                'price' => '15',
                
            ],
            [
                'id' =>5,
                'name' => 'Olive Oil',
                'measurement' => 'tsp',
                'price' => '15',
                
            ],
            [
                'id' =>6,
                'name' => 'Tomato ketchup',
                'measurement' => 'tsp',
                'price' => '8',
            ],
            [
                'id' =>7,
                'name' => 'Parsley',
                'measurement' => 'tsp',
                'price' => '13',
            ],
            [
                'id' =>8,
                'name' => 'Chili powder',
                'measurement' => 'tsp',
                'price' => '5',
            ],
            [
                'id' =>9,
                'name' => 'Cornstarch',
                'measurement' => 'tsp',
                'price' => '8',
            ],
            [
                'id' =>10,
                'name' => 'Shallot',
                'measurement' => 'clove',
                'price' => '5',
            ]
            ]);
    }
}
