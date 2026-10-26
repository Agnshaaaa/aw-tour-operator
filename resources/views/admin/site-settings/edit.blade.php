@extends('layouts.admin')
@section('title', 'Pengaturan Situs — Admin AW Tour')
@section('page_title', 'Pengaturan Halaman Publik (Site Settings)')
@section('content')
<div class="mx-auto max-w-4xl rounded-3xl border border-white/[0.07] bg-[#0B0B0E]/90 p-6 sm:p-8 shadow-xl">
    <p class="mb-6 text-sm text-zinc-400">Kelola konten dinamis yang tampil di halaman publik (Hero, Navbar, Footer, dan WhatsApp).</p>
    <form action="{{ route('admin.site-settings.update') }}" method="POST" class="space-y-8">
        @csrf @method('PUT')
        
        <div class="space-y-6">
            <h3 class="text-lg font-bold text-aw-gold border-b border-white/[0.09] pb-2">Identitas Brand</h3>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 text-sm">
                <div class="sm:col-span-2"><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Nama Perusahaan *</label><input id="company_name" name="company_name" required maxlength="160" value="{{ old('company_name', $settings->company_name) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-white px-4 py-2.5">@error('company_name')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
                <div class="sm:col-span-2"><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Site Title (Meta & Browser Tab) *</label><input id="site_title" name="site_title" required maxlength="160" value="{{ old('site_title', $settings->site_title) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-white px-4 py-2.5" placeholder="AW Tour Operator Surabaya">@error('site_title')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="text-lg font-bold text-aw-gold border-b border-white/[0.09] pb-2">Hero Section (Landing Page)</h3>
            <div class="grid grid-cols-1 gap-5 text-sm">
                <div><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Hero Heading (Judul Utama) *</label><input id="hero_heading" name="hero_heading" required maxlength="255" value="{{ old('hero_heading', $settings->hero_heading) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-white px-4 py-2.5" placeholder="Wujudkan Perjalanan Rombongan Impian">@error('hero_heading')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
                <div><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Hero Subheading (Deskripsi Singkat)</label><textarea id="hero_subheading" name="hero_subheading" rows="3" maxlength="500" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner" placeholder="Spesialis Group Customized Tour di Surabaya...">{{ old('hero_subheading', $settings->hero_subheading) }}</textarea><p class="mt-1 text-xs text-zinc-500">Maksimal 500 karakter</p>@error('hero_subheading')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="text-lg font-bold text-aw-gold border-b border-white/[0.09] pb-2">Profil & Kontak</h3>
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 text-sm">
                <div class="sm:col-span-2"><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Deskripsi Company Profile</label><textarea id="profile_description" name="profile_description" rows="4" maxlength="2000" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('profile_description', $settings->profile_description) }}</textarea>@error('profile_description')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
                <div><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Lokasi</label><input id="location" name="location" maxlength="255" value="{{ old('location', $settings->location) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-white px-4 py-2.5" placeholder="Surabaya, Jawa Timur">@error('location')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
                <div><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Jam Operasional</label><input id="operational_hours" name="operational_hours" maxlength="255" value="{{ old('operational_hours', $settings->operational_hours) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-white px-4 py-2.5" placeholder="Senin - Sabtu (08.00 - 17.00 WIB)">@error('operational_hours')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
                <div><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Nomor WhatsApp *</label><input id="whatsapp_number" name="whatsapp_number" required maxlength="30" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}" placeholder="628123456789" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-white px-4 py-2.5"><p class="mt-1 text-xs text-zinc-500">Format internasional tanpa tanda +</p>@error('whatsapp_number')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
                <div><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Email Publik</label><input id="email" type="email" name="email" maxlength="255" value="{{ old('email', $settings->email) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-white px-4 py-2.5" placeholder="info@awtour.com">@error('email')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="text-lg font-bold text-aw-gold border-b border-white/[0.09] pb-2">Partner & Footer</h3>
            <div class="grid grid-cols-1 gap-5 text-sm">
                <div><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Partner/Klien (satu nama per baris)</label><textarea id="partners_text" name="partners_text" rows="5" maxlength="3000" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner" placeholder="ITS Surabaya&#10;UNAIR&#10;UNESA">{{ old('partners_text', implode("\n", $settings->partners ?? [])) }}</textarea><p class="mt-1 text-xs text-zinc-500">Hanya cantumkan nama partner/klien yang diizinkan untuk dipublikasikan.</p>@error('partners_text')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
                <div><label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Footer Copyright Text</label><textarea id="footer_text" name="footer_text" rows="2" maxlength="500" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner" placeholder="AW Tour Operator Surabaya. All rights reserved.">{{ old('footer_text', $settings->footer_text) }}</textarea>@error('footer_text')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror</div>
            </div>
        </div>

        <div class="flex justify-end border-t border-white/[0.07] pt-5">
            <button type="submit" class="rounded-xl bg-aw-gold px-6 py-3 font-bold text-slate-950 hover:bg-aw-gold/90 transition">
                Simpan Pengaturan Situs
            </button>
        </div>
    </form>
</div>
@endsection
