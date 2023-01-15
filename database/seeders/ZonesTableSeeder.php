<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ZonesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zones')->delete();
        
        \DB::table('zones')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Jakarta',
            'coordinates' => '(-6,0619952, 106.7361085),(-6.0870154, 106.8085496),(-6.0724875, 106.9376034),(-6.2040783, 106.9550449),(-6.2955378, 106.9698032),(-6.3109663, 106.7935031),(-6.2146667, 106.7179354)',
            ),
        ));
        
        
    }
}