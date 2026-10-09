@extends('layouts.admin')

@section('title', 'Dashboard Utama — Admin Control Panel AW Tour')
@section('page_title', 'Ringkasan Dashboard Utama')

@section('content')

{{-- STATS CARDS GRID --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    
    {{-- Total Permintaan --}}
    <div class="bg-aw-navy/90 p-6 rounded-3xl border border-slate-800 shadow-xl flex items-center justify-between">
        <div class="space-y-1">
            <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">Total Quotations</span>
            <span class="font-serif text-3xl font-bold text-white block">{{ $stats['total_requests'] }}</span>
            <span class="text-[11px] text-slate-400">Permintaan Rombongan</span>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-aw-gold/20 text-aw-gold flex items-center justify-center font-bold text-xl border border-aw-gold/30">
            📑
        </div>
    </div>

    {{-- Pending Requests --}}
    <div class="bg-aw-navy/90 p-6 rounded-3xl border border-slate-800 shadow-xl flex items-center justify-between">
        <div class="space-y-1">
            <span class="text-xs text-amber-400 font-semibold uppercase tracking-wider block">Perlu Ditinjau</span>
            <span class="font-serif text-3xl font-bold text-amber-400 block">{{ $stats['pending_requests'] }}</span>
            <span class="text-[11px] text-amber-300/70">Status Pending</span>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold text-xl border border-amber-500/30">
            ⏳
        </div>
    </div>

    {{-- Confirmed Bookings --}}
    <div class="bg-aw-navy/90 p-6 rounded-3xl border border-slate-800 shadow-xl flex items-center justify-between">
        <div class="space-y-1">
            <span class="text-xs text-emerald-400 font-semibold uppercase tracking-wider block">Dikonfirmasi DP</span>
            <span class="font-serif text-3xl font-bold text-emerald-400 block">{{ $stats['confirmed_requests'] }}</span>
            <span class="text-[11px] text-emerald-300/70">Siap Berangkat</span>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xl border border-emerald-500/30">
            ✓
        </div>
    </div>

    {{-- Konten publik --}}
    <div class="bg-aw-navy/90 p-6 rounded-3xl border border-slate-800 shadow-xl flex items-center justify-between">
        <div class="space-y-1">
            <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider block">Konten Website Aktif</span>
            <span class="font-serif text-2xl font-bold text-white block">
                {{ $stats['total_destinations'] }} <span class="text-xs font-normal text-slate-400">Destinasi</span> / {{ $stats['total_transport'] }} <span class="text-xs font-normal text-slate-400">Armada</span>
            </span>
            <span class="text-[11px] text-slate-400">Tersedia di Website</span>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-slate-800 text-slate-300 flex items-center justify-center font-bold text-xl border border-slate-700">
            🏖️
        </div>
    </div>

</div>

{{-- QUICK ACTION SHORTCUTS --}}
<div class="bg-slate-900 p-6 rounded-3xl border border-slate-800 shadow-lg space-y-4">
    <div class="flex items-center justify-between">
        <h3 class="font-serif text-base font-bold text-white">Quick Management Actions</h3>
        <span class="text-xs text-slate-400">Akses cepat menu administratif</span>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-4">
        <a href="{{ route('admin.requests.index', ['status' => 'pending']) }}" class="p-4 rounded-2xl bg-aw-navy hover:bg-slate-800 border border-slate-800 transition-all text-center space-y-2 group">
            <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center mx-auto text-lg group-hover:scale-110 transition-transform">
                📩
            </div>
            <span class="text-xs font-bold text-slate-200 block">Tinjau Tiket Baru</span>
        </a>

        <a href="{{ route('admin.calendar.index') }}" class="p-4 rounded-2xl bg-aw-navy hover:bg-slate-800 border border-slate-800 transition-all text-center space-y-2 group">
            <div class="w-10 h-10 rounded-xl bg-aw-gold/20 text-aw-gold flex items-center justify-center mx-auto text-lg group-hover:scale-110 transition-transform">
                📅
            </div>
            <span class="text-xs font-bold text-slate-200 block">Tambah Block Tanggal</span>
        </a>

        <a href="{{ route('admin.destinations.create') }}" class="p-4 rounded-2xl bg-aw-navy hover:bg-slate-800 border border-slate-800 transition-all text-center space-y-2 group">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center mx-auto text-lg group-hover:scale-110 transition-transform">
                ➕
            </div>
            <span class="text-xs font-bold text-slate-200 block">Tambah Destinasi Wisata</span>
        </a>

        <a href="{{ route('admin.transports.create') }}" class="p-4 rounded-2xl bg-aw-navy hover:bg-slate-800 border border-slate-800 transition-all text-center space-y-2 group">
            <div class="w-10 h-10 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center mx-auto text-lg group-hover:scale-110 transition-transform">
                🚌
            </div>
            <span class="text-xs font-bold text-slate-200 block">Tambah / Kelola Armada</span>
        </a>

        <a href="{{ route('admin.site-settings.edit') }}" class="p-4 rounded-2xl bg-aw-navy hover:bg-slate-800 border border-slate-800 transition-all text-center space-y-2 group">
            <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-300 flex items-center justify-center mx-auto text-lg group-hover:scale-110 transition-transform">🏢</div>
            <span class="text-xs font-bold text-slate-200 block">Edit Profil & Kontak</span>
        </a>
    </div>
</div>

{{-- RECENT REQUESTS & UPCOMING BOOKED DATES --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    {{-- LEFT COLUMN: RECENT QUOTATIONS TABLE --}}
    <div class="lg:col-span-2 bg-aw-navy/90 rounded-3xl p-6 border border-slate-800 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-serif text-lg font-bold text-white">Permintaan Quotation Terbaru</h3>
                <p class="text-xs text-slate-400">5 Tiket quotation yang paling baru dikirim oleh calon klien</p>
            </div>
            <a href="{{ route('admin.requests.index') }}" class="text-xs font-bold text-aw-gold hover:underline">
                Lihat Semua Tiket →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left text-slate-300">
                <thead class="bg-slate-900/80 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="px-4 py-3 rounded-l-xl">No. Tiket</th>
                        <th class="px-4 py-3">Instansi / Klien</th>
                        <th class="px-4 py-3">Tgl Keberangkatan</th>
                        <th class="px-4 py-3">Pax</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right rounded-r-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/80">
                    @forelse($recentRequests as $req)
                        <tr class="hover:bg-slate-800/40 transition-colors">
                            <td class="px-4 py-3.5 font-bold text-aw-gold">
                                {{ $req->ticket_number }}
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="font-bold text-white block">{{ $req->institution_name }}</span>
                                <span class="text-[11px] text-slate-400 block">{{ $req->client_name }} ({{ $req->phone }})</span>
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
                                   class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-aw-gold hover:text-slate-950 text-slate-300 text-[11px] font-bold transition-all inline-block">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500">
                                Belum ada permintaan quotation terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- RIGHT COLUMN: UPCOMING BOOKED DATES --}}
    <div class="lg:col-span-1 bg-aw-navy/90 rounded-3xl p-6 border border-slate-800 shadow-xl space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="font-serif text-lg font-bold text-white">Tanggal Terpesan Terdekat</h3>
            <a href="{{ route('admin.calendar.index') }}" class="text-xs font-bold text-aw-gold hover:underline">
                Kelola Kalender →
            </a>
        </div>

        <div class="space-y-3">
            @forelse($upcomingBookings as $bd)
                <div class="p-3.5 rounded-2xl bg-slate-900/80 border border-slate-800 space-y-1">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-bold text-rose-400 flex items-center gap-1">
                            📅 {{ $bd->booked_date->format('d M Y') }}
                        </span>
                        <span class="text-[10px] text-slate-400 bg-slate-800 px-2 py-0.5 rounded font-semibold">
                            Fully Booked
                        </span>
                    </div>
                    <p class="text-xs font-semibold text-slate-200">
                        {{ $bd->label ?? 'Pemesanan Rombongan' }}
                    </p>
                </div>
            @empty
                <div class="p-6 text-center text-slate-500 text-xs">
                    Belum ada tanggal terpesan di bulan mendatang.
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
