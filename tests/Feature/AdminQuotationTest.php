<?php

namespace Tests\Feature;

use App\Models\BookedDate;
use App\Models\Category;
use App\Models\CustomRequest;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminQuotationTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected Destination $destination;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $category = Category::create([
            'name'        => 'Studi Tour',
            'slug'        => 'studi-tour',
            'description' => 'Paket studi tour',
            'order'       => 1,
            'is_active'   => true,
        ]);

        $this->destination = Destination::create([
            'category_id'       => $category->id,
            'name'              => 'Gunung Bromo',
            'slug'              => 'gunung-bromo',
            'location'          => 'Probolinggo, Jatim',
            'short_description' => 'Indahnya kawah Bromo',
            'min_price'         => 500000,
            'min_pax'           => 10,
            'is_active'         => true,
        ]);
    }

    public function test_admin_can_view_quotations_list(): void
    {
        CustomRequest::create([
            'destination_id'   => $this->destination->id,
            'ticket_number'    => 'AW-20261005-0001',
            'client_name'      => 'Ahmad Dani',
            'institution_name' => 'SMK Negeri 1 Surabaya',
            'phone'            => '081234567890',
            'event_type'       => 'Studi Tour',
            'event_date'       => '2026-11-10',
            'pax'              => 45,
            'transport_mode'   => 'Bus Pariwisata',
            'status'           => 'pending',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.requests.index'));

        $response->assertStatus(200);
        $response->assertSee('AW-20261005-0001');
        $response->assertSee('SMK Negeri 1 Surabaya');
    }

    public function test_admin_can_filter_quotations_by_status_and_search(): void
    {
        CustomRequest::create([
            'destination_id'   => $this->destination->id,
            'ticket_number'    => 'AW-20261005-0001',
            'client_name'      => 'Budi',
            'institution_name' => 'PT Pelindo',
            'phone'            => '081234567890',
            'event_type'       => 'Family Gathering',
            'event_date'       => '2026-11-10',
            'pax'              => 50,
            'transport_mode'   => 'Bus',
            'status'           => 'pending',
        ]);

        CustomRequest::create([
            'destination_id'   => $this->destination->id,
            'ticket_number'    => 'AW-20261005-0002',
            'client_name'      => 'Citra',
            'institution_name' => 'Universitas Airlangga',
            'phone'            => '089876543210',
            'event_type'       => 'Studi Tour',
            'event_date'       => '2026-12-01',
            'pax'              => 30,
            'transport_mode'   => 'Hiace',
            'status'           => 'confirmed',
        ]);

        // Filter status pending
        $responsePending = $this->actingAs($this->admin)->get(route('admin.requests.index', ['status' => 'pending']));
        $responsePending->assertStatus(200);
        $responsePending->assertSee('PT Pelindo');
        $responsePending->assertDontSee('Universitas Airlangga');

        // Search query
        $responseSearch = $this->actingAs($this->admin)->get(route('admin.requests.index', ['search' => 'Airlangga']));
        $responseSearch->assertStatus(200);
        $responseSearch->assertSee('Universitas Airlangga');
        $responseSearch->assertDontSee('PT Pelindo');
    }

    public function test_admin_can_view_quotation_detail(): void
    {
        $request = CustomRequest::create([
            'destination_id'   => $this->destination->id,
            'ticket_number'    => 'AW-20261005-0099',
            'client_name'      => 'Dewi Sartika',
            'institution_name' => 'SMA Wijaya Kusuma',
            'phone'            => '081122334455',
            'email'            => 'dewi@smawijaya.sch.id',
            'event_type'       => 'LDKS Siswa',
            'event_date'       => '2026-11-15',
            'return_date'      => '2026-11-17',
            'pax'              => 80,
            'transport_mode'   => '2 Unit Bus Pariwisata',
            'notes'            => 'Memerlukan briefing khusus untuk guru pendamping.',
            'status'           => 'pending',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.requests.show', $request->id));

        $response->assertStatus(200);
        $response->assertSee('AW-20261005-0099');
        $response->assertSee('SMA Wijaya Kusuma');
        $response->assertSee('Dewi Sartika');
        $response->assertSee('081122334455');
    }

    public function test_updating_status_to_confirmed_locks_date_in_calendar(): void
    {
        $request = CustomRequest::create([
            'destination_id'   => $this->destination->id,
            'ticket_number'    => 'AW-20261005-0010',
            'client_name'      => 'Eko Prasetyo',
            'institution_name' => 'PT Petrokimia',
            'phone'            => '082233445566',
            'event_type'       => 'Gathering',
            'event_date'       => '2026-11-20',
            'pax'              => 40,
            'transport_mode'   => 'Bus Medium',
            'status'           => 'pending',
        ]);

        $this->actingAs($this->admin)->patch(route('admin.requests.update-status', $request->id), [
            'status'      => 'confirmed',
            'admin_notes' => 'DP 50% sudah diterima via transfer bank BCA.',
        ]);

        $request->refresh();
        $this->assertEquals('confirmed', $request->status);
        $this->assertEquals('DP 50% sudah diterima via transfer bank BCA.', $request->admin_notes);

        // Pastikan tanggal terpesan otomatis tercatat di kalender
        $booked = BookedDate::where('custom_request_id', $request->id)->first();
        $this->assertNotNull($booked);
        $this->assertEquals('2026-11-20', $booked->booked_date->format('Y-m-d'));
    }

    public function test_updating_status_to_cancelled_releases_booked_date_from_calendar(): void
    {
        $request = CustomRequest::create([
            'destination_id'   => $this->destination->id,
            'ticket_number'    => 'AW-20261005-0020',
            'client_name'      => 'Fajar Nugraha',
            'institution_name' => 'Dinas Pendidikan',
            'phone'            => '083344556677',
            'event_type'       => 'Kunjungan Kerja',
            'event_date'       => '2026-11-25',
            'pax'              => 25,
            'transport_mode'   => 'Hiace',
            'status'           => 'confirmed',
        ]);

        // Simulasikan tanggal sudah terpesan
        BookedDate::create([
            'custom_request_id' => $request->id,
            'booked_date'       => '2026-11-25',
            'label'             => 'Dinas Pendidikan - Kunjungan Kerja',
        ]);

        $this->assertDatabaseHas('booked_dates', [
            'custom_request_id' => $request->id,
        ]);

        // Admin membatalkan permintaan
        $this->actingAs($this->admin)->patch(route('admin.requests.update-status', $request->id), [
            'status'      => 'cancelled',
            'admin_notes' => 'Klien mengonfirmasi pembatalan acara.',
        ]);

        $request->refresh();
        $this->assertEquals('cancelled', $request->status);

        // Pastikan tanggal telah dilepaskan dari booked_dates
        $this->assertDatabaseMissing('booked_dates', [
            'custom_request_id' => $request->id,
        ]);
    }

    public function test_admin_can_delete_quotation(): void
    {
        $request = CustomRequest::create([
            'destination_id'   => $this->destination->id,
            'ticket_number'    => 'AW-20261005-0030',
            'client_name'      => 'Gilang',
            'institution_name' => 'Komunitas Gowes',
            'phone'            => '084455667788',
            'event_type'       => 'Touring',
            'event_date'       => '2026-12-10',
            'pax'              => 20,
            'transport_mode'   => 'Pick Up & Elf',
            'status'           => 'pending',
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.requests.destroy', $request->id));

        $response->assertRedirect(route('admin.requests.index'));
        $this->assertDatabaseMissing('custom_requests', ['id' => $request->id]);
    }
}
