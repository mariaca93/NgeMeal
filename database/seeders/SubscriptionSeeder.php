<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscription')->insert([
            [
                'id' => 'SUB001',
                'subscription_name' => '5 Meal Vegetarian Pack',
                'price' => '100000',
                'image' => 'subscription-1.jpg',
                'subscription_type' => 1,
                'item_id' => '1,2',
                'slug' => 'sub1'
            ]
            ]);
    }
}
