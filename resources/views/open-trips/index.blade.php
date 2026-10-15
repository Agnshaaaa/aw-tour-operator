@extends('layouts.app')

@section('title', 'Jadwal Open Trip Terjadwal — AW Tour Operator')
@section('meta_description', 'Ikuti paket Open Trip Surabaya, Bromo, Malang, Ijen & Jogja dengan tanggal pasti dan kuota terbatas. Fasilitas tour pimpinan pemandu berpengalaman.')

@section('content')
{{-- HERO BANNER (Altesa Dark Warm Luxury) --}}
<section class="bg-[#18181B] text-white pt-28 pb-20 sm:pt-36 sm:pb-24 relative overflow-hidden border-b border-white/10">
    <div class="absolute -top-12 -right-12 w-64 h-64 bg-aw-gold/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="badge-altesa-dark">
                🚀 Fixed Schedule Open Trip
            </span>
            <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Jadwal Keberangkatan Open Trip
            </h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                Gabung bersama perjalanan wisata seru tanpa batas minimum peserta! Solusi ekonomis bagi individu, pasangan, atau kelompok kecil dengan fasilitas kelas pangeran.
            </p>

            {{-- Trust Badges --}}
            <div class="pt-6 flex flex-wrap items-center justify-center gap-6 text-xs sm:text-sm text-slate-300">
                <div class="flex items-center gap-2">
                    <span class="text-aw-gold font-bold">✓</span>
                    <span>Pasti Berangkat</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-aw-gold font-bold">📍</span>
                    <span>Penjemputan Surabaya & Malang</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-aw-gold font-bold">★</span>
                    <span>Pemandu Wisata Bersertifikat</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAIN OPEN TRIPS CATALOG --}}
