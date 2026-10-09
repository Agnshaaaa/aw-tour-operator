<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard — AW Tour Operator')</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full font-sans antialiased text-slate-100 bg-slate-950 flex flex-col md:flex-row overflow-x-hidden" x-data="{ mobileNav: false }">

    {{-- MOBILE TOPBAR (Visible only on mobile/tablet < md) --}}
    <div class="md:hidden bg-aw-navy border-b border-slate-800 px-4 py-3 flex items-center justify-between sticky top-0 z-40">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.png') }}" 
                 alt="AW Tour" 
                 class="h-7 w-auto object-contain"
                 onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
            <div class="hidden w-7 h-7 rounded-lg bg-aw-gold/20 border border-aw-gold/40 flex items-center justify-center text-aw-gold font-bold text-xs">
                AW
            </div>
            <div class="flex flex-col">
                <span class="font-serif font-bold text-sm text-white tracking-wide leading-none">AW TOUR</span>
                <span class="text-[9px] text-aw-gold font-semibold uppercase tracking-widest leading-none mt-0.5">Admin Control</span>
            </div>
        </a>

        <button @click="mobileNav = true" 
                class="p-2 text-slate-400 hover:text-white hover:bg-slate-800/80 rounded-xl transition-colors focus:outline-none"
                aria-label="Buka Menu Admin">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- MOBILE BACKDROP OVERLAY --}}
    <div x-show="mobileNav" 
         x-cloak 
         @click="mobileNav = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 md:hidden"></div>

    {{-- SIDEBAR CONTAINER (Off-canvas drawer on mobile, static on desktop) --}}
    <aside class="fixed inset-y-0 left-0 z-50 w-72 md:w-64 bg-aw-navy border-r border-slate-800 flex flex-col justify-between transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:min-h-screen shrink-0"
           :class="mobileNav ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
        
        <div>
            {{-- SIDEBAR HEADER --}}
            <div class="p-5 border-b border-slate-800 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="AW Tour" 
                         class="h-8 w-auto object-contain"
                         onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                    <div class="hidden w-8 h-8 rounded-lg bg-aw-gold/20 border border-aw-gold/40 flex items-center justify-center text-aw-gold font-bold text-xs">
                        AW
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif font-bold text-base text-white tracking-wide">AW TOUR</span>
                        <span class="text-[10px] text-aw-gold font-semibold uppercase tracking-widest">Admin Control</span>
                    </div>
                </a>

                {{-- Close Button on Mobile Drawer --}}
                <button @click="mobileNav = false" class="md:hidden text-slate-400 hover:text-white p-1.5 rounded-lg hover:bg-slate-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- NAVIGATION LINKS --}}
            <nav class="p-4 space-y-1.5 text-xs font-medium">
                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-3 mb-2 pt-2">Menu Utama Admin</div>
                
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                   @click="mobileNav = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-aw-gold text-slate-950 font-bold shadow-lg shadow-aw-gold/20 ring-1 ring-aw-gold/50' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard Utama</span>
                </a>

                {{-- Permintaan Quotation --}}
                <a href="{{ route('admin.requests.index') }}" 
                   @click="mobileNav = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.requests.*') ? 'bg-aw-gold text-slate-950 font-bold shadow-lg shadow-aw-gold/20 ring-1 ring-aw-gold/50' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Permintaan Quotation</span>
                </a>

                {{-- Kalender Tanggal Terpesan --}}
                <a href="{{ route('admin.calendar.index') }}" 
                   @click="mobileNav = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.calendar.*') ? 'bg-aw-gold text-slate-950 font-bold shadow-lg shadow-aw-gold/20 ring-1 ring-aw-gold/50' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Kelola Tanggal Terpesan</span>
                </a>

                <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-3 mb-2 pt-4">Katalog & Produk</div>

                {{-- Destinasi Wisata --}}
                <a href="{{ route('admin.destinations.index') }}" 
                   @click="mobileNav = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.destinations.*') ? 'bg-aw-gold text-slate-950 font-bold shadow-lg shadow-aw-gold/20 ring-1 ring-aw-gold/50' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <span>Destinasi Wisata</span>
                </a>

                {{-- Armada & transportasi publik --}}
                <a href="{{ route('admin.transports.index') }}" 
                   @click="mobileNav = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.transports.*') ? 'bg-aw-gold text-slate-950 font-bold shadow-lg shadow-aw-gold/20 ring-1 ring-aw-gold/50' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span>Armada & Transportasi</span>
                </a>

                {{-- Dokumentasi & Galeri Foto --}}
                <a href="{{ route('admin.gallery.index') }}" 
                   @click="mobileNav = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.gallery.*') ? 'bg-aw-gold text-slate-950 font-bold shadow-lg shadow-aw-gold/20 ring-1 ring-aw-gold/50' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Dokumentasi & Galeri</span>
                </a>

                {{-- Profil perusahaan publik --}}
                <a href="{{ route('admin.site-settings.edit') }}"
                   @click="mobileNav = false"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.site-settings.*') ? 'bg-aw-gold text-slate-950 font-bold shadow-lg shadow-aw-gold/20 ring-1 ring-aw-gold/50' : 'text-slate-300 hover:bg-slate-800/80 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7l9-4 9 4v12a2 2 0 01-2 2zM9 21v-8h6v8"/></svg>
                    <span>Profil & Kontak Website</span>
                </a>

                <div class="pt-4 border-t border-slate-800/80 my-2"></div>

                {{-- Website Publik --}}
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-slate-400 hover:bg-slate-800/80 hover:text-white transition-all">
                    <span class="flex items-center gap-3">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        <span>Lihat Website Publik</span>
                    </span>
                    <span class="text-[10px] bg-slate-800/80 text-aw-mint px-2 py-0.5 rounded font-bold border border-slate-700">Live ↗</span>
                </a>
            </nav>
        </div>

        {{-- USER ADMIN PROFILE & LOGOUT FOOTER --}}
        <div class="p-4 border-t border-slate-800 bg-slate-950/80">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 rounded-xl bg-aw-gold/20 text-aw-gold flex items-center justify-center font-bold text-xs border border-aw-gold/40 shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        <span class="text-[10px] text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@awtour.com' }}</span>
                    </div>
                </div>

                {{-- Logout Button Form --}}
                <form action="{{ route('admin.logout') }}" method="POST" class="shrink-0">
                    @csrf
                    <button type="submit" 
                            title="Keluar / Logout" 
                            class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- MAIN CONTENT AREA --}}
    <main class="flex-1 min-w-0 bg-slate-950 overflow-y-auto flex flex-col justify-between">
        
        <div>
            {{-- TOP APPBAR HEADER (Desktop & Tablet) --}}
            <header class="bg-aw-navy/80 backdrop-blur-md border-b border-slate-800 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
                <div>
                    <h1 class="font-serif text-lg sm:text-xl font-bold text-white">
                        @yield('page_title', 'Admin Dashboard')
                    </h1>
                    <p class="text-xs text-slate-400">AW Tour Operator Surabaya — Executive Control Panel</p>
                </div>

                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="hidden sm:inline">Sistem Terlindungi</span>
                        <span class="sm:hidden">Admin</span>
                    </span>
                </div>
            </header>

            {{-- FLASH ALERTS --}}
            <div class="p-4 sm:p-6 pb-0 max-w-7xl mx-auto">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition 
                         class="p-4 mb-4 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs flex items-center justify-between shadow-lg">
                        <div class="flex items-center gap-2.5">
                            <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-300 font-bold flex items-center justify-center shrink-0">✓</span>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-400 hover:text-white p-1 rounded-lg">✕</button>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-transition 
                         class="p-4 mb-4 rounded-2xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs flex items-center justify-between shadow-lg">
                        <div class="flex items-center gap-2.5">
                            <span class="w-6 h-6 rounded-full bg-rose-500/20 text-rose-300 font-bold flex items-center justify-center shrink-0">!</span>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-rose-400 hover:text-white p-1 rounded-lg">✕</button>
                    </div>
                @endif

                @if($errors->any())
                    <div x-data="{ show: true }" x-show="show" x-transition 
                         class="p-4 mb-4 rounded-2xl bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs space-y-1.5 shadow-lg">
                        <div class="flex items-center justify-between font-bold">
                            <span class="flex items-center gap-2">
                                <span>⚠️</span>
                                <span>Terjadi kesalahan pada input data:</span>
                            </span>
                            <button @click="show = false" class="text-rose-400 hover:text-white p-1 rounded-lg">✕</button>
                        </div>
                        <ul class="list-disc pl-6 space-y-0.5 text-rose-200">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- PAGE CONTENT --}}
            <div class="p-4 sm:p-6 max-w-7xl mx-auto space-y-6">
                @yield('content')
            </div>
        </div>

        {{-- ADMIN FOOTER --}}
        <footer class="mt-8 border-t border-slate-800/80 px-6 py-4 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} AW Tour Operator Surabaya. Seluruh hak cipta dilindungi. Panel Eksekutif Administrator.
        </footer>

    </main>

    @stack('scripts')
</body>
</html>
