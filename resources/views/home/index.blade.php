@extends('layouts.app')

@section('title', 'AW Tour Operator Surabaya — Spesialis Group Customized Tour')

@section('content')

<!-- ========================================================================= -->
<!-- 1. HERO SECTION (Header Utama Landing Page) -->
<!-- ========================================================================= -->
<section class="relative bg-aw-navy text-white overflow-hidden pt-12 pb-24 lg:pt-20 lg:pb-32">
    
    <!-- Background Decorator & Gradient Glow -->
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-aw-forest/60 via-aw-navy to-aw-navy opacity-90"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-aw-gold/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-10 w-80 h-80 bg-aw-sage/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- LEFT COLUMN: Headline & CTA -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                
                <!-- Badge Tagline -->
                <div class="inline-flex items-center gap-2 bg-aw-forest/80 border border-aw-sage/40 px-3.5 py-1.5 rounded-full text-xs font-semibold text-aw-mint">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Spesialis Group Customized Tour Surabaya (B2B)</span>
                </div>

                <!-- Main Title -->
                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Wujudkan Perjalanan Rombongan Impian bersama <span class="text-aw-gold italic">AW Tour Operator</span>
                </h1>

                <!-- Subtitle Description -->
                <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Solusi kustomisasi paket <strong class="text-white">Studi Tour, Capacity Building, & Family Gathering</strong> untuk Kampus (ITS, UNAIR, UNESA), Sekolah, dan Perusahaan. Pilih destinasi, jumlah armada, hingga add-on oleh-oleh UMKM lokal!
                </p>

                <!-- CTA Action Buttons -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    
                    <a href="{{ route('quotation.create') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-aw-gold hover:bg-aw-gold-600 text-white font-bold px-7 py-3.5 rounded-full shadow-xl shadow-aw-gold/20 hover:scale-105 active:scale-95 transition-all text-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span>Buat Custom Quotation</span>
                    </a>

                    <a href="https://wa.me/6282233119092?text=Halo%20Admin%20AW%20Tour,%20saya%20tertarik%20konsultasi%20paket%20tour%20rombongan" 
                       target="_blank"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-slate-800/80 hover:bg-slate-700 text-white border border-slate-600/80 font-semibold px-6 py-3.5 rounded-full hover:border-emerald-400 transition-all text-sm">
                        <svg class="w-5 h-5 text-emerald-400 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                        </svg>
                        <span>Konsultasi WA Admin</span>
                    </a>

                </div>

                <!-- Stats Quick Counter -->
                <div class="pt-8 grid grid-cols-3 gap-4 border-t border-slate-800 text-center lg:text-left">
                    <div>
                        <p class="font-display font-extrabold text-2xl text-aw-gold">50+</p>
                        <p class="text-xs text-slate-400">Rombongan Terlayani</p>
                    </div>
                    <div>
                        <p class="font-display font-extrabold text-2xl text-aw-mint">100%</p>
                        <p class="text-xs text-slate-400">Custom Itinerary</p>
                    </div>
                    <div>
                        <p class="font-display font-extrabold text-2xl text-white">&lt; 15 Mnt</p>
                        <p class="text-xs text-slate-400">Respon Quotation WA</p>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Visual Card Showcase -->
            <div class="lg:col-span-5 relative">
                <div class="relative rounded-2xl bg-gradient-to-b from-aw-forest to-aw-navy p-6 border border-aw-sage/30 shadow-2xl space-y-5">
                    
                    <!-- Decorative Badge -->
                    <div class="flex items-center justify-between border-b border-slate-700/60 pb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                        </div>
                        <span class="text-[11px] font-mono text-aw-mint uppercase tracking-wider">AW Quotation System</span>
                    </div>

                    <!-- Visual Mock Feature Card 1 -->
                    <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800 flex items-start gap-4">
                        <div class="p-3 bg-aw-gold/20 text-aw-gold rounded-lg">
                            🎓
                        </div>
                        <div>
                            <h4 class="font-semibold text-white text-sm">Studi Tour Kampus & Sekolah</h4>
                            <p class="text-xs text-slate-400">Kunjungan industri, tempat bersejarah, & pusat studi.</p>
                        </div>
                    </div>

                    <!-- Visual Mock Feature Card 2 -->
                    <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800 flex items-start gap-4">
                        <div class="p-3 bg-aw-sage/20 text-aw-mint rounded-lg">
                            🏢
                        </div>
                        <div>
                            <h4 class="font-semibold text-white text-sm">Capacity Building & Outbound</h4>
                            <p class="text-xs text-slate-400">Program motivasi & team building karyawan di Batu Malang.</p>
                        </div>
                    </div>

                    <!-- Visual Mock Feature Card 3 -->
                    <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800 flex items-start gap-4">
                        <div class="p-3 bg-emerald-500/20 text-emerald-400 rounded-lg">
                            🛍️
                        </div>
                        <div>
                            <h4 class="font-semibold text-white text-sm">Add-on Oleh-Oleh UMKM</h4>
                            <p class="text-xs text-slate-400">Paket batik, keripik, & sambal lokal siap dibagikan ke peserta.</p>
                        </div>
                    </div>

                    <!-- Interactive Link -->
                    <div class="pt-2 text-center">
                        <a href="{{ route('quotation.create') }}" class="text-xs text-aw-gold hover:underline font-medium">
                            Hitung Penawaran Rombongan Anda Sekarang &rarr;
                        </a>
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
            <span class="font-display font-bold text-lg text-slate-700 tracking-wide">ITS SURABAYA</span>
            <span class="font-display font-bold text-lg text-slate-700 tracking-wide">UNAIR</span>
            <span class="font-display font-bold text-lg text-slate-700 tracking-wide">UNESA</span>
            <span class="font-display font-bold text-lg text-slate-700 tracking-wide">INSTANSI SWASTA</span>
            <span class="font-display font-bold text-lg text-slate-700 tracking-wide">UMKM JATIM</span>
        </div>
    </div>
