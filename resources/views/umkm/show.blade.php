@extends('layouts.app')

@section('title', $product->name . ' — Oleh-Oleh UMKM AW Tour Operator')
@section('meta_description', $product->description)

@section('content')
{{-- BREADCRUMB BANNER --}}
<div class="bg-aw-navy text-white pt-8 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex text-xs text-slate-300 mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-aw-gold transition-colors">Beranda</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2 text-slate-500">/</span>
                        <a href="{{ route('umkm.index') }}" class="hover:text-aw-gold transition-colors">Etalase UMKM</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="mx-2 text-slate-500">/</span>
                        <span class="text-aw-gold font-semibold truncate max-w-xs sm:max-w-md">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2">
                <span class="bg-aw-gold text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    🏪 Produsen: {{ $product->producer }}
                </span>
                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">
                    {{ $product->name }}
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm">
                    Produk oleh-oleh lokal unggulan mitra AW Tour Operator Surabaya.
                </p>
            </div>

            <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20 text-right shrink-0">
                <span class="text-xs text-slate-300 block">Harga Satuan</span>
                <span class="font-serif text-2xl sm:text-3xl font-bold text-aw-gold">
                    {{ $product->formatted_price }}
                </span>
            </div>
        </div>
    </div>
</div>

{{-- MAIN CONTENT & ADD-ON BOX --}}
<section class="py-12 bg-aw-cream/40 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- LEFT COLUMN: PRODUCT DETAILS & PRODUCER --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Product Visual Card --}}
                <div class="bg-white rounded-3xl p-8 shadow-md border border-slate-100 flex items-center justify-center min-h-[250px] relative overflow-hidden">
                    @if($product->image)
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="max-h-80 object-contain rounded-2xl">
                    @else
                        <div class="text-center space-y-3">
                            <div class="w-24 h-24 rounded-3xl bg-aw-gold/10 text-aw-gold flex items-center justify-center mx-auto">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5a2 2 0 10-2 2h2zm0 13C10.832 21 2 20 2 20V8.818c0-.448.243-.86.634-1.077l6.634-3.686A1.5 1.5 0 0110.768 4h2.464c.54 0 1.04.288 1.3.755l6.834 3.797c.39.217.634.629.634 1.077V20s-8.832 1-10 1z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-slate-400 block">Foto Produk Autentik Mitra UMKM</span>
                        </div>
                    @endif
                </div>

                {{-- Description & Features --}}
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-md border border-slate-100 space-y-4">
                    <h2 class="font-serif text-xl font-bold text-aw-navy">Deskripsi & Keunggulan Produk</h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                        {{ $product->description }}
                    </p>

                    <div class="pt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 text-xs space-y-1">
                            <span class="font-bold text-aw-navy block">🏬 Produsen Mitra:</span>
                            <span class="text-slate-600 block">{{ $product->producer }}</span>
                        </div>

                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 text-xs space-y-1">
                            <span class="font-bold text-aw-navy block">📦 Satuan Kemasan:</span>
                            <span class="text-slate-600 block">Per {{ $product->unit }}</span>
                        </div>
                    </div>
                </div>

                {{-- Guarantee / Quality Assurance --}}
                <div class="bg-emerald-50/60 rounded-3xl p-6 border border-emerald-200/80 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center shrink-0 font-bold text-lg">
                        ✓
                    </div>
                    <div class="space-y-1 text-xs text-emerald-900">
                        <h3 class="font-serif font-bold text-sm">Jaminan Kualitas & Kesegaran Produk</h3>
                        <p class="leading-relaxed">
                            Seluruh barang diproduksi langsung oleh mitra UMKM sesaat sebelum tanggal keberangkatan rombongan Anda untuk memastikan kesegaran (*freshness*) dan masa kadaluarsa yang maksimal.
                        </p>
                    </div>
                </div>

            </div>

            {{-- RIGHT COLUMN: STICKY ADD-ON ACTION BOX --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-100 space-y-6"
                     x-data="{ 
                         qty: 30, 
                         unitPrice: {{ $product->price }},
                         get total() { return this.qty * this.unitPrice; }
                     }">
                    
                    <div class="space-y-1 pb-4 border-b border-slate-100">
                        <span class="text-xs font-bold text-aw-gold uppercase tracking-wider">Simulasi Add-on Trip</span>
                        <h3 class="font-serif text-xl font-bold text-aw-navy">Tambah ke Quotation</h3>
                    </div>

                    {{-- Estimator Box --}}
                    <div class="p-4 bg-aw-cream/40 rounded-2xl border border-aw-gold/30 space-y-3">
                        <div class="flex items-center justify-between text-xs text-slate-600">
                            <span>Harga Satuan:</span>
                            <span class="font-bold text-slate-800">Rp {{ number_format($product->price, 0, ',', '.') }} / {{ $product->unit }}</span>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Simulasi Jumlah Rombongan</label>
                            <input type="number" x-model="qty" min="1" class="w-full rounded-xl border-slate-300 text-xs text-center font-bold focus:ring-aw-gold">
                        </div>

                        <div class="flex items-center justify-between text-sm font-bold text-aw-navy pt-2 border-t border-slate-200">
                            <span>Estimasi Subtotal:</span>
                            <span class="text-aw-gold font-serif text-lg" x-text="'Rp ' + total.toLocaleString('id-ID')"></span>
                        </div>
                    </div>

                    {{-- Action CTA Buttons --}}
                    <div class="space-y-3">
                        <a href="{{ route('quotation.create') }}" 
                           class="w-full py-3.5 px-4 rounded-xl bg-aw-navy text-white font-bold text-xs hover:bg-aw-gold transition-all text-center flex items-center justify-center gap-2 shadow-lg">
                            <span>⚡ Buat Quotation Rombongan</span>
                        </a>

                        <a :href="'https://wa.me/6282233119092?text=Halo%20Admin%20AW%20Tour,%20saya%20ingin%20tanya%20pemesanan%20produk%20UMKM:%20{{ urlencode($product->name) }}%20sebanyak%20' + qty + '%20{{ $product->unit }}'" 
                           target="_blank" 
                           class="w-full py-3 px-4 rounded-xl bg-emerald-600 text-white font-bold text-xs hover:bg-emerald-500 transition-all text-center flex items-center justify-center gap-2 shadow-md">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                            <span>Tanya via WhatsApp</span>
                        </a>
                    </div>

                    {{-- Admin Note --}}
                    <div class="pt-4 border-t border-slate-100 text-center">
                        <p class="text-[11px] text-slate-400">
                            *Produk ini dapat dikelola (tambah/edit/hapus) kapan saja dari Panel Admin.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
