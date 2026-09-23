@extends('layouts.app')

@section('title', 'Tiket Quotation ' . $customRequest->ticket_number . ' — AW Tour Operator')

@section('content')

<div class="py-12 bg-aw-cream/40 min-h-screen print:bg-white print:py-0">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- MAIN TICKET CARD -->
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden print:shadow-none print:border-none">
            
            <!-- HEADER TIKET QUOTATION -->
            <div class="bg-aw-navy text-white p-8 border-b border-aw-sage/20 relative overflow-hidden print:bg-slate-900">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="bg-emerald-500/20 text-emerald-400 text-xs font-semibold px-3 py-1 rounded-full border border-emerald-500/40">
                                Status: {{ strtoupper($customRequest->status) }}
                            </span>
                            <span class="text-xs text-slate-400">
                                {{ $customRequest->created_at->format('d M Y H:i') }} WIB
                            </span>
                        </div>
                        <h1 class="font-display font-bold text-2xl sm:text-3xl text-white">
                            TIKET QUOTATION
                        </h1>
                        <p class="text-xs text-slate-300">AW Tour Operator Surabaya — Group Customized Tour</p>
                    </div>

                    <!-- TICKET NUMBER BADGE -->
                    <div class="bg-slate-800/90 border border-aw-gold/40 p-4 rounded-2xl text-center">
                        <span class="text-[10px] text-slate-400 uppercase tracking-widest block">Nomor Tiket Rekam</span>
                        <span class="font-mono font-extrabold text-xl text-aw-gold tracking-wider">
                            {{ $customRequest->ticket_number }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- CONTENT RINGKASAN TIKET -->
            <div class="p-8 space-y-8">
                
                <!-- NOTIFIKASI INFO -->
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 p-4 rounded-2xl text-xs flex items-start gap-3 print:hidden">
                    <span class="text-lg">🎉</span>
                    <div>
                        <strong class="font-bold block">Permintaan Quotation Berhasil Ditampilkan & Dibuat!</strong>
                        <span>Silakan klik tombol <strong class="underline">Lanjutkan ke WhatsApp Admin</strong> di bawah ini untuk menerima invoice resmi PDF dan konfirmasi ketersediaan armada.</span>
                    </div>
                </div>

                <!-- GRID DETAIL INFORMASI KLIEN & ACARA -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <!-- INFORMASI KLIEN -->
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-2">
                        <h3 class="font-display font-bold text-sm text-aw-navy uppercase tracking-wider text-aw-gold">
                            Identitas Pemesan
                        </h3>
                        <div class="text-xs space-y-1.5 pt-1">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Nama PIC:</span>
                                <span class="font-bold text-aw-navy">{{ $customRequest->client_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Institusi / PT:</span>
                                <span class="font-bold text-aw-navy">{{ $customRequest->institution_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">No. WhatsApp:</span>
                                <span class="font-bold text-slate-800">{{ $customRequest->phone }}</span>
                            </div>
                            @if($customRequest->email)
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Email:</span>
                                    <span class="font-semibold text-slate-700">{{ $customRequest->email }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- INFORMASI ACARA -->
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-2">
                        <h3 class="font-display font-bold text-sm text-aw-navy uppercase tracking-wider text-aw-gold">
                            Detail Perjalanan
                        </h3>
                        <div class="text-xs space-y-1.5 pt-1">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Kategori Acara:</span>
                                <span class="font-bold text-aw-navy">{{ $customRequest->event_type }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Destinasi:</span>
                                <span class="font-bold text-aw-navy">{{ $customRequest->destination->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Tgl Keberangkatan:</span>
                                <span class="font-bold text-emerald-700">{{ $customRequest->event_date->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Estimasi Peserta:</span>
                                <span class="font-bold text-aw-navy">{{ $customRequest->pax }} Pax</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Armada Transport:</span>
                                <span class="font-semibold text-slate-800">{{ $customRequest->transport_mode }}</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ADD-ON PRODUK UMKM JIKA ADA -->
                @if($customRequest->umkmOrders->count() > 0)
                    <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 space-y-3">
                        <h3 class="font-display font-bold text-sm text-aw-navy uppercase tracking-wider text-aw-gold">
                            Add-on Oleh-Oleh UMKM yang Dipilih
                        </h3>
                        <div class="divide-y divide-slate-200 text-xs">
                            @foreach($customRequest->umkmOrders as $order)
                                <div class="py-2 flex items-center justify-between">
                                    <div>
                                        <span class="font-bold text-aw-navy">{{ $order->product->name }}</span>
                                        <span class="text-slate-500 text-[11px] block">{{ $order->product->producer }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="font-semibold text-slate-700">{{ $order->quantity }} {{ $order->product->unit }}</span>
                                        <span class="font-bold text-aw-gold block">{{ $order->formatted_subtotal }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($customRequest->notes)
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 text-xs">
                        <span class="font-bold text-slate-700 block mb-1">Catatan / Permintaan Khusus:</span>
                        <p class="text-slate-600 italic">"{{ $customRequest->notes }}"</p>
                    </div>
                @endif

                <!-- LAYANAN KONSULTASI ADMIN WA -->
                <div class="border-t border-slate-200 pt-6 space-y-4 print:hidden">
                    <div class="flex flex-col sm:flex-row items-center gap-3">
                        
                        <!-- WHATSAPP DIRECT LINK BUTTON -->
                        <a href="{{ $customRequest->whatsapp_url }}" 
                           target="_blank"
                           class="w-full sm:flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold px-6 py-4 rounded-full text-center shadow-xl hover:scale-105 transition-all flex items-center justify-center gap-3 text-sm">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                            </svg>
                            <span>Lanjutkan ke WhatsApp Admin (+62 822-3311-9092)</span>
                        </a>

                        <!-- CETAK / SIMPAN PDF BUTTON -->
                        <button onclick="window.print()" 
                                class="w-full sm:w-auto bg-slate-800 hover:bg-slate-700 text-white font-semibold px-6 py-4 rounded-full text-xs transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            <span>Cetak / Save PDF Tiket</span>
                        </button>

                    </div>

                    <div class="text-center">
                        <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-aw-navy underline">
                            Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
