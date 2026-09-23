@extends('layouts.app')

@section('title', $destination->name . ' — Paket Tour Rombongan AW Tour Operator')

@section('content')

<!-- BREADCRUMB & HERO BANNER -->
<div class="bg-aw-navy text-white pt-10 pb-16 border-b border-aw-sage/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-aw-gold">Beranda</a>
            <span>/</span>
            <a href="{{ route('destinations.index') }}" class="hover:text-aw-gold">Destinasi Tour</a>
            <span>/</span>
            <span class="text-aw-gold font-semibold">{{ $destination->name }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pt-2">
            <div class="space-y-2">
                <span class="inline-block bg-aw-forest border border-aw-sage/40 text-aw-mint text-xs font-semibold px-3 py-1 rounded-full">
                    Category: {{ $destination->category->name }}
                </span>
                <h1 class="font-display text-3xl sm:text-4xl font-extrabold text-white">
                    {{ $destination->name }}
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm flex items-center gap-2">
                    <span>📍 {{ $destination->location }}</span>
                    <span>•</span>
                    <span>Min. Peserta: <strong>{{ $destination->min_pax }} Pax</strong></span>
                </p>
            </div>

            <!-- Price Highlight Badge -->
            <div class="bg-slate-800/90 border border-aw-gold/40 p-4 rounded-2xl text-left lg:text-right">
                <span class="text-[10px] text-slate-400 uppercase tracking-widest block font-semibold">Estimasi Penawaran Paket</span>
                <span class="font-extrabold text-2xl text-aw-gold">
                    {{ $destination->formatted_price }}
                </span>
            </div>
        </div>

    </div>
</div>

<!-- MAIN CONTENT SECTION -->
<div class="py-12 bg-aw-cream/40 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- LEFT COLUMN: DETAIL CONTENT -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- DESKRIPSI UTAMA -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-4">
                    <h2 class="font-display font-bold text-xl text-aw-navy border-b border-slate-100 pb-3">
                        Deskripsi Perjalanan
                    </h2>
                    <p class="text-slate-700 text-xs sm:text-sm leading-relaxed whitespace-pre-line">
                        {{ $destination->description ?? $destination->short_description }}
                    </p>
                </div>

                <!-- ITINERARY PER HARI -->
                @if(optional($destination->detail)->itinerary)
                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200 space-y-6">
                        <h2 class="font-display font-bold text-xl text-aw-navy border-b border-slate-100 pb-3 flex items-center gap-2">
                            <span>🗺️</span> Rencana Perjalanan (Itinerary)
                        </h2>

                        <div class="space-y-4 relative before:absolute before:inset-0 before:left-3 before:w-0.5 before:bg-aw-gold/30">
                            @foreach($destination->detail->itinerary as $item)
                                <div class="relative pl-8 space-y-1">
                                    <span class="absolute left-1 top-1.5 w-4 h-4 rounded-full bg-aw-gold border-2 border-white shadow"></span>
                                    <div class="flex items-center gap-2 text-xs font-bold text-aw-navy">
                                        <span class="bg-aw-navy text-aw-gold text-[10px] px-2 py-0.5 rounded">Hari {{ $item['hari'] }}</span>
                                        <span>{{ $item['judul'] }}</span>
                                    </div>
                                    <p class="text-xs text-slate-600 leading-relaxed">
                                        {{ $item['kegiatan'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- FASILITAS TERMASUK & TIDAK TERMASUK -->
                @if(optional($destination->detail)->inclusions || optional($destination->detail)->exclusions)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        
                        <!-- INCLUSIONS -->
                        @if(optional($destination->detail)->inclusions)
                            <div class="bg-emerald-50/70 rounded-3xl p-6 border border-emerald-200 space-y-3">
                                <h3 class="font-display font-bold text-sm text-emerald-900 flex items-center gap-2 uppercase tracking-wider">
                                    <span>✅</span> Fasilitas Termasuk (Inclusions)
                                </h3>
                                <ul class="space-y-2 text-xs text-emerald-800">
                                    @foreach($destination->detail->inclusions as $inc)
                                        <li class="flex items-start gap-2">
                                            <span class="text-emerald-600 font-bold">•</span>
                                            <span>{{ $inc }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- EXCLUSIONS -->
                        @if(optional($destination->detail)->exclusions)
                            <div class="bg-rose-50/70 rounded-3xl p-6 border border-rose-200 space-y-3">
                                <h3 class="font-display font-bold text-sm text-rose-900 flex items-center gap-2 uppercase tracking-wider">
                                    <span>❌</span> Tidak Termasuk (Exclusions)
                                </h3>
                                <ul class="space-y-2 text-xs text-rose-800">
                                    @foreach($destination->detail->exclusions as $exc)
                                        <li class="flex items-start gap-2">
                                            <span class="text-rose-600 font-bold">•</span>
                                            <span>{{ $exc }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                @endif

                <!-- CATATAN / KETENTUAN -->
                @if(optional($destination->detail)->notes)
                    <div class="bg-amber-50 rounded-2xl p-5 border border-amber-200 text-xs text-amber-900 space-y-1">
                        <strong class="font-bold flex items-center gap-1">
                            <span>📌</span> Catatan Syarat & Ketentuan:
                        </strong>
                        <p class="leading-relaxed">{{ $destination->detail->notes }}</p>
                    </div>
                @endif

            </div>

            <!-- RIGHT COLUMN: STICKY BOOKING CARD -->
            <div class="lg:col-span-4">
                <div class="sticky top-24 bg-white rounded-3xl p-6 shadow-xl border border-slate-200 space-y-6">
                    
                    <div class="space-y-2 border-b border-slate-100 pb-4">
                        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-widest">Penawaran Rombongan</span>
                        <div class="font-extrabold text-2xl text-aw-navy">
                            {{ $destination->formatted_price }}
                        </div>
                        <p class="text-xs text-slate-500">Harga final disesuaikan dengan jumlah armada & add-on UMKM.</p>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('quotation.create') }}?destination_id={{ $destination->id }}" 
                           class="w-full inline-flex items-center justify-center gap-2 bg-aw-gold hover:bg-aw-gold-600 text-white font-bold py-3.5 px-4 rounded-full shadow-lg transition-all text-xs">
                            <span>🧮 Buat Custom Quotation</span>
                        </a>

                        <a href="https://wa.me/6282233119092?text=Halo%20Admin%20AW%20Tour,%20saya%20tertarik%20konsultasi%20paket%20{{ urlencode($destination->name) }}" 
                           target="_blank"
                           class="w-full inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3.5 px-4 rounded-full transition-all text-xs">
                            <span>💬 Chat WA Admin (+62 822 3311 9092)</span>
                        </a>
                    </div>

                    <div class="pt-2 text-[11px] text-slate-400 space-y-1">
                        <p>✓ Bebas ubah jadwal tanggal</p>
                        <p>✓ Terima invoice resmi instansi (PDF)</p>
                        <p>✓ Garansi pelayanan ramah & responsif</p>
                    </div>

                </div>
            </div>

        </div>


        <!-- RELATED DESTINATIONS -->
        @if($relatedDestinations->count() > 0)
            <div class="pt-16 border-t border-slate-200 mt-16 space-y-6">
                <h3 class="font-display font-bold text-xl text-aw-navy">
                    Destinasi Terkait Lainnya
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedDestinations as $rel)
                        <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-all space-y-3">
                            <h4 class="font-display font-bold text-base text-aw-navy">{{ $rel->name }}</h4>
                            <p class="text-xs text-slate-500 line-clamp-2">{{ $rel->short_description }}</p>
                            <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                                <span class="font-extrabold text-xs text-aw-gold">{{ $rel->formatted_price }}</span>
                                <a href="{{ route('destinations.show', $rel->slug) }}" class="text-xs font-bold text-aw-navy hover:underline">
                                    Lihat Detail &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
