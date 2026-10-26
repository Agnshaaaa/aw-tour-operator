@extends('layouts.admin')
@section('title', 'Kelola Open Trip — Admin AW Tour')
@section('page_title', 'Kelola Jadwal Open Trip')
@section('content')
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between rounded-3xl border border-white/[0.07] bg-[#0B0B0E]/90 p-5 shadow-xl">
    <div><h2 class="font-serif text-lg font-bold text-white">Jadwal Open Trip</h2><p class="text-sm text-zinc-400">Kelola kuota, tanggal keberangkatan, harga, dan status open trip.</p></div>
    <a href="{{ route('admin.open-trips.create') }}" class="rounded-xl bg-aw-gold px-4 py-3 text-center text-sm font-bold text-slate-950">+ Tambah Open Trip Baru</a>
</div>

<div class="mt-6 rounded-3xl border border-white/[0.07] bg-[#0B0B0E]/90 p-5 shadow-xl">
    <form method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul trip..." class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
        </div>
        <div>
            <select name="status" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                <option value="">Semua Status</option>
                <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="rounded-xl bg-[#121215] px-4 py-3 text-xs font-bold text-white">Filter</button>
            <a href="{{ route('admin.open-trips.index') }}" class="rounded-xl bg-[#0B0B0E] px-4 py-3 text-xs font-bold text-zinc-400">Reset</a>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full min-w-[700px] text-left text-sm text-zinc-300">
            <thead class="bg-[#0B0B0E] text-xs uppercase text-zinc-400">
                <tr>
                    <th class="p-3">Judul Trip & Destinasi</th>
                    <th class="p-3">Tanggal Keberangkatan</th>
                    <th class="p-3">Kuota / Terdaftar</th>
                    <th class="p-3">Harga / Pax</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($openTrips as $trip)
                    <tr>
                        <td class="p-3">
                            <strong class="block text-white">{{ $trip->title }}</strong>
                            <span class="text-xs text-zinc-400">Destinasi: {{ $trip->destination->name ?? '-' }}</span>
                        </td>
                        <td class="p-3 text-xs">
                            {{ $trip->departure_date->format('d M Y') }} - {{ $trip->return_date->format('d M Y') }}
                        </td>
                        <td class="p-3 text-xs">
                            <span class="font-bold text-white">{{ $trip->registered }}</span> / {{ $trip->quota }} Pax
                        </td>
                        <td class="p-3 text-xs text-aw-gold font-bold">
                            Rp {{ number_format($trip->price_per_person, 0, ',', '.') }}
                        </td>
                        <td class="p-3">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold {{ $trip->status === 'open' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-[#121215] text-zinc-400 border border-white/[0.09]' }}">
                                {{ ucfirst($trip->status) }}
                            </span>
                        </td>
                        <td class="p-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.open-trips.edit', $trip->id) }}" class="rounded-lg bg-[#121215] px-3 py-2 text-xs font-semibold text-white">Edit</a>
                            <form action="{{ route('admin.open-trips.destroy', $trip->id) }}" method="POST" class="ml-1 inline" onsubmit="return confirm('Hapus jadwal trip {{ addslashes($trip->title) }}?')">
                                @csrf @method('DELETE')
                                <button class="rounded-lg bg-rose-500/10 px-3 py-2 text-xs text-rose-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-8 text-center text-zinc-400">Belum ada jadwal open trip. Silakan tambah baru.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pt-4">{{ $openTrips->links() }}</div>
</div>
@endsection
