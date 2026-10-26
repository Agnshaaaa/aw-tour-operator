@extends('layouts.app')

@section('title', $siteSettings->site_title ?? 'AW Tour Operator Surabaya — Spesialis Group Customized Tour')

@section('content')

<!-- ========================================================================= -->
<!-- 1. HERO SECTION (Header Utama Landing Page) -->
<!-- ========================================================================= -->
<section class="relative w-full min-h-screen bg-cover bg-center overflow-hidden flex items-center justify-center pt-28 sm:pt-32" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
    <!-- 1. OVERLAY GELAP (Wajib berada tepat di atas background) -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/70 to-slate-900/30 z-10 pointer-events-none"></div>

    <!-- 2. KONTEN (Harus menggunakan z-20 agar berada DI ATAS overlay) -->
    <div class="relative z-20 container mx-auto px-4 py-20 lg:py-24 flex items-center justify-center">
        <div class="w-full max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- LEFT COLUMN: Headline & CTA -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left relative">
                <!-- Thin Dark Gradient Layer Behind Text -->
                <div class="absolute -inset-6 bg-gradient-to-r from-slate-950/90 via-slate-950/60 to-transparent rounded-3xl blur-2xl -z-10 pointer-events-none"></div>

                <!-- Main Title -->
                @php
                    $heading = $siteSettings->hero_heading ?? 'Wujudkan Perjalanan Rombongan Impian bersama AW Tour Operator';
                    $heading = str_replace('Rombongan Impian', '<span class="text-teal-400 font-extrabold drop-shadow-[0_2px_10px_rgba(45,212,191,0.5)]">Rombongan Impian</span>', $heading);
                    $heading = str_replace('AW Tour Operator', '<span class="text-amber-400 font-extrabold drop-shadow-[0_2px_10px_rgba(251,191,36,0.5)]">AW Tour Operator</span>', $heading);
                @endphp
                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight drop-shadow-[0_4px_16px_rgba(0,0,0,1)]">
                    {!! $heading !!}
                </h1>

                <!-- Subtitle Description -->
                <p class="text-slate-100 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0 drop-shadow-[0_2px_8px_rgba(0,0,0,1)] font-semibold">
                    {{ $siteSettings->hero_subheading ?? 'Solusi kustomisasi paket Studi Tour, Capacity Building, & Family Gathering untuk kampus, sekolah, dan perusahaan. Pilih destinasi serta armada yang sesuai dengan kebutuhan rombongan.' }}
                </p>

                <!-- CTA Action Buttons -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start">
                    
                    <a href="{{ route('quotation.create') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-amber-500 text-slate-950 font-bold px-7 py-3.5 rounded-full shadow-xl shadow-amber-500/25 hover:bg-amber-400 hover:scale-105 active:scale-95 transition-all text-sm">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                        <span>Buat Custom Quotation</span>
                    </a>

                </div>

                <!-- Stats Quick Counter -->
                <div class="pt-8 grid grid-cols-3 gap-4 border-t border-slate-600/80 text-center lg:text-left">
                    <div>
                        <p class="font-display font-extrabold text-2xl sm:text-3xl text-amber-400 drop-shadow-[0_2px_6px_rgba(0,0,0,1)]">50+</p>
                        <p class="text-xs sm:text-sm text-slate-100 font-bold drop-shadow-[0_1px_4px_rgba(0,0,0,1)]">Rombongan Terlayani</p>
                    </div>
                    <div>
                        <p class="font-display font-extrabold text-2xl sm:text-3xl text-teal-400 drop-shadow-[0_2px_6px_rgba(0,0,0,1)]">100%</p>
                        <p class="text-xs sm:text-sm text-slate-100 font-bold drop-shadow-[0_1px_4px_rgba(0,0,0,1)]">Custom Itinerary</p>
                    </div>
                    <div>
                        <p class="font-display font-extrabold text-2xl sm:text-3xl text-amber-300 drop-shadow-[0_2px_6px_rgba(0,0,0,1)]">&lt; 15 Mnt</p>
                        <p class="text-xs sm:text-sm text-slate-100 font-bold drop-shadow-[0_1px_4px_rgba(0,0,0,1)]">Respon Quotation WA</p>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Interactive Documentation Gallery Preview Card -->
            <div class="lg:col-span-5 relative">
                
                {{-- Smooth Bright/Soft Gradient Behind Gallery Card --}}
                <div class="absolute -inset-4 bg-gradient-to-tr from-teal-400/25 via-emerald-400/20 to-sky-300/30 rounded-3xl blur-3xl -z-10 pointer-events-none"></div>

                <div class="relative rounded-3xl bg-slate-900/75 backdrop-blur-xl border border-teal-500/30 shadow-2xl shadow-teal-950/60 p-6 space-y-5 hover:scale-[1.01] hover:border-teal-400/60 hover:shadow-[0_0_35px_rgba(45,212,191,0.25)] transition-all duration-300 group">
                    
                    {{-- Header Top Bar --}}
                    <div class="text-center pb-1">
                        <h3 class="text-sm font-semibold text-white tracking-wider uppercase">Gallery Tour</h3>
                    </div>

                    {{-- Main Photo Showcase --}}
                    <div class="relative aspect-[16/10] rounded-2xl overflow-hidden bg-slate-950 shadow-xl">
                        <img src="{{ $heroDocumentation ? $heroDocumentation->image_url : asset('images/Bromo.jpg') }}" 
                             alt="{{ $heroDocumentation ? $heroDocumentation->title : 'Dokumentasi Tour Rombongan AW Tour' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out"
                             loading="eager">
                        
                        {{-- Soft Gradient Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-black/20"></div>
                    </div>

                    {{-- Photo Title --}}
                    <div>
                        <p class="text-sm font-medium text-white line-clamp-2 leading-relaxed">
                            {{ $heroDocumentation ? $heroDocumentation->title : 'Corporate Gathering PT Semen Indonesia' }}
                        </p>
                    </div>

                    {{-- Action Button: Buka Dokumentasi & Galeri Foto --}}
                    <div>
                        <a href="{{ route('gallery.index') }}" 
                           class="w-full flex items-center justify-center gap-2.5 py-3 px-5 rounded-xl bg-teal-600 hover:bg-teal-500 text-white font-semibold text-xs shadow-md shadow-teal-900/30 transition-all duration-200">
                            <span>Buka Dokumentasi &amp; Galeri Foto</span>
                            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>

                </div>
            </div>

            </div>
        </div>
    </div>
</section>


<!-- ========================================================================= -->
<!-- 2. CLIENT & INSTITUTION SHOWCASE BAR (Kampus & Perusahaan Partner) -->
<!-- ========================================================================= -->
<section class="bg-aw-cream py-8 border-y border-aw-sage/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-xs uppercase tracking-widest text-slate-500 font-semibold mb-6">
            Dipercaya Oleh Berbagai Rombongan Kampus, Sekolah, & Perusahaan Terkemuka
        </p>
        <div class="flex flex-wrap items-center justify-center gap-8 md:gap-14 opacity-80">
            @foreach($siteSettings->partners ?? [] as $partner)
                <span class="font-display font-bold text-lg text-slate-700 tracking-wide">{{ $partner }}</span>
            @endforeach
        </div>
    </div>
</section>


<!-- ========================================================================= -->
<!-- 3. HIGHLIGHT 3 LAYANAN UTAMA -->
<!-- ========================================================================= -->
<section class="py-20 bg-slate-950 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-emerald-900/20 via-slate-950 to-slate-950 relative overflow-hidden">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-16">
            <span class="text-emerald-400 font-semibold tracking-widest text-xs uppercase">Solusi Spesialis Kami</span>
            <h2 class="text-white font-bold text-3xl md:text-4xl tracking-tight">
                3 Pilar Layanan Tour Rombongan
            </h2>
            <p class="text-slate-400 font-normal text-sm max-w-2xl mx-auto">
                Dirancang khusus untuk memenuhi kebutuhan perjalanan kelompok dengan fleksibilitas jadwal dan armada.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @foreach($categories as $category)
                <div class="bg-slate-900/70 backdrop-blur-xl border border-white/10 rounded-3xl p-8 shadow-2xl transition-all duration-300 hover:-translate-y-2 hover:border-emerald-500/30 group">
                    
                    <div class="w-16 h-16 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300
                        @if($category->slug === 'studi-tour')
                            bg-sky-500/10 border border-sky-500/30 text-sky-400 shadow-[0_0_15px_rgba(56,189,248,0.2)]
                        @elseif($category->slug === 'capacity-building')
                            bg-amber-500/10 border border-amber-500/30 text-amber-400 shadow-[0_0_15px_rgba(251,191,36,0.2)]
                        @else
                            bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 shadow-[0_0_15px_rgba(52,211,153,0.2)]
                        @endif">
                        
                        @if($category->slug === 'studi-tour')
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                            </svg>
                        @elseif($category->slug === 'capacity-building')
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        @endif
                    </div>

                    <h3 class="text-white font-bold text-xl mb-3 mt-6">
                        {{ $category->name }}
                    </h3>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        {{ $category->description }}
                    </p>

                </div>
            @endforeach

        </div>

    </div>
</section>


<!-- ========================================================================= -->
<!-- 4. FEATURED DESTINATIONS SHOWCASE (Destinasi Unggulan) -->
<!-- ========================================================================= -->
<section class="py-20 bg-aw-cream/60 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">Pilihan Terfavorit</span>
                <h2 class="font-display text-3xl font-bold text-aw-navy">Destinasi Tour Unggulan</h2>
            </div>
            <a href="{{ route('destinations.index') }}" 
               class="inline-flex items-center gap-2 text-sm font-semibold text-aw-gold hover:text-aw-gold-700 underline">
                <span>Lihat Semua Destinasi &rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredDestinations as $destination)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-md hover:shadow-xl transition-all flex flex-col justify-between group">
                    
                    <div>
                        <!-- Header Visual / Placeholder Image -->
                        <div class="relative h-48 bg-slate-800 overflow-hidden">
                            @if($destination->cover_image)
                                <img src="{{ $destination->cover_image }}" alt="{{ $destination->name }}" class="absolute inset-0 h-full w-full object-cover" loading="lazy">
                            @endif
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-aw-navy/80 via-transparent to-transparent z-10"></div>
                            
                            <!-- Category Badge -->
                            <span class="absolute top-3 left-3 z-20 bg-aw-navy/90 backdrop-blur-sm text-aw-mint text-[11px] font-semibold px-2.5 py-1 rounded-full border border-aw-sage/30">
                                {{ $destination->location_type === 'luar_negeri' ? 'Luar Negeri' : 'Lokal' }}
                            </span>

                            <!-- Destination Name Overlay -->
                            <div class="absolute bottom-3 left-3 right-3 z-20">
                                <h3 class="font-display font-bold text-lg text-white group-hover:text-aw-gold transition-colors leading-tight">
                                    {{ $destination->name }}
                                </h3>
                                <p class="text-xs text-slate-300 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $destination->location }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 space-y-3">
                            <p class="text-slate-600 text-xs line-clamp-2 leading-relaxed">
                                {{ $destination->short_description }}
                            </p>

                            <div class="pt-2 flex items-center justify-between text-xs border-t border-slate-100">
                                <div>
                                    <span class="text-[10px] uppercase text-slate-400 block font-semibold">Mulai Dari</span>
                                    <span class="font-extrabold text-aw-navy text-sm">{{ $destination->formatted_price }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] uppercase text-slate-400 block font-semibold">Min. Peserta</span>
                                    <span class="font-semibold text-slate-700 text-xs">{{ $destination->min_pax }} Pax</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer Actions -->
                    <div class="p-5 pt-0 flex items-center gap-2">
                        <a href="{{ route('destinations.show', $destination->slug) }}" 
                           class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-aw-navy text-xs font-semibold py-2 rounded-lg transition-colors">
                            Detail Paket
                        </a>
                        <a href="{{ route('quotation.create') }}?destination_id={{ $destination->id }}" 
                           class="flex-1 text-center bg-aw-gold hover:bg-aw-gold-600 text-white text-xs font-semibold py-2 rounded-lg shadow-md transition-colors">
                            Quotation
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>


<!-- ========================================================================= -->
<!-- 5. INTERACTIVE AVAILABILITY CALENDAR BANNER -->
<!-- ========================================================================= -->
<section class="py-16 bg-aw-navy text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-aw-forest via-aw-navy to-slate-900 p-8 sm:p-12 rounded-3xl border border-aw-sage/30 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8">
            
            <div class="space-y-3 text-center md:text-left max-w-xl">
                <div class="inline-flex items-center gap-2 bg-emerald-500/20 text-emerald-300 text-xs font-semibold px-3 py-1 rounded-full border border-emerald-500/40">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>Interactive Calendar System</span>
                </div>
                <h2 class="font-display text-2xl sm:text-3xl font-bold">
                    Cek Ketersediaan Tanggal Tour Rombongan Anda
                </h2>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Pantau status jadwal secara *real-time*. Tanggal berwarna <strong class="text-rose-400">Merah (Fully Booked)</strong> dan <strong class="text-emerald-400">Hijau (Tersedia)</strong>.
                </p>
            </div>

            <div>
                <a href="{{ route('calendar.index') }}" 
                   class="inline-flex items-center gap-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold px-6 py-3.5 rounded-full shadow-lg shadow-emerald-900/40 hover:scale-105 transition-all text-sm">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Buka Kalender Ketersediaan</span>
                </a>
            </div>

        </div>
    </div>
</section>


<!-- ========================================================================= -->
<!-- 6. HIGHLIGHT JADWAL OPEN TRIP (Lead Generator) -->
<!-- ========================================================================= -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-12">
            <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">Jadwal Keberangkatan Terdekat</span>
            <h2 class="font-display text-3xl font-bold text-aw-navy">Open Trip Spesial AW Tour</h2>
            <p class="text-slate-600 text-xs sm:text-sm">
                Paket terbuka untuk umum dengan kuota terbatas. Cocok untuk individu atau kelompok kecil.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($openTrips as $trip)
                <div class="bg-[#FBF9F7] rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="bg-emerald-100 text-emerald-800 text-[11px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                                {{ $trip->status }}
                            </span>
                            <span class="text-xs text-slate-500 font-semibold">
                                {{ $trip->duration }}
                            </span>
                        </div>

                        <h3 class="font-display font-bold text-lg text-aw-navy">
                            {{ $trip->title }}
                        </h3>

                        <p class="text-xs text-slate-600">
                            {{ $trip->highlight }}
                        </p>

                        <div class="bg-white p-3 rounded-xl border border-slate-200/80 space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Tanggal Berangkat:</span>
                                <span class="font-bold text-aw-navy">{{ $trip->departure_date->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Sisa Kuota:</span>
                                <span class="font-bold text-emerald-600">{{ $trip->available_slots }} / {{ $trip->quota }} Orang</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-200 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-semibold uppercase">Harga per Orang</span>
                            <span class="font-extrabold text-aw-gold text-base">Rp {{ number_format($trip->price_per_person, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('open-trips.show', $trip->id) }}" 
                           class="bg-aw-navy hover:bg-slate-800 text-white text-xs font-semibold px-4 py-2 rounded-lg transition-colors">
                            Detail Trip
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>


<!-- ========================================================================= -->
<!-- 8. BOTTOM CTA BANNER (Konfirmasi Rombongan) -->
<!-- ========================================================================= -->
<section class="py-20 bg-aw-navy text-white text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <h2 class="font-display text-3xl sm:text-4xl font-extrabold text-white">
            Rencanakan Perjalanan Rombongan Anda Hari Ini
        </h2>
        <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
            Dapatkan penawaran harga terbaik (quotation) yang disesuaikan dengan anggaran dan jumlah peserta acara Anda.
        </p>
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('quotation.create') }}" 
               class="w-full sm:w-auto bg-aw-gold hover:bg-aw-gold-600 text-white font-bold px-8 py-4 rounded-full shadow-xl shadow-aw-gold/20 hover:scale-105 transition-all text-sm">
                Mulai Custom Quotation Builder
            </a>
            <a href="{{ $siteSettings->whatsapp_url }}" 
               target="_blank" 
               class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-semibold px-8 py-4 rounded-full shadow-lg transition-all text-sm">
                Chat Admin WA (+{{ $siteSettings->whatsapp_number }})
            </a>
        </div>
    </div>
</section>

@endsection
