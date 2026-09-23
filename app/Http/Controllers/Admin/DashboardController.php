<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookedDate;
use App\Models\CustomRequest;
use App\Models\Destination;
use App\Models\UmkmProduct;
use Illuminate\Http\Request;

/**
 * Controller: Admin\DashboardController
 *
 * Mengelola halaman utama (dashboard) statistik panel admin.
 * Menampilkan ringkasan statistik dan aktivitas terbaru.
 */
class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     */
    public function index()
    {
        // 1. Hitung statistik ringkasan
        $stats = [
            'total_requests'     => CustomRequest::count(),
            'pending_requests'   => CustomRequest::where('status', 'pending')->count(),
            'confirmed_requests' => CustomRequest::where('status', 'confirmed')->count(),
            'total_destinations' => Destination::count(),
            'total_umkm'         => UmkmProduct::count(),
        ];

        // 2. Ambil 5 permintaan rombongan terbaru
        $recentRequests = CustomRequest::with('destination')
            ->latest()
            ->take(5)
            ->get();

        // 3. Ambil tanggal terpesan terdekat
        $upcomingBookings = BookedDate::with('customRequest')
            ->where('booked_date', '>=', now()->toDateString())
            ->orderBy('booked_date', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRequests', 'upcomingBookings'));
    }
}
