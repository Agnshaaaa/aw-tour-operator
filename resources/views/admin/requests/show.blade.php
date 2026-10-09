@extends('layouts.admin')

@section('title', 'Detail Tiket ' . $customRequest->ticket_number . ' — Admin Control Panel')
@section('page_title', 'Detail Permintaan Quotation: ' . $customRequest->ticket_number)

@section('content')

{{-- TOP ACTION BAR --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.requests.index') }}" 
           class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-slate-300 hover:text-white border border-slate-800 text-xs font-semibold transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Kembali ke Daftar</span>
        </a>

        <div class="flex items-center gap-2">
            @if($customRequest->status === 'pending')
                <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30 text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                    <span>Menunggu Review</span>
                </span>
            @elseif($customRequest->status === 'reviewed')
                <span class="px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 border border-blue-500/30 text-xs font-bold uppercase tracking-wider">
                    Sedang Ditinjau
                </span>
            @elseif($customRequest->status === 'quoted')
                <span class="px-3 py-1 rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30 text-xs font-bold uppercase tracking-wider">
                    Penawaran Terkirim
                </span>
            @elseif($customRequest->status === 'confirmed')
                <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-bold uppercase tracking-wider flex items-center gap-1">
                    ✓ Terkonfirmasi DP
                </span>
            @else
                <span class="px-3 py-1 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/30 text-xs font-bold uppercase tracking-wider">
                    Dibatalkan
                </span>
            @endif
        </div>
    </div>

    <div class="flex items-center gap-2">
        {{-- Hubungi Klien WhatsApp --}}
        @php
            $cleanPhone = preg_replace('/[^0-9]/', '', $customRequest->phone);
            if (str_starts_with($cleanPhone, '0')) {
                $cleanPhone = '62' . substr($cleanPhone, 1);
            }
            $waMsg = urlencode("Halo {$customRequest->client_name} ({$customRequest->institution_name}), kami dari AW Tour Operator mengonfirmasi permintaan quotation rombongan nomor tiket {$customRequest->ticket_number}.");
            $clientWaUrl = "https://wa.me/{$cleanPhone}?text={$waMsg}";
        @endphp
        <a href="{{ $clientWaUrl }}" target="_blank"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs shadow-md transition-all">
            <span>💬 Hubungi Klien (WhatsApp)</span>
        </a>

        {{-- Tombol Hapus Request --}}
        <form action="{{ route('admin.requests.destroy', $customRequest->id) }}" method="POST" 
              onsubmit="return confirm('Apakah Anda yakin ingin menghapus permintaan quotation ini secara permanen? Data tanggal dan pesanan UMKM terkait juga akan dihapus.');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="p-2 rounded-xl bg-slate-900 hover:bg-rose-500/20 text-slate-400 hover:text-rose-400 border border-slate-800 transition-colors"
                    title="Hapus Permintaan">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- LEFT & CENTER COLUMN (2 COLS): TICKET DETAILS --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- 1. IDENTITAS KLIEN & INSTANSI --}}
        <div class="bg-aw-navy/90 rounded-3xl p-6 border border-slate-800 shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800/80 pb-3">
                <h2 class="font-serif text-base font-bold text-white flex items-center gap-2">
                    <span class="text-aw-gold">🏢</span> Profil Instansi & Kontak PIC
                </h2>
                <span class="text-xs text-slate-400">Masuk: {{ $customRequest->created_at->format('d M Y, H:i') }} WIB</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                <div class="p-3.5 rounded-2xl bg-slate-900/80 border border-slate-800/80 space-y-1">
                    <span class="text-slate-400 block font-medium">Nama Lembaga / Instansi:</span>
                    <span class="font-bold text-white text-sm block">{{ $customRequest->institution_name }}</span>
                    <span class="text-[11px] text-slate-400">Jenis Acara: <strong class="text-slate-200">{{ $customRequest->event_type }}</strong></span>
                </div>

                <div class="p-3.5 rounded-2xl bg-slate-900/80 border border-slate-800/80 space-y-1">
                    <span class="text-slate-400 block font-medium">Person in Charge (PIC):</span>
                    <span class="font-bold text-white text-sm block">{{ $customRequest->client_name }}</span>
                    <span class="text-[11px] text-slate-400">No. HP / WA: <strong class="text-emerald-400">{{ $customRequest->phone }}</strong></span>
                    @if($customRequest->email)
                        <span class="text-[11px] text-slate-400 block">Email: <span class="text-slate-200">{{ $customRequest->email }}</span></span>
                    @endif
                </div>
            </div>
        </div>

        {{-- 2. DESTINASI, JADWAL & ARMADA --}}
        <div class="bg-aw-navy/90 rounded-3xl p-6 border border-slate-800 shadow-xl space-y-4">
            <h2 class="font-serif text-base font-bold text-white flex items-center gap-2 border-b border-slate-800/80 pb-3">
                <span class="text-aw-gold">📍</span> Rencana Perjalanan & Logistik
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                <div class="p-3 rounded-2xl bg-slate-900/80 border border-slate-800/80 space-y-1">
                    <span class="text-slate-400 text-[11px] block">Destinasi</span>
                    <span class="font-bold text-white block">{{ $customRequest->destination_display_name }}</span>
                    @if($customRequest->destination)
                        <span class="text-[10px] text-aw-gold block">{{ $customRequest->destination->location }}</span>
                    @endif
                </div>

                <div class="p-3 rounded-2xl bg-slate-900/80 border border-slate-800/80 space-y-1">
                    <span class="text-slate-400 text-[11px] block">Jadwal Keberangkatan</span>
                    <span class="font-bold text-white block">{{ $customRequest->event_date->format('d M Y') }}</span>
                    @if($customRequest->return_date)
                        <span class="text-[10px] text-slate-400 block">Pulang: {{ $customRequest->return_date->format('d M Y') }}</span>
                    @endif
                </div>

                <div class="p-3 rounded-2xl bg-slate-900/80 border border-slate-800/80 space-y-1">
                    <span class="text-slate-400 text-[11px] block">Jumlah Peserta</span>
                    <span class="font-bold text-white text-base block">{{ $customRequest->pax }}</span>
                    <span class="text-[10px] text-slate-400 block">Orang (Pax)</span>
                </div>

                <div class="p-3 rounded-2xl bg-slate-900/80 border border-slate-800/80 space-y-1">
                    <span class="text-slate-400 text-[11px] block">Moda Transportasi</span>
                    <span class="font-bold text-white block">{{ $customRequest->transport_mode }}</span>
                    <span class="text-[10px] text-slate-400 block">Rencana Armada</span>
                </div>
            </div>

            {{-- Structured Notes Details --}}
            @if($customRequest->notes)
                <div class="p-4 rounded-2xl bg-slate-900/90 border border-slate-800 text-xs space-y-2">
                    <span class="text-[11px] font-bold text-aw-gold uppercase tracking-wider block">Catatan & Rincian Kebutuhan Klien:</span>
                    <div class="text-slate-300 whitespace-pre-line leading-relaxed font-sans">
                        {{ $customRequest->notes }}
                    </div>
                </div>
            @endif
        </div>

        {{-- 3. ADD-ON OLEH-OLEH PRODUK UMKM --}}
        <div class="bg-aw-navy/90 rounded-3xl p-6 border border-slate-800 shadow-xl space-y-4">
            <div class="flex items-center justify-between border-b border-slate-800/80 pb-3">
                <h2 class="font-serif text-base font-bold text-white flex items-center gap-2">
                    <span class="text-aw-gold">🛍️</span> Add-on Oleh-oleh Produk UMKM
                </h2>
                <span class="text-xs text-slate-400">{{ $customRequest->umkmOrders->count() }} Produk Dipilih</span>
            </div>

            @if($customRequest->umkmOrders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-xs text-left text-slate-300">
                        <thead class="bg-slate-900 text-slate-400 font-bold uppercase tracking-wider text-[10px]">
                            <tr>
                                <th class="px-3 py-2 rounded-l-xl">Produk</th>
                                <th class="px-3 py-2">Produsen</th>
                                <th class="px-3 py-2 text-center">Jumlah</th>
                                <th class="px-3 py-2 text-right">Harga Satuan</th>
                                <th class="px-3 py-2 text-right rounded-r-xl">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            @php $grandTotalUmkm = 0; @endphp
                            @foreach($customRequest->umkmOrders as $order)
                                @php 
                                    $subtotal = $order->quantity * $order->price_at_order; 
                                    $grandTotalUmkm += $subtotal;
                                @endphp
                                <tr>
                                    <td class="px-3 py-3 font-semibold text-white">
                                        {{ $order->product->name ?? 'Produk UMKM' }}
                                    </td>
                                    <td class="px-3 py-3 text-slate-400">
                                        {{ $order->product->producer ?? '-' }}
                                    </td>
                                    <td class="px-3 py-3 text-center font-bold text-aw-gold">
                                        {{ $order->quantity }} {{ $order->product->unit ?? 'pcs' }}
                                    </td>
                                    <td class="px-3 py-3 text-right">
                                        Rp {{ number_format($order->price_at_order, 0, ',', '.') }}
                                    </td>
                                    <td class="px-3 py-3 text-right font-bold text-white">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bg-slate-900/60 font-bold text-xs text-white">
                                <td colspan="4" class="px-3 py-3 text-right rounded-l-xl">Total Tambahan Add-on UMKM:</td>
                                <td class="px-3 py-3 text-right text-aw-gold rounded-r-xl">
                                    Rp {{ number_format($grandTotalUmkm, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-center text-slate-500 text-xs">
                    Klien tidak memilih paket add-on produk UMKM.
                </div>
            @endif
        </div>

    </div>

    {{-- RIGHT COLUMN (1 COL): STATUS CONTROL & INTERNAL ADMIN NOTES --}}
    <div class="space-y-6">

        {{-- STATUS CONTROLLER CARD --}}
        <div class="bg-aw-navy/90 rounded-3xl p-6 border border-slate-800 shadow-xl space-y-5 sticky top-20">
            <h2 class="font-serif text-base font-bold text-white flex items-center gap-2 border-b border-slate-800/80 pb-3">
                <span class="text-aw-gold">⚙️</span> Kelola Status & Catatan Internal
            </h2>

            <form action="{{ route('admin.requests.update-status', $customRequest->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                {{-- Status Selection --}}
                <div class="space-y-1.5">
                    <label for="status" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">
                        Status Permintaan:
                    </label>
                    <select name="status" id="status" 
                            class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white p-3 focus:border-aw-gold focus:ring-aw-gold">
                        <option value="pending" {{ $customRequest->status === 'pending' ? 'selected' : '' }}>⏳ Pending (Baru Masuk)</option>
                        <option value="reviewed" {{ $customRequest->status === 'reviewed' ? 'selected' : '' }}>🔍 Ditinjau (Sedang Diproses)</option>
                        <option value="quoted" {{ $customRequest->status === 'quoted' ? 'selected' : '' }}>📄 Penawaran Terkirim (Menunggu DP)</option>
                        <option value="confirmed" {{ $customRequest->status === 'confirmed' ? 'selected' : '' }}>✓ Confirmed DP (Jadwal Terkunci)</option>
                        <option value="cancelled" {{ $customRequest->status === 'cancelled' ? 'selected' : '' }}>✕ Dibatalkan (Bebaskan Kalender)</option>
                    </select>
                </div>

                {{-- Information Box --}}
                <div class="p-3 rounded-xl bg-slate-900/80 border border-slate-800 text-[11px] text-slate-400 space-y-1">
                    <span class="font-bold text-aw-gold block">💡 Sinkronisasi Kalender:</span>
                    <p>Memilih <strong class="text-emerald-400">Confirmed DP</strong> akan otomatis mendaftarkan tanggal di Kalender Terpesan publik. Memilih <strong class="text-rose-400">Dibatalkan</strong> akan otomatis melepaskan tanggal tersebut.</p>
                </div>

                {{-- Admin Internal Notes --}}
                <div class="space-y-1.5">
                    <label for="admin_notes" class="block text-xs font-bold text-slate-300 uppercase tracking-wider">
                        Catatan Internal Admin:
                    </label>
                    <textarea name="admin_notes" id="admin_notes" rows="4" 
                              placeholder="Contoh: Sudah dikirimi proposal via WA; Menunggu approval kepala sekolah; DP 30% diterima tgl..." 
                              class="w-full rounded-xl bg-slate-900 border-slate-700 text-xs text-white placeholder-slate-500 p-3 focus:border-aw-gold focus:ring-aw-gold">{{ old('admin_notes', $customRequest->admin_notes) }}</textarea>
                </div>

                {{-- Submit Button --}}
                <button type="submit" 
                        class="w-full py-3 px-4 rounded-xl bg-aw-gold text-slate-950 font-bold text-xs hover:bg-aw-gold/90 transition-all shadow-md flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Simpan Perubahan Status</span>
                </button>
            </form>

            {{-- Booking Date Status Link --}}
            <div class="pt-3 border-t border-slate-800/80">
                <span class="text-[11px] text-slate-400 block mb-1">Status Kalender Pemesanan:</span>
                @if($customRequest->bookedDates->count() > 0)
                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-300 font-semibold">
                        <span class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span>Terkunci di Kalender ({{ $customRequest->event_date->format('d M Y') }})</span>
                        </span>
                        <a href="{{ route('admin.calendar.index', ['year' => $customRequest->event_date->year, 'month' => $customRequest->event_date->month]) }}" 
                           class="text-aw-gold hover:underline text-[11px]">
                            Lihat ↗
                        </a>
                    </div>
                @else
                    <div class="p-2.5 rounded-xl bg-slate-900 border border-slate-800 text-xs text-slate-400">
                        Tanggal belum terdaftar / telah dilepas dari kalender ketersediaan.
                    </div>
                @endif
            </div>

        </div>

    </div>

</div>

@endsection
