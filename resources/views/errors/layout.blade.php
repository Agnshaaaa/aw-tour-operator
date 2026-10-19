<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Terjadi Kendala') — AW Tour Operator Surabaya</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'aw-navy': '#18181B',
                        'aw-gold': '#D4AF37',
                        'aw-coral': '#F5B990',
                        'aw-peach': '#FBECE3'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Playfair Display', 'serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#0F172A] text-slate-100 font-sans min-h-screen flex flex-col items-center justify-center p-4 selection:bg-amber-400 selection:text-slate-900">
    <div class="relative w-full max-w-xl mx-auto text-center py-12 px-6 sm:px-10 rounded-3xl bg-slate-900/80 border border-slate-800 shadow-2xl backdrop-blur-xl">
        <!-- Brand header -->
        <a href="/" class="inline-flex items-center gap-2.5 mb-8 group">
            <span class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-500 to-amber-300 text-slate-950 font-extrabold flex items-center justify-center shadow-md text-sm">
                AW
            </span>
            <div class="text-left">
                <span class="block font-display font-bold text-lg text-white group-hover:text-amber-400 transition-colors leading-tight">AW Tour Operator</span>
                <span class="block text-[10px] font-semibold tracking-wider text-amber-400 uppercase">Surabaya</span>
            </div>
        </a>

        <!-- Status code pill -->
        <div class="mb-5">
            <span class="inline-block px-4 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-amber-500/10 text-amber-400 border border-amber-500/30">
                Error @yield('code', '500')
            </span>
        </div>

        <!-- Heading -->
        <h1 class="font-display text-3xl sm:text-4xl font-bold text-white mb-4 leading-tight">
            @yield('headline', 'Terjadi Kendala Teknis')
        </h1>

        <!-- Description -->
        <p class="text-slate-400 text-sm sm:text-base leading-relaxed mb-8 max-w-md mx-auto">
            @yield('message', 'Halaman atau layanan yang Anda tuju sedang mengalami kendala atau tidak tersedia untuk saat ini.')
        </p>

        <!-- CTAs -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="/" class="w-full sm:w-auto px-6 py-2.5 rounded-full bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-lg shadow-amber-500/20">
                Kembali ke Beranda
            </a>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20AW%20Tour,%20saya%20mengalami%20kendala%20saat%20mengakses%20website" target="_blank" rel="noopener" class="w-full sm:w-auto px-6 py-2.5 rounded-full border border-slate-700 hover:border-slate-500 text-slate-300 hover:text-white font-medium text-xs tracking-wide transition-all">
                Hubungi Admin WhatsApp
            </a>
        </div>
    </div>

    <footer class="mt-8 text-center text-xs text-slate-500">
        &copy; {{ date('Y') }} AW Tour Operator Surabaya. Seluruh hak cipta dilindungi.
    </footer>
</body>
</html>
