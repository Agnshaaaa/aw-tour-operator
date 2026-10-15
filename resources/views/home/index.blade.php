@extends('layouts.app')

@section('title', 'AW Tour Operator Surabaya — Spesialis Group Customized Tour B2B')

@section('content')

<!-- ========================================================================= -->
<!-- 1. HERO SECTION (Header Utama Altesa Luxury Visual Identity) -->
<!-- ========================================================================= -->
<section id="beranda" class="relative isolate min-h-[min(90vh,62rem)] w-full max-w-full overflow-hidden text-white pt-28 pb-20 sm:pt-36 sm:pb-28 lg:pt-40 lg:pb-36 flex flex-col justify-center scroll-mt-24">
    
    <!-- Cinematic Background Photo -->
    <div class="absolute inset-0 z-0 h-full w-full overflow-hidden">
        <img src="{{ asset('images/Bromo.jpg') }}"
             alt="Pemandangan Bromo Indonesia"
             class="absolute inset-0 block h-full w-full max-w-none object-cover object-center scale-105 transform"
             onerror="this.style.display='none'; document.getElementById('hero-fallback').classList.remove('hidden');"
             loading="eager">
        <!-- Fallback gradient if image fails -->
        <div id="hero-fallback" class="hidden absolute inset-0 bg-gradient-to-br from-[#18181B] via-[#1C1C1C] to-[#18181B]"></div>
        <!-- Dark warm cinematic overlay (Altesa charcoal gradient) -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#18181B]/90 via-[#1C1C1C]/75 to-[#18181B]/85"></div>
        <!-- Extra bottom gradient for smooth transition to content -->
        <div class="absolute inset-x-0 bottom-0 h-44 bg-gradient-to-t from-[#FCFAF7] via-[#FCFAF7]/20 to-transparent"></div>
    </div>

    <!-- Luxury Warm Glow Orbs -->
    <div class="absolute -top-12 -right-12 h-64 w-64 rounded-full bg-aw-gold/20 blur-3xl pointer-events-none z-0 sm:-top-20 sm:-right-20 sm:h-96 sm:w-96"></div>
    <div class="absolute bottom-10 left-4 h-56 w-56 rounded-full bg-aw-gold/15 blur-3xl pointer-events-none z-0 sm:left-10 sm:h-80 sm:w-80"></div>

    <div class="relative z-10 mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- LEFT COLUMN: Headline & CTA -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                
                <!-- Badge Tagline -->
                <div class="inline-flex items-center gap-2 bg-[#18181B]/80 border border-aw-gold/30 px-4 py-1.5 rounded-full text-xs font-semibold text-aw-gold backdrop-blur-md shadow-lg shadow-black/20">
                    <span class="w-2 h-2 rounded-full bg-aw-gold animate-ping"></span>
                    <span>Spesialis Group Customized Tour Surabaya (B2B)</span>
                </div>

                <!-- Main Title with Altesa Typography -->
                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-extrabold text-white tracking-tight leading-[1.15]">
                    Pengalaman Eksklusif Perjalanan Rombongan Bersama <span class="text-aw-gold italic">AW Tour</span>
                </h1>

                <!-- Subtitle Description -->
                <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0 font-normal">
                    Layanan terpercaya kustomisasi paket <strong class="text-white font-semibold">Studi Tour, Capacity Building, & Family Gathering</strong> untuk institusi pendidikan dan korporasi terkemuka di Jawa Timur.
                </p>

                <!-- CTA Action Buttons -->
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    
                    <a href="{{ route('quotation.create') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-aw-gold hover:bg-aw-gold-600 text-aw-navy font-bold px-8 py-4 rounded-full shadow-xl shadow-aw-gold/25 hover:scale-105 active:scale-95 transition-all text-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span>Buat Custom Quotation</span>
                    </a>

                    <a href="{{ $siteSettings->whatsapp_url }}?text={{ urlencode('Halo Admin AW Tour, saya tertarik konsultasi paket tour rombongan') }}" 
                       target="_blank"
                       rel="noopener"
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-semibold px-7 py-4 rounded-full hover:border-aw-gold/50 backdrop-blur-md transition-all text-sm">
                        <!-- Whatsapp Icon SVG -->
                        <svg class="w-5 h-5 text-aw-gold fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                        </svg>
                        <span>Konsultasi WA Admin</span>
                    </a>

                </div>

                <!-- Stats Quick Counter -->
                <div class="pt-8 grid grid-cols-3 gap-4 border-t border-white/10 text-center lg:text-left">
                    <div>
                        <p class="font-display font-extrabold text-2xl sm:text-3xl text-aw-gold">50+</p>
                        <p class="text-xs text-slate-300">Rombongan Terlayani</p>
                    </div>
                    <div>
                        <p class="font-display font-extrabold text-2xl sm:text-3xl text-white">100%</p>
                        <p class="text-xs text-slate-300">Custom Itinerary</p>
                    </div>
                    <div>
                        <p class="font-display font-extrabold text-2xl sm:text-3xl text-aw-gold">&lt; 15 Mnt</p>
                        <p class="text-xs text-slate-300">Respon Quotation</p>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Interactive Documentation Showcase Card -->
            <div class="lg:col-span-5 relative">
                
                {{-- Floating Background Glow --}}
                <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-aw-gold/30 via-aw-gold-600/20 to-aw-gold/30 blur-2xl opacity-60"></div>

                <div class="relative rounded-3xl bg-[#18181B]/75 backdrop-blur-xl border border-white/15 shadow-2xl p-5 sm:p-6 space-y-4 hover:border-aw-gold/40 transition-all duration-300 group">
                    
                    {{-- Header Top Bar --}}
                    <div class="flex items-center justify-between border-b border-white/10 pb-3">
                        <div class="flex items-center gap-2">
                            <span class="inline-block w-2.5 h-2.5 rounded-full bg-aw-gold animate-pulse"></span>
                            <span class="text-xs font-bold text-white tracking-wide">DOKUMENTASI RESMI ROMBONGAN</span>
                        </div>
                        <span class="text-[10px] font-mono text-aw-gold font-bold uppercase tracking-wider bg-aw-gold/10 px-2.5 py-1 rounded-full border border-aw-gold/30">
                            50+ Trip
                        </span>
                    </div>

                    {{-- Main Photo Showcase --}}
                    <div class="relative aspect-[16/10] rounded-2xl overflow-hidden bg-black/40 border border-white/10 shadow-lg">
                        <img src="{{ $heroDocumentation ? $heroDocumentation->image_url : asset('images/Bromo.jpg') }}" 
                             alt="{{ $heroDocumentation ? $heroDocumentation->title : 'Dokumentasi Tour Rombongan AW Tour' }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                             loading="eager">
                        
                        {{-- Dark Gradient Overlay for Readability --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-black/30"></div>

                        {{-- Top Badge: "Rombongan Tour Terbanyak - 50+ Trip" --}}
                        <div class="absolute top-3 inset-x-3 flex items-center justify-between gap-2">
                            <span class="px-3 py-1 rounded-full bg-black/75 text-aw-gold font-extrabold text-[11px] tracking-wide border border-aw-gold/40 backdrop-blur-md shadow-md flex items-center gap-1.5">
                                <span>🏆</span>
                                <span>{{ $heroDocumentation && $heroDocumentation->badge_text ? $heroDocumentation->badge_text : 'Rombongan Tour Terbanyak - 50+ Trip' }}</span>
                            </span>

                            <span class="px-2 py-0.5 rounded-full bg-white/10 text-slate-200 text-[10px] font-medium border border-white/20 backdrop-blur-sm">
                                Real Photo
                            </span>
                        </div>

                        {{-- Bottom Photo Info --}}
                        <div class="absolute bottom-3 inset-x-3 space-y-1">
                            @if($heroDocumentation && $heroDocumentation->destination)
                                <span class="inline-block text-[10px] font-bold text-aw-gold bg-black/70 px-2.5 py-0.5 rounded-full border border-aw-gold/30 backdrop-blur-sm">
                                    📍 {{ $heroDocumentation->destination->name }}
                                </span>
                            @else
                                <span class="inline-block text-[10px] font-bold text-aw-gold bg-black/70 px-2.5 py-0.5 rounded-full border border-aw-gold/30 backdrop-blur-sm">
                                    📍 Gunung Bromo &amp; Malang Tour
                                </span>
                            @endif
                            <p class="text-xs font-bold text-white line-clamp-1 drop-shadow-md">
                                {{ $heroDocumentation ? $heroDocumentation->title : 'Studi Tour & Gathering Rombongan B2B Surabaya' }}
                            </p>
                        </div>
                    </div>

                    {{-- Mini Strip: Trust Points --}}
                    <div class="grid grid-cols-2 gap-2.5 text-center text-[11px] font-semibold text-slate-300 py-1">
                        <div class="bg-white/5 border border-white/10 rounded-xl py-2 px-3 flex items-center justify-center gap-1.5">
                            <span class="text-aw-gold">✓</span> <span>Dokumentasi Asli</span>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-xl py-2 px-3 flex items-center justify-center gap-1.5">
                            <span class="text-aw-gold">★</span> <span>Review B2B 5.0</span>
                        </div>
                    </div>

                    {{-- Action Button: Buka Dokumentasi & Galeri Foto --}}
                    <div class="pt-1">
                        <a href="{{ route('gallery.index') }}" 
                           class="w-full flex items-center justify-center gap-2.5 py-3 px-5 rounded-full bg-aw-gold/15 hover:bg-aw-gold/25 text-aw-gold border border-aw-gold/40 font-bold text-xs shadow-lg transition-all duration-300">
                            <span>Buka Dokumentasi &amp; Galeri Foto</span>
                            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>

        <!-- ===================================================================== -->
        <!-- FLOATING HERO SEARCH & FILTER WIDGET (Altesa Signature Widget) -->
        <!-- ===================================================================== -->
        <div class="mt-14 sm:mt-16 relative z-20">
            <div class="bg-white rounded-3xl sm:rounded-full p-3 sm:p-4 shadow-2xl shadow-black/15 border border-[#F5F0E8] text-aw-navy">
                <form action="{{ route('destinations.index') }}" method="GET" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                    
                    <!-- Search Input: Destinasi / Kata Kunci -->
                    <div class="flex-1 flex items-center gap-3 px-4 py-2 border-b sm:border-b-0 sm:border-r border-gray-100">
                        <div class="w-9 h-9 rounded-full bg-aw-gold/20 flex items-center justify-center text-aw-navy shrink-0">
                            <svg class="w-4 h-4 text-aw-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-wider">Destinasi</label>
                            <input type="text" name="search" placeholder="Cari kota / wisata (Bromo, Jogja, Bali...)" 
                                   class="w-full text-xs sm:text-sm font-semibold text-aw-navy placeholder-gray-400 bg-transparent border-none p-0 focus:ring-0 focus:outline-none">
                        </div>
                    </div>

                    <!-- Category / Pilar Layanan Dropdown -->
                    <div class="flex-1 flex items-center gap-3 px-4 py-2 border-b sm:border-b-0 sm:border-r border-gray-100">
                        <div class="w-9 h-9 rounded-full bg-aw-gold/20 flex items-center justify-center text-aw-navy shrink-0">
                            <svg class="w-4 h-4 text-aw-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-[10px] uppercase font-bold text-gray-400 tracking-wider">Tipe Layanan</label>
                            <select name="category" class="w-full text-xs sm:text-sm font-semibold text-aw-navy bg-transparent border-none p-0 focus:ring-0 focus:outline-none cursor-pointer">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- CTA Action Search Button -->
                    <div class="sm:shrink-0 p-1">
                        <button type="submit" 
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-aw-gold hover:bg-aw-gold-600 text-aw-navy font-bold px-6 py-3.5 rounded-full shadow-md shadow-aw-gold/25 transition-all text-xs sm:text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Eksplorasi Paket</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</section>


<!-- ========================================================================= -->
<!-- 2. CLIENT & INSTITUTION SHOWCASE BAR (Partner Resmi) -->
<!-- ========================================================================= -->
<section class="bg-[#FCFAF7] py-12 border-b border-[#F5F0E8]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-xs uppercase tracking-widest text-slate-400 font-semibold mb-6">
            Dipercaya Oleh Rombongan Institusi Pendidikan & Perusahaan Terkemuka
        </p>
        <div class="flex flex-wrap items-center justify-center gap-8 md:gap-14">
            @foreach($siteSettings->partners ?? [] as $partner)
                <span class="font-display font-bold text-lg text-slate-600 tracking-wide hover:text-aw-gold transition-colors">{{ $partner }}</span>
            @endforeach
        </div>
    </div>
</section>


<!-- ========================================================================= -->
<!-- 3. HIGHLIGHT 3 PILAR LAYANAN UTAMA -->
<!-- ========================================================================= -->
<section id="layanan" class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <span class="badge-altesa-peach">Solusi Spesialis Kami</span>
            <h2 class="font-display text-3xl sm:text-4xl font-bold text-aw-navy">
                3 Pilar Layanan Tour Rombongan
            </h2>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                Dirancang khusus dengan fleksibilitas jadwal, pilihan armada bus pariwisata premium, dan koordinasi tim lapangan yang profesional.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            @foreach($categories as $category)
                <div class="card-altesa p-8 flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-16 h-16 rounded-2xl bg-aw-gold/20 text-aw-navy flex items-center justify-center text-3xl shadow-sm group-hover:scale-110 transition-transform">
                            @if($category->slug === 'studi-tour')
                                🎓
                            @elseif($category->slug === 'capacity-building')
                                🏢
                            @else
                                👨‍👩‍👧‍👦
                            @endif
                        </div>
                        <h3 class="font-display font-bold text-2xl text-aw-navy group-hover:text-aw-gold transition-colors">
                            {{ $category->name }}
                        </h3>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                            {{ $category->description }}
                        </p>
                    </div>

                    <div class="pt-6 border-t border-[#F5F0E8] mt-6">
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
<!-- 4. FEATURED DESTINATIONS SHOWCASE (Destinasi Unggulan + Category Tabs) -->
<!-- ========================================================================= -->
<section id="destinasi" class="py-24 bg-[#FCFAF7] border-y border-[#F5F0E8] scroll-mt-20" x-data="{ selectedCategory: 'all' }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row items-start md:items-end justify-between mb-10 gap-6">
            <div>
                <span class="badge-altesa-peach">Pilihan Terfavorit</span>
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-aw-navy mt-2">Destinasi Tour Unggulan</h2>
            </div>
            
            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2">
                <button type="button" 
                        @click="selectedCategory = 'all'"
                        :class="selectedCategory === 'all' ? 'bg-aw-navy text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:border-aw-gold'"
                        class="px-4 py-2 rounded-full text-xs font-bold transition-all">
                    Semua
                </button>
                @foreach($categories as $cat)
                    <button type="button" 
                            @click="selectedCategory = '{{ $cat->slug }}'"
                            :class="selectedCategory === '{{ $cat->slug }}' ? 'bg-aw-navy text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:border-aw-gold'"
                            class="px-4 py-2 rounded-full text-xs font-bold transition-all">
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredDestinations as $destination)
                <div x-show="selectedCategory === 'all' || selectedCategory === '{{ $destination->category->slug }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="card-altesa overflow-hidden flex flex-col justify-between group">
                    
                    <div>
                        <!-- Header Visual -->
                        <div class="relative h-52 bg-slate-800 overflow-hidden">
                            @if($destination->cover_image)
                                <img src="{{ $destination->cover_image }}" alt="{{ $destination->name }}" class="absolute inset-0 h-full w-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            @endif
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#18181B]/85 via-transparent to-transparent z-10"></div>
                            
                            <!-- Category Badge -->
                            <span class="absolute top-3 left-3 z-20 badge-altesa-dark">
                                {{ $destination->category->name }}
                            </span>

                            <!-- Destination Name Overlay -->
                            <div class="absolute bottom-3 left-4 right-4 z-20">
                                <h3 class="font-display font-bold text-lg text-white group-hover:text-aw-gold transition-colors leading-tight">
                                    {{ $destination->name }}
                                </h3>
                                <p class="text-xs text-slate-300 flex items-center gap-1 mt-0.5">
                                    <span>📍</span> {{ $destination->location }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 space-y-3">
                            <p class="text-slate-600 text-xs line-clamp-2 leading-relaxed">
                                {{ $destination->short_description }}
                            </p>

                            <div class="pt-3 flex items-center justify-between text-xs border-t border-[#F5F0E8]">
                                <div>
                                    <span class="text-[10px] uppercase text-slate-400 block font-semibold">Mulai Dari</span>
                                    <span class="font-extrabold text-aw-gold-700 text-sm">{{ $destination->formatted_price }}</span>
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
                           class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-aw-navy text-xs font-semibold py-2.5 rounded-full transition-colors">
                            Detail Paket
                        </a>
                        <a href="{{ route('quotation.create') }}?destination_id={{ $destination->id }}" 
                           class="flex-1 text-center bg-aw-gold hover:bg-aw-gold-600 text-aw-navy text-xs font-bold py-2.5 rounded-full shadow-md shadow-aw-gold/20 transition-all">
                            Quotation
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('destinations.index') }}" 
               class="btn-altesa-outline">
                <span>Lihat Semua Destinasi Tour</span>
                <span>&rarr;</span>
            </a>
        </div>

    </div>
