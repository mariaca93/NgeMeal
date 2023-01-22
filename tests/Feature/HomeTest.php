<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HomeTest extends TestCase
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
        ->get(route('home'), 
        );

        $response->assertStatus(200);
    }
}
