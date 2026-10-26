@extends('layouts.app')

@section('title', 'Dokumentasi & Galeri Rombongan Tour — AW Tour Operator')
@section('meta_description', 'Koleksi dokumentasi foto dan video perjalanan rombongan corporate gathering, studi tour kampus, dan family gathering yang dipercayakan kepada AW Tour Operator Surabaya.')

@section('content')

{{-- ========================================================================= --}}
{{-- 1. CINEMATIC HERO HEADER SECTION --}}
{{-- ========================================================================= --}}
<section class="relative z-10 min-h-[380px] sm:min-h-[420px] lg:min-h-[460px] flex flex-col justify-center items-center overflow-hidden bg-cover bg-center px-4 sm:px-6 lg:px-8 py-16" style="background-image: url('{{ asset('images/laut-bg.png') }}');">
    <div class="absolute inset-0 bg-slate-950/75 backdrop-blur-[2px] -z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/40 to-transparent -z-10"></div>

    <div class="max-w-7xl mx-auto w-full pt-10 sm:pt-12">
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-300 mb-6 drop-shadow-[0_1px_3px_rgba(0,0,0,0.9)]">
            <a href="{{ route('home') }}" class="hover:text-aw-gold transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-teal-300">Dokumentasi &amp; Galeri Rombongan</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8 space-y-5">
                <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-slate-900/80 border border-teal-400/40 text-teal-300 text-xs font-bold uppercase tracking-wider backdrop-blur-md shadow-md">
                    <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                    <span>Portofolio &amp; Dokumentasi Perjalanan Nyata</span>
                </div>

                <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl tracking-tight text-white leading-tight drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">
                    Setiap Rombongan Memiliki <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 via-aw-gold to-amber-200 drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">
                        Kenangan &amp; Cerita Terbaik
                    </span>
                </h1>

                <p class="text-slate-200 text-sm sm:text-base max-w-2xl leading-relaxed drop-shadow-[0_1px_4px_rgba(0,0,0,0.9)] font-medium">
                    Lihat koleksi foto dan video asli perjalanan rombongan korporat, instansi BUMN, kampus terkemuka (UNAIR, ITS, UNESA), dan komunitas keluarga yang telah menjelajahi berbagai destinasi bersama AW Tour Operator Surabaya.
                </p>

                <div class="pt-2 flex flex-wrap items-center gap-4 text-xs font-bold text-slate-200">
                    <div class="flex items-center gap-2 bg-slate-900/80 border border-white/10 px-3.5 py-2 rounded-xl backdrop-blur-md shadow-sm">
                        <span class="text-aw-gold font-display text-base">50+</span>
                        <span class="text-slate-200">Rombongan Sukses</span>
                    </div>
                    <div class="flex items-center gap-2 bg-slate-900/80 border border-white/10 px-3.5 py-2 rounded-xl backdrop-blur-md shadow-sm">
                        <span class="text-teal-300 font-display text-base">{{ number_format($totalPax, 0, ',', '.') }}+</span>
                        <span class="text-slate-200">Peserta Terlayani</span>
                    </div>
                    <div class="flex items-center gap-2 bg-slate-900/80 border border-white/10 px-3.5 py-2 rounded-xl backdrop-blur-md shadow-sm">
                        <span class="text-emerald-400 font-display text-base">100%</span>
                        <span class="text-slate-200">Dokumentasi Nyata</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="rounded-3xl bg-slate-900/80 border border-white/15 p-6 backdrop-blur-xl shadow-2xl space-y-4 text-center lg:text-left">
                    <div class="w-12 h-12 rounded-2xl bg-aw-gold/20 text-aw-gold flex items-center justify-center mx-auto lg:mx-0 shadow-inner">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                    </div>
                    <div>
                        <h2 class="text-white font-bold text-base">Rencanakan Rombongan Anda</h2>
                        <p class="text-xs text-slate-300 mt-1">Dapatkan estimasi biaya transparan dan armada terbaik sesuai kebutuhan grup Anda.</p>
                    </div>
                    <a href="{{ route('quotation.create') }}" 
                       class="block w-full py-3 px-4 rounded-xl bg-gradient-to-r from-aw-gold to-amber-500 text-slate-950 font-bold text-xs uppercase tracking-wider text-center hover:brightness-110 shadow-lg shadow-aw-gold/20 transition-all">
                        Hitung Biaya Rombongan (Quotation) →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 2. GALLERY INTERACTIVE SHOWCASE SECTION (ALPINE CONTROLLER) --}}
{{-- ========================================================================= --}}
<section class="py-12 sm:py-16 bg-[#0a1128] text-slate-100 min-h-screen relative" 
         x-data="galleryViewer()"
         @keydown.escape.window="closeModal()"
         @keydown.arrow-right.window="if(modalOpen) nextMedia()"
         @keydown.arrow-left.window="if(modalOpen) prevMedia()">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        {{-- FILTER BAR DESTINASI --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 border-b border-white/10 pb-6">
            <div>
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <span>Arsip Album Rombongan</span>
                    <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-teal-500/20 text-teal-300 border border-teal-500/30">
                        {{ $documentations->total() }} Album
                    </span>
                </h3>
                <p class="text-xs text-slate-400">Pilih kotak album di bawah untuk melihat seluruh foto dan video dari rombongan tersebut.</p>
            </div>

            {{-- Filter Pills --}}
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <a href="{{ route('gallery.index') }}" 
                   class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all {{ !request('destination') ? 'bg-aw-gold text-slate-950 font-bold shadow-md' : 'bg-slate-800/80 text-slate-300 hover:bg-slate-700 hover:text-white border border-white/10' }}">
                    Semua Destinasi
                </a>

                @foreach($destinations as $dest)
                    <a href="{{ route('gallery.index', ['destination' => $dest->slug]) }}" 
                       class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition-all {{ request('destination') === $dest->slug ? 'bg-aw-gold text-slate-950 font-bold shadow-md' : 'bg-slate-800/80 text-slate-300 hover:bg-slate-700 hover:text-white border border-white/10' }}">
                        {{ $dest->name }}
                        @if($dest->documentations_count > 0)
                            <span class="opacity-70 text-[10px]">({{ $dest->documentations_count }})</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        {{-- ========================================================================= --}}
        {{-- 3. GRID KOTAK ALBUM DOKUMENTASI (MULTI-PHOTO & VIDEO CARDS) --}}
        {{-- ========================================================================= --}}
        @if($documentations->isEmpty())
            <div class="rounded-3xl bg-slate-900/50 border border-white/10 p-16 text-center space-y-4 max-w-lg mx-auto">
                <div class="w-16 h-16 rounded-2xl bg-slate-800 text-teal-300 flex items-center justify-center text-3xl mx-auto shadow-inner">
                    📷
                </div>
                <h4 class="text-white font-bold text-lg">Belum Ada Dokumentasi untuk Kategori Ini</h4>
                <p class="text-xs text-slate-400">Pilih filter destinasi lain atau kembali ke seluruh koleksi galeri.</p>
                <div class="pt-2">
                    <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-aw-gold text-slate-950 text-xs font-bold rounded-xl hover:bg-aw-gold/90 transition-all">
                        Tampilkan Semua Dokumentasi
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($documentations as $doc)
                    @php
                        // Hitung jumlah foto & video di dalam album
                        $allMedia = $doc->media;
                        
                        // Jika media relasi belum ada di database, gunakan cover image sebagai fallback
                        if ($allMedia->isEmpty()) {
                            $mediaItems = collect([[
                                'id' => 0,
                                'type' => 'image',
                                'url' => $doc->image_url,
                                'caption' => 'Foto Dokumentasi ' . $doc->title,
                                'is_youtube' => false,
                                'youtube_embed' => null,
                            ]]);
                        } else {
                            $mediaItems = $allMedia->map(function($m) {
                                return [
                                    'id' => $m->id,
                                    'type' => $m->type,
                                    'url' => $m->url,
                                    'caption' => $m->caption,
                                    'is_youtube' => $m->is_youtube,
                                    'youtube_embed' => $m->youtube_embed_url,
                                ];
                            });
                        }

                        $photoCount = $allMedia->where('type', 'image')->count();
                        if ($photoCount === 0) { $photoCount = 1; }
                        $videoCount = $allMedia->where('type', 'video')->count();
                        $totalMediaCount = $mediaItems->count();
                        
                        // Siapkan payload JSON untuk dibuka di modal viewer
                        $albumPayload = [
                            'id' => $doc->id,
                            'title' => $doc->title,
                            'description' => $doc->description,
                            'badge_text' => $doc->badge_text,
                            'destination' => $doc->destination ? $doc->destination->name : null,
                            'trip_date' => $doc->trip_date ? $doc->trip_date->format('d M Y') : null,
                            'participant_count' => $doc->participant_count,
                            'media' => $mediaItems->values(),
                        ];
                    @endphp

                    {{-- KOTAK ALBUM ROMBONGAN --}}
                    <article class="relative flex flex-col justify-between rounded-3xl bg-slate-900/60 backdrop-blur-xl border border-white/10 hover:border-teal-400/50 hover:shadow-[0_15px_45px_rgba(20,184,166,0.15)] transition-all duration-300 group overflow-hidden">
                        
                        {{-- STACKED EFFECT VISUAL ACCENT (Menandakan banyak foto di dalam kotak) --}}
                        <div class="absolute -top-1.5 inset-x-4 h-2 bg-slate-800/40 rounded-t-2xl -z-10 group-hover:-top-2.5 transition-all duration-300"></div>

                        <div>
                            {{-- 1. MAIN COVER PREVIEW --}}
                            <div class="relative aspect-[16/10] bg-slate-950 overflow-hidden cursor-pointer"
                                 @click="openModal({{ json_encode($albumPayload) }}, 0)">
                                
                                <img src="{{ $doc->image_url }}" 
                                     alt="{{ $doc->title }}" 
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                                
                                {{-- Dark Overlay Gradient --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-black/30 pointer-events-none"></div>

                                {{-- TOP BADGE: JUMLAH MEMORI DALAM KOTAK --}}
                                <div class="absolute top-3 right-3 pointer-events-none">
                                    <span class="px-2.5 py-1 rounded-full bg-slate-950/90 text-teal-300 font-extrabold text-[11px] border border-teal-400/50 backdrop-blur-md shadow-lg flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <span>{{ $photoCount }} Foto</span>
                                        @if($videoCount > 0)
                                            <span class="text-amber-300 flex items-center gap-1">
                                                ·
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                                {{ $videoCount }} Video
                                            </span>
                                        @endif
                                    </span>
                                </div>

                                {{-- HOVER OVERLAY PROMPT --}}
                                <div class="absolute inset-0 bg-teal-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                                    <div class="px-4 py-2 rounded-xl bg-slate-950/90 border border-teal-400/60 text-teal-300 text-xs font-bold tracking-wide shadow-2xl flex items-center gap-2 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                        <span>🔍 Klik untuk Buka {{ $totalMediaCount }} Memori</span>
                                    </div>
                                </div>

                                {{-- BOTTOM DESTINATION CHIP --}}
                                @if($doc->destination)
                                    <div class="absolute bottom-3 left-3 pointer-events-none">
                                        <span class="px-2.5 py-1 rounded-lg bg-black/75 text-white font-semibold text-[10px] border border-white/15 backdrop-blur-md flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ $doc->destination->name }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- 2. MINI THUMBNAIL STRIP PREVIEW (Teaser foto-foto lain di dalam kotak) --}}
                            <div class="p-3 bg-slate-950/80 border-b border-white/10 flex items-center gap-2">
                                <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400 shrink-0">
                                    Preview:
                                </span>

                                <div class="flex items-center gap-1.5 overflow-hidden flex-1">
                                    @foreach($mediaItems->take(4) as $idx => $previewItem)
                                        <button type="button" 
                                                @click.stop="openModal({{ json_encode($albumPayload) }}, {{ $idx }})"
                                                class="relative w-12 h-9 rounded-lg overflow-hidden border border-white/15 hover:border-teal-400 transition-all shrink-0 group/thumb"
                                                title="{{ $previewItem['caption'] ?: 'Foto ' . ($idx+1) }}">
                                            @if($previewItem['type'] === 'image')
                                                <img src="{{ $previewItem['url'] }}" alt="thumb" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-slate-800 flex items-center justify-center text-[10px] text-amber-300">
                                                    ▶
                                                </div>
                                            @endif

                                            {{-- Last Thumbnail Counter Overlay if more than 4 items --}}
                                            @if($idx === 3 && $totalMediaCount > 4)
                                                <div class="absolute inset-0 bg-black/75 flex items-center justify-center text-teal-300 font-extrabold text-[10px]">
                                                    +{{ $totalMediaCount - 3 }}
                                                </div>
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            {{-- 3. CARD BODY (INFO ROMBONGAN) - SIMPLIFIED --}}
                            <div class="p-5 space-y-2">
                                @if($doc->badge_text || $doc->participant_count)
                                    <div class="flex items-center gap-2 flex-wrap">
                                        @if($doc->badge_text)
                                            <span class="px-2.5 py-0.5 rounded-full bg-teal-500/20 text-teal-300 border border-teal-500/30 text-[10px] font-bold">
                                                {{ $doc->badge_text }}
                                            </span>
                                        @endif
                                        @if($doc->participant_count)
                                            <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-slate-300 border border-slate-700 text-[10px] font-semibold">
                                                {{ $doc->participant_count }} Pax
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                <h3 class="font-display font-bold text-white text-base leading-snug group-hover:text-teal-300 transition-colors line-clamp-2"
                                    title="{{ $doc->title }}">
                                    {{ $doc->title }}
                                </h3>
                            </div>
                        </div>

                        {{-- 4. CARD FOOTER CALL-TO-ACTION --}}
                        <div class="p-4 bg-slate-900/90 border-t border-white/10">
                            <button type="button" 
                                    @click="openModal({{ json_encode($albumPayload) }}, 0)"
                                    class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-teal-500/20 to-teal-400/10 hover:from-teal-500 hover:to-teal-400 hover:text-slate-950 border border-teal-500/30 text-teal-300 font-bold text-xs text-center transition-all duration-300 flex items-center justify-center gap-2 shadow-sm">
                                <span>Lihat Foto/Video →</span>
                            </button>
                        </div>

                    </article>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="mt-12 flex justify-center">
                {{ $documentations->links() }}
            </div>
        @endif

    </div>

    {{-- ========================================================================= --}}
    {{-- 4. INTERACTIVE MULTI-MEDIA CAROUSEL & LIGHTBOX MODAL (VIEWER) --}}
    {{-- ========================================================================= --}}
    <div x-show="modalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-2 sm:p-4 md:p-6 bg-black/90 backdrop-blur-xl transition-all"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        {{-- Backdrop Click to Close --}}
        <div class="absolute inset-0" @click="closeModal()"></div>

        {{-- MODAL CONTAINER --}}
        <div class="relative z-10 w-full max-w-5xl bg-slate-950/95 border border-white/20 rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[95vh]"
             @click.stop>
            
            {{-- MODAL TOP HEADER --}}
            <div class="flex items-center justify-between p-4 sm:p-5 border-b border-white/10 bg-slate-900/90 gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-teal-500/20 text-teal-300 border border-teal-500/40"
                              x-text="currentDoc ? currentDoc.badge_text || 'Dokumentasi Rombongan' : ''"></span>
                        
                        <template x-if="currentDoc && currentDoc.destination">
                            <span class="text-xs text-slate-400 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span x-text="currentDoc.destination"></span>
                            </span>
                        </template>

                        <template x-if="currentDoc && currentDoc.trip_date">
                            <span class="text-xs text-slate-400" x-text="'· 📅 ' + currentDoc.trip_date"></span>
                        </template>
                    </div>

                    <h3 class="text-sm sm:text-base font-bold text-white truncate mt-1" 
                        x-text="currentDoc ? currentDoc.title : ''"></h3>
                </div>

                {{-- Counter & Close Button --}}
                <div class="flex items-center gap-3 shrink-0">
                    <span class="px-3 py-1 rounded-full bg-slate-800 text-teal-300 text-xs font-mono font-bold border border-white/10">
                        <span x-text="(currentIndex + 1)"></span> / <span x-text="mediaList.length"></span>
                    </span>

                    <button type="button" 
                            @click="closeModal()" 
                            class="w-9 h-9 rounded-full bg-white/10 hover:bg-rose-500 hover:text-white text-slate-300 flex items-center justify-center transition-all"
                            title="Tutup (ESC)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            {{-- MODAL MAIN VIEWER STAGE (IMAGE OR VIDEO) --}}
            <div class="relative flex-1 bg-black flex items-center justify-center overflow-hidden min-h-[320px] sm:min-h-[460px]">
                
                {{-- PREVIOUS BUTTON --}}
                <button type="button" 
                        @click="prevMedia()" 
                        x-show="mediaList.length > 1"
                        class="absolute left-3 sm:left-5 z-20 w-11 h-11 rounded-full bg-slate-900/80 hover:bg-teal-500 hover:text-slate-950 text-white border border-white/20 flex items-center justify-center backdrop-blur-md transition-all shadow-xl text-lg font-bold"
                        title="Sebelumnya (Panah Kiri)">
                    ‹
                </button>

                {{-- NEXT BUTTON --}}
                <button type="button" 
                        @click="nextMedia()" 
                        x-show="mediaList.length > 1"
                        class="absolute right-3 sm:right-5 z-20 w-11 h-11 rounded-full bg-slate-900/80 hover:bg-teal-500 hover:text-slate-950 text-white border border-white/20 flex items-center justify-center backdrop-blur-md transition-all shadow-xl text-lg font-bold"
                        title="Berikutnya (Panah Kanan)">
                    ›
                </button>

                {{-- ACTIVE MEDIA DISPLAY --}}
                <template x-if="currentMedia && currentMedia.type === 'image'">
                    <div class="w-full h-full flex flex-col items-center justify-center p-2 sm:p-4">
                        <img :src="currentMedia.url" 
                             :alt="currentMedia.caption" 
                             class="max-h-[55vh] sm:max-h-[64vh] w-auto max-w-full object-contain rounded-xl shadow-2xl transition-all">
                        
                        {{-- Caption Overlay --}}
                        <template x-if="currentMedia.caption">
                            <p class="mt-2.5 px-4 py-1.5 rounded-full bg-slate-900/80 border border-white/10 text-xs text-slate-200 text-center max-w-xl backdrop-blur-sm shadow"
                               x-text="currentMedia.caption"></p>
                        </template>
                    </div>
                </template>

                <template x-if="currentMedia && currentMedia.type === 'video'">
                    <div class="w-full h-full flex flex-col items-center justify-center p-2 sm:p-6 max-w-4xl">
                        <template x-if="currentMedia.is_youtube">
                            <div class="w-full aspect-video rounded-2xl overflow-hidden shadow-2xl border border-white/20 bg-slate-950">
                                <iframe :src="currentMedia.youtube_embed" 
                                        class="w-full h-full" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                            </div>
                        </template>

                        <template x-if="!currentMedia.is_youtube">
                            <video :src="currentMedia.url" 
                                   controls 
                                   autoplay 
                                   class="max-h-[55vh] max-w-full rounded-2xl shadow-2xl border border-white/20"></video>
                        </template>

                        {{-- Caption Overlay --}}
                        <template x-if="currentMedia.caption">
                            <p class="mt-2.5 px-4 py-1.5 rounded-full bg-slate-900/80 border border-white/10 text-xs text-amber-300 text-center max-w-xl backdrop-blur-sm shadow flex items-center gap-1.5 justify-center">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span x-text="currentMedia.caption"></span>
                            </p>
                        </template>
                    </div>
                </template>

            </div>

            {{-- BOTTOM THUMBNAILS CAROUSEL FILMSTRIP --}}
            <div class="p-3 bg-slate-950 border-t border-white/10">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-thin scrollbar-thumb-slate-700">
                    <template x-for="(item, idx) in mediaList" :key="idx">
                        <button type="button" 
                                @click="selectMedia(idx)"
                                :class="currentIndex === idx ? 'border-aw-gold ring-2 ring-aw-gold/60 scale-105 shadow-lg' : 'border-white/15 opacity-60 hover:opacity-100'"
                                class="relative w-16 h-12 rounded-lg overflow-hidden border shrink-0 transition-all bg-slate-900">
                            
                            <template x-if="item.type === 'image'">
                                <img :src="item.url" :alt="item.caption" class="w-full h-full object-cover">
                            </template>

                            <template x-if="item.type === 'video'">
                                <div class="w-full h-full bg-slate-900 flex items-center justify-center text-amber-300 text-xs">
                                    ▶
                                </div>
                            </template>

                            {{-- Active indicator tag --}}
                            <div x-show="currentIndex === idx" class="absolute bottom-0 inset-x-0 h-1 bg-aw-gold"></div>
                        </button>
                    </template>
                </div>
            </div>

            {{-- BOTTOM DRAWER: ALBUM STORY & WHATSAPP ACTION --}}
            <div class="p-4 sm:p-5 bg-slate-900/90 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-slate-300 max-w-2xl text-center sm:text-left">
                    <template x-if="currentDoc && currentDoc.description">
                        <p x-text="currentDoc.description" class="line-clamp-2"></p>
                    </template>
                    <template x-if="!currentDoc || !currentDoc.description">
                        <p>Dokumentasi resmi perjalanan wisata rombongan oleh AW Tour Operator Surabaya.</p>
                    </template>
                </div>

                {{-- WhatsApp Booking Inquiry Button --}}
                <a :href="'https://wa.me/6281234567890?text=' + encodeURIComponent('Halo Admin AW Tour, saya melihat dokumentasi rombongan: ' + (currentDoc ? currentDoc.title : '') + '. Saya tertarik untuk merencanakan trip serupa untuk rombongan kami.')" 
                   target="_blank" 
                   rel="noopener"
                   class="shrink-0 px-4 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs flex items-center gap-2 shadow-lg shadow-emerald-500/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span>Tanya Paket Seperti Ini via WA</span>
                </a>
            </div>

        </div>
    </div>

</section>

{{-- ========================================================================= --}}
{{-- 5. ALPINE.JS SCRIPT LOGIC FOR GALLERY CAROUSEL LIGHTBOX --}}
{{-- ========================================================================= --}}
<script>
function galleryViewer() {
    return {
        modalOpen: false,
        currentDoc: null,
        mediaList: [],
        currentIndex: 0,

        get currentMedia() {
            if (this.mediaList && this.mediaList.length > 0) {
                return this.mediaList[this.currentIndex] || null;
            }
            return null;
        },

        openModal(doc, initialIndex = 0) {
            this.currentDoc = doc;
            this.mediaList = doc.media || [];
            this.currentIndex = initialIndex >= 0 && initialIndex < this.mediaList.length ? initialIndex : 0;
            this.modalOpen = true;
            document.body.style.overflow = 'hidden';
        },

        closeModal() {
            this.modalOpen = false;
            this.currentDoc = null;
            this.mediaList = [];
            this.currentIndex = 0;
            document.body.style.overflow = 'auto';
        },

        selectMedia(index) {
            if (index >= 0 && index < this.mediaList.length) {
                this.currentIndex = index;
            }
        },

        nextMedia() {
            if (this.mediaList.length > 0) {
                this.currentIndex = (this.currentIndex + 1) % this.mediaList.length;
            }
        },

        prevMedia() {
            if (this.mediaList.length > 0) {
                this.currentIndex = (this.currentIndex - 1 + this.mediaList.length) % this.mediaList.length;
            }
        }
    };
}
</script>

@endsection
