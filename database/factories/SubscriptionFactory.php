<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{

    protected $model = Subscription::class;
   
    public function definition()
    { 
        return [
            'id' => 'SUB003',
            'slug' => 'sub2',
            'subscription_name' => Str::random(10),
            'subscription_type' => '1',
            'price' => 12000,
            'image' => Str::random(10)
        ];
    }
}
