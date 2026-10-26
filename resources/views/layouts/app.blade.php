<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'AW Tour Operator Surabaya')) — Custom Group Tour & Travel B2B</title>
    <meta name="description" content="@yield('meta_description', 'AW Tour Operator Surabaya — Spesialis Group Customized Tour untuk Kampus (ITS, UNAIR, UNESA), Sekolah, dan Perusahaan. Studi Tour, Capacity Building, Family Gathering.')">

    <!-- Google Fonts: Inter & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    <!-- Alpine.js untuk interaktivitas komponen Blade (Modal, Mobile Menu, Dropdown) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite Assets (Tailwind CSS & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-slate-950 text-aw-navy font-sans antialiased selection:bg-aw-gold selection:text-white flex flex-col min-h-screen">

    <!-- ========================================================================= -->
    <!-- NAVBAR (Header Utama - Floating Capsule Glassmorphism) -->
    <!-- ========================================================================= -->
@if(!request()->routeIs('open-trips.show'))
    <nav x-data="{ open: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         class="absolute top-0 left-0 right-0 z-50 transition-all duration-300 w-full bg-slate-900/40 backdrop-blur-xl border-b border-white/10 shadow-lg">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between gap-4">
            
            <!-- BRAND LOGO (Sebelah Kiri) -->
            <a href="{{ route('home') }}" class="flex min-w-0 shrink-0 items-center gap-2.5 group">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="AW Tour Operator Surabaya" 
                     class="block h-7 w-auto max-w-[4.5rem] shrink-0 object-contain sm:h-8 sm:max-w-[5.5rem]"
                     onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                
                <div class="hidden relative w-10 h-7 rounded-full bg-gradient-to-r from-[#00a3e0] to-[#006286] flex items-center justify-center shadow border border-[#80ee11]/40">
                    <span class="font-extrabold text-xs text-[#80ee11] italic">AW</span>
                </div>

                <div class="flex flex-col">
                    <span class="font-display font-bold text-base text-white tracking-wide group-hover:text-aw-gold transition-colors">
                        AW TOUR
                    </span>
                </div>
            </a>

            <!-- DESKTOP NAVIGATION CAPSULE (Tengah) -->
            <div class="hidden md:flex items-center gap-1 text-[11px] font-semibold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-[#1e293b]/70 backdrop-blur-md border border-white/10 shadow-lg shadow-black/20">
                <a href="{{ route('home') }}" 
                   class="{{ request()->routeIs('home') ? 'border border-[#2dd4bf] bg-[#1e3a47]/60 text-white font-bold' : 'text-slate-300 hover:text-white hover:bg-white/10' }} px-3.5 py-1 rounded-full transition-all">
                    Beranda
                </a>
                
                <a href="{{ route('destinations.index') }}" 
                   class="{{ request()->routeIs('destinations.*') ? 'border border-[#2dd4bf] bg-[#1e3a47]/60 text-white font-bold' : 'text-slate-300 hover:text-white hover:bg-white/10' }} px-3.5 py-1 rounded-full transition-all">
                    Destinasi
                </a>

                <a href="{{ route('quotation.create') }}" 
                   class="{{ request()->routeIs('quotation.*') ? 'border border-[#2dd4bf] bg-[#1e3a47]/60 text-white font-bold' : 'text-slate-300 hover:text-white hover:bg-white/10' }} px-3.5 py-1 rounded-full transition-all">
                    Quotation
                </a>

                <a href="{{ route('calendar.index') }}" 
                   class="{{ request()->routeIs('calendar.*') ? 'border border-[#2dd4bf] bg-[#1e3a47]/60 text-white font-bold' : 'text-slate-300 hover:text-white hover:bg-white/10' }} px-3.5 py-1 rounded-full transition-all">
                    Kalender
                </a>

                <a href="{{ route('open-trips.index') }}" 
                   class="{{ request()->routeIs('open-trips.*') ? 'border border-[#2dd4bf] bg-[#1e3a47]/60 text-white font-bold' : 'text-slate-300 hover:text-white hover:bg-white/10' }} px-3.5 py-1 rounded-full transition-all">
                    Open Trip
                </a>

                <a href="{{ route('transport.index') }}" 
                   class="{{ request()->routeIs('transport.*') ? 'border border-[#2dd4bf] bg-[#1e3a47]/60 text-white font-bold' : 'text-slate-300 hover:text-white hover:bg-white/10' }} px-3.5 py-1 rounded-full transition-all">
                    Transportasi
                </a>
            </div>

            <!-- CTA BUTTON WHATSAPP (Sebelah Kanan) -->
            <div class="hidden md:flex items-center shrink-0">
                <a href="{{ $siteSettings->whatsapp_url }}?text={{ urlencode('Halo Admin AW Tour Surabaya, saya ingin konsultasi paket tour rombongan') }}" 
                   target="_blank"
                   rel="noopener"
                   class="inline-flex items-center gap-1.5 bg-[#10b981] hover:bg-[#059669] text-slate-950 font-bold text-xs px-4 py-2 rounded-full shadow-md shadow-emerald-950/30 hover:scale-105 active:scale-95 transition-all">
                    <svg class="w-4 h-4 fill-slate-950" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                    </svg>
                    <span>Admin WA</span>
                </a>
            </div>

            <!-- MOBILE MENU BUTTON -->
            <div class="md:hidden flex items-center">
                <button @click="open = !open" 
                        type="button" 
                        class="p-2 rounded-xl text-white hover:bg-white/10 focus:outline-none transition-colors"
                        aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>

        <!-- MOBILE NAVIGATION DROPDOWN -->
        <div x-show="open" 
             x-cloak 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-aw-navy border-b border-aw-sage/20 px-4 pt-2 pb-6 space-y-3 font-medium text-sm text-slate-200">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-aw-gold">Beranda</a>
            <a href="{{ route('destinations.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-aw-gold">Destinasi Tour</a>
            <a href="{{ route('quotation.create') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-aw-gold">Quotation Builder</a>
            <a href="{{ route('calendar.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-aw-gold">Kalender Booking</a>
            <a href="{{ route('open-trips.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-aw-gold">Open Trip</a>
            <a href="{{ route('transport.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-aw-gold">Pilihan Transportasi</a>
            <a href="{{ $siteSettings->whatsapp_url }}" target="_blank" rel="noopener" class="block text-center bg-emerald-600 text-white font-semibold py-2.5 rounded-lg shadow-md mt-4">
                Chat WhatsApp Admin (+{{ $siteSettings->whatsapp_number }})
            </a>
        </div>
    </nav>
@endif


    <!-- ========================================================================= -->
    <!-- NOTIFIKASI FLASH MESSAGE (SUKSES / ERROR) -->
    <!-- ========================================================================= -->
    @if(session('success'))
        <div class="bg-emerald-700 text-white px-4 py-3 shadow-md" role="alert">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-rose-700 text-white px-4 py-3 shadow-md" role="alert">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span class="font-medium text-sm">{{ session('error') }}</span>
                </div>
            </div>
        </div>
    @endif


    <!-- ========================================================================= -->
    <!-- MAIN CONTENT AREA -->
    <!-- ========================================================================= -->
    <main class="flex-grow {{ request()->routeIs('quotation.*') ? 'pt-24 sm:pt-28' : '' }}">
        @yield('content')
    </main>


    <!-- ========================================================================= -->
    <!-- FOOTER UTAMA -->
    <!-- ========================================================================= -->
    <footer class="bg-aw-navy text-slate-300 pt-16 pb-12 border-t border-aw-sage/20 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800">
                
                <!-- KOLOM 1: PROFILE BRAND -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="AW Tour Operator" 
                             class="h-9 w-auto object-contain"
                             onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">

                        <div class="hidden w-10 h-7 rounded-full bg-gradient-to-r from-[#00a3e0] to-[#006286] flex items-center justify-center shadow-md border border-[#80ee11]/40">
                            <span class="font-extrabold text-xs text-[#80ee11] italic">AW</span>
                        </div>
                        <span class="font-display font-bold text-xl text-white">{{ $siteSettings->company_name }}</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">{{ $siteSettings->profile_description }}</p>
                    <div class="pt-2 flex items-center gap-2 text-xs text-aw-gold font-semibold">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <a href="https://www.google.com/maps/place/AW+Tour+Operator/@-7.2873077,112.7258961,17z/data=!3m1!4b1!4m6!3m5!1s0x2dd7fb6a5f844f55:0xd76884a5e4093480!8m2!3d-7.287313!4d112.728471!16s%2Fg%2F11z50nrw3y?entry=ttu&g_ep=EgoyMDI2MTAxMy4wIKXMDSoASAFQAw%3D%3D" target="_blank" rel="noopener" class="hover:underline hover:text-white transition-colors">
                            <span>{{ $siteSettings->location }}</span>
                        </a>
                    </div>
                    
                    <!-- Social Media Icons -->
                    <div class="pt-4 flex items-center gap-3">
                        <a href="https://www.instagram.com/awtouroperator/" target="_blank" rel="noopener" aria-label="Instagram" class="w-9 h-9 rounded-full bg-slate-800/80 border border-white/10 flex items-center justify-center text-slate-300 hover:text-emerald-400 hover:border-emerald-500/40 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                        <a href="https://www.facebook.com/awtour.awtop/" target="_blank" rel="noopener" aria-label="Facebook" class="w-9 h-9 rounded-full bg-slate-800/80 border border-white/10 flex items-center justify-center text-slate-300 hover:text-emerald-400 hover:border-emerald-500/40 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="https://www.tiktok.com/@awtouroperator" target="_blank" rel="noopener" aria-label="TikTok" class="w-9 h-9 rounded-full bg-slate-800/80 border border-white/10 flex items-center justify-center text-slate-300 hover:text-emerald-400 hover:border-emerald-500/40 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </a>
                        <a href="https://www.youtube.com/@awtouroperator" target="_blank" rel="noopener" aria-label="YouTube" class="w-9 h-9 rounded-full bg-slate-800/80 border border-white/10 flex items-center justify-center text-slate-300 hover:text-emerald-400 hover:border-emerald-500/40 transition-all">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- KOLOM 2: LAYANAN UTAMA -->
                <div class="space-y-3">
                    <h3 class="font-display font-semibold text-white text-sm tracking-wider uppercase text-aw-gold">Layanan Rombongan</h3>
                    <ul class="space-y-2 text-xs">
                        <li class="flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-slate-500 flex-shrink-0"></span>
                            <a href="{{ route('destinations.index') }}?category=studi-tour" class="hover:text-aw-gold transition-colors">Studi Tour Kampus & Sekolah</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-slate-500 flex-shrink-0"></span>
                            <a href="{{ route('destinations.index') }}?category=capacity-building" class="hover:text-aw-gold transition-colors">Capacity Building & Outbound</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-slate-500 flex-shrink-0"></span>
                            <a href="{{ route('destinations.index') }}?category=family-gathering" class="hover:text-aw-gold transition-colors">Family Gathering Perusahaan</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-slate-500 flex-shrink-0"></span>
                            <a href="{{ route('quotation.create') }}" class="hover:text-aw-gold transition-colors">Custom Group Quotation Builder</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1 h-1 rounded-full bg-slate-500 flex-shrink-0"></span>
                            <a href="{{ route('open-trips.index') }}" class="hover:text-aw-gold transition-colors">Open Trip Spesial</a>
                        </li>
                    </ul>
                </div>

                <!-- KOLOM 3: PORTOFOLIO KLIEN -->
                <div class="space-y-3">
                    <h3 class="font-display font-semibold text-white text-sm tracking-wider uppercase text-aw-gold">Partner & Klien</h3>
                    <p class="text-xs text-slate-400">Dipercaya oleh institusi pendidikan dan instansi terkemuka:</p>
                    <div class="flex flex-wrap gap-2 pt-1 text-[11px] font-semibold">
                        @foreach($siteSettings->partners ?? [] as $partner)
                            <span class="bg-slate-800 text-slate-300 px-2.5 py-1 rounded-md border border-slate-700">{{ $partner }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- KOLOM 4: KONTAK ADMIN -->
                <div class="space-y-3">
                    <h3 class="font-display font-semibold text-white text-sm tracking-wider uppercase text-aw-gold">Kontak & Layanan Admin</h3>
                    <p class="text-xs text-slate-400">Hubungi tim konsultan tour kami untuk negosiasi kuotasi rombongan:</p>
                    <div class="space-y-2 text-xs">
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                            </svg>
                            <span class="text-emerald-400">WhatsApp Admin:</span>
                            <a href="{{ $siteSettings->whatsapp_url }}" target="_blank" rel="noopener" class="font-bold text-white hover:text-aw-gold">+{{ $siteSettings->whatsapp_number }}</a>
                        </p>
                        @if($siteSettings->email)
                            <p class="flex items-center gap-2 text-slate-400">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <a href="mailto:{{ $siteSettings->email }}" class="hover:text-aw-gold">{{ $siteSettings->email }}</a>
                            </p>
                        @endif
                        <p class="flex items-center gap-2 text-slate-400">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Jam Operasional:</span>
                            <span>{{ $siteSettings->operational_hours }}</span>
                        </p>
                    </div>
                </div>

            </div>

            <!-- COPYRIGHT -->
            <div class="pt-8 flex items-center justify-center text-center text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} {{ $siteSettings->footer_text ?? 'AW Tour Operator Surabaya. All rights reserved.' }}</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
