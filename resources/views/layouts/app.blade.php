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
<body class="bg-[#F8F6F4] text-aw-navy font-sans antialiased selection:bg-aw-gold selection:text-white flex flex-col min-h-screen">

    <!-- ========================================================================= -->
    <!-- NAVBAR (Header Utama) -->
    <!-- ========================================================================= -->
    <nav x-data="{ open: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="scrolled ? 'bg-aw-navy/95 backdrop-blur-md shadow-xl py-3 border-b border-aw-sage/20' : 'bg-aw-navy py-5'"
         class="sticky top-0 z-50 transition-all duration-300">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                
                <!-- BRAND LOGO (Gambar Logo Utama AW Tour Operator) -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="AW Tour Operator Surabaya" 
                         class="h-10 w-auto object-contain group-hover:scale-105 transition-transform duration-300"
                         onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                    
                    {{-- Fallback Badge jika logo.png belum dimasukkan ke public/images/ --}}
                    <div class="hidden relative w-12 h-8 rounded-full bg-gradient-to-r from-[#00a3e0] via-[#0082b3] to-[#006286] flex items-center justify-center shadow-lg border border-[#80ee11]/40">
                        <span class="font-extrabold text-sm text-[#80ee11] tracking-tighter italic drop-shadow-[0_1px_2px_rgba(0,0,0,0.8)]">AW</span>
                    </div>

                    <div class="flex flex-col">
                        <span class="font-display font-bold text-xl text-white tracking-wide group-hover:text-aw-gold transition-colors">
                            AW TOUR
                        </span>
                        <span class="text-[10px] uppercase font-semibold tracking-widest text-aw-mint">
                            Surabaya Operator
                        </span>
                    </div>
                </a>

                <!-- DESKTOP NAVIGATION MENU -->
                <div class="hidden md:flex items-center gap-8 font-medium text-sm text-slate-200">
                    <a href="{{ route('home') }}" 
                       class="{{ request()->routeIs('home') ? 'text-aw-gold font-semibold' : 'hover:text-aw-gold' }} transition-colors py-1 relative">
                        Beranda
                        @if(request()->routeIs('home'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-aw-gold rounded-full"></span>
                        @endif
                    </a>
                    
                    <a href="{{ route('destinations.index') }}" 
                       class="{{ request()->routeIs('destinations.*') ? 'text-aw-gold font-semibold' : 'hover:text-aw-gold' }} transition-colors py-1 relative">
                        Destinasi Tour
                        @if(request()->routeIs('destinations.*'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-aw-gold rounded-full"></span>
                        @endif
                    </a>

                    <a href="{{ route('quotation.create') }}" 
                       class="{{ request()->routeIs('quotation.*') ? 'text-aw-gold font-semibold' : 'hover:text-aw-gold' }} transition-colors py-1 relative">
                        Quotation Builder
                        @if(request()->routeIs('quotation.*'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-aw-gold rounded-full"></span>
                        @endif
                    </a>

                    <a href="{{ route('calendar.index') }}" 
                       class="{{ request()->routeIs('calendar.*') ? 'text-aw-gold font-semibold' : 'hover:text-aw-gold' }} transition-colors py-1 relative">
                        Kalender Booking
                        @if(request()->routeIs('calendar.*'))
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-aw-gold rounded-full"></span>
                        @endif
                    </a>

                    <a href="{{ route('open-trips.index') }}" 
                       class="{{ request()->routeIs('open-trips.*') ? 'text-aw-gold font-semibold' : 'hover:text-aw-gold' }} transition-colors py-1 relative">
                        Open Trip
                    </a>

                    <a href="{{ route('umkm.index') }}" 
                       class="{{ request()->routeIs('umkm.*') ? 'text-aw-gold font-semibold' : 'hover:text-aw-gold' }} transition-colors py-1 relative">
                        Oleh-Oleh UMKM
                    </a>
                </div>

                <!-- CTA BUTTON (WHATSAPP ADMIN) -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="https://wa.me/6282233119092?text=Halo%20Admin%20AW%20Tour%20Surabaya,%20saya%20ingin%20konsultasi%20paket%20tour%20rombongan" 
                       target="_blank"
                       rel="noopener"
                       class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold px-4 py-2.5 rounded-full shadow-lg shadow-emerald-900/20 hover:scale-105 active:scale-95 transition-all">
                        <!-- Whatsapp Icon SVG -->
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                        </svg>
                        <span>Hubungi Admin WA</span>
                    </a>
                </div>

                <!-- MOBILE MENU BUTTON -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" 
                            type="button" 
                            class="p-2 rounded-lg text-slate-300 hover:text-white hover:bg-white/10 focus:outline-none"
                            aria-label="Toggle menu">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

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
            <a href="{{ route('umkm.index') }}" class="block px-3 py-2 rounded-md hover:bg-white/10 hover:text-aw-gold">Oleh-Oleh UMKM</a>
            <a href="https://wa.me/6282233119092" target="_blank" class="block text-center bg-emerald-600 text-white font-semibold py-2.5 rounded-lg shadow-md mt-4">
                Chat WhatsApp Admin (+62 822-3311-9092)
            </a>
        </div>
    </nav>


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
    <main class="flex-grow">
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
                        <span class="font-display font-bold text-xl text-white">AW TOUR</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Spesialis **Group Customized Tour Operator** di Surabaya. Melayani perjalanan rombongan Studi Tour Kampus/Sekolah, Capacity Building Perusahaan, dan Family Gathering dengan itinerary fleksibel.
                    </p>
                    <div class="pt-2 flex items-center gap-3 text-xs text-aw-gold font-semibold">
                        <span>📍 Surabaya, Jawa Timur</span>
                    </div>
                </div>

                <!-- KOLOM 2: LAYANAN UTAMA -->
                <div class="space-y-3">
                    <h3 class="font-display font-semibold text-white text-sm tracking-wider uppercase text-aw-gold">Layanan Rombongan</h3>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('destinations.index') }}?category=studi-tour" class="hover:text-aw-gold transition-colors">🎓 Studi Tour Kampus & Sekolah</a></li>
                        <li><a href="{{ route('destinations.index') }}?category=capacity-building" class="hover:text-aw-gold transition-colors">🏢 Capacity Building & Outbound</a></li>
                        <li><a href="{{ route('destinations.index') }}?category=family-gathering" class="hover:text-aw-gold transition-colors">👨‍👩‍👧‍👦 Family Gathering Perusahaan</a></li>
                        <li><a href="{{ route('quotation.create') }}" class="hover:text-aw-gold transition-colors">🧮 Custom Group Quotation Builder</a></li>
                        <li><a href="{{ route('open-trips.index') }}" class="hover:text-aw-gold transition-colors">🚌 Open Trip Spesial</a></li>
                    </ul>
                </div>

                <!-- KOLOM 3: PORTOFOLIO KLIEN -->
                <div class="space-y-3">
                    <h3 class="font-display font-semibold text-white text-sm tracking-wider uppercase text-aw-gold">Partner & Klien</h3>
                    <p class="text-xs text-slate-400">Dipercaya oleh institusi pendidikan dan instansi terkemuka:</p>
                    <div class="flex flex-wrap gap-2 pt-1 text-[11px] font-semibold">
                        <span class="bg-slate-800 text-slate-300 px-2.5 py-1 rounded-md border border-slate-700">ITS Surabaya</span>
                        <span class="bg-slate-800 text-slate-300 px-2.5 py-1 rounded-md border border-slate-700">UNAIR</span>
                        <span class="bg-slate-800 text-slate-300 px-2.5 py-1 rounded-md border border-slate-700">UNESA</span>
                        <span class="bg-slate-800 text-slate-300 px-2.5 py-1 rounded-md border border-slate-700">Instansi Swasta</span>
                        <span class="bg-slate-800 text-slate-300 px-2.5 py-1 rounded-md border border-slate-700">UMKM Jatim</span>
                    </div>
                </div>

                <!-- KOLOM 4: KONTAK ADMIN -->
                <div class="space-y-3">
                    <h3 class="font-display font-semibold text-white text-sm tracking-wider uppercase text-aw-gold">Kontak & Layanan Admin</h3>
                    <p class="text-xs text-slate-400">Hubungi tim konsultan tour kami untuk negosiasi kuotasi rombongan:</p>
                    <div class="space-y-2 text-xs">
                        <p class="flex items-center gap-2">
                            <span class="text-emerald-400">📱 WhatsApp Admin:</span>
                            <a href="https://wa.me/6282233119092" target="_blank" class="font-bold text-white hover:text-aw-gold">+62 822 3311 9092</a>
                        </p>
                        <p class="flex items-center gap-2 text-slate-400">
                            <span>🕒 Jam Operasional:</span>
                            <span>Senin - Sabtu (08.00 - 17.00 WIB)</span>
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('admin.login') }}" class="text-[11px] text-slate-500 hover:text-slate-300 underline">
                                Area Login Staff / Admin
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- COPYRIGHT -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} AW Tour Operator Surabaya. All rights reserved.</p>
                <p class="text-[11px]">Dikembangkan untuk Tugas Akhir D4 Manajemen Informatika</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
