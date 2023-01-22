<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cuisine_id' => 1,
            'subcuisine_id' => 2,
            'item_name' => 'item_name',
            'weather_id' => 'weather_id',
            'slug' => 'slug',
            'item_type' => 1,
            'tax' => 'tax'
        ];
    }
}
