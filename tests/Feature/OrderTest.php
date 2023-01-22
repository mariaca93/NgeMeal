<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetails;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $user = User::factory()->create(); 
        $userId = $user->id;

        $response = $this->actingAs($user)
        ->get(route('order-history'), 
        );
        
        $response->assertViewIs('web.orders.orders');
        $response->assertViewHas('getorders');
        $response->assertStatus(200);
    }

    public function test_status_update(){
        $user = User::factory()->create(); 
        $userId = $user->id;

        $order = Order::factory()->create(['user_id'=>$userId, 'order_number'=>$userId]);
        
        $response = $this->actingAs($user)
        ->post(route('cancelorder'), ['id'=>$userId]
        );

        $order = Order::where('order_number', $userId)->first();
        
        $this->assertEquals($order->status, '7');
        $response->assertStatus(200);
    }

    public function test_order_details()
    {
        $user = User::factory()->create(); 
        $userId = $user->id;
        $orderNumber = Str::random(10);

        $order = Order::factory()->create(['user_id'=>$userId, 'order_number'=>$orderNumber]);
        OrderDetails::factory()->create(['order_id'=>$order->id]);
        
        $response = $this->actingAs($user)
        ->get('orders-'.$orderNumber, ['order_number'=>$orderNumber]
        );

        $orderDetails = OrderDetails::where('order_id', $order->id)->first();
        
        $response->assertViewIs('web.orders.orderdetails');
        $this->assertEquals(json_encode($orderDetails), json_encode($response['ordersdetails'][0]));
        $response->assertStatus(200);
    }
}
