@extends('layouts.admin')

@section('title', 'Katalog Destinasi Wisata — Admin Control Panel')
@section('page_title', 'Kelola Katalog Destinasi Wisata')

@section('content')

{{-- TOP TOOLBAR --}}
<div class="bg-[#0B0B0E]/90 p-5 rounded-3xl border border-white/[0.07] shadow-xl space-y-4">
    <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
        
        {{-- Search & Filters --}}
        <form method="GET" action="{{ route('admin.destinations.index') }}" class="flex flex-wrap items-center gap-2 flex-1">
            {{-- Search input --}}
            <div class="relative w-full sm:w-56">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari destinasi / kota..." 
                       class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                @if(request('search'))
                    <a href="{{ route('admin.destinations.index', request()->except('search')) }}" 
                       class="absolute right-2.5 top-1/2 -translate-y-1/2 text-zinc-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>

            {{-- Location Type Filter --}}
            <select name="location_type" onchange="this.form.submit()" 
                    class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                <option value="">Semua Wilayah</option>
                <option value="lokal" {{ request('location_type') === 'lokal' ? 'selected' : '' }}>Lokal (Domestik)</option>
                <option value="luar_negeri" {{ request('location_type') === 'luar_negeri' ? 'selected' : '' }}>Luar Negeri</option>
            </select>

            {{-- Status Filter --}}
            <select name="status" onchange="this.form.submit()" 
                    class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif Saja</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif Saja</option>
            </select>

            <button type="submit" class="px-3.5 py-2 bg-[#121215] text-zinc-200 text-xs font-semibold rounded-xl hover:bg-slate-700 transition-colors">
                Filter
            </button>
        </form>

        {{-- Add New Destination Button --}}
        <a href="{{ route('admin.destinations.create') }}" 
           class="px-4 py-2.5 bg-aw-gold text-slate-950 font-bold text-xs rounded-xl hover:bg-aw-gold/90 transition-all shadow-md flex items-center justify-center gap-2 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Tambah Destinasi Baru</span>
        </a>

    </div>
</div>

{{-- DESTINATIONS TABLE --}}
<div class="bg-[#0B0B0E]/90 rounded-3xl p-6 border border-white/[0.07] shadow-xl space-y-4">
    <div class="overflow-x-auto">
        <table class="w-full text-xs text-left text-zinc-300">
            <thead class="bg-[#0B0B0E] text-zinc-400 font-bold uppercase tracking-wider text-[10px]">
                <tr>
                    <th class="px-4 py-3.5 rounded-l-xl">Destinasi</th>
                    <th class="px-4 py-3.5">Cakupan Wilayah</th>
                    <th class="px-4 py-3.5">Estimasi Harga</th>
                    <th class="px-4 py-3.5 text-center">Min. Pax</th>
                    <th class="px-4 py-3.5 text-center">Status</th>
                    <th class="px-4 py-3.5 text-right rounded-r-xl">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($destinations as $dest)
                    <tr class="hover:bg-[#121215]/40 transition-colors">
                        <td class="px-4 py-3.5">
                            <div class="flex items-center gap-3">
                                @if($dest->cover_image)
                                    <img src="{{ $dest->cover_image }}" alt="{{ $dest->name }}" 
                                         class="w-12 h-12 rounded-xl object-cover border border-white/[0.09] shrink-0"
                                         onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                @endif
                                <div class="{{ $dest->cover_image ? 'hidden' : '' }} w-12 h-12 rounded-xl bg-[#121215] text-zinc-400 flex items-center justify-center border border-white/[0.09] shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="min-w-0">
                                    <span class="font-bold text-white text-sm block truncate">{{ $dest->name }}</span>
                                    <span class="text-[11px] text-zinc-400 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $dest->location }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3.5 whitespace-nowrap">
                            <span class="px-2.5 py-1 rounded-full {{ $dest->location_type === 'luar_negeri' ? 'bg-amber-500/20 text-amber-300 border-amber-500/30' : 'bg-[#121215] text-aw-mint border-white/[0.09]' }} border text-[10px] font-semibold">
                                {{ $dest->location_type === 'luar_negeri' ? 'Luar Negeri' : 'Lokal' }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5 whitespace-nowrap">
                            <span class="font-bold text-zinc-200 block">{{ $dest->formatted_price }}</span>
                            @if($dest->max_price)
                                <span class="text-[10px] text-zinc-400 block">s/d Rp {{ number_format($dest->max_price, 0, ',', '.') }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3.5 text-center font-bold text-white whitespace-nowrap">
                            {{ $dest->min_pax }} Pax
                        </td>
                        <td class="px-4 py-3.5 text-center whitespace-nowrap space-y-1">
                            @if($dest->is_active)
                                <span class="inline-block px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-[10px] font-bold">Aktif</span>
                            @else
                                <span class="inline-block px-2.5 py-0.5 rounded-full bg-[#121215] text-zinc-400 border border-white/[0.09] text-[10px] font-bold">Nonaktif</span>
                            @endif
                            @if($dest->is_featured)
                                <span class="inline-flex items-center gap-1 text-[10px] text-aw-gold font-semibold mt-1">
                                    <svg class="w-3 h-3 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    Unggulan
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3.5 text-right whitespace-nowrap space-x-1">
                            <a href="{{ route('destinations.show', $dest->slug) }}" target="_blank"
                               class="p-1.5 text-zinc-400 hover:text-aw-gold rounded-lg hover:bg-[#121215] transition-colors inline-block" title="Lihat di Web Publik">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            <a href="{{ route('admin.destinations.edit', $dest->id) }}" 
                               class="px-2.5 py-1.5 rounded-lg bg-[#121215] hover:bg-aw-gold hover:text-slate-950 text-zinc-200 text-[11px] font-bold transition-all inline-block">
                                Edit
                            </a>
                            <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Hapus destinasi wisata &quot;{{ $dest->name }}&quot; secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-zinc-400 hover:text-rose-400 rounded-lg hover:bg-rose-500/10 transition-colors" title="Hapus Destinasi">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center text-zinc-500">
                            Tidak ditemukan destinasi wisata yang sesuai dengan filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Links --}}
    <div class="pt-4">
        {{ $destinations->links() }}
    </div>
</div>

@endsection
