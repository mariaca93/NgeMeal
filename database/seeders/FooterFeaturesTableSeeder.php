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
                'description' => 'We provide free & reliable shipping.'
            ),
            1 => 
            array (
                'id' => 2,
                'icon' => '<i class="fa-solid fa-map-location-dot"></i>',
                'title' => 'Live Order Tracking',
                'description' => 'Track your order real-time.'
            ),
            2 => 
            array (
                'id' => 3,
                'icon' => '<i class="fa-solid fa-stopwatch-20"></i>',
                'title' => 'Quick Delivery',
                'description' => 'Fast delivery right to your doorstep.'
            ),
        ));
        
        
    }
}