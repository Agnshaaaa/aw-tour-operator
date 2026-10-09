<?php

namespace Tests\Feature;

use App\Models\Destination;
use App\Models\Documentation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GalleryAlbumTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_public_gallery_displays_album_cards_with_media_count(): void
    {
        $doc = Documentation::create([
            'title'             => 'Gathering PT Semen Indonesia',
            'description'       => 'Gathering seru di Bromo dengan jeep hardtop.',
            'image_path'        => 'images/Bromo.jpg',
            'trip_date'         => '2026-08-15',
            'participant_count' => 120,
            'badge_text'        => 'Rombongan Terbanyak',
            'is_featured'       => true,
            'is_active'         => true,
        ]);

        $doc->media()->createMany([
            ['type' => 'image', 'file_path' => 'images/Bromo.jpg', 'caption' => 'Foto 1', 'sort_order' => 1],
            ['type' => 'image', 'file_path' => 'images/Bromo.jpg', 'caption' => 'Foto 2', 'sort_order' => 2],
            ['type' => 'video', 'file_path' => 'https://www.youtube.com/watch?v=1F3X1N_wTio', 'caption' => 'Aftermovie', 'sort_order' => 3],
        ]);

        $response = $this->get(route('gallery.index'));

        $response->assertOk()
            ->assertSee('Gathering PT Semen Indonesia')
            ->assertSee('120 Pax')
            ->assertSee('Rombongan Terbanyak')
            ->assertSee('2 Foto')
            ->assertSee('1 Video');
    }

    public function test_admin_can_create_album_with_multiple_photos_and_video(): void
    {
        Storage::fake('public');

        $admin = $this->admin();
        $cover = UploadedFile::fake()->create('cover.jpg', 100, 'image/jpeg');
        $photo1 = UploadedFile::fake()->create('p1.jpg', 100, 'image/jpeg');
        $photo2 = UploadedFile::fake()->create('p2.jpg', 100, 'image/jpeg');

        $payload = [
            'title'             => 'Studi Tour UNESA Yogyakarta',
            'badge_text'        => 'Studi Tour Favorit',
            'trip_date'         => '2026-07-20',
            'participant_count' => 90,
            'description'       => 'Studi tour mahasiswa ke Malioboro.',
            'image'             => $cover,
            'photos'            => [$photo1, $photo2],
            'video_url'         => 'https://www.youtube.com/watch?v=example123',
            'video_caption'     => 'Aftermovie Video UNESA',
            'is_active'         => '1',
            'is_featured'       => '1',
        ];

        $response = $this->actingAs($admin)->post(route('admin.gallery.store'), $payload);

        $response->assertRedirect(route('admin.gallery.index'));

        $doc = Documentation::where('title', 'Studi Tour UNESA Yogyakarta')->firstOrFail();
        $this->assertSame(90, $doc->participant_count);
        $this->assertTrue($doc->is_featured);

        // Harus ada cover + 2 foto + 1 video = 4 media items
        $this->assertSame(4, $doc->media()->count());
        $this->assertSame(3, $doc->photos()->count());
        $this->assertSame(1, $doc->videos()->count());
    }

    public function test_admin_can_delete_individual_media_item_from_album(): void
    {
        Storage::fake('public');

        $admin = $this->admin();
        $doc = Documentation::create([
            'title'       => 'Test Album Deletion',
            'image_path'  => 'images/Bromo.jpg',
            'is_active'   => true,
        ]);

        $media = $doc->media()->create([
            'type'      => 'video',
            'file_path' => 'https://www.youtube.com/watch?v=example',
            'caption'   => 'Video to delete',
        ]);

        $this->assertSame(1, $doc->media()->count());

        $response = $this->actingAs($admin)->delete(route('admin.gallery.media.destroy', $media->id));

        $response->assertRedirect();
        $this->assertSame(0, $doc->fresh()->media()->count());
    }
}
