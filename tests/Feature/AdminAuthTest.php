<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_login_page(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertSee('Portal Executive Admin');
        // Credentials must not be exposed on the page
        $response->assertDontSee('admin123');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $admin = User::factory()->create([
            'role'     => 'admin',
            'email'    => 'superadmin@awtour.com',
            'password' => Hash::make('secretPassword123'),
        ]);

        $response = $this->post(route('admin.login'), [
            'email'    => 'superadmin@awtour.com',
            'password' => 'secretPassword123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_admin_cannot_login_with_invalid_credentials(): void
    {
        User::factory()->create([
            'role'     => 'admin',
            'email'    => 'superadmin@awtour.com',
            'password' => Hash::make('secretPassword123'),
        ]);

        $response = $this->from(route('admin.login'))->post(route('admin.login'), [
            'email'    => 'superadmin@awtour.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    public function test_admin_can_logout(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }
}
