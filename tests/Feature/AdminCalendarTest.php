<?php

namespace Tests\Feature;

use App\Models\BookedDate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCalendarTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);
    }

    public function test_admin_can_view_calendar_index(): void
    {
        BookedDate::create([
            'booked_date' => '2026-11-15',
            'label'       => 'Family Gathering PT Telkom',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.calendar.index', [
            'year'  => 2026,
            'month' => 11,
        ]));

        $response->assertStatus(200);
        $response->assertSee('November 2026');
        $response->assertSee('Family Gathering PT Telkom');
    }

    public function test_admin_can_add_manual_booked_date_with_null_custom_request_id(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.calendar.store'), [
            'booked_date' => '2026-12-25',
            'label'       => 'Libur Natal & Maintenance Armada',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $booked = BookedDate::where('label', 'Libur Natal & Maintenance Armada')->first();
        $this->assertNotNull($booked);
        $this->assertNull($booked->custom_request_id);
        $this->assertEquals('2026-12-25', $booked->booked_date->format('Y-m-d'));
    }

    public function test_admin_cannot_add_duplicate_booked_date(): void
    {
        BookedDate::create([
            'booked_date' => '2026-12-25',
            'label'       => 'Existing Booking',
        ]);

        $response = $this->actingAs($this->admin)->post(route('admin.calendar.store'), [
            'booked_date' => '2026-12-25',
            'label'       => 'Duplicate Booking',
        ]);

        $response->assertSessionHasErrors('booked_date');
        $this->assertDatabaseMissing('booked_dates', ['label' => 'Duplicate Booking']);
    }

    public function test_admin_can_delete_booked_date(): void
    {
        $date = BookedDate::create([
            'booked_date' => '2026-12-30',
            'label'       => 'Temporary Block',
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.calendar.destroy', $date->id));

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('booked_dates', ['id' => $date->id]);
    }
}
