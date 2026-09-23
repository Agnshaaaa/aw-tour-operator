<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookedDate;
use App\Models\CustomRequest;
use Illuminate\Http\Request;

/**
 * Controller: Admin\CalendarController
 *
 * Mengelola kalender ketersediaan (booked dates) dari panel admin.
 * Admin dapat melihat tanggal terpesan, menambah tanggal terpesan secara manual,
 * atau menghapus status terpesan.
 */
class CalendarController extends Controller
{
    /**
     * Tampilkan daftar dan kalender tanggal terpesan.
     */
    public function index(Request $request)
    {
        $year  = $request->query('year', date('Y'));
        $month = $request->query('month', date('n'));

        $bookedDates = BookedDate::with('customRequest')
            ->inMonth($year, $month)
            ->orderBy('booked_date', 'asc')
            ->get();

        return view('admin.calendar.index', compact('bookedDates', 'year', 'month'));
    }

    /**
     * Tambah tanggal terpesan manual oleh admin.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booked_date' => 'required|date|unique:booked_dates,booked_date',
            'label'       => 'required|string|max:255',
        ]);

        BookedDate::create([
            'booked_date' => $validated['booked_date'],
            'label'       => $validated['label'],
        ]);

        return back()->with('success', 'Tanggal berhasil ditandai sebagai terpesan.');
    }

    /**
     * Hapus tanggal terpesan.
     */
    public function destroy(int $id)
    {
        $bookedDate = BookedDate::findOrFail($id);
        $bookedDate->delete();

        return back()->with('success', 'Tanggal berhasil dihapus dari daftar terpesan.');
    }
}
