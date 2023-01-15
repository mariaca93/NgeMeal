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
                'id' => 'SUB002',
                'subscription_name' => '4 Meal Vegetarian Pack',
                'price' => '800000',
                'image' => 'subscription-1.jpg',
                'subscription_type' => 1,
                'item_id' => '3,8,9,10',
                'slug' => 'sub2'
            ]
            ]);
    }
}
