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
        $year  = (int) $request->query('year', date('Y'));
        $month = (int) $request->query('month', date('n'));

        if ($month < 1 || $month > 12) {
            $month = (int) date('n');
        }
        if ($year < 2020 || $year > 2035) {
            $year = (int) date('Y');
        }

        $currentDate = \Carbon\Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $currentDate->daysInMonth;
        $startOfWeek = $currentDate->dayOfWeekIso; // 1 (Mon) - 7 (Sun)

        $indonesianMonths = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $monthName = $indonesianMonths[$month] . ' ' . $year;

        $prevDate  = $currentDate->copy()->subMonth();
        $nextDate  = $currentDate->copy()->addMonth();
        $prevMonth = ['year' => $prevDate->year, 'month' => $prevDate->month];
        $nextMonth = ['year' => $nextDate->year, 'month' => $nextDate->month];

        $bookedDates = BookedDate::with('customRequest')
            ->inMonth($year, $month)
            ->orderBy('booked_date', 'asc')
            ->get();

        $bookedDatesMap = [];
        foreach ($bookedDates as $b) {
            $bookedDatesMap[$b->booked_date->format('Y-m-d')] = $b;
        }

        $stats = [
            'total_booked_month' => $bookedDates->count(),
            'from_requests'      => $bookedDates->whereNotNull('custom_request_id')->count(),
            'manual_blocks'      => $bookedDates->whereNull('custom_request_id')->count(),
        ];

        return view('admin.calendar.index', compact(
            'bookedDates',
            'bookedDatesMap',
            'year',
            'month',
            'monthName',
            'daysInMonth',
            'startOfWeek',
            'prevMonth',
            'nextMonth',
            'stats'
        ));
    }

    /**
     * Tambah tanggal terpesan manual oleh admin.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booked_date' => 'required|date',
            'label'       => 'required|string|max:255',
        ]);

        $formattedDate = \Carbon\Carbon::parse($validated['booked_date'])->format('Y-m-d');

        if (BookedDate::whereDate('booked_date', $formattedDate)->exists()) {
            return back()->withErrors(['booked_date' => 'Tanggal ini sudah terdaftar sebagai tanggal terpesan.'])->withInput();
        }

        BookedDate::create([
            'booked_date' => $formattedDate,
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
