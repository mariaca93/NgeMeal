<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Address;

class CheckoutTest extends TestCase
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

        $address = Address::factory()->create(['user_id' => $userId]);
        $cart =  Cart::factory()->create(['user_id'=>$userId]);

        $response = $this->actingAs($user)
        ->get(route('checkout')
        );

        $getaddresses = Address::select('id','user_id','address_type','address','lat','lang','area','house_no',)->where('user_id',$userId)->orderbyDesc('id')->get();
        $getcartlist = Cart::where('user_id',$userId)->orderByDesc('id')->get();
        
        $response->assertViewIs('web.checkout.checkout');
        $this->assertEquals(json_encode($response['getaddresses']), $getaddresses);
        $this->assertEquals(json_encode($response['getcartlist']), $getcartlist);
        $response->assertStatus(200);
    }

    public function test_placeorder()
    {
        $user = User::factory()->create(); 
        $userId = $user->id;
        
        $response = $this->actingAs($user)
        ->post(route('placeorder'), 
        [
            'transaction_type' => '1',
            'grand_total' => '10000',
            'address' => 'address',
            'area' => 'area',
            'address_type' => '1',
            'lat' => 'lat',
            'lang' => 'lang',
            'house_no' => 'house_no'
        ]
        );

        $response->assertStatus(200);
    }
}
