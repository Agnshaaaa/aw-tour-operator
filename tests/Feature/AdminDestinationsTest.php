<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDestinationsTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->category = Category::create([
            'name'        => 'Studi Tour',
            'slug'        => 'studi-tour',
            'description' => 'Paket edukasi dan studi tour',
            'order'       => 1,
            'is_active'   => true,
        ]);
    }

    public function test_admin_can_view_destinations_index(): void
    {
        Destination::create([
            'category_id'       => $this->category->id,
            'name'              => 'Kawah Ijen Banyuwangi',
            'slug'              => 'kawah-ijen-banyuwangi',
            'location'          => 'Banyuwangi, Jawa Timur',
            'short_description' => 'Pesona api biru langka dunia.',
            'min_price'         => 750000,
            'min_pax'           => 15,
            'is_active'         => true,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.destinations.index'));

        $response->assertStatus(200);
        $response->assertSee('Kawah Ijen Banyuwangi');
        $response->assertSee('Banyuwangi, Jawa Timur');
    }

    public function test_admin_can_filter_destinations_by_category_and_status(): void
    {
        $cat2 = Category::create([
            'name'      => 'Family Gathering',
            'slug'      => 'family-gathering',
            'order'     => 2,
            'is_active' => true,
        ]);

        Destination::create([
            'category_id'       => $this->category->id,
            'name'              => 'Bromo Tour',
            'slug'              => 'bromo-tour',
            'location'          => 'Probolinggo',
            'short_description' => 'Sunrise Bromo',
            'min_price'         => 600000,
            'min_pax'           => 20,
            'is_active'         => true,
        ]);

        Destination::create([
            'category_id'       => $cat2->id,
            'name'              => 'Pantai Pasir Putih Situbondo',
            'slug'              => 'pantai-pasir-putih-situbondo',
            'location'          => 'Situbondo',
            'short_description' => 'Family Gathering Pantai',
            'min_price'         => 450000,
            'min_pax'           => 30,
            'is_active'         => false,
        ]);

        // Filter by category
        $responseCat = $this->actingAs($this->admin)->get(route('admin.destinations.index', ['category_id' => $cat2->id]));
        $responseCat->assertStatus(200);
        $responseCat->assertSee('Pantai Pasir Putih Situbondo');
        $responseCat->assertDontSee('Bromo Tour');

        // Filter by status active
        $responseActive = $this->actingAs($this->admin)->get(route('admin.destinations.index', ['status' => 'active']));
        $responseActive->assertStatus(200);
        $responseActive->assertSee('Bromo Tour');
        $responseActive->assertDontSee('Pantai Pasir Putih Situbondo');
    }

    public function test_admin_can_view_create_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.destinations.create'));

        $response->assertStatus(200);
        $response->assertSee('Formulir Destinasi Wisata');
        $response->assertSee('Studi Tour');
    }

    public function test_admin_can_store_new_destination_with_detail(): void
    {
        $payload = [
            'category_id'       => $this->category->id,
            'name'              => 'Outbound Coban Rondo',
            'location'          => 'Batu Malang',
            'short_description' => 'Team building seru di air terjun Coban Rondo',
            'description'       => 'Deskripsi lengkap kegiatan outbound',
            'min_price'         => 450000,
            'max_price'         => 800000,
            'min_pax'           => 25,
            'inclusions'        => "Tiket masuk\nGame Master\nMakan Siang",
            'exclusions'        => "Pengeluaran pribadi",
            'notes'             => 'Pakaian olahraga disarankan',
            'is_featured'       => '1',
            'is_active'         => '1',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.destinations.store'), $payload);

        $response->assertRedirect(route('admin.destinations.index'));
        $response->assertSessionHas('success');

        $destination = Destination::where('name', 'Outbound Coban Rondo')->first();
        $this->assertNotNull($destination);
        $this->assertEquals('outbound-coban-rondo', $destination->slug);
        $this->assertTrue($destination->is_featured);
        $this->assertTrue($destination->is_active);

        // Assert detail record created
        $this->assertNotNull($destination->detail);
        $this->assertContains('Tiket masuk', $destination->detail->inclusions);
        $this->assertEquals('Pakaian olahraga disarankan', $destination->detail->notes);
    }

    public function test_admin_can_view_edit_page(): void
    {
        $dest = Destination::create([
            'category_id'       => $this->category->id,
            'name'              => 'Wisata Bahari Lamongan',
            'slug'              => 'wisata-bahari-lamongan',
            'location'          => 'Lamongan',
            'short_description' => 'Wahana wisata air',
            'min_price'         => 350000,
            'min_pax'           => 20,
            'is_active'         => true,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.destinations.edit', $dest->id));

        $response->assertStatus(200);
        $response->assertSee('Wisata Bahari Lamongan');
    }

    public function test_admin_can_update_destination(): void
    {
        $dest = Destination::create([
            'category_id'       => $this->category->id,
            'name'              => 'Jatim Park 1',
            'slug'              => 'jatim-park-1',
            'location'          => 'Batu Malang',
            'short_description' => 'Wisata edukasi dan wahana',
            'min_price'         => 400000,
            'min_pax'           => 15,
            'is_active'         => true,
        ]);

        $dest->detail()->create([
            'notes' => 'Catatan awal',
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.destinations.update', $dest->id), [
            'category_id'       => $this->category->id,
            'name'              => 'Jatim Park 1 & Museum Bagong',
            'location'          => 'Batu Malang, Jawa Timur',
            'short_description' => 'Wisata edukasi anatomi tubuh dan wahana rekreasi',
            'min_price'         => 450000,
            'min_pax'           => 15,
            'notes'             => 'Catatan diperbarui',
            'is_active'         => '1',
        ]);

        $response->assertRedirect(route('admin.destinations.index'));
        $response->assertSessionHas('success');

        $dest->refresh();
        $this->assertEquals('Jatim Park 1 & Museum Bagong', $dest->name);
        $this->assertEquals('jatim-park-1-museum-bagong', $dest->slug);
        $this->assertEquals('Catatan diperbarui', $dest->detail->notes);
    }

    public function test_admin_can_delete_destination(): void
    {
        $dest = Destination::create([
            'category_id'       => $this->category->id,
            'name'              => 'Destinasi Sementara',
            'slug'              => 'destinasi-sementara',
            'location'          => 'Surabaya',
            'short_description' => 'Destinasi uji coba',
            'min_price'         => 100000,
            'min_pax'           => 10,
            'is_active'         => true,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.destinations.destroy', $dest->id));

        $response->assertRedirect(route('admin.destinations.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('destinations', ['id' => $dest->id]);
    }
}
