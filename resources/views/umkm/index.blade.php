@extends('layouts.app')

@section('title', 'Pilihan Transportasi — AW Tour Operator Surabaya')
@section('meta_description', 'Pilihan armada transportasi tour AW Tour Operator Surabaya: Hiace, Medium Bus, dan Big Bus. Informasi estimasi harga transparan untuk kebutuhan rombongan Anda.')

@section('content')
{{-- HERO BANNER --}}
<section class="bg-aw-navy text-white pt-12 pb-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D39252_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="inline-block px-4 py-1.5 rounded-full bg-aw-gold/20 text-aw-gold text-xs font-semibold uppercase tracking-wider border border-aw-gold/30">
                🚌 Katalog Transportasi Rombongan
            </span>
            <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
                Pilihan Transportasi
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Pilih kendaraan yang sesuai dengan kebutuhan perjalanan dan jumlah peserta Anda.
            </p>

            {{-- Trust & Value Pill Badges --}}
            <div class="pt-2 flex flex-wrap items-center justify-center gap-3 sm:gap-4 text-xs sm:text-sm text-slate-300">
                <div class="flex items-center gap-2 bg-white/10 px-3.5 py-1.5 rounded-full backdrop-blur-md border border-white/10">
                    <span>✨ Armada Bersih & Terawat</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-3.5 py-1.5 rounded-full backdrop-blur-md border border-white/10">
                    <span>👨‍✈️ Driver Profesional & Berpengalaman</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-3.5 py-1.5 rounded-full backdrop-blur-md border border-white/10">
                    <span>🧮 Penawaran Transparan</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAIN CONTENT SECTION --}}
