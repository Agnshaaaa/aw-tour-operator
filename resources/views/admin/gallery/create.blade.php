@extends('layouts.admin')

@section('title', 'Buat Album Dokumentasi — Admin Panel')
@section('page_title', 'Buat Album Dokumentasi Perjalanan Rombongan')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">
    
    {{-- Back Link --}}
    <div>
        <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition-colors">
            &larr; Kembali ke Daftar Galeri
        </a>
    </div>

    {{-- Form Container --}}
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-aw-navy/90 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
        @csrf

        <div class="border-b border-slate-800 pb-4">
            <h3 class="text-lg font-bold text-white">Informasi Album &amp; Rombongan</h3>
            <p class="text-xs text-slate-400">Buat album perjalanan baru dan unggah seluruh koleksi foto serta video rombongan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            
            {{-- Judul Dokumentasi --}}
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Nama Rombongan / Judul Album <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required 
                       placeholder="Contoh: Gathering PT Semen Indonesia ke Bromo Sunrise"
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm py-2.5 px-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold @error('title') border-rose-500 @enderror">
                @error('title')
                    <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Destinasi Wisata Terkait --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Destinasi Wisata
                </label>
                <select name="destination_id" 
                        class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm py-2.5 px-3.5 text-white focus:border-aw-gold focus:ring-aw-gold">
                    <option value="">-- Tanpa Destinasi Khusus / Umum --</option>
                    @foreach($destinations as $dest)
                        <option value="{{ $dest->id }}" {{ old('destination_id') == $dest->id ? 'selected' : '' }}>
                            {{ $dest->name }} ({{ $dest->location }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Badge Text Overlay --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Badge / Tagline Overlay
                </label>
                <input type="text" name="badge_text" value="{{ old('badge_text', 'Rombongan Tour Terbanyak - 50+ Trip') }}" 
                       placeholder="Contoh: Rombongan Tour Terbanyak - 50+ Trip"
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm py-2.5 px-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Tanggal Kegiatan --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Tanggal Trip / Kegiatan
                </label>
                <input type="date" name="trip_date" value="{{ old('trip_date') }}"
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm py-2.5 px-3.5 text-white focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Estimasi Jumlah Peserta --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Jumlah Peserta (PAX)
                </label>
                <input type="number" name="participant_count" value="{{ old('participant_count') }}" min="1" placeholder="Contoh: 120"
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm py-2.5 px-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Deskripsi / Cerita Singkat --}}
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Deskripsi / Cerita Singkat Kegiatan
                </label>
                <textarea name="description" rows="3" 
                          placeholder="Ceritakan keseruan rombongan, armada yang digunakan, atau aktivitas menarik selama perjalanan..."
                          class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm p-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">{{ old('description') }}</textarea>
            </div>

            {{-- SECTION: 1. FOTO SAMPUL UTAMA (COVER) --}}
            <div class="sm:col-span-2 pt-2 border-t border-slate-800" x-data="{ previewCover: null }">
                <label class="block text-xs font-bold uppercase tracking-wider text-teal-300 mb-1.5">
                    1. Foto Sampul Utama (Cover Card) <span class="text-rose-400">*</span>
                </label>
                <p class="text-[11px] text-slate-400 mb-2">Foto utama yang akan tampil di kartu luar dan Hero Showcase.</p>
                
                <div class="border-2 border-dashed border-slate-700 hover:border-teal-400/60 rounded-2xl p-5 text-center transition-colors bg-slate-900/50">
                    <input type="file" name="image" required accept="image/*" id="cover-upload" class="hidden"
                           @change="
                               const file = $event.target.files[0];
                               if (file) {
                                   previewCover = URL.createObjectURL(file);
                               }
                           ">
                    
                    <template x-if="!previewCover">
                        <label for="cover-upload" class="cursor-pointer flex flex-col items-center gap-1.5">
                            <div class="w-10 h-10 rounded-xl bg-slate-800 text-teal-300 flex items-center justify-center text-xl shadow">
                                🖼️
                            </div>
                            <span class="text-xs font-semibold text-white">Klik untuk memilih foto sampul</span>
                            <span class="text-[10px] text-slate-500">Format: JPG, PNG, WEBP (Maksimal 5MB)</span>
                        </label>
                    </template>

                    <template x-if="previewCover">
                        <div class="space-y-2">
                            <img :src="previewCover" alt="Cover Preview" class="max-h-48 mx-auto rounded-xl object-contain border border-slate-700 shadow">
                            <label for="cover-upload" class="inline-block px-3 py-1 bg-slate-800 hover:bg-slate-700 text-xs font-semibold text-slate-200 rounded-lg cursor-pointer">
                                🔄 Ganti Sampul
                            </label>
                        </div>
                    </template>
                </div>
            </div>

            {{-- SECTION: 2. MULTI-UPLOAD FOTO GALERI ALBUM --}}
            <div class="sm:col-span-2 pt-2 border-t border-slate-800" x-data="{ photoCount: 0 }">
                <label class="block text-xs font-bold uppercase tracking-wider text-teal-300 mb-1.5">
                    2. Upload Banyak Foto Album Sekaligus (Multi-Upload)
                </label>
                <p class="text-[11px] text-slate-400 mb-2">Pilih beberapa foto sekaligus untuk dimasukkan ke galeri rombongan ini.</p>
                
                <div class="border-2 border-dashed border-slate-700 hover:border-aw-gold/60 rounded-2xl p-5 text-center transition-colors bg-slate-900/50">
                    <input type="file" name="photos[]" multiple accept="image/*" id="photos-upload" class="hidden"
                           @change="photoCount = $event.target.files.length">
                    
                    <label for="photos-upload" class="cursor-pointer flex flex-col items-center gap-1.5">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 text-aw-gold flex items-center justify-center text-xl shadow">
                            📸
                        </div>
                        <span class="text-xs font-semibold text-white">
                            <span x-show="photoCount === 0">Klik untuk memilih banyak foto sekaligus (Tahan Ctrl/Shift)</span>
                            <span x-show="photoCount > 0" class="text-teal-300 font-bold" x-text="photoCount + ' Foto Dipilih Siap Upload!'"></span>
                        </span>
                        <span class="text-[10px] text-slate-500">Mendukung upload banyak file gambar</span>
                    </label>
                </div>
            </div>

            {{-- SECTION: 3. VIDEO DOKUMENTASI (YOUTUBE / LINK) --}}
            <div class="sm:col-span-2 pt-2 border-t border-slate-800 space-y-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-teal-300">
                    3. Tambah Video Dokumentasi (YouTube / Link Video) <span class="text-slate-500 font-normal normal-case">(Opsional)</span>
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="sm:col-span-2">
                        <input type="url" name="video_url" value="{{ old('video_url') }}" 
                               placeholder="Contoh URL: https://www.youtube.com/watch?v=... atau https://youtu.be/..."
                               class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs py-2.5 px-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
                    </div>
                    <div>
                        <input type="text" name="video_caption" value="{{ old('video_caption') }}" 
                               placeholder="Keterangan Video (Opsional)"
                               class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs py-2.5 px-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
                    </div>
                </div>
                <span class="text-[10px] text-slate-500 block">Video akan otomatis disematkan dan dapat diputar langsung di galeri publik.</span>
            </div>

            {{-- Checkboxes Featured & Active --}}
            <div class="sm:col-span-2 flex flex-wrap gap-6 pt-3 border-t border-slate-800">
                <label class="inline-flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                           class="rounded bg-slate-900 border-slate-700 text-aw-gold focus:ring-aw-gold">
                    <span class="text-xs font-bold text-white">⭐ Jadikan Featured (Tampil di Hero Showcase Beranda)</span>
                </label>

                <label class="inline-flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded bg-slate-900 border-slate-700 text-emerald-500 focus:ring-emerald-500">
                    <span class="text-xs font-bold text-white">✅ Tampilkan di Website Publik</span>
                </label>
            </div>

        </div>

        {{-- Submit Button --}}
        <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
            <a href="{{ route('admin.gallery.index') }}" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-aw-gold hover:bg-aw-gold/90 text-slate-950 text-xs font-bold rounded-xl transition-all shadow-lg flex items-center gap-2">
                <span>Simpan Album &amp; Unggah Media</span>
            </button>
        </div>

    </form>

</div>

@endsection
