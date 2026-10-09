@csrf
@if($offering->exists) @method('PUT') @endif
<div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">
    <div class="sm:col-span-2">
        <label for="name" class="block mb-1 font-semibold text-slate-300">Nama armada / tipe bodi *</label>
        <input id="name" name="name" required maxlength="120" value="{{ old('name', $offering->name) }}" class="w-full rounded-xl bg-slate-900 border-slate-700 text-white">
        @error('name')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror
    </div>
    <div>
        <label for="display_group" class="block mb-1 font-semibold text-slate-300">Ditampilkan sebagai *</label>
        <select id="display_group" name="display_group" required class="w-full rounded-xl bg-slate-900 border-slate-700 text-white">
            <option value="vehicle" @selected(old('display_group', $offering->display_group ?: 'vehicle') === 'vehicle')>Kendaraan untuk quotation</option>
            <option value="body_type" @selected(old('display_group', $offering->display_group) === 'body_type')>Tipe bodi armada</option>
        </select>
    </div>
    <div>
        <label for="capacity" class="block mb-1 font-semibold text-slate-300">Kapasitas</label>
        <input id="capacity" name="capacity" maxlength="120" value="{{ old('capacity', $offering->capacity) }}" placeholder="Contoh: 30–35 seat" class="w-full rounded-xl bg-slate-900 border-slate-700 text-white">
    </div>
    <div>
        <label for="price_label" class="block mb-1 font-semibold text-slate-300">Informasi harga</label>
        <input id="price_label" name="price_label" maxlength="160" value="{{ old('price_label', $offering->price_label) }}" placeholder="Contoh: Mulai dari Rp.../hari" class="w-full rounded-xl bg-slate-900 border-slate-700 text-white">
    </div>
    <div>
        <label for="unit_count" class="block mb-1 font-semibold text-slate-300">Jumlah unit (untuk tipe bodi)</label>
        <input id="unit_count" name="unit_count" type="number" min="0" value="{{ old('unit_count', $offering->unit_count) }}" class="w-full rounded-xl bg-slate-900 border-slate-700 text-white">
    </div>
    <div class="sm:col-span-2">
        <label for="description" class="block mb-1 font-semibold text-slate-300">Deskripsi</label>
        <textarea id="description" name="description" rows="3" class="w-full rounded-xl bg-slate-900 border-slate-700 text-white">{{ old('description', $offering->description) }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label for="features" class="block mb-1 font-semibold text-slate-300">Fitur (satu per baris)</label>
        <textarea id="features" name="features" rows="3" class="w-full rounded-xl bg-slate-900 border-slate-700 text-white">{{ old('features', is_array($offering->features) ? implode("\n", $offering->features) : '') }}</textarea>
    </div>
    <div class="sm:col-span-2">
        <label for="image" class="block mb-1 font-semibold text-slate-300">Gambar armada</label>
        @if($offering->image)<img src="{{ $offering->image }}" alt="{{ $offering->name }}" class="mb-3 h-36 w-full sm:w-64 rounded-xl object-cover">@endif
        <input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp" class="block w-full text-slate-300">
        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="Atau masukkan URL gambar https://..." class="mt-3 w-full rounded-xl bg-slate-900 border-slate-700 text-white">
        @error('image')<p class="mt-1 text-rose-400">{{ $message }}</p>@enderror
        @if($offering->image)<label class="mt-3 flex items-center gap-2 text-slate-300"><input type="checkbox" name="remove_image" value="1"> Hapus gambar saat ini</label>@endif
    </div>
    <div>
        <label for="sort_order" class="block mb-1 font-semibold text-slate-300">Urutan tampil</label>
        <input id="sort_order" name="sort_order" type="number" min="0" value="{{ old('sort_order', $offering->sort_order ?? 0) }}" class="w-full rounded-xl bg-slate-900 border-slate-700 text-white">
    </div>
    <label class="flex items-center gap-2 self-end text-slate-300"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $offering->exists ? $offering->is_active : true))> Tampilkan di website</label>
</div>
<div class="flex justify-end gap-3 border-t border-slate-800 pt-5">
    <a href="{{ route('admin.transports.index') }}" class="rounded-xl bg-slate-800 px-5 py-3 text-sm text-slate-300">Batal</a>
    <button class="rounded-xl bg-aw-gold px-6 py-3 text-sm font-bold text-slate-950">Simpan</button>
</div>
