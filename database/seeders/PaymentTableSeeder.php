<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payment')->delete();
        
        \DB::table('payment')->insert(array (
            0 => 
            array (
                'id' => 1,
                'environment' => 0,
                'payment_name' => 'COD',
                'image' => 'payment-cod.png',
                'currency' => '',
                'public_key' => '',
                'secret_key' => '',
                'encryption_key' => '',
                'is_available' => 1,
                'created_at' => '2020-12-29 09:24:50',
                'updated_at' => '2022-11-15 15:45:21',
            ),
            1 => 
            array (
                'id' => 4,
                'environment' => 1,
                'payment_name' => 'Mastercard',
                'image' => 'payment-mastercard.png',
                'currency' => 'USD',
                'public_key' => 'pk_test_51IjNgIJwZppK21ZQa6e7ZVOImwJ2auI54TD6xHici94u7DD5mhGf1oaBiDyL9mX7PbN5nt6Weap4tmGWLRIrslCu00d8QgQ3nI',
                'secret_key' => 'sk_test_51IjNgIJwZppK21ZQK85uLARMdhtuuhA81PB24VDfiqSW8SXQZKrZzvbpIkigEb27zZPBMF4UEG7PK9587Xresuc000x8CdE22A',
                'encryption_key' => '',
                'is_available' => 1,
                'created_at' => '2020-12-29 09:15:15',
                'updated_at' => '2022-11-15 15:45:21',
            )
        ));
        
        
    }
}