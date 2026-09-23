<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use Illuminate\Http\Request;

/**
 * Controller: DestinationController
 *
 * Mengelola katalog destinasi wisata publik.
 * Fitur:
 * - Halaman daftar destinasi dengan filter kategori dan pencarian keyword.
 * - Halaman detail destinasi (itinerary, fasilitas, harga, galeri).
 */
class DestinationController extends Controller
{
    /**
     * Tampilkan katalog semua destinasi wisata.
     */
    public function index(Request $request)
    {
        $query = Destination::active()->with('category');

        // Filter berdasarkan kategori (jika ada parameter category di URL)
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Pencarian berdasarkan keyword nama / lokasi
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Pagination 9 item per halaman
        $destinations = $query->latest()->paginate(9)->withQueryString();

        // Ambil semua kategori untuk filter dropdown/tabs
        $categories = Category::active()->ordered()->get();

        return view('destinations.index', compact('destinations', 'categories'));
    }

    /**
     * Tampilkan detail destinasi tertentu berdasarkan slug.
     */
    public function show(string $slug)
    {
        // Cari destinasi aktif berdasarkan slug beserta detail dan kategorinya
        $destination = Destination::active()
            ->with(['category', 'detail'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Destinasi terkait (kategori yang sama, selain destinasi ini)
        $relatedDestinations = Destination::active()
            ->where('category_id', $destination->category_id)
            ->where('id', '!=', $destination->id)
            ->take(3)
            ->get();

        return view('destinations.show', compact('destination', 'relatedDestinations'));
    }
}
