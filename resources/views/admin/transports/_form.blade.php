@csrf
@if($offering->exists) @method('PUT') @endif
<div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">
    <div class="sm:col-span-2">
        <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Nama armada *</label>
        <input id="name" name="name" required maxlength="120" value="{{ old('name', $offering->name) }}" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
        @error('name')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Kapasitas</label>
        <input id="capacity" name="capacity" maxlength="120" value="{{ old('capacity', $offering->capacity) }}" placeholder="Contoh: 30–35 seat" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
    </div>
    <div>
        <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Informasi harga</label>
        <input id="price_label" name="price_label" maxlength="160" value="{{ old('price_label', $offering->price_label) }}" placeholder="Contoh: Mulai dari Rp.../hari" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
    </div>
    <div class="sm:col-span-2">
        <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Deskripsi</label>
        <textarea id="description" name="description" rows="3" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('description', $offering->description) }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Fitur (satu per baris)</label>
        <textarea id="features" name="features" rows="3" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">{{ old('features', is_array($offering->features) ? implode("\n", $offering->features) : '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Gambar armada</label>
        @if($offering->image)<img src="{{ $offering->image }}" alt="{{ $offering->name }}" class="mb-3 h-36 w-full sm:w-64 rounded-xl object-cover">@endif
        <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner mb-3">
        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="Atau masukkan URL gambar https://..." class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
        @error('image')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror
        @if($offering->image)<label class="block text-xs md:text-sm font-medium text-zinc-400 mt-2"><input type="checkbox" name="remove_image" value="1"> Hapus gambar saat ini</label>@endif
    </div>
    <div>
        <label for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">Urutan tampil</label>
        <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $offering->sort_order ?? 0) }}" class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner">
    </div>
    <div class="flex items-center">
        <label class="block text-xs md:text-sm font-medium text-zinc-400"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $offering->exists ? $offering->is_active : true))> Tampilkan di website</label>
    </div>
</div>
<div class="flex justify-end gap-3 border-t border-white/[0.07] pt-5 mt-6">
    <a href="{{ route('admin.transports.index') }}" class="rounded-xl bg-[#121215] px-5 py-3 text-sm text-zinc-300">Batal</a>
    <button class="rounded-xl bg-aw-gold px-6 py-3 text-sm font-bold text-slate-950">Simpan</button>
</div>
