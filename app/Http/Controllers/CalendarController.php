<?php

namespace App\Http\Controllers;

use App\Models\BookedDate;
use Illuminate\Http\Request;

/**
 * Controller: CalendarController
 *
 * Mengelola Interactive Availability Calendar di halaman publik.
 * Tampilan tanggal fully booked (merah) vs tersedia (hijau).
 */
class CalendarController extends Controller
{
    /**
     * Tampilkan halaman kalender ketersediaan tanggal.
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

        // Tanggal awal bulan
        $currentDate = \Carbon\Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $currentDate->daysInMonth;
        
        // Start of week: 1 (Senin) s/d 7 (Minggu)
        $startOfWeek = $currentDate->dayOfWeekIso; 

        // Nama bulan dalam Bahasa Indonesia
        $indonesianMonths = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $monthName = $indonesianMonths[$month] . ' ' . $year;

        // Prev & Next Month logic
        $prevDate  = $currentDate->copy()->subMonth();
        $nextDate  = $currentDate->copy()->addMonth();
        $prevMonth = ['year' => $prevDate->year, 'month' => $prevDate->month];
        $nextMonth = ['year' => $nextDate->year, 'month' => $nextDate->month];

        // Fetch booked dates in this month
        $bookedRecords = BookedDate::inMonth($year, $month)->get();
        $bookedDatesMap = [];
        $bookedDates = [];

        foreach ($bookedRecords as $record) {
            $dateStr = $record->booked_date->format('Y-m-d');
            $bookedDatesMap[$dateStr] = [
                'label' => $record->label ?? 'Fully Booked',
                'custom_request_id' => $record->custom_request_id,
            ];
            $bookedDates[] = $dateStr;
        }

        $todayStr = date('Y-m-d');

        return view('calendar.index', compact(
            'year',
            'month',
            'monthName',
            'daysInMonth',
            'startOfWeek',
            'prevMonth',
            'nextMonth',
            'bookedDates',
            'bookedDatesMap',
            'todayStr'
        ));
    }
}
