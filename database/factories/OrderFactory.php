<?php

namespace Database\Factories;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Order::class;

    public function definition()
    {
        return [
            'order_from' => 'ID',
            'order_number' => 'OR123',
            'grand_total' => '10000',
            'transaction_id' => 'X123',
            'transaction_type' => '1',
            'address' => 'address',
            'status' => '1'
        ];
    }
}
