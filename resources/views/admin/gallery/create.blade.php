@extends('layouts.admin')

@section('title', 'Buat Album Dokumentasi — Admin Panel')
@section('page_title', 'Buat Album Dokumentasi Perjalanan Rombongan')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">
    
    {{-- Back Link --}}
    <div>
        <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-zinc-400 hover:text-white transition-colors">
            &larr; Kembali ke Daftar Galeri
        </a>
    </div>

    {{-- Form Container --}}
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-[#0B0B0E]/90 border border-white/[0.07] rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
        @csrf

        <div class="border-b border-white/[0.07] pb-4">
            <h3 class="text-lg font-bold text-white">Informasi Album Dokumentasi</h3>
            <p class="text-xs text-zinc-400">Buat album perjalanan baru dan unggah foto serta video rombongan.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            
            {{-- Judul Dokumentasi --}}
            <div class="sm:col-span-2">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Judul Album / Nama Rombongan <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required 
                       placeholder="Contoh: Gathering PT Semen Indonesia ke Bromo Sunrise"
                       class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                @error('title')
                    <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Destinasi Wisata Terkait --}}
            <div class="sm:col-span-2">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Destinasi Wisata (Opsional)
                </label>
                <select name="destination_id" 
                        class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                    <option value="">-- Tanpa Destinasi Khusus / Umum --</option>
                    @foreach($destinations as $dest)
                        <option value="{{ $dest->id }}" {{ old('destination_id') == $dest->id ? 'selected' : '' }}>
                            {{ $dest->name }} ({{ $dest->location }})
                        </option>
                    @endforeach
                </select>
                <p class="text-[10px] text-zinc-500 mt-1">Pilih destinasi untuk kategorisasi album</p>
            </div>

            {{-- SECTION: 1. FOTO SAMPUL UTAMA (COVER) --}}
            <div class="sm:col-span-2 pt-2 border-t border-white/[0.07]" x-data="{ previewCover: null }">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    1. Foto Sampul Utama (Cover Card) <span class="text-rose-400">*</span>
                </label>
                <p class="text-[11px] text-zinc-400 mb-2">Foto utama yang akan tampil di kartu luar dan Hero Showcase.</p>
                
                <div class="border-2 border-dashed border-white/[0.09] hover:border-teal-400/60 rounded-2xl p-5 text-center transition-colors bg-[#0B0B0E]/50">
                    <input type="file" name="image" required accept="image/*" id="cover-upload" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner"
                           @change="
                               const file = $event.target.files[0];
                               if (file) {
                                   previewCover = URL.createObjectURL(file);
                               }
                           ">
                    
                    <template x-if="!previewCover">
                        <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-[#121215] text-teal-300 flex items-center justify-center shadow">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                            <span class="text-xs font-semibold text-white">Klik untuk memilih foto sampul</span>
                            <span class="text-[10px] text-zinc-500">Format: JPG, PNG, WEBP (Maksimal 5MB)</span>
                        </label>
                    </template>

                    <template x-if="previewCover">
                        <div class="space-y-2">
                            <img :src="previewCover" alt="Cover Preview" class="max-h-48 mx-auto rounded-xl object-contain border border-white/[0.09] shadow">
                            <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                Ganti Sampul
                            </label>
                        </div>
                    </template>
                </div>
            </div>

            {{-- SECTION: 2. MULTI-UPLOAD FOTO GALERI ALBUM --}}
            <div class="sm:col-span-2 pt-2 border-t border-white/[0.07]" x-data="{ photoCount: 0 }">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    2. Upload Banyak Foto Album Sekaligus (Multi-Upload)
                </label>
                <p class="text-[11px] text-zinc-400 mb-2">Pilih beberapa foto sekaligus untuk dimasukkan ke galeri rombongan ini.</p>
                
                <div class="border-2 border-dashed border-white/[0.09] hover:border-aw-gold/60 rounded-2xl p-5 text-center transition-colors bg-[#0B0B0E]/50">
                    <input type="file" name="photos[]" multiple accept="image/*" id="photos-upload" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner"
                           @change="photoCount = $event.target.files.length">
                    
                    <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-[#121215] text-aw-gold flex items-center justify-center shadow">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <span class="text-xs font-semibold text-white">
                            <span x-show="photoCount === 0">Klik untuk memilih banyak foto sekaligus (Tahan Ctrl/Shift)</span>
                            <span x-show="photoCount > 0" class="text-teal-300 font-bold" x-text="photoCount + ' Foto Dipilih Siap Upload!'"></span>
                        </span>
                        <span class="text-[10px] text-zinc-500">Mendukung upload banyak file gambar</span>
                    </label>
                </div>
            </div>

            {{-- SECTION: 3. VIDEO DOKUMENTASI (YOUTUBE / LINK) --}}
            <div class="sm:col-span-2 pt-2 border-t border-white/[0.07] space-y-3">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    3. Tambah Video Dokumentasi (YouTube / Link Video) <span class="text-zinc-500 font-normal normal-case">(Opsional)</span>
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="sm:col-span-2">
                        <input type="url" name="video_url" value="{{ old('video_url') }}" 
                               placeholder="Contoh URL: https://www.youtube.com/watch?v=... atau https://youtu.be/..."
                               class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                    </div>
                    <div>
                        <input type="text" name="video_caption" value="{{ old('video_caption') }}" 
                               placeholder="Keterangan Video (Opsional)"
                               class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                    </div>
                </div>
                <span class="text-[10px] text-zinc-500 block">Video akan otomatis disematkan dan dapat diputar langsung di galeri publik.</span>
            </div>

            {{-- Checkboxes Featured & Active --}}
            <div class="sm:col-span-2 flex flex-wrap gap-6 pt-3 border-t border-white/[0.07]">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                           class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                    <span class="text-xs font-bold text-white flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Jadikan Featured (Tampil di Hero Showcase Beranda)
                    </span>
                </label>

                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                    <span class="text-xs font-bold text-white">Tampilkan di Website Publik</span>
                </label>
            </div>

        </div>

        {{-- Submit Button --}}
        <div class="pt-4 border-t border-white/[0.07] flex justify-end gap-3">
            <a href="{{ route('admin.gallery.index') }}" class="px-5 py-2.5 bg-[#121215] hover:bg-slate-700 text-zinc-300 text-xs font-semibold rounded-xl transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-aw-gold hover:bg-aw-gold/90 text-slate-950 text-xs font-bold rounded-xl transition-all shadow-lg flex items-center gap-2">
                <span>Simpan Album &amp; Unggah Media</span>
            </button>
        </div>

    </form>

</div>

@endsection