<section class="py-16 bg-[#FCFAF7] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($openTrips->isEmpty())
            <div class="card-altesa p-12 text-center max-w-lg mx-auto space-y-4">
                <div class="w-16 h-16 bg-aw-gold/20 text-aw-gold-700 rounded-2xl flex items-center justify-center mx-auto mb-2 text-2xl font-bold">
                    📅
                </div>
                <h3 class="font-display font-bold text-xl text-aw-navy">Belum Ada Jadwal Open Trip</h3>
                <p class="text-xs text-slate-500 leading-relaxed">Saat ini belum ada kuota open trip publik yang dibuka. Ingin ajukan trip rombongan Anda sendiri?</p>
                <div class="pt-2">
                    <a href="{{ route('quotation.create') }}" class="btn-altesa-primary !text-xs !py-3 !px-6">
                        <span>Buat Custom Trip Rombongan</span> &rarr;
                    </a>
                </div>
            </div>
        @else

            {{-- Open Trips Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($openTrips as $trip)
                    @php
                        $percentage = round(($trip->registered / $trip->quota) * 100);
                        $slotsLeft = $trip->available_slots;
                    @endphp

                    <div class="card-altesa overflow-hidden flex flex-col justify-between group">
                        
                        {{-- Image & Quota Badge Container --}}
                        <div class="relative h-60 overflow-hidden bg-slate-900">
                            <img src="{{ $trip->destination->cover_image ?? 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=800&q=80' }}" 
                                 alt="{{ $trip->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            <div class="absolute inset-0 bg-gradient-to-t from-[#18181B]/85 via-transparent to-black/20"></div>

                            {{-- Location Badge --}}
                            <div class="absolute top-4 left-4">
                                <span class="badge-altesa-dark">
                                    📍 {{ $trip->destination->location }}
                                </span>
                            </div>

                            {{-- Quota / Availability Badge --}}
                            <div class="absolute top-4 right-4">
                                @if($slotsLeft <= 3 && $slotsLeft > 0)
                                    <span class="bg-rose-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md animate-pulse">
                                        🔥 Sisa {{ $slotsLeft }} Kursi!
                                    </span>
                                @elseif($slotsLeft == 0)
                                    <span class="bg-[#18181B] text-slate-300 text-[11px] font-bold px-3 py-1 rounded-full shadow-md border border-white/10">
                                        FULL BOOKED
                                    </span>
                                @else
                                    <span class="badge-altesa-peach font-bold shadow-md">
                                        ✓ Kuota Terbuka
                                    </span>
                                @endif
                            </div>

                            {{-- Bottom Date Info on Image --}}
                            <div class="absolute bottom-3 left-4 right-4 text-white flex items-center justify-between text-xs">
                                <span class="font-bold flex items-center gap-1.5 text-aw-gold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $trip->departure_date->format('d M Y') }}
                                </span>
                                <span class="bg-white/20 backdrop-blur-md px-2.5 py-0.5 rounded-full text-[10px] font-semibold">
                                    {{ $trip->duration }}
                                </span>
                            </div>
                        </div>

                        {{-- Card Content --}}
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            
                            <div>
                                <h3 class="font-display font-bold text-xl text-aw-navy group-hover:text-aw-gold transition-colors leading-snug mb-2">
                                    {{ $trip->title }}
                                </h3>
                                <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                                    {{ $trip->highlight ?? $trip->destination->description }}
                                </p>
                            </div>

                            {{-- Quota Tracker Progress Bar --}}
                            <div class="space-y-2 pt-3 border-t border-[#F5F0E8]">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <span class="text-slate-500">Kuota Terisi:</span>
                                    <span class="text-aw-navy font-bold">{{ $trip->registered }} / {{ $trip->quota }} Orang</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-aw-gold h-full rounded-full transition-all duration-500" 
                                         style="width: {{ min(100, $percentage) }}%"></div>
                                </div>
                            </div>

                            {{-- Price & CTA Footer --}}
                            <div class="pt-4 border-t border-[#F5F0E8] flex items-center justify-between gap-3">
                                <div>
                                    <span class="text-[10px] text-slate-400 font-semibold block uppercase">Harga per pax</span>
                                    <span class="font-display text-lg font-extrabold text-aw-gold-700">
                                        Rp {{ number_format($trip->price_per_person, 0, ',', '.') }}
                                    </span>
                                </div>

                                <a href="{{ route('open-trips.show', $trip->id) }}" 
                                   class="btn-altesa-dark !py-2.5 !px-5 !text-xs">
                                    <span>Detail Trip</span> &rarr;
                                </a>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Pagination Links --}}
            <div class="mt-8">
                {{ $openTrips->links() }}
            </div>

        @endif

        {{-- B2B Group Lead Generator Banner --}}
        <div class="mt-16 bg-[#18181B] rounded-3xl p-8 sm:p-12 text-white shadow-2xl relative overflow-hidden border border-white/10">
            <div class="absolute right-0 top-0 opacity-15 w-96 h-96 bg-aw-gold/20 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="space-y-3 text-center md:text-left max-w-2xl">
                    <span class="badge-altesa-dark">
                        Layanan Rombongan B2B Kampus &amp; Instansi
                    </span>
                    <h3 class="font-display text-2xl sm:text-3xl font-bold">Punya Rombongan Sendiri?</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Tidak cocok dengan tanggal Open Trip publik? Ajukan <span class="text-aw-gold font-semibold">Custom Group Quotation</span> untuk menentukan jadwal keberangkatan, armada bus, dan destinasi privat rombongan Anda!
                    </p>
                </div>

                <div class="shrink-0 flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="{{ route('quotation.create') }}" class="btn-altesa-primary !text-xs !py-3.5 !px-6 text-center">
                        ⚡ Buat Custom Quotation
                    </a>
                    <a href="{{ $siteSettings->whatsapp_url }}?text={{ urlencode('Halo Admin AW Tour, saya ingin tanya paket open trip dan rombongan') }}"
                       target="_blank" 
                       rel="noopener"
                       class="px-6 py-3.5 rounded-full bg-white/10 hover:bg-white/20 text-white font-bold text-xs border border-white/20 transition-all text-center flex items-center justify-center gap-2">
                        <span>Konsultasi WA</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
