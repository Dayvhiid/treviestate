<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegisterationTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_user_can_register()
    {
     $response = $this->post('/api/register', [
           'name' => 'Test User',
           'email' => 'dada35@gmail.com',
            'password' => 'password',
     ]);      
     
     $response->assertStatus(200);
 
    }

    public function test_user_can_get_profile(){
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'sanctum')->get('/api/user');
        $response->assertStatus(200)
                 ->assertJson([
                     'name' => $user->name,
                     'email' => $user->email,
                 ]);
    }

    public function test_user_can_logout(){
        $user = User::factory()->create();
        $response = $this->actingAs($user, 'sanctum')->post('/api/logout');
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Logged out']);
    }

     
}
