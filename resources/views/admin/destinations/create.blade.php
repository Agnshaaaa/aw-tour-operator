@extends('layouts.admin')

@section('title', 'Tambah Destinasi Wisata — Admin Control Panel')
@section('page_title', 'Tambah Destinasi Wisata Baru')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">

    {{-- Top back button --}}
    <div>
        <a href="{{ route('admin.destinations.index') }}" 
           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white border border-slate-800 text-xs font-semibold transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Daftar Destinasi</span>
        </a>
    </div>

    {{-- Create Form Card --}}
    <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-aw-navy/90 rounded-3xl p-6 sm:p-8 border border-slate-800 shadow-xl space-y-6">
        @csrf

        <div class="border-b border-slate-800 pb-4">
            <h2 class="font-serif text-lg font-bold text-white">Formulir Destinasi Wisata</h2>
            <p class="text-xs text-slate-400">Lengkapi informasi destinasi untuk ditampilkan pada katalog paket tour rombongan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">

            {{-- Kategori Destinasi --}}
            <div class="space-y-1.5 sm:col-span-1">
                <label for="category_id" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Kategori Wisata <span class="text-rose-400">*</span>
                </label>
                <select name="category_id" id="category_id" required 
                        class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
                    <option value="">Pilih Kategori...</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Nama Destinasi --}}
            <div class="space-y-1.5 sm:col-span-1">
                <label for="name" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Nama Destinasi <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required 
                       placeholder="Contoh: Bromo Sunrise & Savana" 
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Lokasi --}}
            <div class="space-y-1.5 sm:col-span-2">
                <label for="location" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Lokasi Wilayah / Kota <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" required 
                       placeholder="Contoh: Probolinggo & Pasuruan, Jawa Timur" 
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Estimasi Harga Min & Max --}}
            <div class="space-y-1.5">
                <label for="min_price" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Harga Mulai Dari (Rp) <span class="text-rose-400">*</span>
                </label>
                <input type="number" name="min_price" id="min_price" value="{{ old('min_price', 0) }}" min="0" required 
                       placeholder="Contoh: 650000" 
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            <div class="space-y-1.5">
                <label for="max_price" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Harga Maksimum (Rp, Opsional)
                </label>
                <input type="number" name="max_price" id="max_price" value="{{ old('max_price') }}" min="0" 
                       placeholder="Contoh: 1200000" 
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Min Pax --}}
            <div class="space-y-1.5 sm:col-span-1">
                <label for="min_pax" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Minimum Peserta (Pax) <span class="text-rose-400">*</span>
                </label>
                <input type="number" name="min_pax" id="min_pax" value="{{ old('min_pax', 20) }}" min="1" required 
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Cover Image --}}
            <div class="space-y-1.5 sm:col-span-1">
                <label class="block font-bold text-slate-300 uppercase tracking-wider">
                    Gambar Cover Destinasi
                </label>
                <input type="file" name="cover_image" accept="image/*" 
                       class="w-full text-xs text-slate-400 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700">
                <input type="text" name="cover_image_url" value="{{ old('cover_image_url') }}" 
                       placeholder="Atau URL gambar web (https://...)" 
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-2.5 mt-1 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Deskripsi Singkat --}}
            <div class="space-y-1.5 sm:col-span-2">
                <label for="short_description" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Deskripsi Singkat (Tampil di Card Katalog) <span class="text-rose-400">*</span>
                </label>
                <textarea name="short_description" id="short_description" rows="2" required 
                          placeholder="Jelaskan ringkasan daya tarik destinasi dalam 1-2 kalimat..." 
                          class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">{{ old('short_description') }}</textarea>
            </div>

            {{-- Deskripsi Lengkap --}}
            <div class="space-y-1.5 sm:col-span-2">
                <label for="description" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Deskripsi Lengkap Destinasi (Opsional)
                </label>
                <textarea name="description" id="description" rows="4" 
                          placeholder="Penjelasan detail tentang destinasi, keunggulan, fasilitas, dan daya tarik wisata..." 
                          class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">{{ old('description') }}</textarea>
            </div>

            {{-- Fasilitas Termasuk (Inclusions) --}}
            <div class="space-y-1.5 sm:col-span-2">
                <label for="itinerary" class="block font-bold text-slate-300 uppercase tracking-wider">Itinerary (satu hari per baris)</label>
                <textarea name="itinerary" id="itinerary" rows="5" placeholder="Hari 1 | Surabaya ke Malang | Berangkat pagi dan check-in hotel" class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">{{ old('itinerary') }}</textarea>
                <span class="text-[10px] text-slate-400">Format tiap baris: Hari | Judul kegiatan | Rincian. Pisahkan ketiga bagian dengan karakter |.</span>
            </div>

            {{-- Fasilitas Termasuk (Inclusions) --}}
            <div class="space-y-1.5">
                <label for="inclusions" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Fasilitas Termasuk (Inclusions)
                </label>
                <textarea name="inclusions" id="inclusions" rows="4" 
                          placeholder="Satu item per baris:&#10;Transportasi Bus AC&#10;Tiket Masuk Lokasi&#10;Makan 3x sehari&#10;Tour Leader & Guide" 
                          class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">{{ old('inclusions') }}</textarea>
                <span class="text-[10px] text-slate-400">Ketik setiap fasilitas di baris baru.</span>
            </div>

            {{-- Fasilitas Tidak Termasuk (Exclusions) --}}
            <div class="space-y-1.5">
                <label for="exclusions" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Tidak Termasuk (Exclusions)
                </label>
                <textarea name="exclusions" id="exclusions" rows="4" 
                          placeholder="Satu item per baris:&#10;Pengeluaran pribadi&#10;Oleh-oleh&#10;Tip guide & driver sukarela" 
                          class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">{{ old('exclusions') }}</textarea>
                <span class="text-[10px] text-slate-400">Ketik setiap item di baris baru.</span>
            </div>

            {{-- Catatan Tambahan (Notes) --}}
            <div class="space-y-1.5 sm:col-span-2">
                <label for="notes" class="block font-bold text-slate-300 uppercase tracking-wider">
                    Catatan Penting Perjalanan (Notes)
                </label>
                <textarea name="notes" id="notes" rows="2" 
                          placeholder="Contoh: Peserta diwajibkan membawa jaket tebal karena suhu udara dingin di malam hari." 
                          class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">{{ old('notes') }}</textarea>
            </div>

            {{-- Checkboxes --}}
            <div class="sm:col-span-2 flex flex-wrap items-center gap-6 pt-2 border-t border-slate-800">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} 
                           class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-aw-gold focus:ring-aw-gold">
                    <span class="font-bold text-slate-200">Aktifkan di Katalog Website</span>
                </label>

                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} 
                           class="w-4 h-4 rounded bg-slate-900 border-slate-700 text-aw-gold focus:ring-aw-gold">
                    <span class="font-bold text-aw-gold">Tampilkan sebagai Destinasi Unggulan (Homepage)</span>
                </label>
            </div>

        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-800">
            <a href="{{ route('admin.destinations.index') }}" 
               class="px-5 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-xs transition-colors">
                Batal
            </a>
            <button type="submit" 
                    class="px-6 py-3 rounded-xl bg-aw-gold text-slate-950 font-bold text-xs hover:bg-aw-gold/90 transition-all shadow-md">
                Simpan Destinasi Baru
            </button>
        </div>

    </form>

</div>

@endsection
