@extends('layouts.admin')
@section('title', 'Kelola Transportasi — Admin AW Tour')
@section('page_title', 'Kelola Armada & Transportasi')
@section('content')
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between rounded-3xl border border-slate-800 bg-aw-navy/90 p-5 shadow-xl">
    <div><h2 class="font-serif text-lg font-bold text-white">Konten Armada Website</h2><p class="text-sm text-slate-400">Kelola foto, kapasitas, harga estimasi, fitur, dan status tampil.</p></div>
    <a href="{{ route('admin.transports.create') }}" class="rounded-xl bg-aw-gold px-4 py-3 text-center text-sm font-bold text-slate-950">+ Tambah Informasi Armada</a>
</div>
<div class="overflow-x-auto rounded-3xl border border-slate-800 bg-aw-navy/90 p-5 shadow-xl">
    <table class="w-full min-w-[700px] text-left text-sm text-slate-300">
        <thead class="bg-slate-900 text-xs uppercase text-slate-400"><tr><th class="p-3">Armada</th><th class="p-3">Jenis tampilan</th><th class="p-3">Kapasitas / harga</th><th class="p-3">Status</th><th class="p-3 text-right">Aksi</th></tr></thead>
        <tbody class="divide-y divide-slate-800">
            @forelse($offerings as $offering)
                <tr>
                    <td class="p-3"><div class="flex items-center gap-3">@if($offering->image)<img src="{{ $offering->image }}" alt="" class="h-12 w-16 rounded-lg object-cover">@else<div class="flex h-12 w-16 items-center justify-center rounded-lg bg-slate-800">🚌</div>@endif<div><strong class="block text-white">{{ $offering->name }}</strong><span class="text-xs text-slate-400">{{ $offering->description }}</span></div></div></td>
                    <td class="p-3">{{ $offering->display_group === 'vehicle' ? 'Kendaraan quotation' : 'Tipe bodi' }}</td>
                    <td class="p-3">{{ $offering->capacity ?: '—' }}<span class="block text-xs text-aw-gold">{{ $offering->price_label ?: ($offering->unit_count !== null ? $offering->unit_count . ' unit' : '—') }}</span></td>
                    <td class="p-3">{{ $offering->is_active ? 'Tampil' : 'Disembunyikan' }}</td>
                    <td class="p-3 text-right whitespace-nowrap"><a href="{{ route('admin.transports.edit', $offering->id) }}" class="rounded-lg bg-slate-800 px-3 py-2 font-semibold text-white">Edit</a>
                        <form action="{{ route('admin.transports.destroy', $offering->id) }}" method="POST" class="ml-1 inline" onsubmit="return confirm('Hapus informasi {{ addslashes($offering->name) }}?')">@csrf @method('DELETE')<button class="rounded-lg bg-rose-500/10 px-3 py-2 text-rose-300">Hapus</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-8 text-center text-slate-400">Belum ada informasi transportasi. Tambahkan armada untuk menampilkannya di situs.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="pt-4">{{ $offerings->links() }}</div>
</div>
@endsection
