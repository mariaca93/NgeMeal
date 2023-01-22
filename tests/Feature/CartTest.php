<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Support\Str;

class CartTest extends TestCase
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
        ->get(route('cart')
        );

        $response->assertViewIs('web.cart.cart');
        $response->assertViewHas('getcartlist');
        $response->assertStatus(200);
    }

    public function test_addTocart()
    {
        $randSlug = Str::random(5);
        $user = User::factory()->create(); 
        $userId = $user->id;

        $item = Item::factory()->create(['slug'=>$randSlug]);

        $response = $this->actingAs($user)
        ->post(route('additemtocart'), 
        [
            'slug' => $randSlug
        ]
        );

        $item = Item::where('slug', $randSlug)->first();
        $this->assertNotNull($item);
        $response->assertStatus(200);
    }

    public function test_deleteCartItem()
    {
        $user = User::factory()->create(); 
        $userId = $user->id;

        Cart::factory()->create(['id'=>$userId]);

        $response = $this->actingAs($user)
        ->post(route('deletecartitem'), 
        [
            'id' => $userId
        ]
        );

        $cart = Cart::find($userId);
        $this->assertNull($cart);
        $response->assertStatus(200);
    }
}
