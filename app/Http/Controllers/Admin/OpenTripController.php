<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\OpenTrip;
use Illuminate\Http\Request;

class OpenTripController extends Controller
{
    public function index(Request $request)
    {
        $query = OpenTrip::with('destination')->latest('departure_date');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $openTrips = $query->paginate(10)->withQueryString();

        return view('admin.open-trips.index', compact('openTrips'));
    }

    public function create()
    {
        $destinations = Destination::active()->orderBy('name')->get();
        return view('admin.open-trips.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id'   => 'required|exists:destinations,id',
            'title'            => 'required|string|max:255',
            'departure_date'   => 'required|date',
            'return_date'      => 'required|date|after_or_equal:departure_date',
            'quota'            => 'required|integer|min:1',
            'registered'       => 'nullable|integer|min:0|lte:quota',
            'price_per_person' => 'required|integer|min:0',
            'highlight'        => 'nullable|string',
            'status'           => 'required|in:open,closed,completed',
        ]);

        $validated['registered'] = $validated['registered'] ?? 0;

        OpenTrip::create($validated);

        return redirect()->route('admin.open-trips.index')->with('success', 'Jadwal Open Trip berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $openTrip = OpenTrip::findOrFail($id);
        $destinations = Destination::active()->orderBy('name')->get();
        return view('admin.open-trips.edit', compact('openTrip', 'destinations'));
    }

    public function update(Request $request, int $id)
    {
        $openTrip = OpenTrip::findOrFail($id);

        $validated = $request->validate([
            'destination_id'   => 'required|exists:destinations,id',
            'title'            => 'required|string|max:255',
            'departure_date'   => 'required|date',
            'return_date'      => 'required|date|after_or_equal:departure_date',
            'quota'            => 'required|integer|min:1',
            'registered'       => 'nullable|integer|min:0|lte:quota',
            'price_per_person' => 'required|integer|min:0',
            'highlight'        => 'nullable|string',
            'status'           => 'required|in:open,closed,completed',
        ]);

        $validated['registered'] = $validated['registered'] ?? $openTrip->registered;

        $openTrip->update($validated);

        return redirect()->route('admin.open-trips.index')->with('success', 'Jadwal Open Trip berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $openTrip = OpenTrip::findOrFail($id);
        $openTrip->delete();

        return redirect()->route('admin.open-trips.index')->with('success', 'Jadwal Open Trip berhasil dihapus.');
    }
}
