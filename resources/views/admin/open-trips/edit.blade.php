@extends('layouts.admin')
@section('title', 'Edit Open Trip — Admin AW Tour')
@section('page_title', 'Edit Jadwal Open Trip')
@section('content')
<div class="max-w-4xl rounded-3xl border border-white/[0.07] bg-[#0B0B0E]/90 p-6 sm:p-8 shadow-xl">
    <form action="{{ route('admin.open-trips.update', $openTrip->id) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')

        <div>
            <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Destinasi Terkait *</label>
            <select name="destination_id" id="destination_id" required class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                <option value="">Pilih Destinasi</option>
                @foreach($destinations as $dest)
                    <option value="{{ $dest->id }}" {{ old('destination_id', $openTrip->destination_id) == $dest->id ? 'selected' : '' }}>{{ $dest->name }} ({{ $dest->location }})</option>
                @endforeach
            </select>
            @error('destination_id')<p class="mt-1 text-rose-400 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Judul Open Trip *</label>
            <input type="text" name="title" id="title" required value="{{ old('title', $openTrip->title) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-xs text-white px-4 py-3">
            @error('title')<p class="mt-1 text-rose-400 text-xs">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Tanggal Keberangkatan *</label>
                <input type="date" name="departure_date" id="departure_date" required value="{{ old('departure_date', $openTrip->departure_date->format('Y-m-d')) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-xs text-white px-4 py-3">
                @error('departure_date')<p class="mt-1 text-rose-400 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Tanggal Kepulangan *</label>
                <input type="date" name="return_date" id="return_date" required value="{{ old('return_date', $openTrip->return_date->format('Y-m-d')) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-xs text-white px-4 py-3">
                @error('return_date')<p class="mt-1 text-rose-400 text-xs">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Total Kuota Pax *</label>
                <input type="number" name="quota" id="quota" min="1" required value="{{ old('quota', $openTrip->quota) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-xs text-white px-4 py-3">
                @error('quota')<p class="mt-1 text-rose-400 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Sudah Terdaftar</label>
                <input type="number" name="registered" id="registered" min="0" value="{{ old('registered', $openTrip->registered) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-xs text-white px-4 py-3">
                @error('registered')<p class="mt-1 text-rose-400 text-xs">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Harga per Pax (Rp) *</label>
                <input type="number" name="price_per_person" id="price_per_person" min="0" required value="{{ old('price_per_person', $openTrip->price_per_person) }}" class="w-full rounded-xl border-white/[0.09] bg-[#0B0B0E] text-xs text-white px-4 py-3">
                @error('price_per_person')<p class="mt-1 text-rose-400 text-xs">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Status Trip *</label>
            <select name="status" id="status" required class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
                <option value="open" {{ old('status', $openTrip->status) === 'open' ? 'selected' : '' }}>Open (Buka Pendaftaran)</option>
                <option value="closed" {{ old('status', $openTrip->status) === 'closed' ? 'selected' : '' }}>Closed (Pendaftaran Ditutup)</option>
                <option value="completed" {{ old('status', $openTrip->status) === 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
            </select>
            @error('status')<p class="mt-1 text-rose-400 text-xs">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Highlight / Ringkasan Trip</label>
            <textarea name="highlight" id="highlight" rows="4" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('highlight', $openTrip->highlight) }}</textarea>
            @error('highlight')<p class="mt-1 text-rose-400 text-xs">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-white/[0.07]">
            <a href="{{ route('admin.open-trips.index') }}" class="rounded-xl bg-[#121215] px-5 py-3 text-xs font-semibold text-zinc-300">Batal</a>
            <button type="submit" class="rounded-xl bg-aw-gold px-6 py-3 text-xs font-bold text-slate-950 shadow-lg shadow-aw-gold/20">Perbarui Jadwal Open Trip</button>
        </div>
    </form>
</div>
@endsection