<section class="py-12 bg-aw-cream/40 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- IMPORTANT PRICE DISCLAIMER BANNER --}}
        <div class="bg-amber-50 border border-amber-200/80 rounded-2xl p-4 sm:p-5 mb-10 shadow-sm flex items-start gap-3.5">
            <div class="w-9 h-9 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 text-lg font-bold">
                ℹ️
            </div>
            <div class="text-xs sm:text-sm text-amber-900 leading-relaxed space-y-1">
                <p class="font-bold text-amber-950">Keterangan Estimasi Harga:</p>
                <p>
                    Harga di atas merupakan informasi harga dasar/estimasi dan tetap dapat berubah tergantung tanggal perjalanan, rute, durasi, kebutuhan perjalanan, dan ketersediaan kendaraan.
                </p>
                <p class="font-semibold text-amber-800 pt-0.5">
                    "Harga dapat menyesuaikan tanggal, rute, durasi, dan ketersediaan armada."
                </p>
            </div>
        </div>

        {{-- 3 MAIN TRANSPORTATION CATEGORIES GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            
            {{-- CARD 1: HIACE --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-slate-200/80 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                {{-- Visual Image Container --}}
                <div class="relative h-56 bg-gradient-to-br from-slate-900 via-aw-navy to-slate-800 overflow-hidden flex items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-cover bg-center opacity-25 group-hover:scale-105 transition-transform duration-500" style="background-image: url('https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=800&q=80');"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    
                    {{-- Badge Capacity --}}
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-aw-gold text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md">
                            🚐 Rombongan Kecil
                        </span>
                    </div>

                    {{-- Center SVG Illustration & Name --}}
                    <div class="relative z-10 text-center space-y-2">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 17h8M8 17a2 2 0 11-4 0 2 2 0 014 0zm8 0a2 2 0 124 0 2 2 0 02-4 0zM3 9l2-4h10l2 4m-14 0h14m0 0v5a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            </svg>
                        </div>
                        <h3 class="font-display font-bold text-2xl text-white tracking-wide">Hiace</h3>
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between space-y-6">
                    <div class="space-y-3">
                        <h3 class="font-display font-bold text-xl text-aw-navy group-hover:text-aw-gold transition-colors">
                            Hiace
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Cocok untuk perjalanan rombongan kecil dan perjalanan yang lebih fleksibel.
                        </p>

                        {{-- Quick Features --}}
                        <div class="pt-2 flex flex-wrap gap-1.5 text-[11px] font-medium text-slate-500">
                            <span class="bg-slate-100 px-2.5 py-1 rounded-lg">Format Rombongan Kecil</span>
                            <span class="bg-slate-100 px-2.5 py-1 rounded-lg">Fleksibel & Nyaman</span>
                            <span class="bg-slate-100 px-2.5 py-1 rounded-lg">Full AC</span>
                        </div>
                    </div>

                    {{-- Price & CTA --}}
                    <div class="pt-4 border-t border-slate-100 space-y-4">
                        <div>
                            <span class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider block mb-0.5">Informasi Harga:</span>
                            <span class="font-display text-lg font-bold text-aw-gold block">
                                Mulai dari Rp1.000.000/hari
                            </span>
                        </div>

                        <a href="{{ route('quotation.create', ['transport' => 'HiAce / Elf Long (14-19 Seat)']) }}" 
                           class="w-full inline-flex items-center justify-center gap-2 bg-aw-navy hover:bg-aw-gold text-white font-bold text-xs sm:text-sm py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                            <span>Ajukan Quotation</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- CARD 2: MEDIUM BUS --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-slate-200/80 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                {{-- Visual Image Container --}}
                <div class="relative h-56 bg-gradient-to-br from-slate-900 via-aw-navy to-slate-800 overflow-hidden flex items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-cover bg-center opacity-25 group-hover:scale-105 transition-transform duration-500" style="background-image: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=800&q=80');"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    
                    {{-- Badge Capacity --}}
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-aw-gold text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md">
                            🚌 Rombongan Menengah
                        </span>
                    </div>

                    {{-- Center SVG Illustration & Name --}}
                    <div class="relative z-10 text-center space-y-2">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7h8m-8 4h8m-4 4h4m-12 3h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1zm3 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm10 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-display font-bold text-2xl text-white tracking-wide">Medium Bus</h3>
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between space-y-6">
                    <div class="space-y-3">
                        <h3 class="font-display font-bold text-xl text-aw-navy group-hover:text-aw-gold transition-colors">
                            Medium Bus
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Cocok untuk rombongan dengan jumlah peserta menengah.
                        </p>

                        {{-- Quick Features --}}
                        <div class="pt-2 flex flex-wrap gap-1.5 text-[11px] font-medium text-slate-500">
                            <span class="bg-slate-100 px-2.5 py-1 rounded-lg">Kapasitas Menengah</span>
                            <span class="bg-slate-100 px-2.5 py-1 rounded-lg">Full AC & Bagasi</span>
                            <span class="bg-slate-100 px-2.5 py-1 rounded-lg">Reclining Seat</span>
                        </div>
                    </div>

                    {{-- Price & CTA --}}
                    <div class="pt-4 border-t border-slate-100 space-y-4">
                        <div>
                            <span class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider block mb-0.5">Informasi Harga:</span>
                            <span class="font-display text-lg font-bold text-aw-gold block">
                                Rp2.500.000 – Rp3.000.000/hari
                            </span>
                        </div>

                        <a href="{{ route('quotation.create', ['transport' => 'Bus Medium (30-35 Seat)']) }}" 
                           class="w-full inline-flex items-center justify-center gap-2 bg-aw-navy hover:bg-aw-gold text-white font-bold text-xs sm:text-sm py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                            <span>Ajukan Quotation</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            {{-- CARD 3: BIG BUS --}}
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-slate-200/80 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                {{-- Visual Image Container --}}
                <div class="relative h-56 bg-gradient-to-br from-slate-900 via-aw-navy to-slate-800 overflow-hidden flex items-center justify-center p-6 text-white">
                    <div class="absolute inset-0 bg-cover bg-center opacity-25 group-hover:scale-105 transition-transform duration-500" style="background-image: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=800&q=80');"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    
                    {{-- Badge Capacity --}}
                    <div class="absolute top-4 left-4 z-10">
                        <span class="bg-aw-gold text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md">
                            🚍 Rombongan Besar
                        </span>
                    </div>

                    {{-- Center SVG Illustration & Name --}}
                    <div class="relative z-10 text-center space-y-2">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                            <svg class="w-10 h-10 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7h8m-8 4h8m-4 4h4m-12 3h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1zm3 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm10 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                            </svg>
                        </div>
                        <h3 class="font-display font-bold text-2xl text-white tracking-wide">Big Bus</h3>
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p-6 sm:p-7 flex-1 flex flex-col justify-between space-y-6">
                    <div class="space-y-3">
                        <h3 class="font-display font-bold text-xl text-aw-navy group-hover:text-aw-gold transition-colors">
                            Big Bus
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                            Cocok untuk rombongan besar.
                        </p>

                        {{-- Quick Features --}}
                        <div class="pt-2 flex flex-wrap gap-1.5 text-[11px] font-medium text-slate-500">
                            <span class="bg-slate-100 px-2.5 py-1 rounded-lg">Kapasitas Besar</span>
                            <span class="bg-slate-100 px-2.5 py-1 rounded-lg">Full AC & Multimedia</span>
                            <span class="bg-slate-100 px-2.5 py-1 rounded-lg">Bagasi Sangat Luas</span>
                        </div>
                    </div>

                    {{-- Price & CTA --}}
                    <div class="pt-4 border-t border-slate-100 space-y-4">
                        <div>
                            <span class="text-[11px] text-slate-400 font-semibold uppercase tracking-wider block mb-0.5">Informasi Harga:</span>
                            <span class="font-display text-lg font-bold text-aw-gold block">
                                Rp3.500.000 – Rp4.000.000/hari
                            </span>
                        </div>

                        <a href="{{ route('quotation.create', ['transport' => 'Bus Pariwisata Big (45-59 Seat)']) }}" 
                           class="w-full inline-flex items-center justify-center gap-2 bg-aw-navy hover:bg-aw-gold text-white font-bold text-xs sm:text-sm py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
                            <span>Ajukan Quotation</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- INFORMASI ARMADA SECTION --}}
        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-lg mb-16">
            <div class="max-w-3xl mx-auto">
                <div class="text-center space-y-2 mb-8">
                    <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">Varian Tipe Kendaraan</span>
                    <h2 class="font-display font-bold text-2xl text-aw-navy">Pilihan Armada</h2>
                    <p class="text-xs sm:text-sm text-slate-500">
                        Informasi jenis/tipe bodi armada yang tersedia dalam jaringan operasional kami:
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-xl mx-auto">
                    {{-- Jet Bus --}}
                    <div class="bg-aw-cream/40 border border-slate-200/90 rounded-2xl p-6 text-center space-y-2 hover:border-aw-gold/60 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-aw-navy text-aw-gold font-bold flex items-center justify-center mx-auto text-lg shadow-sm">
                            🚍
                        </div>
                        <h4 class="font-display font-bold text-lg text-aw-navy">Jet Bus</h4>
                        <div class="inline-block px-3.5 py-1 rounded-full bg-aw-gold/20 text-aw-gold text-xs font-extrabold border border-aw-gold/30">
                            5 unit
                        </div>
                        <p class="text-[11px] text-slate-500 pt-1">
                            Tipe bodi armada bus modern dengan kenyamanan kabin optimal.
                        </p>
                    </div>

                    {{-- SR --}}
                    <div class="bg-aw-cream/40 border border-slate-200/90 rounded-2xl p-6 text-center space-y-2 hover:border-aw-gold/60 transition-colors">
                        <div class="w-12 h-12 rounded-xl bg-aw-navy text-aw-gold font-bold flex items-center justify-center mx-auto text-lg shadow-sm">
                            🚌
                        </div>
                        <h4 class="font-display font-bold text-lg text-aw-navy">SR</h4>
                        <div class="inline-block px-3.5 py-1 rounded-full bg-aw-gold/20 text-aw-gold text-xs font-extrabold border border-aw-gold/30">
                            3 unit
                        </div>
                        <p class="text-[11px] text-slate-500 pt-1">
                            Tipe bodi armada bus dengan desain aerodinamis & pandangan luas.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALUR PROSES QUOTATION --}}
        <div class="bg-aw-navy text-white rounded-3xl p-8 sm:p-12 relative overflow-hidden shadow-xl mb-16">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D39252_1px,transparent_1px)] [background-size:16px_16px]"></div>
            <div class="relative z-10 max-w-4xl mx-auto">
                <div class="text-center space-y-2 mb-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">Alur Pemesanan</span>
                    <h2 class="font-display font-bold text-2xl sm:text-3xl text-white">Alur Pengajuan Quotation</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 text-center items-center">
                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-xl bg-aw-gold/20 text-aw-gold font-bold text-sm flex items-center justify-center mx-auto border border-aw-gold/30">
                            1
                        </div>
                        <h4 class="font-bold text-xs text-white">Pilih Jenis Kendaraan</h4>
                    </div>

                    <div class="hidden lg:block text-aw-gold text-xl">&rarr;</div>

                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-xl bg-aw-gold/20 text-aw-gold font-bold text-sm flex items-center justify-center mx-auto border border-aw-gold/30">
                            2
                        </div>
                        <h4 class="font-bold text-xs text-white">Ajukan Quotation</h4>
                    </div>

                    <div class="hidden lg:block text-aw-gold text-xl">&rarr;</div>

                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-xl bg-aw-gold/20 text-aw-gold font-bold text-sm flex items-center justify-center mx-auto border border-aw-gold/30">
                            3
                        </div>
                        <h4 class="font-bold text-xs text-white">Masuk Quotation Builder</h4>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-center items-center mt-6 pt-6 border-t border-white/10">
                    <div class="space-y-2 lg:col-start-1">
                        <div class="w-10 h-10 rounded-xl bg-aw-gold/20 text-aw-gold font-bold text-sm flex items-center justify-center mx-auto border border-aw-gold/30">
                            4
                        </div>
                        <h4 class="font-bold text-xs text-white">User Mengisi Kebutuhan Perjalanan</h4>
                    </div>

                    <div class="hidden lg:block text-aw-gold text-xl">&rarr;</div>

                    <div class="space-y-2">
                        <div class="w-10 h-10 rounded-xl bg-aw-gold/20 text-aw-gold font-bold text-sm flex items-center justify-center mx-auto border border-aw-gold/30">
                            5
                        </div>
                        <h4 class="font-bold text-xs text-white">AW TOUR Konfirmasi Harga Akhir</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- WHATSAPP CTA SECTION --}}
        <div class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-teal-900 text-white rounded-3xl p-8 sm:p-12 shadow-xl text-center relative overflow-hidden">
            <div class="max-w-2xl mx-auto space-y-5 relative z-10">
                <div class="w-16 h-16 rounded-full bg-emerald-700/60 border border-emerald-400/30 flex items-center justify-center mx-auto text-2xl shadow-inner">
                    💬
                </div>
                <h3 class="font-display font-bold text-2xl sm:text-3xl text-white">
                    Masih bingung memilih kendaraan?
                </h3>
                <p class="text-xs sm:text-sm text-emerald-100 leading-relaxed">
                    Hubungi AW TOUR untuk mendapatkan rekomendasi kendaraan sesuai jumlah peserta dan kebutuhan perjalanan Anda.
                </p>
                <div class="pt-2">
                    <a href="https://wa.me/6282233119092?text=Halo%20Admin%20AW%20Tour%20Surabaya,%20saya%20ingin%20konsultasi%20pilihan%20kendaraan%20transportasi" 
                       target="_blank"
                       rel="noopener"
                       class="inline-flex items-center gap-3 bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-sm px-8 py-4 rounded-2xl shadow-lg hover:scale-105 active:scale-95 transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                        </svg>
                        <span>Hubungi Admin WA</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
