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
    public function index()
    {
        $destinations = Destination::with('category')->latest()->paginate(10);
        return view('admin.destinations.index', compact('destinations'));
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
            'min_price'         => 'required|integer|min:0',
            'max_price'         => 'nullable|integer|gte:min_price',
            'min_pax'           => 'required|integer|min:1',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',

            // Detail fields
            'notes' => 'nullable|string',
        ]);

        $validated['slug']        = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active']   = $request->has('is_active');

        $destination = Destination::create($validated);

        // Buat detail kosong/awal
        DestinationDetail::create([
            'destination_id' => $destination->id,
            'notes'          => $request->notes,
        ]);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi wisata berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit destinasi.
     */
    public function edit(int $id)
    {
        $destination = Destination::with('detail')->findOrFail($id);
        $categories  = Category::active()->ordered()->get();

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
            'min_price'         => 'required|integer|min:0',
            'max_price'         => 'nullable|integer|gte:min_price',
            'min_pax'           => 'required|integer|min:1',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'notes'             => 'nullable|string',
        ]);

        $validated['slug']        = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active']   = $request->has('is_active');

        $destination->update($validated);

        if ($destination->detail) {
            $destination->detail->update(['notes' => $request->notes]);
        }

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Data destinasi berhasil diperbarui!');
    }

    /**
     * Hapus destinasi.
     */
    public function destroy(int $id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destinasi wisata berhasil dihapus.');
    }
}
