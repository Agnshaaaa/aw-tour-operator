@extends('layouts.admin')

@section('title', 'Edit Foto Dokumentasi — Admin Panel')
@section('page_title', 'Edit Foto Dokumentasi Perjalanan')

@section('content')

<div class="max-w-4xl mx-auto space-y-6">
    
    {{-- Back Link --}}
    <div>
        <a href="{{ route('admin.gallery.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-zinc-400 hover:text-white transition-colors">
            &larr; Kembali ke Daftar Galeri
        </a>
    </div>

    {{-- Form Container --}}
    <form action="{{ route('admin.gallery.update', $documentation->id) }}" method="POST" enctype="multipart/form-data" 
          class="bg-[#0B0B0E]/90 border border-white/[0.07] rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
        @csrf
        @method('PUT')

        <div class="border-b border-white/[0.07] pb-4">
            <h3 class="text-lg font-bold text-white">Edit Album: {{ $documentation->title }}</h3>
            <p class="text-xs text-zinc-400">Perbarui informasi album atau tambahkan foto/video baru.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            
            {{-- Judul Dokumentasi --}}
            <div class="sm:col-span-2">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Judul Album / Nama Rombongan <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $documentation->title) }}" required 
                       class="w-full rounded-xl bg-[#0B0B0E] border-white/[0.09] text-sm py-2.5 px-3.5 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold @error('title') border-rose-500 @enderror">
                @error('title')
                    <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Foto Saat Ini & Upload Baru --}}
            <div class="sm:col-span-2" x-data="{ previewUrl: null }">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Foto Dokumentasi
                </label>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-start">
                    {{-- Current Image --}}
                    <div class="bg-[#0B0B0E]/60 p-4 rounded-2xl border border-white/[0.07] space-y-2">
                        <span class="text-xs text-zinc-400 font-semibold block">Foto Saat Ini:</span>
                        <img src="{{ $documentation->image_url }}" alt="{{ $documentation->title }}" class="rounded-xl max-h-48 w-full object-cover border border-white/[0.09]">
                    </div>

                    {{-- Upload New Image Area --}}
                    <div class="border-2 border-dashed border-white/[0.09] hover:border-aw-gold/60 rounded-2xl p-6 text-center transition-colors bg-[#0B0B0E]/50">
                        <input type="file" name="image" accept="image/*" id="image-upload-edit" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner"
                               @change="
                                   const file = $event.target.files[0];
                                   if (file) {
                                       previewUrl = URL.createObjectURL(file);
                                   }
                               ">
                        
                        <template x-if="!previewUrl">
                            <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                                <div class="w-10 h-10 rounded-xl bg-[#121215] text-aw-gold flex items-center justify-center shadow">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-semibold text-white">Klik untuk mengganti foto</span>
                                <span class="text-[11px] text-zinc-400">Kosongkan jika tetap memakai foto lama</span>
                            </label>
                        </template>

                        <template x-if="previewUrl">
                            <div class="space-y-2">
                                <img :src="previewUrl" alt="New Preview" class="max-h-40 mx-auto rounded-xl object-contain border border-white/[0.09] shadow-lg">
                                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
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
            <div class="sm:col-span-2 pt-4 border-t border-white/[0.07] space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-bold text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span>Koleksi Foto &amp; Video Album</span>
                            <span class="px-2 py-0.5 rounded-full bg-teal-500/20 text-teal-300 font-bold text-xs border border-teal-500/30">
                                {{ $documentation->media->count() }} Media
                            </span>
                        </h4>
                        <p class="text-[11px] text-zinc-400">Daftar semua memori foto dan video yang ada dalam kotakan album rombongan ini.</p>
                    </div>
                </div>

                @if($documentation->media->isEmpty())
                    <div class="p-4 rounded-xl bg-[#0B0B0E]/50 border border-white/[0.07] text-center text-xs text-zinc-400">
                        Belum ada item foto/video tambahan di dalam album ini. Tambahkan melalui form di bawah!
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        @foreach($documentation->media as $m)
                            <div class="relative group rounded-xl bg-[#0B0B0E] border border-white/[0.07] overflow-hidden shadow">
                                <div class="aspect-video bg-[#060608] flex items-center justify-center overflow-hidden">
                                    @if($m->type === 'image')
                                        <img src="{{ $m->url }}" alt="{{ $m->caption }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                                    @else
                                        <div class="p-2 text-center text-xs text-amber-300 flex flex-col items-center gap-1">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm14.024-.983a1.125 1.125 0 010 1.966l-5.603 3.113A1.125 1.125 0 019 15.113V8.887c0-.857.921-1.4 1.671-.983l5.603 3.113z" clip-rule="evenodd"/>
                                            </svg>
                                            <span class="text-[10px] truncate max-w-[100px]">Video</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Type Badge --}}
                                <div class="absolute top-1.5 left-1.5 pointer-events-none">
                                    <span class="px-1.5 py-0.5 rounded text-[9px] font-bold {{ $m->type === 'image' ? 'bg-[#060608]/70 text-zinc-300' : 'bg-amber-500/90 text-slate-950' }}">
                                        {{ $m->type === 'image' ? 'Foto' : 'Video' }}
                                    </span>
                                </div>

                                {{-- Delete Button --}}
                                <div class="p-2 bg-[#0B0B0E]/95 flex items-center justify-between border-t border-white/[0.07]">
                                    <span class="text-[10px] text-zinc-400 truncate max-w-[90px]" title="{{ $m->caption }}">
                                        {{ $m->caption ?: 'Tanpa keterangan' }}
                                    </span>
                                    
                                    <button type="button" 
                                            onclick="if(confirm('Hapus media ini dari album?')) { document.getElementById('delete-media-{{ $m->id }}').submit(); }"
                                            class="text-rose-400 hover:text-rose-300 p-1 rounded hover:bg-rose-500/10 transition-colors"
                                            title="Hapus media ini">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- SECTION: TAMBAH FOTO BARU KE ALBUM (MULTI-UPLOAD) --}}
    <div class="sm:col-span-2 pt-2 border-t border-white/[0.07]" x-data="{ addPhotoCount: 0 }">
        <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
            Tambah Banyak Foto Baru ke Album Ini
        </label>
        <p class="text-[11px] text-zinc-400 mb-2">Pilih satu atau lebih file foto untuk ditambahkan ke dalam memori rombongan ini.</p>
        
        <div class="border-2 border-dashed border-white/[0.09] hover:border-teal-400/60 rounded-2xl p-5 text-center transition-colors bg-[#0B0B0E]/50">
            <input type="file" name="photos[]" multiple accept="image/*" id="additional-photos-upload" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner"
                   @change="addPhotoCount = $event.target.files.length">
            
            <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                <div class="w-10 h-10 rounded-xl bg-[#121215] text-teal-300 flex items-center justify-center shadow">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                        <template x-if="addPhotoCount === 0">
                            <div>
                                <span class="text-xs font-semibold text-white">Klik untuk memilih tambahan foto (Bisa pilih sekaligus)</span>
                                <span class="text-[10px] text-zinc-500 block">Format: JPG, PNG, WEBP (Maksimal 5MB per file)</span>
                            </div>
                        </template>
                        <template x-if="addPhotoCount > 0">
                            <div>
                                <span class="text-xs font-bold text-teal-300" x-text="addPhotoCount + ' foto baru siap diunggah saat disimpan'"></span>
                                <span class="text-[10px] text-zinc-400 block">Klik untuk memilih ulang foto</span>
                            </div>
                        </template>
                    </label>
                </div>
                @error('photos.*')
                    <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- SECTION: TAMBAH VIDEO KE ALBUM --}}
            <div class="sm:col-span-2 pt-2 border-t border-white/[0.07] space-y-3">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    Tambah Video Dokumentasi (YouTube / Link Video)
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">URL Video (YouTube / Direct Video Link)</label>
                        <input type="url" name="video_url" value="{{ old('video_url') }}"
                               placeholder="https://www.youtube.com/watch?v=..."
                               class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                    </div>
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Keterangan / Caption Video</label>
                        <input type="text" name="video_caption" value="{{ old('video_caption') }}"
                               placeholder="Contoh: Aftermovie Cinematic Tour Bromo"
                               class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                    </div>
                </div>
                @error('video_url')
                    <span class="text-rose-400 text-xs block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Checkboxes Featured & Active --}}
            <div class="sm:col-span-2 flex flex-wrap gap-6 pt-2 border-t border-white/[0.07]">
                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $documentation->is_featured) ? 'checked' : '' }}
                           class="rounded bg-[#0B0B0E] border-white/[0.09] text-aw-gold focus:ring-aw-gold">
                    <span class="text-xs font-bold text-white flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Jadikan Featured (Tampil di Hero Showcase Beranda)
                    </span>
                </label>

                <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $documentation->is_active) ? 'checked' : '' }}
                           class="rounded bg-[#0B0B0E] border-white/[0.09] text-emerald-500 focus:ring-emerald-500">
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
