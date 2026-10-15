@extends('layouts.app')

@section('title', $destination->name . ' — Paket Tour Rombongan AW Tour Operator')

@section('content')

<!-- BREADCRUMB & HERO BANNER (Altesa Dark Warm Luxury) -->
<div class="relative overflow-hidden bg-[#18181B] text-white pt-28 pb-16 sm:pt-36 sm:pb-20 border-b border-white/10">
    @if($destination->cover_image)
        <img src="{{ $destination->cover_image }}" alt="{{ $destination->name }}" class="absolute inset-0 h-full w-full object-cover opacity-25">
    @endif
    <div class="absolute inset-0 bg-gradient-to-r from-[#18181B] via-[#18181B]/90 to-[#18181B]/70"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-400">
            <a href="{{ route('home') }}" class="hover:text-aw-gold transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('destinations.index') }}" class="hover:text-aw-gold transition-colors">Destinasi Tour</a>
            <span>/</span>
            <span class="text-aw-gold font-semibold">{{ $destination->name }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pt-2">
            <div class="space-y-2">
                <span class="badge-altesa-dark">
                    Category: {{ $destination->category->name }}
                </span>
                <h1 class="font-display text-3xl sm:text-5xl font-extrabold text-white">
                    {{ $destination->name }}
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm flex items-center gap-2">
                    <span>📍 {{ $destination->location }}</span>
                    <span>•</span>
                    <span>Min. Peserta: <strong class="text-white">{{ $destination->min_pax }} Pax</strong></span>
                </p>
            </div>

            <!-- Price Highlight Badge -->
            <div class="bg-white/10 backdrop-blur-md border border-white/20 p-5 rounded-3xl text-left lg:text-right shadow-xl">
                <span class="text-[10px] text-slate-300 uppercase tracking-widest block font-semibold">Estimasi Penawaran Paket</span>
                <span class="font-extrabold text-2xl sm:text-3xl text-aw-gold">
                    {{ $destination->formatted_price }}
                </span>
            </div>
        </div>

    </div>
</div>

<!-- MAIN CONTENT SECTION -->
<div class="py-16 bg-[#FCFAF7] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- LEFT COLUMN: DETAIL CONTENT -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- DESKRIPSI UTAMA -->
                <div class="card-altesa p-6 sm:p-8 space-y-4">
                    <h2 class="font-display font-bold text-xl text-aw-navy border-b border-[#F5F0E8] pb-3">
                        Deskripsi Perjalanan
                    </h2>
                    <p class="text-slate-700 text-xs sm:text-sm leading-relaxed whitespace-pre-line">
                        {{ $destination->description ?? $destination->short_description }}
                    </p>
                </div>

                <!-- ITINERARY PER HARI -->
                @if(optional($destination->detail)->itinerary)
                    <div class="card-altesa p-6 sm:p-8 space-y-6">
                        <h2 class="font-display font-bold text-xl text-aw-navy border-b border-[#F5F0E8] pb-3 flex items-center gap-2">
                            <span>🗺️</span> Rencana Perjalanan (Itinerary)
                        </h2>

                        <div class="space-y-6 relative before:absolute before:inset-0 before:left-3 before:w-0.5 before:bg-aw-gold/30">
                            @foreach($destination->detail->itinerary as $item)
                                <div class="relative pl-8 space-y-1.5">
                                    <span class="absolute left-1.5 top-1.5 w-3.5 h-3.5 rounded-full bg-aw-gold border-2 border-white shadow"></span>
                                    <div class="flex items-center gap-2 text-xs font-bold text-aw-navy">
                                        <span class="bg-[#18181B] text-aw-gold text-[10px] px-2.5 py-0.5 rounded-full font-semibold">Hari {{ $item['hari'] }}</span>
                                        <span class="text-sm font-display">{{ $item['judul'] }}</span>
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
                            <div class="bg-emerald-50/80 rounded-3xl p-6 border border-emerald-200/80 space-y-3">
                                <h3 class="font-display font-bold text-sm text-emerald-950 flex items-center gap-2 uppercase tracking-wider">
                                    <span>✅</span> Fasilitas Termasuk (Inclusions)
                                </h3>
                                <ul class="space-y-2 text-xs text-emerald-900">
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
                            <div class="bg-rose-50/80 rounded-3xl p-6 border border-rose-200/80 space-y-3">
                                <h3 class="font-display font-bold text-sm text-rose-950 flex items-center gap-2 uppercase tracking-wider">
                                    <span>❌</span> Tidak Termasuk (Exclusions)
                                </h3>
                                <ul class="space-y-2 text-xs text-rose-900">
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
                    <div class="bg-[#FCFAF7] rounded-3xl p-6 border border-[#F5F0E8] text-xs text-slate-700 space-y-1.5">
                        <strong class="font-bold flex items-center gap-1.5 text-aw-navy">
                            <span>📌</span> Catatan Syarat &amp; Ketentuan:
                        </strong>
                        <p class="leading-relaxed">{{ $destination->detail->notes }}</p>
                    </div>
                @endif

            </div>

            <!-- RIGHT COLUMN: STICKY BOOKING CARD -->
            <div class="lg:col-span-4">
                <div class="sticky top-24 card-altesa p-6 sm:p-7 space-y-6">
                    
                    <div class="space-y-2 border-b border-[#F5F0E8] pb-4">
                        <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-widest">Penawaran Rombongan</span>
                        <div class="font-extrabold text-2xl text-aw-gold-700">
                            {{ $destination->formatted_price }}
                        </div>
                        <p class="text-xs text-slate-500">Harga final disesuaikan dengan kuantitas peserta, tipe armada & add-on UMKM.</p>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('quotation.create') }}?destination_id={{ $destination->id }}" 
                           class="w-full btn-altesa-primary !text-xs !py-3.5">
                            <span>🧮 Buat Custom Quotation</span>
                        </a>

                        <a href="{{ $siteSettings->whatsapp_url }}?text={{ urlencode('Halo Admin AW Tour, saya tertarik konsultasi paket ' . $destination->name) }}" 
                           target="_blank"
                           rel="noopener"
                           class="w-full inline-flex items-center justify-center gap-2 bg-[#18181B] hover:bg-black text-white font-semibold py-3.5 px-4 rounded-full transition-all text-xs">
                            <span>💬 Chat WA Admin (+{{ $siteSettings->whatsapp_number }})</span>
                        </a>
                    </div>

                    <div class="pt-2 text-[11px] text-slate-500 space-y-2 border-t border-[#F5F0E8]">
                        <p class="flex items-center gap-2">
                            <span class="text-aw-gold-700 font-bold">✓</span> <span>Bebas ubah jadwal dan tanggal</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="text-aw-gold-700 font-bold">✓</span> <span>Terima invoice &amp; LPJ resmi instansi (PDF)</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <span class="text-aw-gold-700 font-bold">✓</span> <span>Garansi pelayanan ramah &amp; profesional</span>
                        </p>
                    </div>

                </div>
            </div>

        </div>


        <!-- RELATED DESTINATIONS -->
        @if($relatedDestinations->count() > 0)
            <div class="pt-16 border-t border-[#F5F0E8] mt-16 space-y-6">
                <h3 class="font-display font-bold text-2xl text-aw-navy">
                    Destinasi Terkait Lainnya
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    @foreach($relatedDestinations as $rel)
                        <div class="card-altesa p-6 space-y-3 flex flex-col justify-between">
                            <div>
                                <h4 class="font-display font-bold text-base text-aw-navy">{{ $rel->name }}</h4>
                                <p class="text-xs text-slate-500 line-clamp-2 mt-1 leading-relaxed">{{ $rel->short_description }}</p>
                            </div>
                            <div class="flex items-center justify-between pt-3 border-t border-[#F5F0E8]">
                                <span class="font-extrabold text-xs text-aw-gold-700">{{ $rel->formatted_price }}</span>
                                <a href="{{ route('destinations.show', $rel->slug) }}" class="text-xs font-bold text-aw-navy hover:text-aw-gold transition-colors">
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
