<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FooterFeaturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('footer_features')->delete();
        
        \DB::table('footer_features')->insert(array (
            0 => 
            array (
                'id' => 1,
                'icon' => '<i class="fa-solid fa-truck-fast"></i>',
                'title' => 'Free Shipping',
                'description' => 'Lorem ipsum dolor sit amet, consectetur',
                'created_at' => '2022-11-15 15:00:49',
                'updated_at' => '2022-11-15 15:00:49',
            ),
            1 => 
            array (
                'id' => 2,
                'icon' => '<i class="fa-solid fa-map-location-dot"></i>',
                'title' => 'Live Order Tracking',
                'description' => 'Lorem ipsum dolor sit amet, consectetur',
                'created_at' => '2022-11-15 15:00:49',
                'updated_at' => '2022-11-15 15:00:49',
            ),
            2 => 
            array (
                'id' => 3,
                'icon' => '<i class="fa-solid fa-stopwatch-20"></i>',
                'title' => 'Quick Delivery',
                'description' => 'Lorem ipsum dolor sit amet, consectetur',
                'created_at' => '2022-11-15 15:00:49',
                'updated_at' => '2022-11-15 15:00:49',
            ),
        ));
        
        
    }
}