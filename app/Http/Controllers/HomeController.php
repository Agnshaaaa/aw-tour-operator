<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Documentation;
use App\Models\OpenTrip;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

/**
 * Controller: HomeController
 *
 * Mengelola halaman utama (landing page) publik AW Tour Operator.
 * Menyiapkan data yang dibutuhkan untuk section-section di homepage:
 * - Kategori layanan (Studi Tour, Capacity Building, Family Gathering)
 * - Destinasi wisata unggulan (featured destinations)
 * - Jadwal Open Trip mendatang
 * - Dokumentasi galeri perjalanan rombongan
 */
class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama (homepage).
     */
    public function index()
    {
        // 1. Ambil kategori aktif yang diurutkan
        $categories = Category::active()->ordered()->get();

        // 2. Ambil destinasi unggulan (featured) beserta relasi kategorinya
        $featuredDestinations = Destination::active()
            ->featured()
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        // 3. Ambil jadwal open trip mendatang
        $openTrips = OpenTrip::with('destination')
            ->open()
            ->upcoming()
            ->orderBy('departure_date', 'asc')
            ->take(3)
            ->get();

        // 4. Ambil dokumentasi untuk Hero Preview Card & Galeri Showcase
        $heroDocumentation = Documentation::active()->featured()->latest()->first() 
            ?? Documentation::active()->latest()->first();

        $galleryPreviews = Documentation::active()->ordered()->take(6)->get();

        $siteSettings = SiteSetting::current();

        return view('home.index', compact(
            'categories',
            'featuredDestinations',
            'openTrips',
            'heroDocumentation',
            'galleryPreviews',
            'siteSettings'
        ));
    }
}
