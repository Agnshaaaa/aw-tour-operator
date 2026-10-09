<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Executive Admin — AW Tour Operator</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full font-sans antialiased text-slate-100 bg-slate-950 flex items-center justify-center p-4">

    <div class="max-w-md w-full space-y-8" x-data="{ showPass: false }">
        
        {{-- BRAND LOGO & SECURITY HEADER --}}
        <div class="text-center space-y-3">
            <div class="inline-flex items-center justify-center p-3 rounded-2xl bg-aw-navy border border-slate-800 shadow-2xl">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="AW Tour" 
                     class="h-12 w-auto object-contain"
                     onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                <div class="hidden w-12 h-12 rounded-xl bg-aw-gold/20 border border-aw-gold/40 flex items-center justify-center text-aw-gold font-bold text-lg">
                    AW
                </div>
            </div>

            <div class="space-y-1">
                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-white tracking-wide">
                    Portal Executive Admin
                </h2>
                <p class="text-xs text-slate-400">
                    AW Tour Operator Surabaya — Executive Access Only
                </p>
            </div>

            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-500/10 border border-rose-500/30 text-rose-400 text-[11px] font-semibold">
                🔒 Area Akses Terbatas & Terenkripsi
            </div>
        </div>

        {{-- LOGIN CARD FORM --}}
        <div class="bg-aw-navy/90 rounded-3xl p-8 shadow-2xl border border-slate-800 space-y-6 backdrop-blur-md">
            
            {{-- Flash Alert Errors --}}
            @if($errors->any())
                <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs space-y-1">
                    <span class="font-bold block">Gagal Masuk:</span>
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 text-xs">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Email Input --}}
                <div class="space-y-1">
                    <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">
                        Email Administrator <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus
                               placeholder="admin@awtour.com" 
                               class="w-full rounded-xl bg-slate-900 border-slate-700 text-white placeholder-slate-500 text-xs py-3 px-4 focus:border-aw-gold focus:ring-aw-gold">
                    </div>
                </div>

                {{-- Password Input with Visibility Toggle --}}
                <div class="space-y-1">
                    <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">
                        Kata Sandi / Password <span class="text-rose-400">*</span>
                    </label>
                    <div class="relative">
                        <input id="password" 
                               :type="showPass ? 'text' : 'password'" 
                               name="password" 
                               required
                               placeholder="••••••••" 
                               class="w-full rounded-xl bg-slate-900 border-slate-700 text-white placeholder-slate-500 text-xs py-3 px-4 pr-10 focus:border-aw-gold focus:ring-aw-gold">
                        
                        <button type="button" 
                                @click="showPass = !showPass" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white text-xs">
                            <span x-text="showPass ? 'Sembunyikan' : 'Lihat'"></span>
                        </button>
                    </div>
                </div>

                {{-- Remember Me & Help --}}
                <div class="flex items-center justify-between text-xs text-slate-400">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded bg-slate-900 border-slate-700 text-aw-gold focus:ring-aw-gold">
                        <span>Ingat Saya di Perangkat Ini</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" 
                        class="w-full py-3.5 px-4 rounded-xl bg-aw-gold text-white font-bold text-xs hover:bg-amber-600 transition-all shadow-xl flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    <span>Masuk ke Executive Control Panel</span>
                </button>
            </form>



        </div>

        {{-- FOOTER BACK TO WEBSITE LINK --}}
        <div class="text-center">
            <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-aw-gold transition-colors inline-flex items-center gap-1">
                &larr; Kembali ke Halaman Utama Website Publik
            </a>
        </div>

    </div>

</body>
</html>
