<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookedDate;
use App\Models\CustomRequest;
use Illuminate\Http\Request;

/**
 * Controller: Admin\RequestController
 *
 * Mengelola daftar permintaan quotation rombongan yang masuk dari klien.
 * Admin dapat meninjau detail, mengubah status permintaan (pending -> reviewed -> quoted -> confirmed / cancelled),
 * dan menambahkan catatan internal admin.
 */
class RequestController extends Controller
{
    /**
     * Tampilkan daftar permintaan quotation dengan filter status.
     */
    public function index(Request $request)
    {
        $query = CustomRequest::with('destination')->latest();

        // Filter status jika ada di URL (?status=pending)
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Search berdasarkan nomor tiket atau nama instansi
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('institution_name', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(10)->withQueryString();

        return view('admin.requests.index', compact('requests'));
    }

    /**
     * Tampilkan detail satu permintaan quotation.
     */
    public function show(int $id)
    {
        $customRequest = CustomRequest::with(['destination.category', 'umkmOrders.product', 'bookedDates'])
            ->findOrFail($id);

        return view('admin.requests.show', compact('customRequest'));
    }

    /**
     * Update status & catatan admin untuk permintaan quotation.
     */
    public function updateStatus(Request $request, int $id)
    {
        $customRequest = CustomRequest::findOrFail($id);

        $validated = $request->validate([
            'status'      => 'required|in:pending,reviewed,quoted,confirmed,cancelled',
            'admin_notes' => 'nullable|string',
        ]);

        $customRequest->update($validated);

        // Jika status diubah ke 'confirmed', pastikan tanggal terpesan masuk ke booked_dates
        if ($validated['status'] === 'confirmed') {
            BookedDate::firstOrCreate([
                'custom_request_id' => $customRequest->id,
                'booked_date'       => $customRequest->event_date,
            ], [
                'label' => $customRequest->institution_name . ' - ' . $customRequest->event_type,
            ]);
        }

        return back()->with('success', 'Status permintaan berhasil diperbarui!');
    }

    /**
     * Hapus permintaan quotation.
     */
    public function destroy(int $id)
    {
        $customRequest = CustomRequest::findOrFail($id);
        $customRequest->delete();

        return redirect()->route('admin.requests.index')
            ->with('success', 'Permintaan quotation berhasil dihapus.');
    }
}
