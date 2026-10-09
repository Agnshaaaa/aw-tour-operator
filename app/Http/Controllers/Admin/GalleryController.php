<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Documentation;
use App\Models\DocumentationMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Controller: Admin\GalleryController
 *
 * Mengelola CRUD album dokumentasi & galeri foto/video perjalanan rombongan
 * yang tampil di Hero Section dan Halaman Galeri Publik.
 */
class GalleryController extends Controller
{
    /**
     * Tampilkan daftar dokumentasi galeri.
     */
    public function index(Request $request)
    {
        $query = Documentation::with(['destination', 'media'])->latest('id');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('badge_text', 'like', "%{$search}%");
            });
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured === '1');
        }

        $documentations = $query->paginate(12)->withQueryString();
        $destinations = Destination::active()->orderBy('name')->get();

        return view('admin.gallery.index', compact('documentations', 'destinations'));
    }

    /**
     * Tampilkan form tambah foto dokumentasi baru.
     */
    public function create()
    {
        $destinations = Destination::active()->orderBy('name')->get();
        return view('admin.gallery.create', compact('destinations'));
    }

    /**
     * Simpan album dokumentasi baru (Cover + Banyak Foto + Video) ke database & storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'destination_id'    => 'nullable|exists:destinations,id',
            'image'             => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'photos.*'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'video_url'         => 'nullable|url',
            'video_caption'     => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'trip_date'         => 'nullable|date',
            'participant_count' => 'nullable|integer|min:1',
            'badge_text'        => 'nullable|string|max:100',
            'is_featured'       => 'nullable|boolean',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
        ], [
            'title.required'    => 'Judul dokumentasi wajib diisi.',
            'image.required'    => 'Foto sampul (cover) wajib diunggah.',
            'image.image'       => 'File sampul harus berupa gambar valid (JPG, PNG, WEBP).',
            'image.max'         => 'Ukuran foto sampul maksimal 5MB.',
            'photos.*.image'    => 'File galeri harus berupa gambar valid.',
            'photos.*.max'      => 'Ukuran masing-masing foto maksimal 5MB.',
        ]);

        // 1. Upload Cover Image
        $imagePath = $request->file('image')->store('gallery', 'public');

        $doc = Documentation::create([
            'title'             => $validated['title'],
            'destination_id'    => $validated['destination_id'] ?? null,
            'image_path'        => $imagePath,
            'description'       => $validated['description'] ?? null,
            'trip_date'         => $validated['trip_date'] ?? null,
            'participant_count' => $validated['participant_count'] ?? null,
            'badge_text'        => $validated['badge_text'] ?: 'Rombongan Tour Terbanyak - 50+ Trip',
            'is_featured'       => $request->has('is_featured'),
            'is_active'         => $request->has('is_active') ? true : ($request->exists('is_active') ? false : true),
            'sort_order'        => $validated['sort_order'] ?? 0,
        ]);

        // Simpan foto cover juga sebagai item media pertama
        $doc->media()->create([
            'type'       => 'image',
            'file_path'  => $imagePath,
            'caption'    => 'Foto Sampul: ' . $doc->title,
            'sort_order' => 1,
        ]);

        // 2. Upload Multi Photos (Koleksi Foto Album)
        if ($request->hasFile('photos')) {
            $order = 2;
            foreach ($request->file('photos') as $photoFile) {
                $photoPath = $photoFile->store('gallery/album_' . $doc->id, 'public');
                $doc->media()->create([
                    'type'       => 'image',
                    'file_path'  => $photoPath,
                    'caption'    => $doc->title . ' - Foto ' . $order,
                    'sort_order' => $order++,
                ]);
            }
        }

        // 3. Tambahkan Video (YouTube / Link Video) jika ada
        if (!empty($validated['video_url'])) {
            $doc->media()->create([
                'type'       => 'video',
                'file_path'  => $validated['video_url'],
                'caption'    => $validated['video_caption'] ?: 'Video Dokumentasi: ' . $doc->title,
                'sort_order' => 99,
            ]);
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Album dokumentasi perjalanan (' . $doc->media()->count() . ' media) berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit foto dokumentasi.
     */
    public function edit(int $id)
    {
        $documentation = Documentation::with('media')->findOrFail($id);
        $destinations = Destination::active()->orderBy('name')->get();

        return view('admin.gallery.edit', compact('documentation', 'destinations'));
    }

    /**
     * Update data dokumentasi, tambah foto/video baru ke album.
     */
    public function update(Request $request, int $id)
    {
        $documentation = Documentation::findOrFail($id);

        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'destination_id'    => 'nullable|exists:destinations,id',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'photos.*'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'video_url'         => 'nullable|url',
            'video_caption'     => 'nullable|string|max:255',
            'description'       => 'nullable|string',
            'trip_date'         => 'nullable|date',
            'participant_count' => 'nullable|integer|min:1',
            'badge_text'        => 'nullable|string|max:100',
            'is_featured'       => 'nullable|boolean',
            'is_active'         => 'nullable|boolean',
            'sort_order'        => 'nullable|integer',
        ], [
            'title.required'    => 'Judul dokumentasi wajib diisi.',
            'image.image'       => 'File sampul harus berupa gambar valid (JPG, PNG, WEBP).',
            'image.max'         => 'Ukuran foto maksimal 5MB.',
        ]);

        $imagePath = $documentation->image_path;

        if ($request->hasFile('image')) {
            if ($imagePath && !str_starts_with($imagePath, 'images/') && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('gallery', 'public');
        }

        $documentation->update([
            'title'             => $validated['title'],
            'destination_id'    => $validated['destination_id'] ?? null,
            'image_path'        => $imagePath,
            'description'       => $validated['description'] ?? null,
            'trip_date'         => $validated['trip_date'] ?? null,
            'participant_count' => $validated['participant_count'] ?? null,
            'badge_text'        => $validated['badge_text'] ?: 'Rombongan Tour Terbanyak - 50+ Trip',
            'is_featured'       => $request->has('is_featured'),
            'is_active'         => $request->has('is_active'),
            'sort_order'        => $validated['sort_order'] ?? 0,
        ]);

        // Upload Tambahan Foto Baru ke Album
        if ($request->hasFile('photos')) {
            $lastOrder = $documentation->media()->max('sort_order') ?? 1;
            foreach ($request->file('photos') as $photoFile) {
                $photoPath = $photoFile->store('gallery/album_' . $documentation->id, 'public');
                $documentation->media()->create([
                    'type'       => 'image',
                    'file_path'  => $photoPath,
                    'caption'    => $documentation->title,
                    'sort_order' => ++$lastOrder,
                ]);
            }
        }

        // Tambah Video Baru jika diisi
        if (!empty($validated['video_url'])) {
            $documentation->media()->create([
                'type'       => 'video',
                'file_path'  => $validated['video_url'],
                'caption'    => $validated['video_caption'] ?: 'Video Dokumentasi: ' . $documentation->title,
                'sort_order' => 99,
            ]);
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Album dokumentasi (' . $documentation->media()->count() . ' media) berhasil diperbarui!');
    }

    /**
     * Hapus satu item media (Foto / Video) spesifik dari dalam album.
     */
    public function destroyMedia(int $mediaId)
    {
        $media = DocumentationMedia::findOrFail($mediaId);

        if ($media->type === 'image' && !str_starts_with($media->file_path, 'images/') && Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        $media->delete();

        return back()->with('success', 'Media berhasil dihapus dari album.');
    }

    /**
     * Hapus seluruh album dokumentasi dari database dan storage disk.
     */
    public function destroy(int $id)
    {
        $documentation = Documentation::with('media')->findOrFail($id);

        // Hapus file cover
        if ($documentation->image_path && !str_starts_with($documentation->image_path, 'images/') && Storage::disk('public')->exists($documentation->image_path)) {
            Storage::disk('public')->delete($documentation->image_path);
        }

        // Hapus semua file media album
        foreach ($documentation->media as $mediaItem) {
            if ($mediaItem->type === 'image' && !str_starts_with($mediaItem->file_path, 'images/') && Storage::disk('public')->exists($mediaItem->file_path)) {
                Storage::disk('public')->delete($mediaItem->file_path);
            }
        }

        // Hapus folder album jika ada
        Storage::disk('public')->deleteDirectory('gallery/album_' . $documentation->id);

        $documentation->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Album dokumentasi beserta seluruh foto & videonya berhasil dihapus.');
    }
}
