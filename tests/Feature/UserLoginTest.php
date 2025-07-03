<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
        use RefreshDatabase;
    /**
     * A basic feature test example.
     */
   public function test_user_can_login()
    {
     $response = $this->post('/api/register', [
           'name' => 'Test User',
           'email' => 'dada35@gmail.com',
            'password' => 'password',
     ]);      
     
     $response->assertStatus(200);
 
    }
}
