@extends('layouts.admin')

@section('title', 'Dashboard Utama — Admin Control Panel AW Tour')
@section('page_title', 'Ringkasan Dashboard Utama')

@section('content')

{{-- STATS CARDS GRID --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    
    {{-- Total Permintaan --}}
    <div class="bg-[#0B0B0E]/60 backdrop-blur-md border border-white/[0.09] rounded-2xl p-5 shadow-xl flex items-center justify-between hover:border-sky-500/30 transition-all duration-200">
        <div class="space-y-1.5">
            <span class="text-xs text-zinc-400 font-semibold uppercase tracking-wider block">Total Quotations</span>
            <span class="text-3xl font-bold text-white block">{{ $stats['total_requests'] }}</span>
            <span class="text-xs text-zinc-400">Permintaan Rombongan</span>
        </div>
        <div class="w-14 h-14 rounded-xl bg-sky-500/10 text-sky-400 border border-sky-500/20 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
    </div>

    {{-- Pending Requests --}}
    <div class="bg-[#0B0B0E]/60 backdrop-blur-md border border-white/[0.09] rounded-2xl p-5 shadow-xl flex items-center justify-between hover:border-amber-500/30 transition-all duration-200">
        <div class="space-y-1.5">
            <span class="text-xs text-amber-400 font-semibold uppercase tracking-wider block">Perlu Ditinjau</span>
            <span class="text-3xl font-bold text-amber-400 block">{{ $stats['pending_requests'] }}</span>
            <span class="text-xs text-amber-300/70">Status Pending</span>
        </div>
        <div class="w-14 h-14 rounded-xl bg-amber-500/10 text-amber-400 border border-amber-500/20 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
    </div>

    {{-- Confirmed Bookings --}}
    <div class="bg-[#0B0B0E]/60 backdrop-blur-md border border-white/[0.09] rounded-2xl p-5 shadow-xl flex items-center justify-between hover:border-emerald-500/30 transition-all duration-200">
        <div class="space-y-1.5">
            <span class="text-xs text-emerald-400 font-semibold uppercase tracking-wider block">Dikonfirmasi DP</span>
            <span class="text-3xl font-bold text-emerald-400 block">{{ $stats['confirmed_requests'] }}</span>
            <span class="text-xs text-emerald-300/70">Siap Berangkat</span>
        </div>
        <div class="w-14 h-14 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
    </div>

    {{-- Konten publik --}}
    <div class="bg-[#0B0B0E]/60 backdrop-blur-md border border-white/[0.09] rounded-2xl p-5 shadow-xl flex items-center justify-between hover:border-indigo-500/30 transition-all duration-200">
        <div class="space-y-1.5">
            <span class="text-xs text-zinc-400 font-semibold uppercase tracking-wider block">Konten Website Aktif</span>
            <span class="text-2xl font-bold text-white block">
                {{ $stats['total_destinations'] }} <span class="text-xs font-normal text-zinc-400">Destinasi</span> / {{ $stats['total_transport'] }} <span class="text-xs font-normal text-zinc-400">Armada</span>
            </span>
            <span class="text-xs text-zinc-400">Tersedia di Website</span>
        </div>
        <div class="w-14 h-14 rounded-xl bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 flex items-center justify-center">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
    </div>

</div>

{{-- QUICK ACTION SHORTCUTS --}}
<div class="bg-[#0B0B0E]/50 backdrop-blur-md p-6 rounded-3xl border border-white/[0.09] shadow-lg space-y-5">
    <div class="flex items-center justify-between">
        <h3 class="font-serif text-base font-bold text-white">Quick Management Actions</h3>
        <span class="text-xs text-zinc-400">Akses cepat menu administratif</span>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-4">
        <a href="{{ route('admin.requests.index', ['status' => 'pending']) }}" class="p-5 rounded-2xl bg-[#121215]/50 backdrop-blur-md hover:bg-[#121215] hover:-translate-y-1 hover:shadow-lg hover:border-amber-500/30 border border-white/[0.09] transition-all duration-200 text-center space-y-3 group">
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-zinc-200 block">Tinjau Tiket Baru</span>
        </a>

        <a href="{{ route('admin.calendar.index') }}" class="p-5 rounded-2xl bg-[#121215]/50 backdrop-blur-md hover:bg-[#121215] hover:-translate-y-1 hover:shadow-lg hover:border-sky-500/30 border border-white/[0.09] transition-all duration-200 text-center space-y-3 group">
            <div class="w-12 h-12 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-zinc-200 block">Tambah Block Tanggal</span>
        </a>

        <a href="{{ route('admin.destinations.create') }}" class="p-5 rounded-2xl bg-[#121215]/50 backdrop-blur-md hover:bg-[#121215] hover:-translate-y-1 hover:shadow-lg hover:border-emerald-500/30 border border-white/[0.09] transition-all duration-200 text-center space-y-3 group">
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-zinc-200 block">Tambah Destinasi Wisata</span>
        </a>

        <a href="{{ route('admin.transports.create') }}" class="p-5 rounded-2xl bg-[#121215]/50 backdrop-blur-md hover:bg-[#121215] hover:-translate-y-1 hover:shadow-lg hover:border-violet-500/30 border border-white/[0.09] transition-all duration-200 text-center space-y-3 group">
            <div class="w-12 h-12 rounded-xl bg-violet-500/10 text-violet-400 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-zinc-200 block">Tambah / Kelola Armada</span>
        </a>

        <a href="{{ route('admin.site-settings.edit') }}" class="p-5 rounded-2xl bg-[#121215]/50 backdrop-blur-md hover:bg-[#121215] hover:-translate-y-1 hover:shadow-lg hover:border-blue-500/30 border border-white/[0.09] transition-all duration-200 text-center space-y-3 group">
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-zinc-200 block">Edit Profil & Kontak</span>
        </a>
    </div>
</div>

{{-- RECENT REQUESTS & UPCOMING BOOKED DATES --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- LEFT COLUMN: RECENT QUOTATIONS TABLE --}}
    <div class="lg:col-span-2 bg-[#0B0B0E]/90 rounded-3xl p-6 border border-white/[0.07] shadow-xl space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-serif text-lg font-bold text-white">Permintaan Quotation Terbaru</h3>
                <p class="text-xs text-zinc-400">5 Tiket quotation yang paling baru dikirim oleh calon klien</p>
            </div>
            <a href="{{ route('admin.requests.index') }}" class="text-xs font-bold text-aw-gold hover:underline">
                Lihat Semua Tiket →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left text-zinc-300">
                <thead class="bg-[#0B0B0E]/80 backdrop-blur-xl text-zinc-400 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="px-4 py-3 rounded-l-xl">No. Tiket</th>
                        <th class="px-4 py-3">Instansi / Klien</th>
                        <th class="px-4 py-3">Tgl Keberangkatan</th>
                        <th class="px-4 py-3">Pax</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right rounded-r-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5/80">
                    @forelse($recentRequests as $req)
                        <tr class="hover:bg-[#121215]/40 transition-colors">
                            <td class="px-4 py-3.5 font-bold text-aw-gold">
                                {{ $req->ticket_number }}
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="font-bold text-white block">{{ $req->institution_name }}</span>
                                <span class="text-[11px] text-zinc-400 block">{{ $req->client_name }} ({{ $req->phone }})</span>
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                {{ $req->event_date->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3.5 font-bold text-white">
                                {{ $req->pax }} orang
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                @if($req->status === 'pending')
                                    <span class="px-2.5 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[10px] font-bold uppercase">Pending</span>
                                @elseif($req->status === 'reviewed')
                                    <span class="px-2.5 py-1 rounded-full bg-blue-500/20 text-blue-300 border border-blue-500/30 text-[10px] font-bold uppercase">Ditinjau</span>
                                @elseif($req->status === 'quoted')
                                    <span class="px-2.5 py-1 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30 text-[10px] font-bold uppercase">Penawaran Dikirim</span>
                                @elseif($req->status === 'confirmed')
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[10px] font-bold uppercase">Confirmed DP</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/30 text-[10px] font-bold uppercase">Batal</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                <a href="{{ route('admin.requests.show', $req->id) }}" 
                                   class="px-3 py-1.5 rounded-lg bg-[#121215] hover:bg-aw-gold hover:text-slate-950 text-zinc-300 text-[11px] font-bold transition-all inline-block">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-zinc-500">
                                Belum ada permintaan quotation terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- RIGHT COLUMN: UPCOMING BOOKED DATES --}}
    <div class="lg:col-span-1 bg-[#0B0B0E]/90 rounded-3xl p-6 border border-white/[0.07] shadow-xl space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="font-serif text-lg font-bold text-white">Tanggal Terpesan Terdekat</h3>
            <a href="{{ route('admin.calendar.index') }}" class="text-xs font-bold text-aw-gold hover:underline">
                Kelola Kalender →
            </a>
        </div>

        <div class="space-y-3">
            @forelse($upcomingBookings as $bd)
                <div class="p-3.5 rounded-2xl bg-[#0B0B0E]/80 backdrop-blur-xl border border-white/[0.07] space-y-1">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-bold text-rose-400 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $bd->booked_date->format('d M Y') }}
                        </span>
                        <span class="text-[10px] text-zinc-400 bg-[#121215] px-2 py-0.5 rounded font-semibold">
                            Fully Booked
                        </span>
                    </div>
                    <p class="text-xs font-semibold text-zinc-200">
                        {{ $bd->label ?? 'Pemesanan Rombongan' }}
                    </p>
                </div>
            @empty
                <div class="p-6 text-center text-zinc-500 text-xs">
                    Belum ada tanggal terpesan di bulan mendatang.
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
