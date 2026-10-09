@extends('layouts.admin')

@section('title', 'Manajemen Permintaan Quotation — Admin Control Panel')
@section('page_title', 'Daftar Permintaan Quotation Rombongan')

@section('content')

{{-- TOP TOOLBAR & STATUS FILTERS --}}
<div class="bg-aw-navy/90 p-5 rounded-3xl border border-slate-800 shadow-xl space-y-4">
    <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
        
        {{-- Status Filter Tabs --}}
        <div class="flex flex-wrap items-center gap-1.5 text-xs">
            <a href="{{ route('admin.requests.index', request()->only('search')) }}" 
               class="px-3 py-1.5 rounded-xl font-bold transition-all {{ !request('status') ? 'bg-aw-gold text-slate-950 shadow-md ring-1 ring-aw-gold/50' : 'bg-slate-900 text-slate-400 hover:text-white hover:bg-slate-800' }}">
                Semua Status
            </a>
            <a href="{{ route('admin.requests.index', array_merge(request()->only('search'), ['status' => 'pending'])) }}" 
               class="px-3 py-1.5 rounded-xl font-bold transition-all {{ request('status') === 'pending' ? 'bg-amber-500 text-slate-950 shadow-md' : 'bg-slate-900 text-slate-400 hover:text-white hover:bg-slate-800' }}">
                ⏳ Pending
            </a>
            <a href="{{ route('admin.requests.index', array_merge(request()->only('search'), ['status' => 'reviewed'])) }}" 
               class="px-3 py-1.5 rounded-xl font-bold transition-all {{ request('status') === 'reviewed' ? 'bg-blue-500 text-white shadow-md' : 'bg-slate-900 text-slate-400 hover:text-white hover:bg-slate-800' }}">
                🔍 Ditinjau
            </a>
            <a href="{{ route('admin.requests.index', array_merge(request()->only('search'), ['status' => 'quoted'])) }}" 
               class="px-3 py-1.5 rounded-xl font-bold transition-all {{ request('status') === 'quoted' ? 'bg-purple-500 text-white shadow-md' : 'bg-slate-900 text-slate-400 hover:text-white hover:bg-slate-800' }}">
                📄 Penawaran Terkirim
            </a>
            <a href="{{ route('admin.requests.index', array_merge(request()->only('search'), ['status' => 'confirmed'])) }}" 
               class="px-3 py-1.5 rounded-xl font-bold transition-all {{ request('status') === 'confirmed' ? 'bg-emerald-500 text-slate-950 shadow-md' : 'bg-slate-900 text-slate-400 hover:text-white hover:bg-slate-800' }}">
                ✓ Confirmed DP
            </a>
            <a href="{{ route('admin.requests.index', array_merge(request()->only('search'), ['status' => 'cancelled'])) }}" 
               class="px-3 py-1.5 rounded-xl font-bold transition-all {{ request('status') === 'cancelled' ? 'bg-rose-500 text-white shadow-md' : 'bg-slate-900 text-slate-400 hover:text-white hover:bg-slate-800' }}">
                ✕ Batal
            </a>
        </div>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('admin.requests.index') }}" class="flex items-center gap-2">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="relative w-full sm:w-64">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari No Tiket / Instansi / Nama..." 
                       class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs py-2 px-3.5 pr-8 text-white placeholder-slate-500 focus:border-aw-gold focus:ring-aw-gold">
                @if(request('search'))
                    <a href="{{ route('admin.requests.index', request()->only('status')) }}" 
                       class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white text-xs" 
                       title="Hapus Pencarian">✕</a>
                @endif
            </div>
            <button type="submit" class="px-3.5 py-2 bg-aw-gold text-slate-950 text-xs font-bold rounded-xl hover:bg-aw-gold/90 transition-colors shrink-0">
                Cari
            </button>
        </form>

    </div>
</div>

{{-- REQUESTS TABLE --}}
<div class="bg-aw-navy/90 rounded-3xl p-6 border border-slate-800 shadow-xl space-y-4">
    <div class="overflow-x-auto">
        <table class="w-full text-xs text-left text-slate-300">
            <thead class="bg-slate-900 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                <tr>
                    <th class="px-4 py-3.5 rounded-l-xl">No. Tiket</th>
                    <th class="px-4 py-3.5">Instansi / PIC</th>
                    <th class="px-4 py-3.5">Destinasi</th>
                    <th class="px-4 py-3.5">Jadwal & Pax</th>
                    <th class="px-4 py-3.5">Armada</th>
                    <th class="px-4 py-3.5">Status</th>
                    <th class="px-4 py-3.5 text-right rounded-r-xl">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800">
                @forelse($requests as $req)
                    <tr class="hover:bg-slate-800/40 transition-colors">
                        <td class="px-4 py-4 font-bold text-aw-gold whitespace-nowrap">
                            <a href="{{ route('admin.requests.show', $req->id) }}" class="hover:underline">
                                {{ $req->ticket_number }}
                            </a>
                            <span class="block text-[10px] text-slate-400 font-normal">
                                {{ $req->created_at->format('d/m/y H:i') }}
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="font-bold text-white block">{{ $req->institution_name }}</span>
                            <span class="text-[11px] text-slate-400 block">PIC: {{ $req->client_name }} ({{ $req->phone }})</span>
                        </td>
                        <td class="px-4 py-4 font-semibold text-slate-200">
                            {{ $req->destination_display_name }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="block font-bold text-slate-200">{{ $req->event_date->format('d M Y') }}</span>
                            <span class="text-[11px] text-slate-400 block">{{ $req->pax }} Orang ({{ $req->event_type }})</span>
                        </td>
                        <td class="px-4 py-4 text-slate-300">
                            {{ $req->transport_mode }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($req->status === 'pending')
                                <span class="px-2.5 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-[10px] font-bold uppercase">Pending</span>
                            @elseif($req->status === 'reviewed')
                                <span class="px-2.5 py-1 rounded-full bg-blue-500/20 text-blue-300 border border-blue-500/30 text-[10px] font-bold uppercase">Ditinjau</span>
                            @elseif($req->status === 'quoted')
                                <span class="px-2.5 py-1 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30 text-[10px] font-bold uppercase">Penawaran Dikirim</span>
                            @elseif($req->status === 'confirmed')
                                <span class="px-2.5 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[10px] font-bold uppercase">Confirmed DP</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/30 text-[10px] font-bold uppercase">Dibatalkan</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-right space-x-1 whitespace-nowrap">
                            <a href="{{ route('admin.requests.show', $req->id) }}" 
                               class="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-aw-gold hover:text-slate-950 text-slate-200 text-[11px] font-bold transition-all inline-block">
                                Kelola Tiket
                            </a>
                            <form action="{{ route('admin.requests.destroy', $req->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Hapus permintaan tiket {{ $req->ticket_number }} secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-400 rounded-lg hover:bg-rose-500/10 transition-colors" title="Hapus Tiket">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-12 text-center text-slate-500">
                            Tidak ditemukan data permintaan quotation dengan filter yang dipilih.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="pt-4">
        {{ $requests->links() }}
    </div>
</div>

@endsection
