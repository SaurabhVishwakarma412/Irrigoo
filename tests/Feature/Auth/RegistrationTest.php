<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'farmer',
            'location' => 'Pune',
            'crop_type' => 'Sugarcane',
            'organization' => 'Test Farm',
            'phone' => '9876543210',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => 'farmer',
        ]);
        $this->assertDatabaseHas('farmer_profiles', [
            'location' => 'Pune',
            'crop_type' => 'Sugarcane',
        ]);
        $response->assertRedirect(route('login', absolute: false));
    }

    public function test_provider_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Provider User',
            'email' => 'provider-user@example.com',
            'role' => 'provider',
            'location' => 'Pune',
            'organization' => 'Provider Services',
            'service_area' => 'Pune District',
            'phone' => '9876543210',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $this->assertDatabaseHas('users', [
            'email' => 'provider-user@example.com',
            'role' => 'provider',
        ]);
        $this->assertDatabaseHas('provider_profiles', [
            'organization' => 'Provider Services',
            'service_area' => 'Pune District',
        ]);
        $response->assertRedirect(route('login', absolute: false));
    }

    public function test_manufacturer_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Manufacturer User',
            'email' => 'manufacturer-user@example.com',
            'role' => 'manufacturer',
            'location' => 'Mumbai',
            'organization' => 'Manufacturer Industries',
            'phone' => '9876543210',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $this->assertDatabaseHas('users', [
            'email' => 'manufacturer-user@example.com',
            'role' => 'manufacturer',
        ]);
        $this->assertDatabaseHas('manufacturer_profiles', [
            'organization' => 'Manufacturer Industries',
            'location' => 'Mumbai',
        ]);
        $response->assertRedirect(route('login', absolute: false));
    }
}
