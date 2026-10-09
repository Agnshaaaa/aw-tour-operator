<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Documentation;
use Illuminate\Http\Request;

/**
 * Controller: GalleryController
 *
 * Mengelola halaman publik galeri foto dan portofolio
 * dokumentasi perjalanan rombongan AW Tour Operator.
 */
class GalleryController extends Controller
{
    /**
     * Tampilkan halaman galeri foto publik.
     */
    public function index(Request $request)
    {
        $query = Documentation::active()->with(['destination', 'media'])->ordered();

        // Filter per destinasi jika dipilih
        if ($request->filled('destination')) {
            $destinationSlug = $request->destination;
            $query->whereHas('destination', function ($q) use ($destinationSlug) {
                $q->where('slug', $destinationSlug);
            });
        }

        $documentations = $query->paginate(12)->withQueryString();

        // Ambil destinasi yang memiliki dokumentasi untuk filter bar
        $destinations = Destination::active()
            ->whereHas('documentations', function ($q) {
                $q->where('is_active', true);
            })
            ->withCount(['documentations' => function ($q) {
                $q->where('is_active', true);
            }])
            ->orderBy('name')
            ->get();

        $totalTrips = Documentation::active()->count();
        $totalPax = Documentation::active()->sum('participant_count') ?: 1500;

        return view('gallery.index', compact(
            'documentations',
            'destinations',
            'totalTrips',
            'totalPax'
        ));
    }
}
