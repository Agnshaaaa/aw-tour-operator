@extends('layouts.app')

@section('title', 'Dokumentasi & Galeri Rombongan Tour — AW Tour Operator')
@section('meta_description', 'Koleksi dokumentasi foto dan video perjalanan rombongan corporate gathering, studi tour kampus, dan family gathering yang dipercayakan kepada AW Tour Operator Surabaya.')

@section('content')

{{-- ========================================================================= --}}
{{-- 1. CINEMATIC HERO HEADER SECTION (Altesa Dark Warm Luxury) --}}
{{-- ========================================================================= --}}
<section class="relative isolate overflow-hidden bg-[#18181B] text-white pt-28 pb-20 sm:pt-36 sm:pb-24 lg:pt-40 lg:pb-28 border-b border-white/10">
    {{-- Glow Accents & Decorative Backdrops --}}
    <div class="absolute inset-0 -z-10 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -left-40 w-96 h-96 rounded-full bg-aw-gold/15 blur-3xl"></div>
        <div class="absolute top-1/2 -right-40 w-96 h-96 rounded-full bg-aw-gold/10 blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-aw-gold transition-colors">Beranda</a>
            <span>/</span>
            <span class="text-aw-gold">Dokumentasi &amp; Galeri Rombongan</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8 space-y-5">
                {{-- Super Badge --}}
                <div class="badge-altesa-dark">
                    <span class="w-2 h-2 rounded-full bg-aw-gold animate-pulse"></span>
                    <span>Portofolio &amp; Dokumentasi Perjalanan Nyata</span>
                </div>

                <h1 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl tracking-tight text-white leading-tight">
                    Setiap Rombongan Memiliki <br class="hidden sm:inline">
                    <span class="text-aw-gold italic">
                        Kenangan &amp; Cerita Terbaik
                    </span>
                </h1>

                <p class="text-slate-300 text-sm sm:text-base max-w-2xl leading-relaxed">
                    Lihat koleksi foto dan video asli perjalanan rombongan korporat, instansi BUMN, kampus terkemuka (UNAIR, ITS, UNESA), dan komunitas keluarga yang telah menjelajahi berbagai destinasi bersama AW Tour Operator Surabaya.
                </p>

                {{-- Fast Proof Stats Pills --}}
                <div class="pt-2 flex flex-wrap items-center gap-4 text-xs font-bold text-slate-200">
                    <div class="flex items-center gap-2 bg-white/10 border border-white/15 px-4 py-2 rounded-full backdrop-blur-md">
                        <span class="text-aw-gold font-display text-base">50+</span>
                        <span class="text-slate-300">Rombongan Sukses</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 border border-white/15 px-4 py-2 rounded-full backdrop-blur-md">
                        <span class="text-aw-gold font-display text-base">{{ number_format($totalPax, 0, ',', '.') }}+</span>
                        <span class="text-slate-300">Peserta Terlayani</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 border border-white/15 px-4 py-2 rounded-full backdrop-blur-md">
                        <span class="text-emerald-400 font-display text-base">100%</span>
                        <span class="text-slate-300">Dokumentasi Nyata</span>
                    </div>
                </div>
            </div>

            {{-- Quick Hero Card / Quotation Teaser --}}
            <div class="lg:col-span-4">
                <div class="rounded-3xl bg-white/10 border border-white/20 p-6 backdrop-blur-xl shadow-2xl space-y-4 text-center lg:text-left">
                    <div class="w-12 h-12 rounded-2xl bg-aw-gold/20 text-aw-gold flex items-center justify-center text-2xl mx-auto lg:mx-0 shadow-inner">
                        🚌
                    </div>
                    <div>
                        <h2 class="text-white font-display font-bold text-base">Rencanakan Rombongan Anda</h2>
                        <p class="text-xs text-slate-300 mt-1 leading-relaxed">Dapatkan estimasi biaya transparan dan armada terbaik sesuai kebutuhan grup Anda.</p>
                    </div>
                    <a href="{{ route('quotation.create') }}" 
                       class="block w-full py-3 px-4 rounded-full bg-aw-gold hover:bg-aw-gold-600 text-aw-navy font-bold text-xs uppercase tracking-wider text-center shadow-lg shadow-aw-gold/20 transition-all">
                        Hitung Biaya Rombongan →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================================= --}}
{{-- 2. GALLERY INTERACTIVE SHOWCASE SECTION (ALPINE CONTROLLER) --}}
{{-- ========================================================================= --}}
<section class="py-16 bg-[#FCFAF7] text-slate-900 min-h-screen relative" 
         x-data="galleryViewer()"
         @keydown.escape.window="closeModal()"
         @keydown.arrow-right.window="if(modalOpen) nextMedia()"
         @keydown.arrow-left.window="if(modalOpen) prevMedia()">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

        {{-- FILTER BAR DESTINASI --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 border-b border-[#F5F0E8] pb-6">
            <div>
                <h3 class="text-xl font-display font-bold text-aw-navy flex items-center gap-2">
                    <span>Arsip Album Rombongan</span>
                    <span class="badge-altesa-peach text-[10px]">
                        {{ $documentations->total() }} Album
                    </span>
                </h3>
                <p class="text-xs text-slate-500 mt-1">Pilih kotak album di bawah untuk melihat seluruh foto dan video dari rombongan tersebut.</p>
            </div>

            {{-- Filter Pills --}}
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <a href="{{ route('gallery.index') }}" 
                   class="px-4 py-2 rounded-full text-xs font-bold transition-all {{ !request('destination') ? 'bg-[#18181B] text-aw-gold shadow-md' : 'bg-white text-slate-700 border border-gray-200 hover:border-aw-gold' }}">
                    Semua Destinasi
                </a>

                @foreach($destinations as $dest)
                    <a href="{{ route('gallery.index', ['destination' => $dest->slug]) }}" 
                       class="px-4 py-2 rounded-full text-xs font-bold transition-all {{ request('destination') === $dest->slug ? 'bg-[#18181B] text-aw-gold shadow-md' : 'bg-white text-slate-700 border border-gray-200 hover:border-aw-gold' }}">
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
            <div class="card-altesa p-16 text-center space-y-4 max-w-lg mx-auto">
                <div class="w-16 h-16 rounded-2xl bg-aw-gold/20 text-aw-navy flex items-center justify-center text-3xl mx-auto shadow-inner">
                    📷
                </div>
                <h4 class="font-display font-bold text-xl text-aw-navy">Belum Ada Dokumentasi untuk Kategori Ini</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Pilih filter destinasi lain atau kembali ke seluruh koleksi galeri.</p>
                <div class="pt-2">
                    <a href="{{ route('gallery.index') }}" class="btn-altesa-primary !text-xs !py-2.5 !px-5">
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
                    <article class="card-altesa overflow-hidden flex flex-col justify-between group">
                        
                        <div>
                            {{-- 1. MAIN COVER PREVIEW --}}
                            <div class="relative aspect-[16/10] bg-slate-900 overflow-hidden cursor-pointer"
                                 @click="openModal({{ json_encode($albumPayload) }}, 0)">
                                
                                <img src="{{ $doc->image_url }}" 
                                     alt="{{ $doc->title }}" 
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                                
                                {{-- Dark Overlay Gradient --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[#18181B]/85 via-transparent to-black/20 pointer-events-none"></div>

                                {{-- TOP BADGES --}}
                                <div class="absolute top-3 inset-x-3 flex items-center justify-between gap-2 pointer-events-none">
                                    {{-- Left Badge --}}
                                    @if($doc->badge_text)
                                        <span class="px-2.5 py-1 rounded-full bg-black/75 text-aw-gold font-bold text-[10px] tracking-wide border border-aw-gold/30 backdrop-blur-md shadow flex items-center gap-1">
                                            <span>⭐</span>
                                            <span class="truncate max-w-[150px]">{{ $doc->badge_text }}</span>
                                        </span>
                                    @else
                                        <span></span>
                                    @endif

                                    {{-- Right Badge: JUMLAH MEMORI DALAM KOTAK --}}
                                    <span class="px-2.5 py-1 rounded-full bg-black/80 text-white font-bold text-[10px] border border-white/20 backdrop-blur-md shadow-lg flex items-center gap-1">
                                        <span>📸 {{ $photoCount }} Foto</span>
                                        @if($videoCount > 0)
                                            <span class="text-aw-gold">· 🎥 {{ $videoCount }} Video</span>
                                        @endif
                                    </span>
                                </div>

                                {{-- HOVER OVERLAY PROMPT --}}
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center pointer-events-none">
                                    <div class="px-4 py-2 rounded-full bg-[#18181B]/90 border border-aw-gold/50 text-aw-gold text-xs font-bold tracking-wide shadow-2xl flex items-center gap-2 transform translate-y-2 group-hover:translate-y-0 transition-transform">
                                        <span>🔍 Klik untuk Buka {{ $totalMediaCount }} Memori</span>
                                    </div>
                                </div>

                                {{-- BOTTOM DESTINATION CHIP --}}
                                @if($doc->destination)
                                    <div class="absolute bottom-3 left-3 pointer-events-none">
                                        <span class="px-2.5 py-1 rounded-full bg-black/75 text-white font-semibold text-[10px] border border-white/15 backdrop-blur-md">
                                            📍 {{ $doc->destination->name }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- 2. MINI THUMBNAIL STRIP PREVIEW --}}
                            <div class="p-3 bg-[#FCFAF7] border-b border-[#F5F0E8] flex items-center gap-2">
                                <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400 shrink-0">
                                    Preview:
                                </span>

                                <div class="flex items-center gap-1.5 overflow-hidden flex-1">
                                    @foreach($mediaItems->take(4) as $idx => $previewItem)
                                        <button type="button" 
                                                @click.stop="openModal({{ json_encode($albumPayload) }}, {{ $idx }})"
                                                class="relative w-12 h-9 rounded-lg overflow-hidden border border-gray-200 hover:border-aw-gold transition-all shrink-0"
                                                title="{{ $previewItem['caption'] ?: 'Foto ' . ($idx+1) }}">
                                            @if($previewItem['type'] === 'image')
                                                <img src="{{ $previewItem['url'] }}" alt="thumb" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-[#18181B] flex items-center justify-center text-[10px] text-aw-gold">
                                                    ▶
                                                </div>
                                            @endif

                                            {{-- Last Thumbnail Counter Overlay if more than 4 items --}}
                                            @if($idx === 3 && $totalMediaCount > 4)
                                                <div class="absolute inset-0 bg-black/75 flex items-center justify-center text-aw-gold font-extrabold text-[10px]">
                                                    +{{ $totalMediaCount - 3 }}
                                                </div>
                                            @endif
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            {{-- 3. CARD BODY (INFO ROMBONGAN) --}}
                            <div class="p-5 space-y-3">
                                <h3 class="font-display font-bold text-aw-navy text-lg leading-snug group-hover:text-aw-gold transition-colors line-clamp-2"
                                    title="{{ $doc->title }}">
                                    {{ $doc->title }}
                                </h3>

                                @if($doc->description)
                                    <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                                        {{ $doc->description }}
                                    </p>
                                @endif

                                {{-- Meta Badges: Tanggal & Pax --}}
                                <div class="pt-3 flex items-center gap-4 text-xs text-slate-500 border-t border-[#F5F0E8]">
                                    @if($doc->trip_date)
                                        <span class="flex items-center gap-1">
                                            <span>📅</span>
                                            <span>{{ $doc->trip_date->format('d M Y') }}</span>
                                        </span>
                                    @endif
                                    @if($doc->participant_count)
                                        <span class="flex items-center gap-1 font-semibold text-aw-gold-700">
                                            <span>👥</span>
                                            <span>{{ $doc->participant_count }} Pax</span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- 4. CARD FOOTER CALL-TO-ACTION --}}
                        <div class="p-5 pt-0">
                            <button type="button" 
                                    @click="openModal({{ json_encode($albumPayload) }}, 0)"
                                    class="w-full btn-altesa-dark !py-2.5 !text-xs">
                                <span>Lihat Semua {{ $totalMediaCount }} Foto &amp; Video</span>
                                <span>→</span>
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
        <div class="relative z-10 w-full max-w-5xl bg-[#18181B] border border-white/20 rounded-3xl shadow-2xl overflow-hidden flex flex-col max-h-[95vh]"
             @click.stop>
            
            {{-- MODAL TOP HEADER --}}
            <div class="flex items-center justify-between p-4 sm:p-5 border-b border-white/10 bg-[#18181B] gap-4">
                <div class="min-w-0">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-aw-gold/20 text-aw-gold border border-aw-gold/40"
                              x-text="currentDoc ? currentDoc.badge_text || 'Dokumentasi Rombongan' : ''"></span>
                        
                        <template x-if="currentDoc && currentDoc.destination">
                            <span class="text-xs text-slate-300" x-text="'📍 ' + currentDoc.destination"></span>
                        </template>

                        <template x-if="currentDoc && currentDoc.trip_date">
                            <span class="text-xs text-slate-300" x-text="'· 📅 ' + currentDoc.trip_date"></span>
                        </template>
                    </div>

                    <h3 class="font-display text-sm sm:text-base font-bold text-white truncate mt-1" 
                        x-text="currentDoc ? currentDoc.title : ''"></h3>
                </div>

                {{-- Counter & Close Button --}}
                <div class="flex items-center gap-3 shrink-0">
                    <span class="px-3 py-1 rounded-full bg-white/10 text-aw-gold text-xs font-mono font-bold border border-white/10">
                        <span x-text="(currentIndex + 1)"></span> / <span x-text="mediaList.length"></span>
                    </span>

                    <button type="button" 
                            @click="closeModal()" 
                            class="w-9 h-9 rounded-full bg-white/10 hover:bg-rose-500 hover:text-white text-slate-300 flex items-center justify-center transition-all text-sm font-bold"
                            title="Tutup (ESC)">
                        ✕
                    </button>
                </div>
            </div>

            {{-- MODAL MAIN VIEWER STAGE (IMAGE OR VIDEO) --}}
            <div class="relative flex-1 bg-black flex items-center justify-center overflow-hidden min-h-[320px] sm:min-h-[460px]">
                
                {{-- PREVIOUS BUTTON --}}
                <button type="button" 
                        @click="prevMedia()" 
                        x-show="mediaList.length > 1"
                        class="absolute left-3 sm:left-5 z-20 w-11 h-11 rounded-full bg-[#18181B]/80 hover:bg-aw-gold hover:text-aw-navy text-white border border-white/20 flex items-center justify-center backdrop-blur-md transition-all shadow-xl text-lg font-bold"
                        title="Sebelumnya (Panah Kiri)">
                    ‹
                </button>

                {{-- NEXT BUTTON --}}
                <button type="button" 
                        @click="nextMedia()" 
                        x-show="mediaList.length > 1"
                        class="absolute right-3 sm:right-5 z-20 w-11 h-11 rounded-full bg-[#18181B]/80 hover:bg-aw-gold hover:text-aw-navy text-white border border-white/20 flex items-center justify-center backdrop-blur-md transition-all shadow-xl text-lg font-bold"
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
                            <p class="mt-2.5 px-4 py-1.5 rounded-full bg-[#18181B]/80 border border-white/10 text-xs text-slate-200 text-center max-w-xl backdrop-blur-sm shadow"
                               x-text="currentMedia.caption"></p>
                        </template>
                    </div>
                </template>

                <template x-if="currentMedia && currentMedia.type === 'video'">
                    <div class="w-full h-full flex flex-col items-center justify-center p-2 sm:p-6 max-w-4xl">
                        <template x-if="currentMedia.is_youtube">
                            <div class="w-full aspect-video rounded-2xl overflow-hidden shadow-2xl border border-white/20 bg-black">
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
                            <p class="mt-2.5 px-4 py-1.5 rounded-full bg-[#18181B]/80 border border-white/10 text-xs text-aw-gold text-center max-w-xl backdrop-blur-sm shadow"
                               x-text="'🎥 ' + currentMedia.caption"></p>
                        </template>
                    </div>
                </template>

            </div>

            {{-- BOTTOM THUMBNAILS CAROUSEL FILMSTRIP --}}
            <div class="p-3 bg-black border-t border-white/10">
                <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-thin">
                    <template x-for="(item, idx) in mediaList" :key="idx">
                        <button type="button" 
                                @click="selectMedia(idx)"
                                :class="currentIndex === idx ? 'border-aw-gold ring-2 ring-aw-gold/60 scale-105 shadow-lg' : 'border-white/15 opacity-60 hover:opacity-100'"
                                class="relative w-16 h-12 rounded-lg overflow-hidden border shrink-0 transition-all bg-slate-900">
                            
                            <template x-if="item.type === 'image'">
                                <img :src="item.url" :alt="item.caption" class="w-full h-full object-cover">
                            </template>

                            <template x-if="item.type === 'video'">
                                <div class="w-full h-full bg-slate-900 flex items-center justify-center text-aw-gold text-xs">
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
            <div class="p-4 sm:p-5 bg-[#18181B] border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-slate-300 max-w-2xl text-center sm:text-left">
                    <template x-if="currentDoc && currentDoc.description">
                        <p x-text="currentDoc.description" class="line-clamp-2"></p>
                    </template>
                    <template x-if="!currentDoc || !currentDoc.description">
                        <p>Dokumentasi resmi perjalanan wisata rombongan oleh AW Tour Operator Surabaya.</p>
                    </template>
                </div>

                {{-- WhatsApp Booking Inquiry Button --}}
                <a :href="'https://wa.me/{{ \App\Models\SiteSetting::current()->whatsapp_number }}?text=' + encodeURIComponent('Halo Admin AW Tour, saya melihat dokumentasi rombongan: ' + (currentDoc ? currentDoc.title : '') + '. Saya tertarik untuk merencanakan trip serupa untuk rombongan kami.')" 
                   target="_blank" 
                   rel="noopener"
                   class="shrink-0 btn-altesa-primary !text-xs !py-2.5 !px-5">
                    <span>💬 Tanya Paket Seperti Ini via WA</span>
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
