<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'item_id' => '1',
            'item_name' => 'item_name',
            'item_image' => 'item_image',
            'item_type' => 'veg',
            'qty' => 1,
            'item_price' => '10000'
        ];
    }
}
