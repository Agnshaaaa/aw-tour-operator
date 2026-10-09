@extends('layouts.admin')

@section('title', 'Dokumentasi & Galeri Foto — Admin Panel')
@section('page_title', 'Kelola Album Dokumentasi Foto & Video Rombongan')

@section('content')

{{-- TOP TOOLBAR --}}
<div class="bg-aw-navy/90 p-5 rounded-3xl border border-slate-800 shadow-xl space-y-4">
    <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
        
        {{-- Search & Filters --}}
        <form method="GET" action="{{ route('admin.gallery.index') }}" class="flex flex-wrap items-center gap-2 flex-1">
            {{-- Search input --}}
            <div class="relative w-full sm:w-60">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari judul / rombongan..." 
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs py-2 px-3.5 pr-8 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
                @if(request('search'))
                    <a href="{{ route('admin.gallery.index', request()->except('search')) }}" 
                       class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white text-xs">✕</a>
                @endif
            </div>

            {{-- Destination Filter --}}
            <select name="destination_id" onchange="this.form.submit()" 
                    class="rounded-xl bg-slate-900 border-slate-700 text-xs py-2 px-3 text-slate-300 focus:border-aw-gold focus:ring-aw-gold">
                <option value="">Semua Destinasi</option>
                @foreach($destinations as $dest)
                    <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>
                        {{ $dest->name }}
                    </option>
                @endforeach
            </select>

            {{-- Featured Filter --}}
            <select name="featured" onchange="this.form.submit()" 
                    class="rounded-xl bg-slate-900 border-slate-700 text-xs py-2 px-3 text-slate-300 focus:border-aw-gold focus:ring-aw-gold">
                <option value="">Semua Status</option>
                <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Featured Saja (Hero Preview)</option>
            </select>

            <button type="submit" class="px-3.5 py-2 bg-slate-800 text-slate-200 text-xs font-semibold rounded-xl hover:bg-slate-700 transition-colors">
                Filter
            </button>
        </form>

        {{-- Add New Button --}}
        <a href="{{ route('admin.gallery.create') }}" 
           class="px-4 py-2.5 bg-aw-gold text-slate-950 font-bold text-xs rounded-xl hover:bg-aw-gold/90 transition-all shadow-md flex items-center justify-center gap-2 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>+ Buat Album Dokumentasi Baru</span>
        </a>

    </div>
</div>

