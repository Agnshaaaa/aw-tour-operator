@extends('layouts.app')

@section('title', 'Jadwal Open Trip Terjadwal — AW Tour Operator')
@section('meta_description', 'Ikuti paket Open Trip Surabaya, Bromo, Malang, Ijen & Jogja dengan tanggal pasti dan kuota terbatas. Fasilitas tour pimpinan pemandu berpengalaman.')

@section('content')
{{-- HERO BANNER --}}
<section class="bg-aw-navy text-white pt-12 pb-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D39252_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="inline-block px-4 py-1.5 rounded-full bg-aw-gold/20 text-aw-gold text-xs font-semibold uppercase tracking-wider border border-aw-gold/30">
                🚀 Fixed Schedule Open Trip
            </span>
            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
                Jadwal Keberangkatan Open Trip
            </h1>
            <p class="text-slate-300 text-base sm:text-lg leading-relaxed">
                Gabung bersama perjalanan wisata seru tanpa batas minimum peserta! Solusi ekonomis bagi individu, pasangan, atau kelompok kecil dengan fasilitas kelas pangeran.
            </p>

            {{-- Trust Badges --}}
            <div class="pt-4 flex flex-wrap items-center justify-center gap-6 text-xs sm:text-sm text-slate-300">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Pasti Berangkat</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <span>Penjemputan Surabaya & Malang</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Pemandu Wisata Licenced Tour Guide</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAIN OPEN TRIPS CATALOG --}}
<section class="py-12 bg-aw-cream/40 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($openTrips->isEmpty())
            <div class="bg-white rounded-3xl p-12 text-center max-w-lg mx-auto shadow-md border border-slate-100">
                <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-serif font-bold text-xl text-aw-navy mb-2">Belum Ada Jadwal Open Trip</h3>
                <p class="text-xs text-slate-500 mb-6">Saat ini belum ada kuota open trip publik yang dibuka. Ingin ajukan trip rombongan Anda sendiri?</p>
                <a href="{{ route('quotation.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-aw-gold text-white font-bold text-xs rounded-xl shadow-md">
                    <span>Buat Custom Trip Rombongan</span> &rarr;
                </a>
            </div>
        @else

            {{-- Open Trips Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($openTrips as $trip)
                    @php
                        $percentage = round(($trip->registered / $trip->quota) * 100);
                        $slotsLeft = $trip->available_slots;
                    @endphp

                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-slate-100 hover:shadow-2xl transition-all duration-300 flex flex-col group">
                        
                        {{-- Image & Quota Badge Container --}}
                        <div class="relative h-56 overflow-hidden bg-slate-200">
                            <img src="{{ $trip->destination->image_url ?? 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=800&q=80' }}" 
                                 alt="{{ $trip->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-black/20"></div>

                            {{-- Category Badge --}}
                            <div class="absolute top-4 left-4">
                                <span class="bg-aw-navy/90 backdrop-blur-md text-white text-[11px] font-bold px-3 py-1 rounded-full border border-white/20">
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
                                    <span class="bg-slate-800 text-slate-300 text-[11px] font-bold px-3 py-1 rounded-full shadow-md">
                                        FULL BOOKED
                                    </span>
                                @else
                                    <span class="bg-emerald-600 text-white text-[11px] font-bold px-3 py-1 rounded-full shadow-md">
                                        ✓ Kuota Terbuka
                                    </span>
                                @endif
                            </div>

                            {{-- Bottom Date Info on Image --}}
                            <div class="absolute bottom-3 left-4 right-4 text-white flex items-center justify-between text-xs">
                                <span class="font-bold flex items-center gap-1">
                                    <svg class="w-4 h-4 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $trip->departure_date->format('d M Y') }}
                                </span>
                                <span class="bg-white/20 backdrop-blur-sm px-2.5 py-0.5 rounded text-[11px] font-semibold">
                                    {{ $trip->duration }}
                                </span>
                            </div>
                        </div>

                        {{-- Card Content --}}
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                            
                            <div>
                                <h3 class="font-serif font-bold text-xl text-aw-navy group-hover:text-aw-gold transition-colors leading-snug mb-2">
                                    {{ $trip->title }}
                                </h3>
                                <p class="text-xs text-slate-600 line-clamp-2 leading-relaxed">
                                    {{ $trip->highlight ?? $trip->destination->description }}
                                </p>
                            </div>

                            {{-- Quota Tracker Progress Bar --}}
                            <div class="space-y-1.5 pt-2 border-t border-slate-100">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <span class="text-slate-500">Kuota Terisi:</span>
                                    <span class="text-aw-navy font-bold">{{ $trip->registered }} / {{ $trip->quota }} Orang</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-gradient-to-r from-aw-gold to-emerald-500 h-full rounded-full transition-all duration-500" 
                                         style="width: {{ min(100, $percentage) }}%"></div>
                                </div>
                            </div>

                            {{-- Price & CTA Footer --}}
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                                <div>
                                    <span class="text-[10px] text-slate-400 font-semibold block uppercase">Harga per pax</span>
                                    <span class="font-serif text-lg font-bold text-aw-navy">
                                        Rp {{ number_format($trip->price_per_person, 0, ',', '.') }}
                                    </span>
                                </div>

                                <a href="{{ route('open-trips.show', $trip->id) }}" 
                                   class="inline-flex items-center gap-1 px-5 py-2.5 rounded-xl bg-aw-navy text-white text-xs font-bold hover:bg-aw-gold transition-all shadow-md">
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
        <div class="mt-16 bg-gradient-to-r from-aw-navy via-aw-forest to-aw-navy rounded-3xl p-8 sm:p-10 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 w-96 h-96 bg-[radial-gradient(#D39252_2px,transparent_2px)] [background-size:20px_20px]"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="space-y-2 text-center md:text-left max-w-2xl">
                    <span class="text-xs font-bold text-aw-gold uppercase tracking-widest bg-white/10 px-3 py-1 rounded-full">
                        🏢 Layanan Rombongan B2B Kampus & Instansi
                    </span>
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold">Punya Rombongan Sendiri?</h3>
                    <p class="text-xs sm:text-sm text-slate-300">
                        Tidak cocok dengan tanggal Open Trip publik? Ajukan <span class="text-aw-gold font-semibold">Custom Group Quotation</span> untuk menentukan jadwal keberangkatan, armada bus, dan destinasi privat rombongan Anda!
                    </p>
                </div>

                <div class="shrink-0 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('quotation.create') }}" class="px-6 py-3.5 rounded-xl bg-aw-gold text-white font-bold text-xs hover:bg-amber-600 transition-all shadow-lg text-center">
                        ⚡ Buat Custom Quotation
                    </a>
                    <a href="https://wa.me/6282233119092?text=Halo%20Admin%20AW%20Tour,%20saya%20ingin%20tanya%20paket%20open%20trip%20dan%20rombongan" 
                       target="_blank" 
                       class="px-6 py-3.5 rounded-xl bg-emerald-600 text-white font-bold text-xs hover:bg-emerald-500 transition-all shadow-lg text-center flex items-center justify-center gap-2">
                        <span>Konsultasi WA</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
