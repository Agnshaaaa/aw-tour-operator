@extends('layouts.app')

@section('title', 'Katalog Destinasi Wisata Rombongan — AW Tour Operator')

@section('content')

<!-- HEADER BANNER -->
<div class="bg-aw-navy text-white py-12 border-b border-aw-sage/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">Group Tour Catalog</span>
        <h1 class="font-display text-3xl sm:text-4xl font-extrabold">Katalog Destinasi Tour Rombongan</h1>
        <p class="text-slate-300 text-xs sm:text-sm max-w-2xl mx-auto">
            Jelajahi berbagai pilihan destinasi wisata populer untuk paket Studi Tour, Capacity Building, dan Family Gathering.
        </p>
    </div>
</div>

<!-- FILTER & SEARCH BAR SECTION -->
<div class="py-8 bg-white border-b border-slate-200 sticky top-16 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('destinations.index') }}" method="GET" class="flex flex-col md:flex-row items-center justify-between gap-4">
            
            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <a href="{{ route('destinations.index') }}" 
                   class="px-4 py-2 rounded-full text-xs font-semibold transition-all {{ !request('category') ? 'bg-aw-navy text-aw-gold shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Semua Kategori
                </a>

                @foreach($categories as $cat)
                    <a href="{{ route('destinations.index', ['category' => $cat->slug]) }}" 
                       class="px-4 py-2 rounded-full text-xs font-semibold transition-all {{ request('category') === $cat->slug ? 'bg-aw-navy text-aw-gold shadow-md' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <!-- Search Bar -->
            <div class="w-full md:w-72 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau lokasi..."
                       class="w-full pl-9 pr-4 py-2 rounded-full border-slate-300 text-xs focus:border-aw-gold focus:ring-aw-gold">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

        </form>
    </div>
</div>

<!-- CATALOG GRID SECTION -->
<div class="py-12 bg-aw-cream/40 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($destinations->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($destinations as $dest)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-md hover:shadow-xl transition-all flex flex-col justify-between group">
                        
                        <div>
                            <!-- Visual Banner Card -->
                            <div class="relative h-52 bg-slate-800 overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-t from-aw-navy/90 via-transparent to-transparent z-10"></div>
                                
                                <span class="absolute top-3 left-3 z-20 bg-aw-navy/90 backdrop-blur-sm text-aw-mint text-[11px] font-semibold px-3 py-1 rounded-full border border-aw-sage/30">
                                    {{ $dest->category->name }}
                                </span>

                                <div class="absolute bottom-3 left-3 right-3 z-20">
                                    <h3 class="font-display font-bold text-xl text-white group-hover:text-aw-gold transition-colors leading-tight">
                                        {{ $dest->name }}
                                    </h3>
                                    <p class="text-xs text-slate-300 flex items-center gap-1 mt-1">
                                        <span>📍</span> {{ $dest->location }}
                                    </p>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 space-y-4">
                                <p class="text-slate-600 text-xs sm:text-sm line-clamp-3 leading-relaxed">
                                    {{ $dest->short_description }}
                                </p>

                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                    <div>
                                        <span class="text-[10px] uppercase text-slate-400 block font-semibold">Mulai Dari</span>
                                        <span class="font-extrabold text-aw-navy text-sm">{{ $dest->formatted_price }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-[10px] uppercase text-slate-400 block font-semibold">Min. Peserta</span>
                                        <span class="font-semibold text-slate-700 text-xs">{{ $dest->min_pax }} Pax</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="p-6 pt-0 flex items-center gap-3">
                            <a href="{{ route('destinations.show', $dest->slug) }}" 
                               class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-aw-navy text-xs font-bold py-2.5 rounded-xl transition-colors">
                                Detail Paket
                            </a>
                            <a href="{{ route('quotation.create') }}?destination_id={{ $dest->id }}" 
                               class="flex-1 text-center bg-aw-gold hover:bg-aw-gold-600 text-white text-xs font-bold py-2.5 rounded-xl shadow-md transition-colors">
                                Quotation
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- PAGINATION -->
            <div class="pt-10">
                {{ $destinations->links() }}
            </div>
        @else
            <!-- EMPTY STATE -->
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 max-w-lg mx-auto space-y-4">
                <span class="text-4xl block">🔍</span>
                <h3 class="font-display font-bold text-xl text-aw-navy">Destinasi Tidak Ditemukan</h3>
                <p class="text-xs text-slate-500">
                    Maaf, tidak ada destinasi wisata yang sesuai dengan pencarian atau filter pilihan Anda.
                </p>
                <a href="{{ route('destinations.index') }}" class="inline-block bg-aw-navy text-white text-xs font-bold px-6 py-2.5 rounded-full shadow">
                    Reset Filter Pencarian
                </a>
            </div>
        @endif

    </div>
</div>

@endsection
