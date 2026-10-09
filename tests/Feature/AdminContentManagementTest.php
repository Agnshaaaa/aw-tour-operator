<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\TransportOffering;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContentManagementTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_transport_catalog_is_public_and_uses_admin_content(): void
    {
        TransportOffering::create([
            'name' => 'Big Bus',
            'slug' => 'big-bus',
            'display_group' => 'vehicle',
            'capacity' => '45–59 seat',
            'price_label' => 'Rp3.500.000/hari',
            'description' => 'Armada rombongan besar.',
            'features' => ['AC'],
            'is_active' => true,
        ]);

        $this->get(route('transport.index'))
            ->assertOk()
            ->assertSee('Big Bus')
            ->assertSee('45–59 seat')
            ->assertSee('Rp3.500.000/hari');
    }

    public function test_admin_can_create_and_edit_transport_content(): void
    {
        $admin = $this->admin();
        $payload = [
            'name' => 'Hiace Premium',
            'display_group' => 'vehicle',
            'capacity' => '14–19 seat',
            'price_label' => 'Mulai Rp1.200.000/hari',
            'description' => 'Armada untuk rombongan kecil.',
            'features' => "Full AC\nFleksibel",
            'unit_count' => '',
            'sort_order' => 1,
            'is_active' => '1',
        ];

        $this->actingAs($admin)->post(route('admin.transports.store'), $payload)
            ->assertRedirect(route('admin.transports.index'));

        $offering = TransportOffering::where('name', 'Hiace Premium')->firstOrFail();
        $this->assertSame('hiace-premium', $offering->slug);
        $this->assertSame(['Full AC', 'Fleksibel'], $offering->features);

        $this->actingAs($admin)->put(route('admin.transports.update', $offering->id), array_merge($payload, [
            'name' => 'Hiace Executive',
            'is_active' => '0',
        ]))->assertRedirect(route('admin.transports.index'));

        $this->assertDatabaseHas('transport_offerings', [
            'id' => $offering->id,
            'name' => 'Hiace Executive',
            'slug' => 'hiace-executive',
            'is_active' => false,
        ]);
    }

    public function test_guest_cannot_manage_transport_content(): void
    {
        $this->get(route('admin.transports.index'))->assertRedirect(route('admin.login'));
    }

    public function test_public_site_does_not_expose_the_admin_entry_link(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee(route('admin.login'))
            ->assertDontSee('Area Login Staff / Admin');
    }

    public function test_old_umkm_url_redirects_to_the_real_transport_page(): void
    {
        $this->get('/umkm')->assertRedirect('/transportasi');
    }

    public function test_admin_can_update_company_profile_used_by_public_site(): void
    {
        $admin = $this->admin();
        $this->actingAs($admin)->put(route('admin.site-settings.update'), [
            'company_name' => 'AW Tour Surabaya',
            'profile_description' => 'Profil yang diperbarui.',
            'location' => 'Surabaya, Jawa Timur',
            'partners_text' => "ITS Surabaya\nUNAIR",
            'whatsapp_number' => '+62 812-3456-7890',
            'email' => 'halo@example.test',
            'operational_hours' => 'Senin-Jumat 09.00-17.00 WIB',
        ])->assertRedirect();

        $settings = SiteSetting::firstOrFail();
        $this->assertSame(['ITS Surabaya', 'UNAIR'], $settings->partners);
        $this->assertSame('6281234567890', $settings->whatsapp_number);
        $this->get(route('home'))->assertOk()->assertSee('Profil yang diperbarui.')->assertSee('UNAIR');
    }
}
