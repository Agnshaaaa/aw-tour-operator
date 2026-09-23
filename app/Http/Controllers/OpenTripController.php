<?php

namespace App\Http\Controllers;

use App\Models\OpenTrip;
use Illuminate\Http\Request;

/**
 * Controller: OpenTripController
 *
 * Mengelola halaman publik Open Trip (jadwal keberangkatan kelompok terbuka).
 * Berfungsi sebagai lead generator paket perjalanan.
 */
class OpenTripController extends Controller
{
    /**
     * Tampilkan daftar semua jadwal Open Trip yang akan datang.
     */
    public function index()
    {
        $openTrips = OpenTrip::with('destination')
            ->open()
            ->upcoming()
            ->orderBy('departure_date', 'asc')
            ->paginate(6);

        return view('open-trips.index', compact('openTrips'));
    }

    /**
     * Tampilkan detail jadwal Open Trip tertentu.
     */
    public function show(int $id)
    {
        $openTrip = OpenTrip::with(['destination.category', 'destination.detail'])
            ->where('id', $id)
            ->firstOrFail();

        return view('open-trips.show', compact('openTrip'));
    }
}
