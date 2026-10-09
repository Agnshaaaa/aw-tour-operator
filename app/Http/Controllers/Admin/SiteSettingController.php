<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.site-settings.edit', ['settings' => SiteSetting::current()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:160'],
            'profile_description' => ['nullable', 'string', 'max:2000'],
            'location' => ['nullable', 'string', 'max:255'],
            'partners_text' => ['nullable', 'string', 'max:3000'],
            'whatsapp_number' => ['required', 'string', 'max:30', 'regex:/^[0-9+()\\s-]+$/'],
            'email' => ['nullable', 'email', 'max:255'],
            'operational_hours' => ['nullable', 'string', 'max:255'],
        ]);

        $partners = collect(preg_split('/\\r?\\n/', $validated['partners_text'] ?? ''))
            ->map(fn (string $partner) => trim($partner))
            ->filter()
            ->values()
            ->all();

        SiteSetting::current()->update([
            'company_name' => $validated['company_name'],
            'profile_description' => $validated['profile_description'] ?? null,
            'location' => $validated['location'] ?? null,
            'partners' => $partners,
            'whatsapp_number' => preg_replace('/\\D+/', '', $validated['whatsapp_number']),
            'email' => $validated['email'] ?? null,
            'operational_hours' => $validated['operational_hours'] ?? null,
        ]);

        return back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