</section>


<!-- ========================================================================= -->
<!-- 3. HIGHLIGHT 3 LAYANAN UTAMA -->
<!-- ========================================================================= -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">Solusi Spesialis Kami</span>
            <h2 class="font-display text-3xl sm:text-4xl font-bold text-aw-navy">
                3 Pilar Layanan Tour Rombongan
            </h2>
            <p class="text-slate-600 text-sm sm:text-base">
                Dirancang khusus untuk memenuhi kebutuhan perjalanan kelompok dengan fleksibilitas jadwal dan armada.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @foreach($categories as $category)
                <div class="bg-[#FBF9F7] rounded-2xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="w-14 h-14 rounded-2xl bg-aw-navy text-aw-gold flex items-center justify-center text-2xl shadow-md group-hover:scale-110 transition-transform">
                            @if($category->slug === 'studi-tour')
                                🎓
                            @elseif($category->slug === 'capacity-building')
                                🏢
                            @else
                                👨‍👩‍👧‍👦
                            @endif
                        </div>
                        <h3 class="font-display font-bold text-xl text-aw-navy group-hover:text-aw-gold transition-colors">
                            {{ $category->name }}
                        </h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                            {{ $category->description }}
                        </p>
                    </div>

                    <div class="pt-6 border-t border-slate-200/60 mt-6">
                        <a href="{{ route('destinations.index') }}?category={{ $category->slug }}" 
                           class="inline-flex items-center gap-2 text-xs font-bold text-aw-navy hover:text-aw-gold transition-colors">
                            <span>Lihat Paket {{ $category->name }}</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
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
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-aw-navy/80 via-transparent to-transparent z-10"></div>
                            
                            <!-- Category Badge -->
                            <span class="absolute top-3 left-3 z-20 bg-aw-navy/90 backdrop-blur-sm text-aw-mint text-[11px] font-semibold px-2.5 py-1 rounded-full border border-aw-sage/30">
                                {{ $destination->category->name }}
                            </span>

                            <!-- Destination Name Overlay -->
                            <div class="absolute bottom-3 left-3 right-3 z-20">
                                <h3 class="font-display font-bold text-lg text-white group-hover:text-aw-gold transition-colors leading-tight">
                                    {{ $destination->name }}
                                </h3>
                                <p class="text-xs text-slate-300 flex items-center gap-1">
                                    <span>📍</span> {{ $destination->location }}
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
<!-- 7. HIGHLIGHT ETALASE PRODUK UMKM LOKAL -->
<!-- ========================================================================= -->
<section class="py-20 bg-aw-cream/40 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">Add-on Spesial Rombongan</span>
                <h2 class="font-display text-3xl font-bold text-aw-navy">Oleh-Oleh Khas UMKM Jawa Timur</h2>
            </div>
            <a href="{{ route('umkm.index') }}" 
               class="inline-flex items-center gap-2 text-sm font-semibold text-aw-gold hover:text-aw-gold-700 underline">
                <span>Lihat Katalog Lengkap UMKM &rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($umkmProducts as $product)
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                    <div class="space-y-2">
                        <span class="text-[10px] uppercase font-bold text-aw-sage tracking-wider">
                            {{ $product->producer ?? 'UMKM Jawa Timur' }}
                        </span>
                        <h3 class="font-display font-bold text-base text-aw-navy">
                            {{ $product->name }}
                        </h3>
                        <p class="text-xs text-slate-500 line-clamp-2">
                            {{ $product->description }}
                        </p>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between">
                        <span class="font-extrabold text-aw-navy text-sm">
                            {{ $product->formatted_price }}
                        </span>
                        <span class="text-[10px] bg-emerald-50 text-emerald-700 font-semibold px-2 py-0.5 rounded border border-emerald-200">
                            Tersedia Add-on
                        </span>
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
            Dapatkan penawaran harga terbaik (*quotation*) yang disesuaikan dengan anggaran dan jumlah peserta acara Anda.
        </p>
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('quotation.create') }}" 
               class="w-full sm:w-auto bg-aw-gold hover:bg-aw-gold-600 text-white font-bold px-8 py-4 rounded-full shadow-xl shadow-aw-gold/20 hover:scale-105 transition-all text-sm">
                Mulai Custom Quotation Builder
            </a>
            <a href="https://wa.me/6282233119092" 
               target="_blank" 
               class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-semibold px-8 py-4 rounded-full shadow-lg transition-all text-sm">
                Chat Admin WA (+62 822 3311 9092)
            </a>
        </div>
    </div>
</section>

@endsection
