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
                'image' => 'payment-63739ef98fac6.png',
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
                'id' => 2,
                'environment' => 0,
                'payment_name' => 'Wallet',
                'image' => 'payment-63739ef99ee19.png',
                'currency' => '',
                'public_key' => '',
                'secret_key' => '',
                'encryption_key' => '',
                'is_available' => 1,
                'created_at' => '2020-12-29 09:15:15',
                'updated_at' => '2022-11-19 07:29:20',
            ),
            2 => 
            array (
                'id' => 3,
                'environment' => 1,
                'payment_name' => 'RazorPay',
                'image' => 'payment-63739ef9ad8f5.png',
                'currency' => 'INR',
                'public_key' => 'rzp_test_4r8y0wDMkrUDFn',
                'secret_key' => 'nEDuJlpL3x2BqHxYlQBYtrto',
                'encryption_key' => '',
                'is_available' => 1,
                'created_at' => '2020-12-29 09:15:15',
                'updated_at' => '2022-11-19 07:29:20',
            ),
            3 => 
            array (
                'id' => 4,
                'environment' => 1,
                'payment_name' => 'Stripe',
                'image' => 'payment-63739ef9eba1a.png',
                'currency' => 'USD',
                'public_key' => 'pk_test_51IjNgIJwZppK21ZQa6e7ZVOImwJ2auI54TD6xHici94u7DD5mhGf1oaBiDyL9mX7PbN5nt6Weap4tmGWLRIrslCu00d8QgQ3nI',
                'secret_key' => 'sk_test_51IjNgIJwZppK21ZQK85uLARMdhtuuhA81PB24VDfiqSW8SXQZKrZzvbpIkigEb27zZPBMF4UEG7PK9587Xresuc000x8CdE22A',
                'encryption_key' => '',
                'is_available' => 1,
                'created_at' => '2020-12-29 09:15:15',
                'updated_at' => '2022-11-15 15:45:21',
            ),
            4 => 
            array (
                'id' => 5,
                'environment' => 1,
                'payment_name' => 'Flutterwave',
                'image' => 'payment-63739efa4b392.png',
                'currency' => 'NGN',
                'public_key' => 'FLWPUBK_TEST-61c94068c4a44548a771cc7cf9548d05-X',
                'secret_key' => 'FLWSECK_TEST-1140781769b7bd5cfd6b3fb6d5704017-X',
                'encryption_key' => 'FLWSECK_TEST863a39eb1475',
                'is_available' => 1,
                'created_at' => '2020-12-29 09:15:15',
                'updated_at' => '2022-11-15 15:45:22',
            ),
            5 => 
            array (
                'id' => 6,
                'environment' => 1,
                'payment_name' => 'Paystack',
                'image' => 'payment-63739efa906ca.png',
                'currency' => 'GHS',
                'public_key' => 'pk_test_8a6a139a3bae6e41cbbbc41f4d7b65d4da9f7967',
                'secret_key' => 'sk_test_6ab143b6f0c2a209373adeef55a64411c1a91ae9',
                'encryption_key' => '',
                'is_available' => 1,
                'created_at' => '2020-12-29 09:15:15',
                'updated_at' => '2022-11-15 15:45:22',
            ),
        ));
        
        
    }
}