{{-- GALLERY GRID CARDS --}}
@if($documentations->isEmpty())
    <div class="bg-aw-navy/60 rounded-3xl p-12 border border-slate-800 text-center space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-slate-800 text-slate-400 flex items-center justify-center mx-auto text-xl">
            📷
        </div>
        <h3 class="text-white font-bold text-base">Belum Ada Album Dokumentasi</h3>
        <p class="text-xs text-slate-400 max-w-sm mx-auto">
            Buat album dokumentasi perjalanan rombongan dengan banyak foto dan video untuk ditampilkan di website publik.
        </p>
        <div class="pt-2">
            <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-aw-gold text-slate-950 text-xs font-bold rounded-xl hover:bg-aw-gold/90">
                + Buat Album Pertama
            </a>
        </div>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" x-data="{
        previewModal: false,
        activeDoc: null,
        openModal(doc) {
            this.activeDoc = doc;
            this.previewModal = true;
        }
    }">
        @foreach($documentations as $doc)
            @php
                $photoCount = $doc->media->where('type', 'image')->count();
                $videoCount = $doc->media->where('type', 'video')->count();
            @endphp
            <div class="bg-aw-navy/80 rounded-2xl border border-slate-800 overflow-hidden shadow-lg hover:border-slate-700 transition-all flex flex-col justify-between group">
                <div>
                    {{-- Thumbnail with Badges --}}
                    <div class="relative aspect-[4/3] bg-slate-950 overflow-hidden cursor-pointer"
                         @click="openModal({{ json_encode([
                             'title' => $doc->title,
                             'description' => $doc->description,
                             'badge_text' => $doc->badge_text,
                             'destination' => $doc->destination ? $doc->destination->name : null,
                             'trip_date' => $doc->trip_date ? $doc->trip_date->format('d M Y') : null,
                             'participant_count' => $doc->participant_count,
                             'media' => $doc->media->map(function($m) {
                                 return [
                                     'id' => $m->id,
                                     'type' => $m->type,
                                     'url' => $m->url,
                                     'caption' => $m->caption,
                                     'is_youtube' => $m->is_youtube,
                                     'youtube_embed' => $m->youtube_embed_url,
                                 ];
                             })
                         ]) }})">
                        
                        <img src="{{ $doc->image_url }}" 
                             alt="{{ $doc->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        
                        {{-- Top Badges --}}
                        <div class="absolute top-2.5 inset-x-2.5 flex items-center justify-between gap-2 pointer-events-none">
                            @if($doc->is_featured)
                                <span class="px-2 py-0.5 rounded-md bg-amber-500/90 text-slate-950 font-bold text-[10px] tracking-wide shadow backdrop-blur-sm">
                                    ⭐ Hero Featured
                                </span>
                            @else
                                <span></span>
                            @endif

                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold shadow backdrop-blur-sm {{ $doc->is_active ? 'bg-emerald-500/80 text-white' : 'bg-slate-700/80 text-slate-300' }}">
                                {{ $doc->is_active ? 'Aktif' : 'Draft' }}
                            </span>
                        </div>

                        {{-- Multi-Media Count Pill --}}
                        <div class="absolute bottom-2.5 right-2.5">
                            <span class="px-2.5 py-1 rounded-full bg-slate-950/85 text-teal-300 font-bold text-[10px] border border-teal-400/30 backdrop-blur-md shadow flex items-center gap-1.5">
                                <span>📸 {{ max(1, $photoCount) }} Foto</span>
                                @if($videoCount > 0)
                                    <span>· 🎥 {{ $videoCount }} Video</span>
                                @endif
                            </span>
                        </div>

                        {{-- Destinasi Pill --}}
                        @if($doc->destination)
                            <div class="absolute bottom-2.5 left-2.5">
                                <span class="px-2 py-0.5 rounded-md bg-slate-950/80 text-white font-semibold text-[10px] border border-white/10 backdrop-blur-sm">
                                    📍 {{ $doc->destination->name }}
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Card Info --}}
                    <div class="p-4 space-y-2">
                        <h4 class="font-bold text-white text-sm line-clamp-1 group-hover:text-aw-gold transition-colors" title="{{ $doc->title }}">
                            {{ $doc->title }}
                        </h4>

                        @if($doc->badge_text)
                            <p class="text-[11px] font-medium text-emerald-400 line-clamp-1">
                                🏷️ {{ $doc->badge_text }}
                            </p>
                        @endif

                        @if($doc->description)
                            <p class="text-xs text-slate-400 line-clamp-2 leading-relaxed">
                                {{ $doc->description }}
                            </p>
                        @endif

                        <div class="flex items-center gap-3 pt-1 text-[11px] text-slate-400 border-t border-slate-800">
                            @if($doc->trip_date)
                                <span>📅 {{ $doc->trip_date->format('d M Y') }}</span>
                            @endif
                            @if($doc->participant_count)
                                <span>👥 {{ $doc->participant_count }} Pax</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="p-3 bg-slate-900/60 border-t border-slate-800 flex items-center justify-between gap-2">
                    <a href="{{ route('admin.gallery.edit', $doc->id) }}" 
                       class="flex-1 py-1.5 px-3 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold text-center transition-colors">
                        Kelola Album ({{ max(1, $photoCount + $videoCount) }})
                    </a>

                    <form action="{{ route('admin.gallery.destroy', $doc->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus seluruh album dokumentasi ini beserta semua foto & videonya?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="py-1.5 px-3 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 text-xs font-semibold transition-colors"
                                title="Hapus album">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- LIGHTBOX MODAL PREVIEW IN ADMIN --}}
        <div x-show="previewModal" 
             x-cloak 
             @keydown.escape.window="previewModal = false"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md">
            
            <div class="absolute inset-0" @click="previewModal = false"></div>

            <div class="relative z-10 max-w-4xl w-full bg-slate-900 border border-white/20 rounded-3xl p-6 shadow-2xl text-white space-y-4 max-h-[90vh] overflow-y-auto"
                 @click.stop>
                
                <div class="flex items-center justify-between border-b border-white/10 pb-3">
                    <div>
                        <span class="text-xs text-teal-300 font-bold uppercase tracking-wider" x-text="activeDoc ? activeDoc.badge_text : ''"></span>
                        <h3 class="text-lg font-bold text-white" x-text="activeDoc ? activeDoc.title : ''"></h3>
                    </div>
                    <button @click="previewModal = false" class="w-8 h-8 rounded-full bg-white/10 text-slate-300 hover:text-white flex items-center justify-center">✕</button>
                </div>

                {{-- Media Grid in Modal --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-2">
                    <template x-for="media in (activeDoc ? activeDoc.media : [])" :key="media.id">
                        <div class="rounded-xl overflow-hidden bg-slate-950 border border-white/10 aspect-video relative group">
                            <template x-if="media.type === 'image'">
                                <img :src="media.url" :alt="media.caption" class="w-full h-full object-cover">
                            </template>
                            <template x-if="media.type === 'video'">
                                <div class="w-full h-full flex flex-col items-center justify-center bg-slate-950 p-2 text-center">
                                    <template x-if="media.is_youtube">
                                        <iframe :src="media.youtube_embed" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                                    </template>
                                    <template x-if="!media.is_youtube">
                                        <video :src="media.url" controls class="w-full h-full object-cover"></video>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>

            </div>
        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $documentations->links() }}
    </div>
@endif

@endsection
