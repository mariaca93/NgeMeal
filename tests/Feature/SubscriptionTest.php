<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Subscription;
use Mockery\MockInterface;

class SubscriptionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use withFaker;

    // public function test_showsubscription()
    // {
    //     $user = User::factory()->create(); 
    //     $response = $this->actingAs($user)
    //     ->get(route('showsubscription'), 
    //     [
    //         'slug' => 'sub2'
    //     ]);
    
    //     $mock = $this->mock(Subscription::class, function (MockInterface $mock) {
    //         $mock->shouldReceive('where')->andReturnUsing(function()
    //         {
    //             $subscription = Subscription::factory()->create();
            
    //             return $subscription;
    //         });
    //     });
    //     $response->assertStatus(200);
    // }

    public function test_subscription_details()
    {
        $user = User::factory()->create(); 
        $response = $this->actingAs($user)
        ->get('subscription-sub2', 
        [
            'slug' => 'sub2'
        ]);
    
        // $mock = $this->mock(Subscription::class, function (MockInterface $mock) {
        //     $mock->shouldReceive('where')->andReturnUsing(function()
        //     {
        //         $subscription = Subscription::factory()->create();
            
        //         return $subscription;
        //     });
        // });
        $response->assertStatus(200);
    }
}
