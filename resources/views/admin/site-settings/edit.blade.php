@extends('layouts.admin')
@section('title', 'Profil Website — Admin AW Tour')
@section('page_title', 'Profil Perusahaan & Informasi Publik')
@section('content')
<div class="mx-auto max-w-4xl rounded-3xl border border-slate-800 bg-aw-navy/90 p-6 sm:p-8 shadow-xl">
    <p class="mb-6 text-sm text-slate-400">Perubahan berikut akan tampil pada bagian profil, partner/klien, dan kontak di website publik.</p>
    <form action="{{ route('admin.site-settings.update') }}" method="POST" class="space-y-6">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 text-sm">
            <div class="sm:col-span-2"><label for="company_name" class="mb-1 block font-semibold text-slate-300">Nama perusahaan *</label><input id="company_name" name="company_name" required maxlength="160" value="{{ old('company_name', $settings->company_name) }}" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white">@error('company_name')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            <div class="sm:col-span-2"><label for="profile_description" class="mb-1 block font-semibold text-slate-300">Deskripsi company profile</label><textarea id="profile_description" name="profile_description" rows="4" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white">{{ old('profile_description', $settings->profile_description) }}</textarea>@error('profile_description')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            <div><label for="location" class="mb-1 block font-semibold text-slate-300">Lokasi</label><input id="location" name="location" maxlength="255" value="{{ old('location', $settings->location) }}" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white">@error('location')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            <div><label for="operational_hours" class="mb-1 block font-semibold text-slate-300">Jam operasional</label><input id="operational_hours" name="operational_hours" maxlength="255" value="{{ old('operational_hours', $settings->operational_hours) }}" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white">@error('operational_hours')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            <div><label for="whatsapp_number" class="mb-1 block font-semibold text-slate-300">Nomor WhatsApp internasional *</label><input id="whatsapp_number" name="whatsapp_number" required value="{{ old('whatsapp_number', $settings->whatsapp_number) }}" placeholder="628123456789" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white">@error('whatsapp_number')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            <div><label for="email" class="mb-1 block font-semibold text-slate-300">Email publik</label><input id="email" type="email" name="email" value="{{ old('email', $settings->email) }}" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white">@error('email')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            <div class="sm:col-span-2"><label for="partners_text" class="mb-1 block font-semibold text-slate-300">Partner/klien (satu nama per baris)</label><textarea id="partners_text" name="partners_text" rows="5" class="w-full rounded-xl border-slate-700 bg-slate-900 text-white">{{ old('partners_text', implode("\n", $settings->partners ?? [])) }}</textarea><p class="mt-1 text-xs text-slate-500">Hanya cantumkan nama partner/klien yang memang diizinkan untuk dipublikasikan.</p>@error('partners_text')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
        </div>
        <div class="flex justify-end border-t border-slate-800 pt-5"><button class="rounded-xl bg-aw-gold px-6 py-3 font-bold text-slate-950">Simpan Profil Publik</button></div>
    </form>
</div>
@endsection
