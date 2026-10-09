<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransportOffering;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TransportController extends Controller
{
    public function index(): View
    {
        $offerings = TransportOffering::orderBy('display_group')->orderBy('sort_order')->orderBy('name')->paginate(12);

        return view('admin.transports.index', compact('offerings'));
    }

    public function create(): View
    {
        return view('admin.transports.create', ['offering' => new TransportOffering()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);
        $validated['slug'] = $this->uniqueSlug($validated['name']);
        $validated['features'] = $this->parseFeatures($request->input('features'));
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['image'] = $this->storeImage($request);

        TransportOffering::create($validated);

        return redirect()->route('admin.transports.index')->with('success', 'Informasi armada berhasil ditambahkan.');
    }

    public function edit(int $id): View
    {
        $offering = TransportOffering::findOrFail($id);

        return view('admin.transports.edit', compact('offering'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $offering = TransportOffering::findOrFail($id);
        $validated = $this->validated($request);
        if ($validated['name'] !== $offering->name) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $offering->id);
        }
        $validated['features'] = $this->parseFeatures($request->input('features'));
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->boolean('remove_image')) {
            $this->deleteStoredImage($offering->image);
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            $this->deleteStoredImage($offering->image);
            $validated['image'] = $this->storeImage($request);
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->input('image_url');
        }

        $offering->update($validated);

        return redirect()->route('admin.transports.index')->with('success', 'Informasi armada berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $offering = TransportOffering::findOrFail($id);
        $this->deleteStoredImage($offering->image);
        $offering->delete();

        return redirect()->route('admin.transports.index')->with('success', 'Informasi armada berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'display_group' => ['required', 'in:vehicle,body_type'],
            'capacity' => ['nullable', 'string', 'max:120'],
            'price_label' => ['nullable', 'string', 'max:160'],
            'description' => ['nullable', 'string', 'max:3000'],
            'features' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'image_url' => ['nullable', 'url', 'max:1000'],
            'unit_count' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_active' => ['nullable', 'boolean'],
            'remove_image' => ['nullable', 'boolean'],
        ]);
    }

    private function parseFeatures(?string $features): array
    {
        return collect(preg_split('/\\r?\\n/', $features ?? ''))
            ->map(fn (string $feature) => trim($feature))
            ->filter()
            ->values()
            ->all();
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'armada';
        $slug = $base;
        $counter = 1;

        while (TransportOffering::where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }

    private function storeImage(Request $request): ?string
    {
        if ($request->hasFile('image')) {
            return '/storage/' . $request->file('image')->store('transport', 'public');
        }

        return $request->filled('image_url') ? $request->input('image_url') : null;
    }

    private function deleteStoredImage(?string $image): void
    {
        if ($image && str_starts_with($image, '/storage/transport/')) {
            Storage::disk('public')->delete(substr($image, strlen('/storage/')));
        }
    }
}
