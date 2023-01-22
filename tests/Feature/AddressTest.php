<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Address;
use App\Models\User;

class AddressTest extends TestCase
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
        $getaddresses = Address::select('id','user_id','address_type','address','lat','lang','area','house_no')->where('user_id',$userId)->orderbyDesc('id')->get();
        
        $response = $this->actingAs($user)
        ->get(route('address'), 
        );
        
        $response->assertViewIs('web.address.index');
        $this->assertEquals(json_encode($response['getaddresses']), $getaddresses);
        $response->assertStatus(200);
    }

    public function test_add()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
        ->get(route('add-address'), 
        );
        
        $response->assertViewIs('web.address.add');
        $response->assertStatus(200);
    }

    public function test_store()
    {
        $user = User::factory()->create(); 

        $response = $this->actingAs($user)
        ->post(route('store-address'), 
        [
            'address_type' => 1,
            'address' => 'address',
            'lat' => '-6.1399004',
            'lang' => '106.8692019',
            'house_no' => 'house_no'
        ]
        );
        
        $response->assertRedirect(route('address'));
        $response->assertStatus(302);
    }

    public function test_show()
    {
        $user = User::factory()->create(); 
        $userId = $user->id;

        $address = Address::factory()->create(['id' => $userId]);
        $getaddress = Address::find($userId);
        
        $response = $this->actingAs($user)
        ->get('address-'.$userId, 
        );
        
        $response->assertViewIs('web.address.update');
        $this->assertEquals(json_encode($response['addressdata']), $getaddress);
        $response->assertStatus(200);
    }

    public function test_update()
    {
        $user = User::factory()->create(); 
        $userId = $user->id;

        $address = Address::factory()->create(['id' => $userId]);
        
        $response = $this->actingAs($user)
        ->post('address/update-'.$userId, 
        [
            'address_type' => 1,
            'address' => 'address',
            'lat' => '-6.1399004',
            'lang' => '106.8692019',
            'house_no' => 'house_no'
        ]
        );
        
        $getaddress = Address::find($userId);
        $this->assertEquals(1, $getaddress->address_type);
        $this->assertEquals('address', $getaddress->address);
        $this->assertEquals('-6.1399004', $getaddress->lat);
        $this->assertEquals('106.8692019', $getaddress->lang);
        $this->assertEquals('house_no', $getaddress->house_no);
        $response->assertRedirect(route('address'));
        $response->assertStatus(302);
    }

    public function test_delete()
    {
        $user = User::factory()->create(); 
        $userId = $user->id;

        $address = Address::factory()->create(['id' => $userId]);
        
        $response = $this->actingAs($user)
        ->post('address/update-'.$userId, 
        [
            'address_type' => 1,
            'address' => 'address',
            'lat' => '-6.1399004',
            'lang' => '106.8692019',
            'house_no' => 'house_no'
        ]
        );
        
        $getaddress = Address::find($userId);
        $this->assertEquals(1, $getaddress->address_type);
        $this->assertEquals('address', $getaddress->address);
        $this->assertEquals('-6.1399004', $getaddress->lat);
        $this->assertEquals('106.8692019', $getaddress->lang);
        $this->assertEquals('house_no', $getaddress->house_no);
        $response->assertRedirect(route('address'));
        $response->assertStatus(302);
    }
}
