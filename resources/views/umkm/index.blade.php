@extends('layouts.app')

@section('title', 'Etalase Souvenir & Oleh-Oleh UMKM Lokal — AW Tour Operator')
@section('meta_description', 'Katalog souvenir & oleh-oleh khas Jawa Timur produk UMKM lokal mitra AW Tour Operator. Tambahkan paket oleh-oleh untuk rombongan tour Anda.')

@section('content')
{{-- HERO BANNER --}}
<section class="bg-aw-navy text-white pt-12 pb-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D39252_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="inline-block px-4 py-1.5 rounded-full bg-aw-gold/20 text-aw-gold text-xs font-semibold uppercase tracking-wider border border-aw-gold/30">
                🎁 Program Pemberdayaan UMKM Lokal
            </span>
            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
                Etalase Souvenir & Oleh-Oleh UMKM
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Setiap perjalanan rombongan Anda menjadi berdampak! Pilih add-on oleh-oleh khas daerah hasil karya pengrajin UMKM Jawa Timur yang dapat langsung disiapkan dalam paket tour.
            </p>

            {{-- Trust & Value Pill Badges --}}
            <div class="pt-2 flex flex-wrap items-center justify-center gap-4 text-xs sm:text-sm text-slate-300">
                <div class="flex items-center gap-2 bg-white/10 px-3.5 py-1.5 rounded-full backdrop-blur-md border border-white/10">
                    <span>🛍️ 100% Produk Pengrajin Lokal</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-3.5 py-1.5 rounded-full backdrop-blur-md border border-white/10">
                    <span>📦 Siap Packing per Peserta Rombongan</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-3.5 py-1.5 rounded-full backdrop-blur-md border border-white/10">
                    <span>✨ Kualitas & Cita Rasa Autentik</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAIN PRODUCTS CATALOG --}}
<section class="py-12 bg-aw-cream/40 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Admin Customization Notice Banner --}}
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-8 flex items-center justify-between text-xs text-amber-900 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-amber-200 text-amber-900 flex items-center justify-center shrink-0 font-bold">💡</div>
                <p>
                    <strong>Katalog Dinamis:</strong> Pengelola / Admin dapat menambah, mengubah harga, atau menghapus produk souvenir UMKM sesuai kemauan melalui <strong>Panel Admin</strong>.
                </p>
            </div>
            <a href="{{ route('quotation.create') }}" class="shrink-0 hidden sm:inline-flex px-3.5 py-1.5 rounded-lg bg-aw-gold text-white font-bold hover:bg-amber-600 transition-colors">
                Pilih di Form Quotation
            </a>
        </div>

        @if($products->isEmpty())
            <div class="bg-white rounded-3xl p-12 text-center max-w-lg mx-auto shadow-md border border-slate-100">
                <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="font-serif font-bold text-xl text-aw-navy mb-2">Katalog Souvenir Belum Tersedia</h3>
                <p class="text-xs text-slate-500 mb-6">Produk UMKM akan segera diupdate oleh tim admin kami.</p>
                <a href="{{ route('quotation.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-aw-gold text-white font-bold text-xs rounded-xl shadow-md">
                    <span>Lanjut ke Quotation Tour</span> &rarr;
                </a>
            </div>
        @else

            {{-- Products Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($products as $product)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-slate-100 hover:shadow-2xl transition-all duration-300 flex flex-col group">
                        
                        {{-- Image / Visual Container --}}
                        <div class="relative h-52 bg-slate-100 overflow-hidden flex items-center justify-center p-4">
                            @if($product->image)
                                <img src="{{ $product->image }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                {{-- Placeholder visual icon for souvenir --}}
                                <div class="w-20 h-20 rounded-2xl bg-aw-gold/10 text-aw-gold flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm0 13C10.832 21 2 20 2 20V8.818c0-.448.243-.86.634-1.077l6.634-3.686A1.5 1.5 0 0110.768 4h2.464c.54 0 1.04.288 1.3.755l6.834 3.797c.39.217.634.629.634 1.077V20s-8.832 1-10 1z"/>
                                    </svg>
                                </div>
                            @endif

                            {{-- Producer Badge --}}
                            <div class="absolute top-4 left-4">
                                <span class="bg-aw-navy/90 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-full border border-white/20">
                                    🏪 {{ $product->producer }}
                                </span>
                            </div>
                        </div>

                        {{-- Card Content --}}
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="font-serif font-bold text-lg text-aw-navy group-hover:text-aw-gold transition-colors leading-snug mb-2">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed">
                                    {{ $product->description }}
                                </p>
                            </div>

                            {{-- Price & Action Buttons Footer --}}
                            <div class="pt-4 border-t border-slate-100 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-[11px] text-slate-400 font-semibold uppercase">Harga Satuan</span>
                                    <span class="font-serif text-base font-bold text-aw-gold">
                                        {{ $product->formatted_price }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 gap-2">
                                    <a href="{{ route('umkm.show', $product->slug) }}" 
                                       class="py-2.5 px-3 rounded-xl border border-slate-200 text-aw-navy text-xs font-bold hover:bg-slate-50 transition-all text-center">
                                        Detail Produk
                                    </a>
                                    
                                    <a href="{{ route('quotation.create') }}" 
                                       class="py-2.5 px-3 rounded-xl bg-aw-navy text-white text-xs font-bold hover:bg-aw-gold transition-all text-center shadow-md">
                                        Pilih Add-on
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Pagination Links --}}
            <div class="mt-8">
                {{ $products->links() }}
            </div>

        @endif

        {{-- Add-on Integration Explanation Banner --}}
        <div class="mt-16 bg-white rounded-3xl p-8 sm:p-10 border border-slate-100 shadow-xl grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-aw-gold/10 text-aw-gold flex items-center justify-center shrink-0">
                    <span class="text-xl font-bold">1</span>
                </div>
                <div>
                    <h4 class="font-serif font-bold text-aw-navy text-base mb-1">Pilih Produk Souvenir</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Pilih produk oleh-oleh khas yang Anda inginkan pada langkah 4 form Custom Quotation.
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-aw-navy/10 text-aw-navy flex items-center justify-center shrink-0">
                    <span class="text-xl font-bold">2</span>
                </div>
                <div>
                    <h4 class="font-serif font-bold text-aw-navy text-base mb-1">Pengemasan Khusus</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Tim AW Tour & mitra UMKM mengemas barang sesuai jumlah peserta rombongan secara rapi.
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                    <span class="text-xl font-bold">3</span>
                </div>
                <div>
                    <h4 class="font-serif font-bold text-aw-navy text-base mb-1">Serah Terima di Bus</h4>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Souvenir diserahterimakan langsung kepada kru tour sebelum keberangkatan atau saat pemulangan.
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
