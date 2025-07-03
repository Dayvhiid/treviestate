<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;

class ListingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_property()
    {
        // Fake the storage (no actual file is saved)
        Storage::fake('public');

        // Create and authenticate user
        $user = User::factory()->create();

        // Fake image upload
        $image = UploadedFile::fake()->image('house.jpg');

        // Act as the authenticated user using Sanctum
        $response = $this->actingAs($user, 'sanctum')->postJson('/api/properties', [
            'image' => $image,
            'price' => 250000,
            'location' => 'Lagos',
            'description' => 'A lovely 2-bedroom apartment',
        ]);

        $response->assertStatus(201); // Or 200 based on your controller

        // Optionally verify the file was "stored"
        Storage::disk('public')->assertExists('properties/' . $image->hashName());
    }

    public function test_guest_user_cannot_create_property()
    {
        // Guest (unauthenticated)
        $response = $this->postJson('/api/properties', [
            'price' => 250000,
            'location' => 'Abuja',
            'description' => 'Unauthorized listing',
            'image' => UploadedFile::fake()->image('unauth.jpg'),
        ]);

        $response->assertStatus(401); // Sanctum returns 401 for unauthenticated API
    }

    public function test_user_can_view_own_properties()
    {
        // Create and authenticate user
        $user = User::factory()->create();

        // Create a property for the user
        $property = $user->properties()->create([
            'image' => 'fake_image.jpg',
            'price' => 300000,
            'location' => 'Port Harcourt',
            'description' => 'A beautiful house in Port Harcourt',
        ]);

        // Act as the authenticated user
        $response = $this->actingAs($user, 'sanctum')->getJson('/api/my-properties');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $property->id,
                     'price' => 300000,
                     'location' => 'Port Harcourt',
                 ]);
    }
}
