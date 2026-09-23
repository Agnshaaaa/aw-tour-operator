<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UmkmProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Controller: Admin\UmkmController
 *
 * Mengelola CRUD katalog produk UMKM lokal (oleh-oleh add-on trip).
 */
class UmkmController extends Controller
{
    /**
     * Tampilkan daftar produk UMKM.
     */
    public function index()
    {
        $products = UmkmProduct::latest()->paginate(10);
        return view('admin.umkm.index', compact('products'));
    }

    /**
     * Tampilkan form tambah produk UMKM.
     */
    public function create()
    {
        return view('admin.umkm.create');
    }

    /**
     * Simpan produk UMKM baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'producer'     => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'required|integer|min:0',
            'unit'         => 'required|string|max:50',
            'is_available' => 'boolean',
        ]);

        $validated['slug']         = Str::slug($validated['name']);
        $validated['is_available'] = $request->has('is_available');

        UmkmProduct::create($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Produk UMKM berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit produk UMKM.
     */
    public function edit(int $id)
    {
        $product = UmkmProduct::findOrFail($id);
        return view('admin.umkm.edit', compact('product'));
    }

    /**
     * Update data produk UMKM.
     */
    public function update(Request $request, int $id)
    {
        $product = UmkmProduct::findOrFail($id);

        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'producer'     => 'nullable|string|max:255',
            'description'  => 'nullable|string',
            'price'        => 'required|integer|min:0',
            'unit'         => 'required|string|max:50',
            'is_available' => 'boolean',
        ]);

        $validated['slug']         = Str::slug($validated['name']);
        $validated['is_available'] = $request->has('is_available');

        $product->update($validated);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Produk UMKM berhasil diperbarui!');
    }

    /**
     * Hapus produk UMKM.
     */
    public function destroy(int $id)
    {
        $product = UmkmProduct::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Produk UMKM berhasil dihapus.');
    }
}
