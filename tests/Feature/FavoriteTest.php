<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Favorite;

class FavoriteTest extends TestCase
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

        $item = Item::factory()->create(['id' => $userId]);
        $favorite =  Favorite::factory()->create(['item_id'=>$userId, 'user_id' => $userId]);
        $cart = Cart::factory()->create(['item_id'=>$userId, 'user_id'=>$userId]);
        $response = $this->actingAs($user)
        ->get(route('user-favouritelist')
        );

        // $response->assertViewIs('web.favoritelist');
        // $response->assertViewHas('getfavoritelist');
        // $response->assertStatus(200);
    }

    public function test_managefavorites()
    {
        $user = User::factory()->create(); 
        $userId = $user->id;

        $favorite =  Favorite::factory()->create(['item_id'=>'slug', 'user_id' => $userId]);
        $response = $this->actingAs($user)
        ->post(route('managefavorites'), 
        [
            'slug' => 'slug',
            'type' => 1,
            'favurl' => 'favurl'
        ]
        );

        $data = '<a class="heart-icon btn btn-wishlist" href="javascript:void(0)" onclick="managefavorite('.'slug'.',0,'.chr(0x27).'favurl'.chr(0x27).')" title="'.trans('labels.remove_wishlist').'"> <i class="fa-solid fa-bookmark fs-5"></i> </a>';
        
        $this->assertEquals($response['data'], $data);
        $response->assertStatus(200);
    }
}
