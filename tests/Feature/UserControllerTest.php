<?php

namespace Tests\Feature;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserControllerTest extends TestCase
{

    use withFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creates_user()
    {
        $user = User::factory()->create(); 

        $response = $this->actingAs($user)
        ->post(route('adduser'), 
        [
            'name' => $this->faker->words(3, true),
            'password' => 'pass',
            'password_confirmation' => 'pass',
            'name' => $this->faker->words(3, true),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->randomNumber(8),
            'checkbox' => '1'
        ]);
    
        $response->assertStatus(302);
    
        $response->assertRedirect(route('login'));
    }

    public function test_check_login()
    {
        $user = User::factory()->create(); 
        $email = $this->faker->unique()->safeEmail();
        $response = $this->actingAs($user)
        ->post(route('checklogin'), 
        [
            'password' => '12345',
            'email' => 'user@gmail.com'
        ]);
    
        $response->assertStatus(302);
    
        $response->assertRedirect(route('home'));
    }

    public function test_edit_profile()
    {
        $user = User::factory()->create(); 
        $email = $this->faker->unique()->safeEmail();
        $response = $this->actingAs($user)
        ->post(route('editprofile'), 
        [
            'name' => 'user',
        ]);
    
        $response->assertStatus(302);
    }

    public function test_update_password()
    {
        $user = User::factory()->create(); 
        $email = $this->faker->unique()->safeEmail();
        $response = $this->actingAs($user)
        ->post(route('editprofile'), 
        [
            'old_password' => 'pass',
            'new_password' => 'new_pass',
            'confirm_password' => 'new_pass'
        ]);
    
        $response->assertStatus(302);
    }

    public function test_logout()
    {
        $user = User::factory()->create(); 
        $email = $this->faker->unique()->safeEmail();
        $response = $this->actingAs($user)
        ->get(route('logout'), 
        [
            
        ]);
    
        $response->assertStatus(302);
    }
}
