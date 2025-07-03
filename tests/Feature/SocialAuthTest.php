<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SocialAuthTest extends TestCase
{
     use RefreshDatabase;
    /**
     * A basic feature test example.
     */
   public function test_user_can_login_with_google()
{
    // Fake Google user
    $abstractUser = Mockery::mock(ProviderUser::class);
    $abstractUser->shouldReceive('getEmail')->andReturn('test@example.com');
    $abstractUser->shouldReceive('getName')->andReturn('Test User');

    // Mock Socialite
    Socialite::shouldReceive('driver->stateless->user')->andReturn($abstractUser);

    $response = $this->get('/api/auth/google/callback');

    $response->assertStatus(200)
             ->assertJsonStructure([
                 'access_token',
                 'token_type',
                 'user' => ['id', 'name', 'email'],
             ]);
}
}
