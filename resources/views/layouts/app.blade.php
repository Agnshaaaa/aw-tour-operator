<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
<body class="bg-[#FCFAF7] text-aw-navy font-sans antialiased selection:bg-aw-gold selection:text-aw-navy flex flex-col min-h-screen">

    <!-- ========================================================================= -->
    <!-- NAVBAR (Header Utama Altesa Warm Luxury) -->
    <!-- ========================================================================= -->
    <nav x-data="{ 
            open: false, 
            scrolled: false, 
            trackModal: false, 
            ticketInput: '',
            scrollToSection(id) {
                const el = document.getElementById(id);
                if (el) {
                    if (window.lenis) {
                        window.lenis.scrollTo(el, { offset: -80 });
                    } else {
                        el.scrollIntoView({ behavior: 'smooth' });
                    }
                    this.open = false;
                } else {
                    window.location.href = '{{ route('home') }}#' + id;
                }
            }
         }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         :class="scrolled ? 'bg-[#18181B]/95 backdrop-blur-md shadow-xl py-3.5 border-b border-white/10' : 'bg-transparent py-5 sm:py-6 border-b border-transparent shadow-none'"
         class="fixed top-0 inset-x-0 z-50 transition-all duration-300">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex min-w-0 items-center justify-between gap-4">
                
                <!-- BRAND LOGO (AW Tour Operator - Ellipse Masked) -->
                <a href="{{ route('home') }}" class="flex min-w-0 shrink-0 items-center gap-2.5 sm:gap-3 group">
                    <div class="relative w-12 h-7 sm:w-14 sm:h-8 rounded-full overflow-hidden shrink-0 flex items-center justify-center bg-transparent shadow-sm">
                        <img src="{{ asset('images/logo.png') }}" 
                             alt="AW Tour Operator Surabaya" 
                             class="w-full h-full object-cover scale-[1.08] transition-transform duration-300 group-hover:scale-115"
                             onerror="this.parentElement.style.display='none'; this.parentElement.nextElementSibling.classList.remove('hidden');">
                    </div>
                    
                    {{-- Fallback Badge jika logo.png belum dimasukkan ke public/images/ --}}
                    <div class="hidden relative w-10 h-8 rounded-full bg-aw-gold text-aw-navy flex items-center justify-center shadow-lg border border-white/20 font-extrabold text-xs tracking-tight">
                        AW
                    </div>

                    <div class="flex flex-col">
                        <span class="font-display font-bold text-lg sm:text-xl text-white tracking-wide group-hover:text-aw-gold transition-colors leading-tight">
                            AW Tour
                        </span>
                        <span class="text-[9px] uppercase font-semibold tracking-wider text-aw-gold/90">
                            Surabaya Operator
                        </span>
                    </div>
                </a>

                <!-- DESKTOP NAVIGATION MENU (Clean & Minimalist In-Page Anchor without URL Hash) -->
                <div class="hidden min-w-0 flex-1 items-center justify-center gap-5 text-xs font-medium text-white/75 md:flex lg:gap-7 lg:text-sm">
                    <a href="{{ route('home') }}" @click.prevent="scrollToSection('beranda')" 
                       class="hover:text-white transition-colors cursor-pointer">
                        Beranda
                    </a>
                    
                    <a href="{{ route('home') }}" @click.prevent="scrollToSection('layanan')" 
                       class="hover:text-white transition-colors cursor-pointer">
                        Layanan
                    </a>

                    <a href="{{ route('home') }}" @click.prevent="scrollToSection('destinasi')" 
                       class="hover:text-white transition-colors cursor-pointer">
                        Destinasi
                    </a>

                    <a href="{{ route('home') }}" @click.prevent="scrollToSection('kalender')" 
                       class="hover:text-white transition-colors cursor-pointer">
                        Kalender
                    </a>

                    <a href="{{ route('home') }}" @click.prevent="scrollToSection('open-trip')" 
                       class="hover:text-white transition-colors cursor-pointer">
                        Open Trip
                    </a>

                    <a href="{{ route('home') }}" @click.prevent="scrollToSection('tentang')" 
                       class="hover:text-white transition-colors cursor-pointer">
                        Tentang Kami
                    </a>
                </div>

                <!-- CTA BUTTONS (Dual Pill: White Outline & Warm Peach Solid) -->
                <div class="hidden shrink-0 items-center gap-3 xl:flex">
                    <button @click="trackModal = true"
                            type="button"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-white/40 text-white/90 hover:text-white hover:border-white hover:bg-white/10 transition-all text-xs font-medium">
                        <svg class="w-3.5 h-3.5 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                        <span>Cek Status Tiket</span>
                    </button>

                    <a href="{{ $siteSettings->whatsapp_url }}?text={{ urlencode('Halo Admin AW Tour Surabaya, saya ingin konsultasi paket tour rombongan') }}" 
                       target="_blank"
                       rel="noopener"
                       class="inline-flex items-center gap-2 bg-[#F5B990] hover:bg-[#E89C62] text-[#1C1C1C] font-bold text-xs px-5 py-2 rounded-full shadow-sm hover:scale-[1.02] active:scale-95 transition-all">
                        <!-- Whatsapp Icon SVG -->
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                        </svg>
                        <span>Hubungi Admin WA</span>
                    </a>
                </div>

                <!-- MOBILE MENU BUTTON -->
                <div class="md:hidden flex items-center gap-2">
                    <button @click="trackModal = true" 
                            type="button" 
                            class="p-2 rounded-xl text-aw-gold border border-aw-gold/30 hover:bg-white/10"
                            title="Lacak Status Tiket">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </button>

                    <button @click="open = !open" 
                            type="button" 
                            class="p-2 rounded-xl text-white/80 hover:text-white hover:bg-white/10 focus:outline-none"
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
             class="md:hidden bg-[#18181B] border-b border-white/10 px-4 pt-3 pb-6 space-y-2 font-medium text-sm text-white/90 shadow-2xl">
            <a href="{{ route('home') }}" @click.prevent="scrollToSection('beranda')" class="block px-3 py-2 rounded-xl hover:bg-white/10 hover:text-aw-gold cursor-pointer">Beranda</a>
            <a href="{{ route('home') }}" @click.prevent="scrollToSection('layanan')" class="block px-3 py-2 rounded-xl hover:bg-white/10 hover:text-aw-gold cursor-pointer">Layanan Tour</a>
            <a href="{{ route('home') }}" @click.prevent="scrollToSection('destinasi')" class="block px-3 py-2 rounded-xl hover:bg-white/10 hover:text-aw-gold cursor-pointer">Destinasi Tour</a>
            <a href="{{ route('home') }}" @click.prevent="scrollToSection('kalender')" class="block px-3 py-2 rounded-xl hover:bg-white/10 hover:text-aw-gold cursor-pointer">Kalender Booking</a>
            <a href="{{ route('home') }}" @click.prevent="scrollToSection('open-trip')" class="block px-3 py-2 rounded-xl hover:bg-white/10 hover:text-aw-gold cursor-pointer">Open Trip</a>
            <a href="{{ route('home') }}" @click.prevent="scrollToSection('tentang')" class="block px-3 py-2 rounded-xl hover:bg-white/10 hover:text-aw-gold cursor-pointer">Tentang Kami</a>
            
            <button @click="trackModal = true; open = false" 
                    type="button" 
                    class="w-full text-left px-3.5 py-2.5 rounded-xl bg-white/5 border border-aw-gold/30 text-aw-gold hover:bg-aw-gold hover:text-aw-navy transition-all flex items-center justify-between font-semibold mt-2">
                <span>🎫 Lacak Tiket Permintaan</span>
                <span class="text-xs">&rarr;</span>
            </button>

            <a href="{{ $siteSettings->whatsapp_url }}" target="_blank" rel="noopener" class="block text-center bg-[#F5B990] text-[#1C1C1C] font-bold py-3 rounded-xl shadow-md mt-4">
                Chat WhatsApp Admin (+{{ $siteSettings->whatsapp_number }})
            </a>
        </div>

        <!-- MODAL POPUP: LACAK STATUS TIKET -->
        <div x-show="trackModal"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
             @click.self="trackModal = false">
            
            <div class="bg-[#FCFAF7] rounded-3xl shadow-2xl max-w-md w-full overflow-hidden border border-[#F5F0E8] text-aw-navy p-6 sm:p-7 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-[#EDE5D8]">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-aw-gold/20 text-aw-gold-600 flex items-center justify-center font-bold text-lg shrink-0">
                            🎫
                        </div>
                        <div>
                            <h3 class="font-display font-bold text-lg text-aw-navy">Lacak Status Tiket</h3>
                            <p class="text-xs text-aw-sage">Cek status pemrosesan paket tour rombongan Anda</p>
                        </div>
                    </div>
                    <button @click="trackModal = false" class="text-gray-400 hover:text-gray-700 p-1.5 rounded-xl hover:bg-black/5 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('quotation.track') }}" method="GET" class="space-y-4">
                    <div>
                        <label for="modal_ticket_number" class="block text-xs font-bold uppercase tracking-wider text-aw-navy mb-1.5">
                            Nomor Tiket Permintaan:
                        </label>
                        <div class="relative">
                            <input type="text"
                                   id="modal_ticket_number"
                                   name="ticket_number"
                                   x-model="ticketInput"
                                   placeholder="Contoh: AW-202610-0001"
                                   required
                                   class="w-full px-4 py-3 rounded-2xl border border-gray-200 text-sm font-mono uppercase tracking-wider focus:border-aw-gold focus:ring-aw-gold text-aw-navy bg-white">
                        </div>
                        <p class="text-[11px] text-aw-sage mt-1.5 leading-relaxed">
                            Nomor tiket tercantum pada halaman konfirmasi setelah pengajuan formulir quotation.
                        </p>
                    </div>

                    <div class="flex gap-2.5 pt-2">
                        <button type="button" @click="trackModal = false"
                                class="w-1/3 py-2.5 rounded-full border border-gray-200 text-gray-600 font-semibold text-xs hover:bg-gray-100 transition-all">
                            Tutup
                        </button>
                        <button type="submit"
                                class="w-2/3 py-2.5 rounded-full bg-aw-gold hover:bg-aw-gold-600 text-aw-navy font-bold text-xs shadow-md shadow-aw-gold/20 transition-all flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Cari Status Tiket</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>


    <!-- ========================================================================= -->
    <!-- NOTIFIKASI FLASH MESSAGE (SUKSES / ERROR) -->
    <!-- ========================================================================= -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4" role="alert">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-2xl shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center shrink-0 text-emerald-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4" role="alert">
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-2xl shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center shrink-0 text-rose-600">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
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
    <!-- FOOTER UTAMA (Altesa Dark Charcoal Warm Luxury) -->
    <!-- ========================================================================= -->
    <footer class="bg-[#18181B] text-slate-300 pt-16 pb-12 border-t border-white/5 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">
                
                <!-- KOLOM 1: PROFILE BRAND -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="relative w-12 h-7 rounded-full overflow-hidden shrink-0 flex items-center justify-center bg-transparent shadow-sm">
                            <img src="{{ asset('images/logo.png') }}" 
                                 alt="AW Tour Operator" 
                                 class="w-full h-full object-cover scale-[1.08]"
                                 onerror="this.parentElement.style.display='none'; this.parentElement.nextElementSibling.classList.remove('hidden');">
                        </div>

                        <div class="hidden w-10 h-8 rounded-full bg-aw-gold text-aw-navy flex items-center justify-center font-extrabold text-xs shadow-md">
                            AW
                        </div>
                        <span class="font-display font-bold text-xl text-white">{{ $siteSettings->company_name }}</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">{{ $siteSettings->profile_description }}</p>
                    <div class="pt-2 flex items-center gap-2 text-xs text-aw-gold font-semibold">
                        <span>📍 {{ $siteSettings->location }}</span>
                    </div>
                </div>

                <!-- KOLOM 2: LAYANAN UTAMA -->
                <div class="space-y-3">
                    <h3 class="font-display font-semibold text-white text-sm tracking-wider uppercase text-aw-gold">Layanan Rombongan</h3>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('destinations.index') }}?category=studi-tour" class="text-slate-400 hover:text-aw-gold transition-colors">🎓 Studi Tour Kampus & Sekolah</a></li>
                        <li><a href="{{ route('destinations.index') }}?category=capacity-building" class="text-slate-400 hover:text-aw-gold transition-colors">🏢 Capacity Building & Outbound</a></li>
                        <li><a href="{{ route('destinations.index') }}?category=family-gathering" class="text-slate-400 hover:text-aw-gold transition-colors">👨‍👩‍👧‍👦 Family Gathering Perusahaan</a></li>
                        <li><a href="{{ route('quotation.create') }}" class="text-slate-400 hover:text-aw-gold transition-colors">🧮 Custom Group Quotation Builder</a></li>
                        <li><a href="{{ route('open-trips.index') }}" class="text-slate-400 hover:text-aw-gold transition-colors">🚌 Open Trip Spesial</a></li>
                    </ul>
                </div>

                <!-- KOLOM 3: PORTOFOLIO KLIEN -->
                <div class="space-y-3">
                    <h3 class="font-display font-semibold text-white text-sm tracking-wider uppercase text-aw-gold">Partner & Klien</h3>
                    <p class="text-xs text-slate-400">Dipercaya oleh institusi pendidikan dan instansi terkemuka:</p>
                    <div class="flex flex-wrap gap-2 pt-1 text-[11px] font-semibold">
                        @foreach($siteSettings->partners ?? [] as $partner)
                            <span class="bg-white/5 text-slate-300 px-3 py-1 rounded-full border border-white/10">{{ $partner }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- KOLOM 4: KONTAK ADMIN -->
                <div class="space-y-3">
                    <h3 class="font-display font-semibold text-white text-sm tracking-wider uppercase text-aw-gold">Kontak & Layanan Admin</h3>
                    <p class="text-xs text-slate-400">Hubungi tim konsultan tour kami untuk negosiasi kuotasi rombongan:</p>
                    <div class="space-y-2.5 text-xs">
                        <p class="flex items-center gap-2">
                            <span class="text-aw-gold">📱 WhatsApp:</span>
                            <a href="{{ $siteSettings->whatsapp_url }}" target="_blank" rel="noopener" class="font-bold text-white hover:text-aw-gold transition-colors">+{{ $siteSettings->whatsapp_number }}</a>
                        </p>
                        @if($siteSettings->email)
                            <p class="flex items-center gap-2 text-slate-400">
                                <span>✉</span>
                                <a href="mailto:{{ $siteSettings->email }}" class="hover:text-aw-gold transition-colors">{{ $siteSettings->email }}</a>
                            </p>
                        @endif
                        <p class="flex items-center gap-2 text-slate-400">
                            <span>🕒 Jam Operasional:</span>
                            <span>{{ $siteSettings->operational_hours }}</span>
                        </p>
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