</section>


<!-- ========================================================================= -->
<!-- 4. INTERACTIVE AVAILABILITY CALENDAR BANNER -->
<!-- ========================================================================= -->
<section id="kalender" class="py-20 bg-[#18181B] text-white relative overflow-hidden scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-[#18181B] via-[#27272A] to-[#18181B] p-8 sm:p-12 rounded-3xl border border-white/10 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
            
            <div class="space-y-3 text-center md:text-left max-w-xl z-10">
                <div class="inline-flex items-center gap-2 bg-aw-gold/20 text-aw-gold text-xs font-semibold px-3.5 py-1 rounded-full border border-aw-gold/30">
                    <span class="w-2 h-2 rounded-full bg-aw-gold animate-pulse"></span>
                    <span>Interactive Calendar System</span>
                </div>
                <h2 class="font-display text-2xl sm:text-3xl font-bold">
                    Cek Ketersediaan Tanggal Tour Rombongan Anda
                </h2>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Pantau status jadwal secara *real-time*. Tanggal berwarna <strong class="text-rose-400">Merah (Fully Booked)</strong> dan <strong class="text-aw-gold">Emas (Tersedia)</strong>.
                </p>
            </div>

            <div class="z-10">
                <a href="{{ route('calendar.index') }}" 
                   class="btn-altesa-primary">
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
<!-- 7. HIGHLIGHT JADWAL OPEN TRIP (Lead Generator) -->
<!-- ========================================================================= -->
<section id="open-trip" class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-14">
            <span class="badge-altesa-peach">Jadwal Keberangkatan Terdekat</span>
            <h2 class="font-display text-3xl font-bold text-aw-navy">Open Trip Spesial AW Tour</h2>
            <p class="text-slate-600 text-xs sm:text-sm">
                Paket terbuka untuk umum dengan kuota terbatas. Cocok untuk individu atau kelompok kecil.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($openTrips as $trip)
                <div class="card-altesa p-6 flex flex-col justify-between">
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="badge-altesa-peach uppercase text-[11px]">
                                {{ $trip->status }}
                            </span>
                            <span class="text-xs text-slate-500 font-semibold">
                                {{ $trip->duration }}
                            </span>
                        </div>

                        <h3 class="font-display font-bold text-lg text-aw-navy">
                            {{ $trip->title }}
                        </h3>

                        <p class="text-xs text-slate-600 leading-relaxed">
                            {{ $trip->highlight }}
                        </p>

                        <div class="bg-[#FCFAF7] p-3.5 rounded-2xl border border-[#F5F0E8] space-y-2 text-xs">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Tanggal Berangkat:</span>
                                <span class="font-bold text-aw-navy">{{ $trip->departure_date->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Sisa Kuota:</span>
                                <span class="font-bold text-aw-gold-700">{{ $trip->available_slots }} / {{ $trip->quota }} Orang</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t border-[#F5F0E8] flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 block font-semibold uppercase">Harga per Orang</span>
                            <span class="font-extrabold text-aw-gold-700 text-base">Rp {{ number_format($trip->price_per_person, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('open-trips.show', $trip->id) }}" 
                           class="btn-altesa-dark !py-2 !px-4 !text-xs">
                            Detail Trip
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>


<!-- ========================================================================= -->
<!-- 6. VALUE PROPOSITION: "TENTANG KAMI" (Altesa Signature Section) -->
<!-- ========================================================================= -->
<section id="tentang" class="py-24 bg-[#FCFAF7] border-y border-[#F5F0E8] overflow-hidden scroll-mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- LEFT COLUMN: Feature Points -->
            <div class="lg:col-span-6 space-y-8">
                <div class="space-y-3">
                    <span class="badge-altesa-peach">Standar Kualitas Altesa</span>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold text-aw-navy">
                        Mengapa Mempercayakan Tour Rombongan Bersama Kami?
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        Kami mengerti bahwa membawa rombongan besar membutuhkan perencanaan matang, ketepatan waktu, dan kenyamanan peserta.
                    </p>
                </div>

                <div class="space-y-6">
                    <!-- Point 01 -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-aw-gold/20 text-aw-gold-700 font-display font-extrabold text-lg flex items-center justify-center shrink-0">
                            01
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-lg text-aw-navy">Kustomisasi Itinerary 100% Fleksibel</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                                Jadwal, rute, destinasi singgah, hingga menu makan siang disesuaikan penuh dengan preferensi dan budget panitia.
                            </p>
                        </div>
                    </div>

                    <!-- Point 02 -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-aw-gold/20 text-aw-gold-700 font-display font-extrabold text-lg flex items-center justify-center shrink-0">
                            02
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-lg text-aw-navy">Armada Bus Pariwisata Prima & Terawat</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                                Pilihan armada Big Bus (50 seats), Medium Bus (33 seats), hingga HiAce dengan standar keamanan berkendara resmi.
                            </p>
                        </div>
                    </div>

                    <!-- Point 03 -->
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-aw-gold/20 text-aw-gold-700 font-display font-extrabold text-lg flex items-center justify-center shrink-0">
                            03
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-lg text-aw-navy">Quotation Kilat & Estimasi Transparan</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 leading-relaxed">
                                Fitur Quotation Builder otomatis memudahkan panitia mendapatkan estimasi biaya rombongan dalam hitungan menit.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('quotation.create') }}" class="btn-altesa-primary">
                        <span>Coba Quotation Builder Sekarang</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- RIGHT COLUMN: Overlapping Visual Gallery + Floating Review Badge -->
            <div class="lg:col-span-6 relative">
                <div class="relative mx-auto max-w-md lg:max-w-none">
                    
                    <!-- Main Featured Image -->
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white aspect-[4/3]">
                        <img src="{{ asset('images/Bromo.jpg') }}" alt="Tour Rombongan AW Tour" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                    </div>

                    <!-- Floating Trust Badge 1 -->
                    <div class="absolute -bottom-6 -left-4 sm:left-4 bg-white rounded-2xl p-4 shadow-xl border border-gray-100 flex items-center gap-3.5 z-20">
                        <div class="w-10 h-10 rounded-xl bg-aw-gold/20 text-aw-gold-700 flex items-center justify-center text-xl font-bold">
                            ★
                        </div>
                        <div>
                            <p class="font-bold text-aw-navy text-sm">Rating 5.0 / 5.0</p>
                            <p class="text-[11px] text-gray-500">Dari 50+ Institusi B2B</p>
                        </div>
                    </div>

                    <!-- Floating Trust Badge 2 -->
                    <div class="absolute -top-6 -right-4 bg-[#18181B] text-white rounded-2xl p-4 shadow-xl border border-white/10 hidden sm:flex items-center gap-3 z-20">
                        <div class="w-9 h-9 rounded-xl bg-aw-gold text-aw-navy flex items-center justify-center text-sm font-bold">
                            ✓
                        </div>
                        <div>
                            <p class="font-bold text-xs">Official Operator</p>
                            <p class="text-[10px] text-aw-gold">Legalitas Lengkap Surabaya</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- ========================================================================= -->
<!-- 7. BOTTOM CTA BANNER (Konfirmasi Rombongan) -->
<!-- ========================================================================= -->
<section id="kontak" class="py-24 bg-[#18181B] text-white text-center relative overflow-hidden scroll-mt-20">
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-96 h-96 bg-aw-gold/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 relative z-10">
        <span class="badge-altesa-dark">Mulai Perjalanan Anda</span>
        <h2 class="font-display text-3xl sm:text-5xl font-extrabold text-white">
            Rencanakan Perjalanan Rombongan Anda Hari Ini
        </h2>
        <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
            Dapatkan penawaran harga terbaik (*quotation*) yang disesuaikan dengan anggaran, tanggal keberangkatan, dan jumlah peserta acara Anda.
        </p>
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('quotation.create') }}" 
               class="btn-altesa-primary w-full sm:w-auto !py-4 !px-8 text-sm">
                Mulai Custom Quotation Builder
            </a>
            <a href="{{ $siteSettings->whatsapp_url }}" 
               target="_blank" 
               rel="noopener"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-semibold px-8 py-4 rounded-full hover:border-aw-gold/50 backdrop-blur-md transition-all text-sm">
                <span>Chat Admin WA (+{{ $siteSettings->whatsapp_number }})</span>
            </a>
        </div>
    </div>
</section>

@endsection
