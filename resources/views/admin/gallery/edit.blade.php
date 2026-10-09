@extends('layouts.admin')

@section('title', 'Edit Foto Dokumentasi — Admin Panel')
@section('page_title', 'Edit Foto Dokumentasi Perjalanan')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">
    
    {{-- Back Link --}}
    <div>
        <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition-colors">
            &larr; Kembali ke Daftar Galeri
        </a>
    </div>

    {{-- Form Container --}}
    <form action="{{ route('admin.gallery.update', $documentation->id) }}" method="POST" enctype="multipart/form-data" 
          class="bg-aw-navy/90 border border-slate-800 rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <div class="border-b border-slate-800 pb-4">
            <h3 class="text-lg font-bold text-white">Edit Dokumentasi: {{ $documentation->title }}</h3>
            <p class="text-xs text-slate-400">Perbarui rincian atau ganti foto dokumentasi perjalanan ini.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            
            {{-- Judul Dokumentasi --}}
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Judul Dokumentasi / Nama Rombongan <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $documentation->title) }}" required 
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
                        <option value="{{ $dest->id }}" {{ old('destination_id', $documentation->destination_id) == $dest->id ? 'selected' : '' }}>
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
                <input type="text" name="badge_text" value="{{ old('badge_text', $documentation->badge_text) }}" 
                       placeholder="Contoh: Rombongan Tour Terbanyak - 50+ Trip"
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm py-2.5 px-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Tanggal Kegiatan --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Tanggal Trip / Kegiatan
                </label>
                <input type="date" name="trip_date" value="{{ old('trip_date', $documentation->trip_date ? $documentation->trip_date->format('Y-m-d') : '') }}"
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm py-2.5 px-3.5 text-white focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Estimasi Jumlah Peserta --}}
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Jumlah Peserta (PAX)
                </label>
                <input type="number" name="participant_count" value="{{ old('participant_count', $documentation->participant_count) }}" min="1"
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm py-2.5 px-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
            </div>

            {{-- Deskripsi / Cerita Singkat --}}
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Deskripsi / Cerita Singkat Kegiatan
                </label>
                <textarea name="description" rows="3" 
                          class="w-full rounded-xl bg-slate-900 border-slate-700 text-sm p-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">{{ old('description', $documentation->description) }}</textarea>
            </div>

            {{-- Foto Saat Ini & Upload Baru --}}
            <div class="sm:col-span-2" x-data="{ previewUrl: null }">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Foto Dokumentasi
                </label>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-start">
                    {{-- Current Image --}}
                    <div class="bg-slate-900/60 p-4 rounded-2xl border border-slate-800 space-y-2">
                        <span class="text-xs text-slate-400 font-semibold block">Foto Saat Ini:</span>
                        <img src="{{ $documentation->image_url }}" alt="{{ $documentation->title }}" class="rounded-xl max-h-48 w-full object-cover border border-slate-700">
                    </div>

                    {{-- Upload New Image Area --}}
                    <div class="border-2 border-dashed border-slate-700 hover:border-aw-gold/60 rounded-2xl p-6 text-center transition-colors bg-slate-900/50">
                        <input type="file" name="image" accept="image/*" id="image-upload-edit" class="hidden"
                               @change="
                                   const file = $event.target.files[0];
                                   if (file) {
                                       previewUrl = URL.createObjectURL(file);
                                   }
                               ">
                        
                        <template x-if="!previewUrl">
                            <label for="image-upload-edit" class="cursor-pointer flex flex-col items-center gap-2">
                                <div class="w-10 h-10 rounded-xl bg-slate-800 text-aw-gold flex items-center justify-center text-xl shadow">
                                    🔄
                                </div>
                                <span class="text-xs font-semibold text-white">Klik untuk mengganti foto</span>
                                <span class="text-[11px] text-slate-400">Kosongkan jika tetap memakai foto lama</span>
                            </label>
                        </template>

                        <template x-if="previewUrl">
                            <div class="space-y-2">
                                <img :src="previewUrl" alt="New Preview" class="max-h-40 mx-auto rounded-xl object-contain border border-slate-700 shadow-lg">
                                <label for="image-upload-edit" class="inline-block px-3 py-1 bg-slate-800 text-xs font-semibold text-slate-200 rounded-lg cursor-pointer">
                                    Pilih Foto Lain
                                </label>
                            </div>
                        </template>
                    </div>
                </div>

                @error('image')
                    <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- SECTION: KOLEKSI MEDIA DALAM ALBUM SAAT INI --}}
            <div class="sm:col-span-2 pt-4 border-t border-slate-800 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-bold text-white flex items-center gap-2">
                            <span>📸 Koleksi Foto &amp; Video Album</span>
                            <span class="px-2 py-0.5 rounded-full bg-teal-500/20 text-teal-300 font-bold text-xs border border-teal-500/30">
                                {{ $documentation->media->count() }} Media
                            </span>
                        </h4>
                        <p class="text-[11px] text-slate-400">Daftar semua memori foto dan video yang ada dalam kotakan album rombongan ini.</p>
                    </div>
                </div>

                @if($documentation->media->isEmpty())
                    <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-center text-xs text-slate-400">
                        Belum ada item foto/video tambahan di dalam album ini. Tambahkan melalui form di bawah!
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        @foreach($documentation->media as $m)
                            <div class="relative group rounded-xl bg-slate-900 border border-slate-800 overflow-hidden shadow">
                                <div class="aspect-video bg-slate-950 flex items-center justify-center overflow-hidden">
                                    @if($m->type === 'image')
                                        <img src="{{ $m->url }}" alt="{{ $m->caption }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                    @else
                                        <div class="p-2 text-center text-xs text-amber-300 flex flex-col items-center gap-1">
                                            <span class="text-xl">🎥</span>
                                            <span class="text-[10px] truncate max-w-[100px]">{{ $m->is_youtube ? 'YouTube Video' : 'Video' }}</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Type Badge --}}
                                <div class="absolute top-1.5 left-1.5 pointer-events-none">
                                    <span class="px-1.5 py-0.5 rounded text-[9px] font-bold {{ $m->type === 'image' ? 'bg-black/70 text-slate-300' : 'bg-amber-500/90 text-slate-950' }}">
                                        {{ $m->type === 'image' ? 'Foto' : 'Video' }}
                                    </span>
                                </div>

                                {{-- Delete Button --}}
                                <div class="p-2 bg-slate-900/95 flex items-center justify-between border-t border-slate-800">
                                    <span class="text-[10px] text-slate-400 truncate max-w-[90px]" title="{{ $m->caption }}">
                                        {{ $m->caption ?: 'Tanpa keterangan' }}
                                    </span>
                                    
                                    <button type="button" 
                                            onclick="if(confirm('Hapus media ini dari album?')) { document.getElementById('delete-media-{{ $m->id }}').submit(); }"
                                            class="text-rose-400 hover:text-rose-300 text-xs p-1 rounded hover:bg-rose-500/10 transition-colors"
                                            title="Hapus media ini">
                                        🗑️
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- SECTION: TAMBAH FOTO BARU KE ALBUM (MULTI-UPLOAD) --}}
            <div class="sm:col-span-2 pt-2 border-t border-slate-800" x-data="{ addPhotoCount: 0 }">
                <label class="block text-xs font-bold uppercase tracking-wider text-teal-300 mb-1.5">
                    ➕ Tambah Banyak Foto Baru ke Album Ini
                </label>
                <p class="text-[11px] text-slate-400 mb-2">Pilih satu atau lebih file foto untuk ditambahkan ke dalam memori rombongan ini.</p>
                
                <div class="border-2 border-dashed border-slate-700 hover:border-teal-400/60 rounded-2xl p-5 text-center transition-colors bg-slate-900/50">
                    <input type="file" name="photos[]" multiple accept="image/*" id="additional-photos-upload" class="hidden"
                           @change="addPhotoCount = $event.target.files.length">
                    
                    <label for="additional-photos-upload" class="cursor-pointer flex flex-col items-center gap-1.5">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 text-teal-300 flex items-center justify-center text-xl shadow">
                            📁
                        </div>
                        <template x-if="addPhotoCount === 0">
                            <div>
                                <span class="text-xs font-semibold text-white">Klik untuk memilih tambahan foto (Bisa pilih sekaligus)</span>
                                <span class="text-[10px] text-slate-500 block">Format: JPG, PNG, WEBP (Maksimal 5MB per file)</span>
                            </div>
                        </template>
                        <template x-if="addPhotoCount > 0">
                            <div>
                                <span class="text-xs font-bold text-teal-300" x-text="addPhotoCount + ' foto baru siap diunggah saat disimpan'"></span>
                                <span class="text-[10px] text-slate-400 block">Klik untuk memilih ulang foto</span>
                            </div>
                        </template>
                    </label>
                </div>
                @error('photos.*')
                    <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- SECTION: TAMBAH VIDEO KE ALBUM --}}
            <div class="sm:col-span-2 pt-2 border-t border-slate-800 space-y-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-amber-300">
                    ➕ Tambah Video Dokumentasi (YouTube / Link Video)
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] text-slate-300 mb-1">URL Video (YouTube / Direct Video Link)</label>
                        <input type="url" name="video_url" value="{{ old('video_url') }}"
                               placeholder="https://www.youtube.com/watch?v=..."
                               class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs py-2 px-3 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
                    </div>
                    <div>
                        <label class="block text-[11px] text-slate-300 mb-1">Keterangan / Caption Video</label>
                        <input type="text" name="video_caption" value="{{ old('video_caption') }}"
                               placeholder="Contoh: Aftermovie Cinematic Tour Bromo"
                               class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs py-2 px-3 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
                    </div>
                </div>
                @error('video_url')
                    <span class="text-rose-400 text-xs block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Checkboxes Featured & Active --}}
            <div class="sm:col-span-2 flex flex-wrap gap-6 pt-2 border-t border-slate-800">
                <label class="inline-flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $documentation->is_featured) ? 'checked' : '' }}
                           class="rounded bg-slate-900 border-slate-700 text-aw-gold focus:ring-aw-gold">
                    <span class="text-xs font-bold text-white">⭐ Jadikan Featured (Tampil di Hero Showcase Beranda)</span>
                </label>

                <label class="inline-flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $documentation->is_active) ? 'checked' : '' }}
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
                <span>Perbarui Data Dokumentasi</span>
            </button>
        </div>

    </form>

    {{-- Hidden Delete Forms for Media Items --}}
    @foreach($documentation->media as $m)
        <form id="delete-media-{{ $m->id }}" 
              action="{{ route('admin.gallery.media.destroy', $m->id) }}" 
              method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

</div>

@endsection
