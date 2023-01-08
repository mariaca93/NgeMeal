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
                'name' => 'tangier',
            'coordinates' => '(84.26810492707672, -83.05930384012179),(68.14232782533084, -160.4030538401218),(-48.91636421906061, -83.05930384012179),(-49.831960641143034, 67.4094461598782),(-35.45306507202603, 163.0344461598782),(76.51899554808767, 170.0656961598782),(81.92449797120776, 56.1594461598782)',
                'created_at' => '2022-05-30 13:42:24',
                'updated_at' => '2022-10-25 10:30:01',
            ),
        ));
        
        
    }
}