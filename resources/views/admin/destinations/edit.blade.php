@extends('layouts.admin')

@section('title', 'Edit Destinasi: ' . $destination->name . ' — Admin Control Panel')
@section('page_title', 'Edit Destinasi Wisata: ' . $destination->name)

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    {{-- Top back button --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.destinations.index') }}" 
           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-[#0B0B0E] hover:bg-[#121215] text-zinc-300 hover:text-white border border-white/[0.07] text-xs font-semibold transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Daftar Destinasi</span>
        </a>

        <a href="{{ route('destinations.show', $destination->slug) }}" target="_blank" 
           class="text-xs text-aw-gold hover:underline flex items-center gap-1 font-semibold">
            <span>Lihat Halaman Publik ↗</span>
        </a>
    </div>

    {{-- Edit Form Card --}}
    <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data" 
          class="bg-[#0B0B0E]/90 rounded-3xl p-6 sm:p-8 border border-white/[0.07] shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <div class="border-b border-white/[0.07] pb-4">
            <h2 class="font-serif text-lg font-bold text-white">Perbarui Informasi Destinasi</h2>
            <p class="text-xs text-zinc-400">ID Destinasi: #{{ $destination->id }} | Slug: <code class="text-aw-gold">{{ $destination->slug }}</code></p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">

            {{-- Kategori Layanan --}}
            <div class="space-y-1.5 sm:col-span-1">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Kategori Layanan <span class="text-rose-400">*</span>
                </label>
                <select name="category_id" id="category_id" required 
                        class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                    @foreach($categories ?? [] as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $destination->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Lokasi Type (Lokal vs Luar Negeri) --}}
            <div class="space-y-1.5 sm:col-span-1">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Cakupan Wilayah <span class="text-rose-400">*</span>
                </label>
                <select name="location_type" id="location_type" required 
                        class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                    <option value="lokal" {{ old('location_type', $destination->location_type) == 'lokal' ? 'selected' : '' }}>Destinasi Lokal (Domestik)</option>
                    <option value="luar_negeri" {{ old('location_type', $destination->location_type) == 'luar_negeri' ? 'selected' : '' }}>Destinasi Luar Negeri (Internasional)</option>
                </select>
            </div>

            {{-- Nama Destinasi --}}
            <div class="space-y-1.5 sm:col-span-1">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Nama Destinasi <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $destination->name) }}" required 
                       class="w-full rounded-xl bg-[#0B0B0E] border-white/[0.09] text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Lokasi --}}
            <div class="space-y-1.5 sm:col-span-2">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Lokasi Wilayah / Kota <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="location" id="location" value="{{ old('location', $destination->location) }}" required 
                       class="w-full rounded-xl bg-[#0B0B0E] border-white/[0.09] text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Estimasi Harga Min & Max --}}
            <div class="space-y-1.5">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Harga Mulai Dari (Rp) <span class="text-rose-400">*</span>
                </label>
                <input type="number" name="min_price" id="min_price" value="{{ old('min_price', $destination->min_price) }}" min="0" required 
                       class="w-full rounded-xl bg-[#0B0B0E] border-white/[0.09] text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            <div class="space-y-1.5">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Harga Maksimum (Rp, Opsional)
                </label>
                <input type="number" name="max_price" id="max_price" value="{{ old('max_price', $destination->max_price) }}" min="0" 
                       class="w-full rounded-xl bg-[#0B0B0E] border-white/[0.09] text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Min Pax --}}
            <div class="space-y-1.5 sm:col-span-1">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Minimum Peserta (Pax) <span class="text-rose-400">*</span>
                </label>
                <input type="number" name="min_pax" id="min_pax" value="{{ old('min_pax', $destination->min_pax) }}" min="1" required 
                       class="w-full rounded-xl bg-[#0B0B0E] border-white/[0.09] text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Cover Image --}}
            <div class="space-y-1.5 sm:col-span-1">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Gambar Cover Destinasi
                </label>
                @if($destination->cover_image)
                    <div class="flex items-center gap-3 mb-2 p-2 rounded-xl bg-[#0B0B0E]/80 backdrop-blur-xl border border-white/[0.07]">
                        <img src="{{ $destination->cover_image }}" alt="{{ $destination->name }}" 
                             class="w-14 h-14 rounded-lg object-cover border border-white/[0.09]"
                             onerror="this.style.display='none';">
                        <div class="text-[11px] text-zinc-400 truncate">
                            <span>Gambar Saat Ini:</span>
                            <span class="block text-zinc-200 truncate">{{ $destination->cover_image }}</span>
                        </div>
                    </div>
                @endif
                <input type="file" name="cover_image" accept="image/*" 
                       class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                <input type="text" name="cover_image_url" value="{{ old('cover_image_url', $destination->cover_image) }}" 
                       placeholder="Atau URL gambar web (https://...)" 
                       class="w-full rounded-xl bg-[#0B0B0E] border-white/[0.09] text-xs text-white p-2.5 mt-1 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="space-y-1.5 sm:col-span-2">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Deskripsi Singkat (Tampil di Card Katalog) <span class="text-rose-400">*</span>
                </label>
                <textarea name="short_description" id="short_description" rows="2" required 
                          class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('short_description', $destination->short_description) }}</textarea>
            </div>

            {{-- Deskripsi Lengkap --}}
            <div class="space-y-1.5 sm:col-span-2">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Deskripsi Lengkap Destinasi (Opsional)
                </label>
                <textarea name="description" id="description" rows="4" 
                          class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('description', $destination->description) }}</textarea>
            </div>

            @php
                $detail = $destination->detail;
                $inclusionsText = is_array($detail?->inclusions) ? implode("\n", $detail->inclusions) : ($detail?->inclusions ?? '');
                $exclusionsText = is_array($detail?->exclusions) ? implode("\n", $detail->exclusions) : ($detail?->exclusions ?? '');
                $itineraryText = collect($detail?->itinerary ?? [])->map(fn ($item) => implode(' | ', [$item['hari'] ?? '', $item['judul'] ?? '', $item['kegiatan'] ?? '']))->implode("\n");
            @endphp

            <div class="space-y-1.5 sm:col-span-2">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Itinerary (satu hari per baris)</label>
                <textarea name="itinerary" id="itinerary" rows="5" placeholder="Hari 1 | Surabaya ke Malang | Berangkat pagi dan check-in hotel" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('itinerary', $itineraryText) }}</textarea>
                <span class="text-[10px] text-zinc-400">Format tiap baris: Hari | Judul kegiatan | Rincian.</span>
            </div>

            {{-- Fasilitas Termasuk (Inclusions) --}}
            <div class="space-y-1.5">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Fasilitas Termasuk (Inclusions)
                </label>
                <textarea name="inclusions" id="inclusions" rows="4" 
                          class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('inclusions', $inclusionsText) }}</textarea>
                <span class="text-[10px] text-zinc-400">Ketik setiap fasilitas di baris baru.</span>
            </div>

            {{-- Fasilitas Tidak Termasuk (Exclusions) --}}
            <div class="space-y-1.5">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Tidak Termasuk (Exclusions)
                </label>
                <textarea name="exclusions" id="exclusions" rows="4" 
                          class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('exclusions', $exclusionsText) }}</textarea>
                <span class="text-[10px] text-zinc-400">Ketik setiap item di baris baru.</span>
            </div>

            {{-- Catatan Tambahan (Notes) --}}
            <div class="space-y-1.5 sm:col-span-2">
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Catatan Penting Perjalanan (Notes)
                </label>
                <textarea name="notes" id="notes" rows="2" 
                          class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('notes', $detail?->notes) }}</textarea>
            </div>

            {{-- Checkboxes --}}
            <div class="sm:col-span-2 flex flex-wrap items-center gap-6 pt-2 border-t border-white/[0.07]">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $destination->is_active) ? 'checked' : '' }} 
                           class="w-4 h-4 rounded bg-[#0B0B0E] border-white/[0.09] text-aw-gold focus:ring-aw-gold">
                    <span class="font-bold text-zinc-200">Aktifkan di Katalog Website</span>
                </label>

                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }} 
                           class="w-4 h-4 rounded bg-[#0B0B0E] border-white/[0.09] text-aw-gold focus:ring-aw-gold">
                    <span class="font-bold text-aw-gold">Tampilkan sebagai Destinasi Unggulan (Homepage)</span>
                </label>
            </div>

        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-white/[0.07]">
            <a href="{{ route('admin.destinations.index') }}" 
               class="px-5 py-3 rounded-xl bg-[#121215] hover:bg-slate-700 text-zinc-300 font-semibold text-xs transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="px-6 py-3 rounded-xl bg-aw-gold text-slate-950 font-bold text-xs hover:bg-aw-gold/90 transition-all shadow-md">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

@endsection
