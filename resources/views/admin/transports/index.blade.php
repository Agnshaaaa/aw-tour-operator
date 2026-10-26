@extends('layouts.admin')
@section('title', 'Kelola Transportasi — Admin AW Tour')
@section('page_title', 'Kelola Armada & Transportasi')
@section('content')
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between rounded-3xl border border-white/[0.07] bg-[#0B0B0E]/90 p-5 shadow-xl">
    <div><h2 class="font-serif text-lg font-bold text-white">Konten Armada Website</h2><p class="text-sm text-zinc-400">Kelola foto, kapasitas, harga estimasi, fitur, dan status tampil.</p></div>
    <a href="{{ route('admin.transports.create') }}" class="rounded-xl bg-aw-gold px-4 py-3 text-center text-sm font-bold text-slate-950">+ Tambah Informasi Armada</a>
</div>
<div class="overflow-x-auto rounded-3xl border border-white/[0.07] bg-[#0B0B0E]/90 p-5 shadow-xl">
    <table class="w-full min-w-[700px] text-left text-sm text-zinc-300">
        <thead class="bg-[#0B0B0E] text-xs uppercase text-zinc-400"><tr><th class="p-3">Armada</th><th class="p-3">Kapasitas / Harga</th><th class="p-3">Status</th><th class="p-3 text-right">Aksi</th></tr></thead>
        <tbody class="divide-y divide-white/5">
            @forelse($offerings as $offering)
                <tr>
                    <td class="p-3"><div class="flex items-center gap-3">@if($offering->image)<img src="{{ $offering->image }}" alt="" class="h-12 w-16 rounded-xl object-cover border border-white/[0.09]">@else<div class="flex h-12 w-16 items-center justify-center rounded-xl bg-[#121215] border border-white/[0.09] p-2.5"><svg class="w-full h-full text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg></div>@endif<div><strong class="block text-white">{{ $offering->name }}</strong><span class="text-xs text-zinc-400">{{ $offering->description }}</span></div></div></td>
                    <td class="p-3">{{ $offering->capacity ?: '—' }}<span class="block text-xs text-aw-gold">{{ $offering->price_label ?: '—' }}</span></td>
                    <td class="p-3">{{ $offering->is_active ? 'Tampil' : 'Disembunyikan' }}</td>
                    <td class="p-3 text-right whitespace-nowrap"><a href="{{ route('admin.transports.edit', $offering->id) }}" class="rounded-lg bg-[#121215] px-3 py-2 font-semibold text-white">Edit</a>
                        <form action="{{ route('admin.transports.destroy', $offering->id) }}" method="POST" class="ml-1 inline" onsubmit="return confirm('Hapus informasi {{ addslashes($offering->name) }}?')">@csrf @method('DELETE')<button class="rounded-lg bg-rose-500/10 px-3 py-2 text-rose-300">Hapus</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="p-8 text-center text-zinc-400">Belum ada informasi transportasi. Tambahkan armada untuk menampilkannya di situs.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pt-4">{{ $offerings->links() }}</div>
</div>
@endsection
