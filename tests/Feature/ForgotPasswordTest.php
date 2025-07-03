<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

 

    // public function test_returns_error_for_invalid_email()
    // {
    //     Notification::fake();

    //     $response = $this->postJson('/api/forgot-password', [
    //         'email' => 'nonexistent@example.com',
    //     ]);

    //     // Even for non-existent emails, Laravel returns success to avoid leaking emails
    //     $response->assertStatus(200)
    //              ->assertJson(['message' => 'Password reset link sent']);

    //     // Make sure no notification was sent
    //     Notification::assertNothingSent();
    // }

    public function test_fails_validation_with_invalid_email_format()
    {
        $response = $this->postJson('/api/forgot-password', [
            'email' => 'not-an-email',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('email');
    }

    public function test_fails_validation_when_email_missing()
    {
        $response = $this->postJson('/api/forgot-password', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('email');
    }
}
