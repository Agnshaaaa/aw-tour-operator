<?php

namespace App\Http\Controllers;

use App\Models\UmkmProduct;
use Illuminate\Http\Request;

/**
 * Controller: UmkmController
 *
 * Mengelola etalase produk UMKM lokal (oleh-oleh khas).
 * Produk-produk ini dapat dilihat calon klien dan dipilih sebagai add-on trip.
 */
class UmkmController extends Controller
{
    /**
     * Tampilkan etalase produk UMKM lokal.
     */
    public function index()
    {
        $products = UmkmProduct::available()
            ->latest()
            ->paginate(8);

        return view('umkm.index', compact('products'));
    }

    /**
     * Tampilkan detail produk UMKM.
     */
    public function show(string $slug)
    {
        $product = UmkmProduct::where('slug', $slug)
            ->where('is_available', true)
            ->firstOrFail();

        return view('umkm.show', compact('product'));
    }
}
