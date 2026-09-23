@extends('layouts.app')

@section('title', $openTrip->title . ' — AW Tour Operator')
@section('meta_description', 'Detail jadwal Open Trip ' . $openTrip->title . ' tanggal ' . $openTrip->departure_date->format('d M Y') . '. Kuota terbatas, amankan slot keberangkatan Anda!')

@section('content')
{{-- BREADCRUMB & HEADER --}}
<div class="bg-aw-navy text-white pt-8 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex text-xs text-slate-300 mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-aw-gold transition-colors">Beranda</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2 text-slate-500">/</span>
                        <a href="{{ route('open-trips.index') }}" class="hover:text-aw-gold transition-colors">Open Trip</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="mx-2 text-slate-500">/</span>
                        <span class="text-aw-gold font-semibold truncate max-w-xs sm:max-w-md">{{ $openTrip->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- Header Title --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-2 max-w-3xl">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="bg-aw-gold text-white text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        📍 {{ $openTrip->destination->location }}
                    </span>
                    <span class="bg-white/10 text-slate-200 text-[11px] font-bold px-3 py-1 rounded-full border border-white/20">
                        {{ $openTrip->duration }}
                    </span>
                    @if($openTrip->available_slots <= 3 && $openTrip->available_slots > 0)
                        <span class="bg-rose-600 text-white text-[11px] font-bold px-3 py-1 rounded-full animate-pulse">
                            🔥 Sisa {{ $openTrip->available_slots }} Slot Lagi!
                        </span>
                    @endif
                </div>

                <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white leading-tight">
                    {{ $openTrip->title }}
                </h1>
                <p class="text-slate-300 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Jadwal Keberangkatan: <strong>{{ $openTrip->departure_date->format('d M Y') }}</strong> s/d <strong>{{ $openTrip->return_date->format('d M Y') }}</strong></span>
                </p>
            </div>

            {{-- Price Highlight Header --}}
            <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20 text-right shrink-0">
                <span class="text-xs text-slate-300 block">Biaya Investasi / Pax</span>
                <span class="font-serif text-2xl sm:text-3xl font-bold text-aw-gold">
                    Rp {{ number_format($openTrip->price_per_person, 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>
</div>

{{-- MAIN CONTENT & STICKY BOOKING SIDEBAR --}}
<section class="py-12 bg-aw-cream/40 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- LEFT COLUMN: CONTENT & ITINERARY --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Banner Image --}}
                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-slate-100 relative">
                    <img src="{{ $openTrip->destination->image_url ?? 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=1200&q=80' }}" 
                         alt="{{ $openTrip->title }}" 
                         class="w-full h-80 sm:h-96 object-cover">
                </div>

                {{-- Highlight Description --}}
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-md border border-slate-100 space-y-4">
                    <h2 class="font-serif text-xl font-bold text-aw-navy">Highlight & Ringkasan Trip</h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                        {{ $openTrip->highlight ?? $openTrip->destination->description }}
                    </p>

                    {{-- Quota Tracker Card --}}
                    @php
                        $percentage = round(($openTrip->registered / $openTrip->quota) * 100);
                    @endphp
                    <div class="mt-4 p-4 bg-slate-50 border border-slate-200 rounded-2xl space-y-2">
                        <div class="flex items-center justify-between text-xs font-semibold">
                            <span class="text-slate-700">Status Kuota Keberangkatan:</span>
                            <span class="text-aw-navy font-bold">{{ $openTrip->registered }} dari {{ $openTrip->quota }} Pax Terdaftar ({{ $percentage }}%)</span>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-aw-gold to-emerald-500 h-full rounded-full transition-all duration-500"
                                 style="width: {{ min(100, $percentage) }}%"></div>
                        </div>
                        <p class="text-[11px] text-slate-500">
                            *Setiap peserta mendapatkan seat bus pariwisata AC, snack & air mineral, serta pendampingan tour guide professional.
                        </p>
                    </div>
                </div>

                {{-- ITINERARY SECTION --}}
                @if($openTrip->destination && $openTrip->destination->detail && !empty($openTrip->destination->detail->itinerary_list))
                    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-md border border-slate-100 space-y-6">
                        <div class="flex items-center justify-between">
                            <h2 class="font-serif text-xl font-bold text-aw-navy">Rencana Perjalanan (Itinerary)</h2>
                            <span class="text-xs font-bold text-aw-gold uppercase tracking-wider">
                                {{ count($openTrip->destination->detail->itinerary_list) }} Hari Perjalanan
                            </span>
                        </div>

                        <div class="relative pl-6 border-l-2 border-aw-gold/30 space-y-8">
                            @foreach($openTrip->destination->detail->itinerary_list as $index => $item)
                                <div class="relative group">
                                    <span class="absolute -left-[31px] top-0 w-6 h-6 rounded-full bg-aw-navy text-white text-[11px] font-bold flex items-center justify-center border-2 border-white shadow-sm">
                                        {{ $index + 1 }}
                                    </span>
                                    <div class="space-y-1">
                                        <h3 class="font-serif font-bold text-aw-navy text-base">
                                            {{ $item['day'] ?? 'Hari ' . ($index + 1) }}: {{ $item['title'] ?? 'Kegiatan Wisata' }}
                                        </h3>
                                        <p class="text-xs text-slate-600 leading-relaxed">
                                            {{ $item['description'] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- INCLUSIONS & EXCLUSIONS --}}
                @if($openTrip->destination && $openTrip->destination->detail)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Inclusions --}}
                        <div class="bg-emerald-50/60 rounded-3xl p-6 border border-emerald-200/80 space-y-3">
                            <h3 class="font-serif font-bold text-emerald-900 text-base flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-bold">✓</span>
                                <span>Fasilitas Termasuk (Inclusions)</span>
                            </h3>
                            <ul class="text-xs text-emerald-800 space-y-2">
                                @if(!empty($openTrip->destination->detail->inclusions_list))
                                    @foreach($openTrip->destination->detail->inclusions_list as $inc)
                                        <li class="flex items-start gap-2">
                                            <span class="text-emerald-600 font-bold">•</span>
                                            <span>{{ $inc }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li>• Transportasi armada standar pariwisata AC</li>
                                    <li>• Tiket masuk seluruh objek wisata utama</li>
                                    <li>• Makan & Air mineral sesuai program</li>
                                    <li>• Tour Leader & Pemandu Wisata ramah</li>
                                @endif
                            </ul>
                        </div>

                        {{-- Exclusions --}}
                        <div class="bg-rose-50/60 rounded-3xl p-6 border border-rose-200/80 space-y-3">
                            <h3 class="font-serif font-bold text-rose-900 text-base flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-rose-600 text-white flex items-center justify-center text-xs font-bold">✕</span>
                                <span>Tidak Termasuk (Exclusions)</span>
                            </h3>
                            <ul class="text-xs text-rose-800 space-y-2">
                                @if(!empty($openTrip->destination->detail->exclusions_list))
                                    @foreach($openTrip->destination->detail->exclusions_list as $exc)
                                        <li class="flex items-start gap-2">
                                            <span class="text-rose-600 font-bold">•</span>
                                            <span>{{ $exc }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li>• Pengeluaran pribadi & wahana opsional</li>
                                    <li>• Tipping driver & tour leader (sukarela)</li>
                                    <li>• Asuransi kesehatan tambahan</li>
                                @endif
                            </ul>
                        </div>

                    </div>
                @endif

                {{-- Meeting Point Info --}}
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-md border border-slate-100 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-aw-navy/10 text-aw-navy flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-aw-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-serif font-bold text-aw-navy text-lg">Lokasi Titik Kumpul (Meeting Point)</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            {{ $openTrip->destination->detail->meeting_point ?? 'Stasiun Gubeng Surabaya / Rest Area Tol Malang (Dapat disesuaikan)' }}
                        </p>
                    </div>
                </div>

            </div>

            {{-- RIGHT COLUMN: STICKY BOOKING CARD --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-100 space-y-6"
                     x-data="{ 
                         pax: 1, 
                         name: '', 
                         phone: '',
                         pricePerPax: {{ $openTrip->price_per_person }},
                         get totalPrice() { return this.pax * this.pricePerPax; },
                         get waUrl() {
                             const text = `Halo Admin AW Tour Operator, saya ingin mendaftar Open Trip:\n\n` +
                                          `📌 *Trip:* {{ addslashes($openTrip->title) }}\n` +
                                          `📅 *Jadwal:* {{ $openTrip->departure_date->format('d M Y') }}\n` +
                                          `👤 *Nama:* ${encodeURIComponent(this.name || '-')}\n` +
                                          `📱 *No WA:* ${encodeURIComponent(this.phone || '-')}\n` +
                                          `👥 *Jumlah Peserta:* ${this.pax} orang\n` +
                                          `💰 *Total Estimasi:* Rp ${this.totalPrice.toLocaleString('id-ID')}`;
                             return `https://wa.me/6282233119092?text=${text}`;
                         }
                     }">

                    <div class="space-y-1 pb-4 border-b border-slate-100">
                        <span class="text-xs font-bold text-aw-gold uppercase tracking-wider">Form Pendaftaran Fast-Track</span>
                        <h3 class="font-serif text-xl font-bold text-aw-navy">Amankan Slot Kursi</h3>
                    </div>

                    {{-- Dynamic Price Box --}}
                    <div class="p-4 bg-aw-cream/40 rounded-2xl border border-aw-gold/30 space-y-2">
                        <div class="flex items-center justify-between text-xs text-slate-600">
                            <span>Harga / Orang:</span>
                            <span class="font-bold text-slate-800">Rp {{ number_format($openTrip->price_per_person, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm font-bold text-aw-navy pt-2 border-t border-slate-200">
                            <span>Total Tagihan:</span>
                            <span class="text-aw-gold font-serif text-lg" x-text="'Rp ' + totalPrice.toLocaleString('id-ID')"></span>
                        </div>
                    </div>

                    {{-- Form Inputs --}}
                    <div class="space-y-4 text-xs">
                        
                        <div>
                            <label class="block font-bold text-slate-700 uppercase mb-1">Nama Pendaftar <span class="text-rose-500">*</span></label>
                            <input type="text" x-model="name" placeholder="Contoh: Rizky Pratama"
                                   class="w-full rounded-xl border-slate-300 text-xs focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase mb-1">Nomor WhatsApp <span class="text-rose-500">*</span></label>
                            <input type="text" x-model="phone" placeholder="Contoh: 081234567890"
                                   class="w-full rounded-xl border-slate-300 text-xs focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase mb-1">Jumlah Peserta (Pax) <span class="text-rose-500">*</span></label>
                            <select x-model="pax" class="w-full rounded-xl border-slate-300 text-xs focus:border-aw-gold focus:ring-aw-gold">
                                @for($i = 1; $i <= max(1, $openTrip->available_slots); $i++)
                                    <option value="{{ $i }}">{{ $i }} Orang</option>
                                @endfor
                            </select>
                        </div>

                    </div>

                    {{-- WhatsApp Submit CTA --}}
                    @if($openTrip->available_slots > 0)
                        <a :href="waUrl" 
                           target="_blank" 
                           class="w-full py-3.5 px-4 rounded-xl bg-emerald-600 text-white font-extrabold text-xs hover:bg-emerald-500 transition-all text-center flex items-center justify-center gap-2 shadow-lg hover:scale-[1.02]">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                            <span>Daftar via WhatsApp Admin</span>
                        </a>
                    @else
                        <button disabled class="w-full py-3.5 px-4 rounded-xl bg-slate-300 text-slate-500 font-bold text-xs cursor-not-allowed text-center">
                            Mohon Maaf, Kuota Sudah Penuh (Full)
                        </button>
                    @endif

                    {{-- B2B Group Cross-sell --}}
                    <div class="pt-4 border-t border-slate-100 text-center space-y-2">
                        <p class="text-[11px] text-slate-500 leading-snug">
                            Ingin rombongan khusus kampus, sekolah, atau instansi dengan tanggal bebas?
                        </p>
                        <a href="{{ route('quotation.create', ['destination_id' => $openTrip->destination_id]) }}" 
                           class="inline-block text-xs font-bold text-aw-gold hover:underline">
                            Buat Custom Group Quotation →
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection
