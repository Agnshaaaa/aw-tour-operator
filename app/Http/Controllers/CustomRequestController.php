<?php

namespace App\Http\Controllers;

use App\Models\BookedDate;
use App\Models\CustomRequest;
use App\Models\Destination;
use App\Models\TransportOffering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Controller: CustomRequestController
 *
 * Mengelola fitur utama Custom Group Quotation Builder.
 * Alur:
 * 1. create()  : Tampilkan form multi-step (pilih destinasi, tanggal, peserta, moda, add-on UMKM).
 * 2. store()   : Validasi input, generate nomor tiket otomatis (AW-YYYYMMDD-XXXX),
 *                simpan data ke custom_requests, umkm_orders, & booked_dates (DB Transaction).
 * 3. success() : Tampilkan halaman sukses dengan ringkasan & tombol WhatsApp Admin.
 */
class CustomRequestController extends Controller
{
    /**
     * Tampilkan form multi-step quotation builder.
     */
    public function create(Request $request)
    {
        // Ambil semua destinasi aktif
        $destinations = Destination::active()->with('category')->get();

        $transportOfferings = TransportOffering::active()->vehicles()->orderBy('sort_order')->orderBy('name')->get();

        // Pre-select destinasi/tanggal/transport jika ada query string
        $selectedDestinationId = $request->query('destination_id');
        $selectedDate          = $request->query('date');
        $selectedTransport     = $request->query('transport');

        return view('quotation.create', compact('destinations', 'transportOfferings', 'selectedDestinationId', 'selectedDate', 'selectedTransport'));
    }

    /**
     * Simpan permintaan quotation baru dari form.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'destination_id'           => 'nullable|exists:destinations,id',
            'custom_destination'       => 'nullable|string|max:255',
            'client_name'              => 'required|string|max:255',
            'institution_name'         => 'required|string|max:255',
            'phone'                    => 'required|string|max:20',
            'email'                    => 'nullable|email|max:255',
            'event_type'               => 'required|string|max:100',
            'event_date'               => 'required|date|after_or_equal:today',
            'return_date'              => 'nullable|date|after_or_equal:event_date',
            'pax'                      => 'required|integer|min:1',
            'transport_mode'           => 'required|string|max:255',
            'departure_point'          => 'nullable|string|max:255',
            'departure_time'           => 'nullable|string|max:50',
            'return_time'              => 'nullable|string|max:50',
            'pickup_notes'             => 'nullable|string',
            'need_hotel'               => 'nullable|string|max:10',
            'hotel_rooms'              => 'nullable|integer|min:1',
            'hotel_room_type'          => 'nullable|string|max:100',
            'hotel_notes'              => 'nullable|string',
            'special_notes'            => 'nullable|string',
            'notes'                    => 'nullable|string',

        ]);

        // 2. Simpan menggunakan DB Transaction untuk keamanan data
        DB::beginTransaction();

        try {
            // Jika destination_id kosong namun custom_destination diisi (misal Singapore, Bali, dll)
            if (empty($validated['destination_id'])) {
                $customName = trim($validated['custom_destination'] ?? 'Destinasi Custom');

                // Cari atau buat record destination fallback
                $fallbackCat = \App\Models\Category::first();
                $fallbackDestination = Destination::firstOrCreate(
                    ['slug' => 'custom-request-destination'],
                    [
                        'category_id'       => $fallbackCat ? $fallbackCat->id : 1,
                        'name'              => 'Destinasi Custom / Request',
                        'location'          => 'Sesuai Permintaan Klien',
                        'short_description' => 'Destinasi wisata custom sesuai permintaan khusus klien.',
                        'min_price'         => 0,
                        'max_price'         => 0,
                        'min_pax'           => 1,
                        'is_active'         => true,
                    ]
                );

                $validated['destination_id'] = $fallbackDestination->id;
            }

            // Susun catatan terstruktur lengkap (logistik, transportasi & penginapan)
            $noteBlocks = [];

            if (!empty($validated['custom_destination'])) {
                $noteBlocks[] = "📍 DESTINASI REQUEST KLIEN: " . trim($validated['custom_destination']);
            }

            if (!empty($request->departure_point)) {
                $dep = "🚩 TITIK KEBERANGKATAN: " . trim($request->departure_point);
                if (!empty($request->departure_time)) {
                    $dep .= " (Jam " . trim($request->departure_time) . " WIB)";
                }
                if (!empty($request->pickup_notes)) {
                    $dep .= "\n   Catatan Penjemputan: " . trim($request->pickup_notes);
                }
                $noteBlocks[] = $dep;
            }

            if (!empty($request->transport_mode)) {
                $noteBlocks[] = "🚌 RENCANA TRANSPORTASI: " . trim($request->transport_mode);
            }

            if ($request->need_hotel === 'Ya') {
                $hotel = "🏨 KEBUTUHAN PENGINAPAN: Ya (" . ($request->hotel_rooms ?? 1) . " Kamar, Preferensi Tipe: " . ($request->hotel_room_type ?? 'Belum menentukan') . ")";
                if (!empty($request->hotel_notes)) {
                    $hotel .= "\n   Catatan Hotel: " . trim($request->hotel_notes);
                }
                $noteBlocks[] = $hotel;
            } elseif ($request->need_hotel === 'Tidak') {
                $noteBlocks[] = "🏨 KEBUTUHAN PENGINAPAN: Tidak Diperlukan";
            }

            if (!empty($request->special_notes)) {
                $noteBlocks[] = "📝 CATATAN KHUSUS: " . trim($request->special_notes);
            } elseif (!empty($request->notes) && empty($request->special_notes)) {
                $noteBlocks[] = "📝 CATATAN KHUSUS: " . trim($request->notes);
            }

            if (!empty($noteBlocks)) {
                $validated['notes'] = implode("\n\n", $noteBlocks);
            }

            // Clean up array for Eloquent model creation
            $modelData = [
                'destination_id'   => $validated['destination_id'],
                'client_name'      => $validated['client_name'],
                'institution_name' => $validated['institution_name'],
                'phone'            => $validated['phone'],
                'email'            => $validated['email'] ?? null,
                'event_type'       => $validated['event_type'],
                'event_date'       => $validated['event_date'],
                'return_date'      => $validated['return_date'] ?? null,
                'pax'              => $validated['pax'],
                'transport_mode'   => $validated['transport_mode'],
                'notes'            => $validated['notes'] ?? null,
                'ticket_number'    => CustomRequest::generateTicketNumber(),
                'status'           => 'pending',
            ];

            // Simpan custom_request
            $customRequest = CustomRequest::create($modelData);

            // Simpan booked_date awal
            BookedDate::create([
                'custom_request_id' => $customRequest->id,
                'booked_date'       => $validated['event_date'],
                'label'             => $validated['institution_name'] . ' - ' . $validated['event_type'],
            ]);

            DB::commit();

            // Redirect ke halaman sukses dengan nomor tiket
            return redirect()->route('quotation.success', ['ticket_number' => $customRequest->ticket_number])
                ->with('success', 'Permintaan quotation berhasil dikirim!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal mengirim permintaan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan halaman sukses pengiriman quotation beserta tombol WhatsApp Admin.
     */
    public function success(string $ticketNumber)
    {
        $customRequest = CustomRequest::with('destination')
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();

        return view('quotation.success', compact('customRequest'));
    }
}
