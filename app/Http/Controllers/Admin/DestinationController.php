<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use App\Models\DestinationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Controller: Admin\DestinationController
 *
 * Mengelola CRUD katalog destinasi wisata dan detail perjalanannya.
 */
class DestinationController extends Controller
{
    /**
     * Tampilkan daftar semua destinasi wisata.
     */
    public function index(Request $request)
    {
        $query = Destination::with('category')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $destinations = $query->paginate(10)->withQueryString();
        $categories   = Category::ordered()->get();

        return view('admin.destinations.index', compact('destinations', 'categories'));
    }

    /**
     * Tampilkan form tambah destinasi baru.
     */
    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.destinations.create', compact('categories'));
    }

    /**
     * Simpan destinasi baru dan detailnya.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string|max:255',
            'location'          => 'required|string|max:255',
            'short_description' => 'required|string',
            'description'       => 'nullable|string',
            'cover_image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_image_url'   => 'nullable|string|max:500',
            'min_price'         => 'required|integer|min:0',
            'max_price'         => 'nullable|integer|gte:min_price',
            'min_pax'           => 'required|integer|min:1',
            'is_featured'       => 'nullable|boolean',
            'is_active'         => 'nullable|boolean',
            'itinerary'         => 'nullable|string|max:10000',

            // Detail fields
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'itinerary'  => 'nullable|string',
            'notes'      => 'nullable|string',
        ]);

        // Generate slug unik
        $baseSlug = Str::slug($validated['name']);
        $slug     = $baseSlug;
        $counter  = 1;
        while (Destination::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }
        $validated['slug']        = $slug;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');

        // Handle cover image
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('destinations', 'public');
            $validated['cover_image'] = '/storage/' . $path;
        } elseif (!empty($request->cover_image_url)) {
            $validated['cover_image'] = $request->cover_image_url;
        }

        $destination = Destination::create($validated);

        // Parse detail inclusions & exclusions jika format baris baru
        $inclusions = $request->filled('inclusions')
            ? array_filter(array_map('trim', explode("\n", str_replace("\r", "", $request->inclusions))))
            : null;
        $exclusions = $request->filled('exclusions')
            ? array_filter(array_map('trim', explode("\n", str_replace("\r", "", $request->exclusions))))
            : null;

        DestinationDetail::create([
            'destination_id' => $destination->id,
            'inclusions'     => $inclusions,
            'exclusions'     => $exclusions,
            'itinerary'      => $this->parseItinerary($request->input('itinerary')),
            'notes'          => $request->notes,
        ]);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi wisata "' . $destination->name . '" berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail destinasi (redirect ke edit).
     */
    public function show(int $id)
    {
        return redirect()->route('admin.destinations.edit', $id);
    }

    /**
     * Tampilkan form edit destinasi.
     */
    public function edit(int $id)
    {
        $destination = Destination::with('detail')->findOrFail($id);
        $categories  = Category::ordered()->get();

        return view('admin.destinations.edit', compact('destination', 'categories'));
    }

    /**
     * Update data destinasi.
     */
    public function update(Request $request, int $id)
    {
        $destination = Destination::findOrFail($id);

        $validated = $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string|max:255',
            'location'          => 'required|string|max:255',
            'short_description' => 'required|string',
            'description'       => 'nullable|string',
            'cover_image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cover_image_url'   => 'nullable|string|max:500',
            'min_price'         => 'required|integer|min:0',
            'max_price'         => 'nullable|integer|gte:min_price',
            'min_pax'           => 'required|integer|min:1',
            'is_featured'       => 'nullable|boolean',
            'is_active'         => 'nullable|boolean',
            'itinerary'         => 'nullable|string|max:10000',
            'inclusions'        => 'nullable|string',
            'exclusions'        => 'nullable|string',
            'notes'             => 'nullable|string',
        ]);

        // Slug update jika nama berubah
        if ($validated['name'] !== $destination->name) {
            $baseSlug = Str::slug($validated['name']);
            $slug     = $baseSlug;
            $counter  = 1;
            while (Destination::where('slug', $slug)->where('id', '!=', $destination->id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $validated['slug'] = $slug;
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active']   = $request->boolean('is_active');

        // Handle cover image
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('destinations', 'public');
            $validated['cover_image'] = '/storage/' . $path;
        } elseif ($request->filled('cover_image_url')) {
            $validated['cover_image'] = $request->cover_image_url;
        }

        $destination->update($validated);

        // Update detail
        $inclusions = $request->filled('inclusions')
            ? array_filter(array_map('trim', explode("\n", str_replace("\r", "", $request->inclusions))))
            : null;
        $exclusions = $request->filled('exclusions')
            ? array_filter(array_map('trim', explode("\n", str_replace("\r", "", $request->exclusions))))
            : null;

        if ($destination->detail) {
            $destination->detail->update([
                'itinerary'  => $this->parseItinerary($request->input('itinerary')),
                'inclusions' => $inclusions,
                'exclusions' => $exclusions,
                'notes'      => $request->notes,
            ]);
        } else {
            DestinationDetail::create([
                'destination_id' => $destination->id,
                'itinerary'      => $this->parseItinerary($request->input('itinerary')),
                'inclusions'     => $inclusions,
                'exclusions'     => $exclusions,
                'notes'          => $request->notes,
            ]);
        }

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Data destinasi "' . $destination->name . '" berhasil diperbarui!');
    }

    /**
     * Hapus destinasi.
     */
    public function destroy(int $id)
    {
        $destination = Destination::findOrFail($id);
        $name = $destination->name;

        // Detail dihapus jika ada
        if ($destination->detail) {
            $destination->detail->delete();
        }
        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi wisata "' . $name . '" berhasil dihapus.');
    }

    private function parseItinerary(?string $itinerary): ?array
    {
        if (! $itinerary || ! trim($itinerary)) {
            return null;
        }

        return collect(preg_split('/\r?\n/', $itinerary))
            ->map(function (string $line, int $index) {
                $parts = array_map('trim', explode('|', $line, 3));
                if (count($parts) < 3 || ! $parts[0] || ! $parts[1] || ! $parts[2]) {
                    return null;
                }

                return ['hari' => $parts[0] ?: (string) ($index + 1), 'judul' => $parts[1], 'kegiatan' => $parts[2]];
            })
            ->filter()
            ->values()
            ->all() ?: null;
    }
}
