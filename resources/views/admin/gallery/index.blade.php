@extends('layouts.admin')

@section('title', 'Dokumentasi & Galeri Foto — Admin Panel')
@section('page_title', 'Kelola Album Dokumentasi Foto & Video Rombongan')

@section('content')

{{-- TOP TOOLBAR --}}
<div class="bg-[#0B0B0E]/90 p-5 rounded-3xl border border-white/[0.07] shadow-xl space-y-4">
    <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
        
        {{-- Search & Filters --}}
        <form method="GET" action="{{ route('admin.gallery.index') }}" class="flex flex-wrap items-center gap-2 flex-1">
            {{-- Search input --}}
            <div class="relative w-full sm:w-60">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari judul / rombongan..." 
                       class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                @if(request('search'))
                    <a href="{{ route('admin.gallery.index', request()->except('search')) }}" 
                       class="absolute right-2.5 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>

            {{-- Destination Filter --}}
            <select name="destination_id" onchange="this.form.submit()" 
                    class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                <option value="">Semua Destinasi</option>
                @foreach($destinations as $dest)
                    <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>
                        {{ $dest->name }}
                    </option>
                @endforeach
            </select>

            {{-- Featured Filter --}}
            <select name="featured" onchange="this.form.submit()" 
                    class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                <option value="">Semua Status</option>
                <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Featured Saja (Hero Preview)</option>
            </select>

            <button type="submit" class="px-3.5 py-2 bg-[#121215] text-zinc-200 text-xs font-semibold rounded-xl hover:bg-slate-700 transition-colors">
                Filter
            </button>
        </form>

        {{-- Add New Button --}}
        <a href="{{ route('admin.gallery.create') }}" 
           class="px-4 py-2.5 bg-aw-gold text-slate-950 font-bold text-xs rounded-xl hover:bg-aw-gold/90 transition-all shadow-md flex items-center justify-center gap-2 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Buat Album Dokumentasi Baru</span>
        </a>

    </div>
</div>

{{-- GALLERY GRID CARDS --}}
@if($documentations->isEmpty())
    <div class="bg-[#0B0B0E]/60 rounded-3xl p-12 border border-white/[0.07] text-center space-y-3">
        <div class="w-12 h-12 rounded-2xl bg-[#121215] text-zinc-400 flex items-center justify-center mx-auto">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3 class="text-white font-bold text-base">Belum Ada Album Dokumentasi</h3>
        <p class="text-xs text-zinc-400 max-w-sm mx-auto">
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
            <div class="bg-[#0B0B0E]/60 backdrop-blur-md border border-white/[0.09] rounded-2xl overflow-hidden shadow-lg hover:border-white/[0.09] hover:shadow-xl transition-all flex flex-col justify-between group">
                <div>
                    {{-- Thumbnail with Badges --}}
                    <div class="relative aspect-[4/3] bg-[#060608] overflow-hidden cursor-pointer"
                         @click="openModal({{ json_encode([
                             'title' => $doc->title,
                             'destination' => $doc->destination ? $doc->destination->name : null,
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
                                <span class="px-2 py-0.5 rounded-md bg-amber-500/90 text-slate-950 font-bold text-[10px] tracking-wide shadow backdrop-blur-sm flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                    Hero Featured
                                </span>
                            @else
                                <span></span>
                            @endif

                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold shadow backdrop-blur-sm {{ $doc->is_active ? 'bg-emerald-500/80 text-white' : 'bg-slate-700/80 text-zinc-300' }}">
                                {{ $doc->is_active ? 'Aktif' : 'Draft' }}
                            </span>
                        </div>

                        {{-- Multi-Media Count Pill --}}
                        <div class="absolute bottom-2.5 right-2.5">
                            <span class="px-2.5 py-1 rounded-full bg-[#060608]/85 text-teal-300 font-bold text-[10px] border border-teal-400/30 backdrop-blur-md shadow flex items-center gap-1.5">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>{{ max(1, $photoCount) }}</span>
                                @if($videoCount > 0)
                                    <span class="flex items-center gap-1">
                                        ·
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                        {{ $videoCount }}
                                    </span>
                                @endif
                            </span>
                        </div>

                        {{-- Destinasi Pill --}}
                        @if($doc->destination)
                            <div class="absolute bottom-2.5 left-2.5">
                                <span class="px-2 py-0.5 rounded-md bg-[#060608]/80 text-white font-semibold text-[10px] border border-white/[0.09] backdrop-blur-sm flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $doc->destination->name }}
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Card Info - Simplified --}}
                    <div class="p-4">
                        <h4 class="font-bold text-white text-sm line-clamp-2 group-hover:text-aw-gold transition-colors" title="{{ $doc->title }}">
                            {{ $doc->title }}
                        </h4>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="p-3 bg-[#0B0B0E]/60 border-t border-white/[0.07] flex items-center justify-between gap-2">
                    <a href="{{ route('admin.gallery.edit', $doc->id) }}" 
                       class="flex-1 py-2 px-3 rounded-lg bg-[#121215] hover:bg-slate-700 text-zinc-200 text-xs font-semibold text-center transition-colors flex items-center justify-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Kelola</span>
                    </a>

                    <form action="{{ route('admin.gallery.destroy', $doc->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus album dokumentasi ini beserta semua foto & videonya?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="py-2 px-3 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 text-xs font-semibold transition-colors"
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
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#060608]/80 backdrop-blur-md">
            
            <div class="absolute inset-0" @click="previewModal = false"></div>

            <div class="relative z-10 max-w-4xl w-full bg-[#0B0B0E] border border-white/20 rounded-3xl p-6 shadow-2xl text-white space-y-4 max-h-[90vh] overflow-y-auto"
                 @click.stop>
                
                <div class="flex items-center justify-between border-b border-white/[0.09] pb-3">
                    <div>
                        <h3 class="text-lg font-bold text-white" x-text="activeDoc ? activeDoc.title : ''"></h3>
                        <p class="text-xs text-zinc-400 flex items-center gap-1" x-show="activeDoc && activeDoc.destination">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span x-text="activeDoc ? activeDoc.destination : ''"></span>
                        </p>
                    </div>
                    <button @click="previewModal = false" class="w-8 h-8 rounded-full bg-zinc-900/50 backdrop-blur-md border border-white/[0.08] shadow-xl/10 text-zinc-300 hover:text-white flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Media Grid in Modal --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-2">
                    <template x-for="media in (activeDoc ? activeDoc.media : [])" :key="media.id">
                        <div class="rounded-xl overflow-hidden bg-[#060608] border border-white/[0.09] aspect-video relative group">
                            <template x-if="media.type === 'image'">
                                <img :src="media.url" :alt="media.caption" class="w-full h-full object-cover">
                            </template>
                            <template x-if="media.type === 'video'">
                                <div class="w-full h-full flex flex-col items-center justify-center bg-[#060608] p-2 text-center">
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
