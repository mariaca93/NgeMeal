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
                'name' => 'Salt',
                'measurement' => 'tsp',
                'price' => '10',
                
            ],
            [
                'name' => 'Vegetable Oil',
                'measurement' => 'tsp',
                'price' => '20',
                
            ],
            [
                'name' => 'Sugar',
                'measurement' => 'tsp',
                'price' => '15',
                
            ],
            [
                'name' => 'Black pepper',
                'measurement' => 'tsp',
                'price' => '15',
                
            ],
            [
                'name' => 'Olice Oil',
                'measurement' => 'tsp',
                'price' => '15',
                
            ]
            ]);
    }
}
