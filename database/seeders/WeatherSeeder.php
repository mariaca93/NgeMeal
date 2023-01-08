<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weather')->insert([
            [
                'id' => '1',
                'weather_code' => '0,1,2,3,45,48',
                'weather_name' => 'Sunny',
            ],
            [
                'id' => '2',
                'weather_code' => '51,53,55,56,57,61,63,65,66,67,71,73,75,77,80,81,82,85,86,95,96,99',
                'weather_name' => 'Rainy',
            ]
            ]);
    }
}
