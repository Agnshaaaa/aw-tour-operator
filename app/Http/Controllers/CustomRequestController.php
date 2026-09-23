<?php

namespace App\Http\Controllers;

use App\Models\BookedDate;
use App\Models\CustomRequest;
use App\Models\Destination;
use App\Models\UmkmOrder;
use App\Models\UmkmProduct;
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

        // Ambil semua produk UMKM yang tersedia untuk add-on
        $umkmProducts = UmkmProduct::available()->get();

        // Pre-select destinasi/tanggal jika ada query string
        $selectedDestinationId = $request->query('destination_id');
        $selectedDate          = $request->query('date');

        return view('quotation.create', compact('destinations', 'umkmProducts', 'selectedDestinationId', 'selectedDate'));
    }

    /**
     * Simpan permintaan quotation baru dari form.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'destination_id'   => 'required|exists:destinations,id',
            'client_name'      => 'required|string|max:255',
            'institution_name' => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'event_type'       => 'required|string|max:100',
            'event_date'       => 'required|date|after_or_equal:today',
            'return_date'      => 'nullable|date|after_or_equal:event_date',
            'pax'              => 'required|integer|min:1',
            'transport_mode'   => 'required|string|max:100',
            'notes'            => 'nullable|string',

            // Add-on UMKM (array opsional dari form)
            'umkm_products'             => 'nullable|array',
            'umkm_products.*.id'       => 'required_with:umkm_products|exists:umkm_products,id',
            'umkm_products.*.quantity' => 'required_with:umkm_products|integer|min:1',
        ]);

        // 2. Simpan menggunakan DB Transaction untuk keamanan data
        DB::beginTransaction();

        try {
            // Generate nomor tiket unik
            $validated['ticket_number'] = CustomRequest::generateTicketNumber();
            $validated['status']        = 'pending';

            // Simpan custom_request
            $customRequest = CustomRequest::create($validated);

            // Simpan booked_date awal
            BookedDate::create([
                'custom_request_id' => $customRequest->id,
                'booked_date'       => $validated['event_date'],
                'label'             => $validated['institution_name'] . ' - ' . $validated['event_type'],
            ]);

            // Simpan add-on produk UMKM jika dipilih
            if (!empty($request->umkm_products)) {
                foreach ($request->umkm_products as $item) {
                    if (isset($item['id']) && isset($item['quantity']) && $item['quantity'] > 0) {
                        $product = UmkmProduct::find($item['id']);
                        if ($product) {
                            UmkmOrder::create([
                                'custom_request_id' => $customRequest->id,
                                'umkm_product_id'   => $product->id,
                                'quantity'          => $item['quantity'],
                                'price_at_order'    => $product->price,
                            ]);
                        }
                    }
                }
            }

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
        $customRequest = CustomRequest::with(['destination', 'umkmOrders.product'])
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();

        return view('quotation.success', compact('customRequest'));
    }
}
