@extends('layouts.app')

@section('title', 'Custom Group Quotation Builder — AW Tour Operator Surabaya')

@section('content')

<!-- Header Banner -->
<div class="bg-aw-navy text-white py-12 border-b border-aw-sage/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">B2B Customized Group Tour System</span>
        <h1 class="font-display text-3xl sm:text-4xl font-extrabold">Custom Group Quotation Builder</h1>
        <p class="text-slate-300 text-xs sm:text-sm max-w-2xl mx-auto">
            Rancang perjalanan rombongan Anda hanya dalam 4 langkah mudah. Dapatkan estimasi penawaran harga resmi (*Quotation Ticket*) dan terhubung langsung ke WhatsApp Admin.
        </p>
    </div>
</div>

<!-- Main Form Section -->
<div class="py-12 bg-aw-cream/40 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Form Multi-Step Container (Alpine.js State) -->
        <div x-data="{ 
                step: {{ isset($selectedDestinationId) && $selectedDestinationId ? 2 : 1 }}, 
                selectedDestination: '{{ $selectedDestinationId ?? '' }}',
                eventType: 'Studi Tour Kampus/Sekolah',
                paxCount: 30,
                transportMode: 'Bus Pariwisata Big (45-59 Seat)',
                totalSteps: 4 
             }" 
             class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden">
            
            <!-- STEP PROGRESS BAR -->
            <div class="bg-slate-900 px-6 py-4 text-white border-b border-slate-800">
                <div class="flex items-center justify-between text-xs font-semibold mb-3">
                    <span class="text-aw-gold uppercase tracking-wider">
                        Langkah <span x-text="step"></span> dari <span x-text="totalSteps"></span>
                    </span>
                    <span class="text-slate-400" x-text="
                        step === 1 ? 'Pilih Jenis Acara & Destinasi' : 
                        step === 2 ? 'Identitas Klien & Instansi' : 
                        step === 3 ? 'Tanggal, Peserta & Armada' : 'Add-on Oleh-Oleh UMKM'
                    "></span>
                </div>

                <!-- Progress Track -->
                <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                    <div class="bg-gradient-to-r from-aw-gold to-aw-mint h-full transition-all duration-500" 
                         :style="'width: ' + (step / totalSteps * 100) + '%'"></div>
                </div>

                <!-- Step Tabs Header -->
                <div class="grid grid-cols-4 gap-2 text-center text-[11px] pt-4 text-slate-400">
                    <div :class="step >= 1 ? 'text-aw-gold font-bold' : ''">1. Acara & Destinasi</div>
                    <div :class="step >= 2 ? 'text-aw-gold font-bold' : ''">2. Data Instansi</div>
                    <div :class="step >= 3 ? 'text-aw-gold font-bold' : ''">3. Logistik & Jadwal</div>
                    <div :class="step >= 4 ? 'text-aw-gold font-bold' : ''">4. Add-on UMKM</div>
                </div>
            </div>

            <!-- FORM START -->
            <form action="{{ route('quotation.store') }}" method="POST" class="p-6 sm:p-10">
                @csrf

                <!-- ========================================================================= -->
                <!-- STEP 1: PILIHAN ACARA & DESTINASI WISATA -->
                <!-- ========================================================================= -->
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="space-y-6">
                    <div>
                        <h2 class="font-display font-bold text-xl text-aw-navy mb-1">Pilih Jenis Acara & Destinasi</h2>
                        <p class="text-xs text-slate-500">Tentukan kategori acara rombongan Anda dan lokasi destinasi tujuan.</p>
                    </div>

                    <!-- Jenis Acara -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                            Jenis Acara Rombongan <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="border rounded-2xl p-4 cursor-pointer hover:border-aw-gold transition-all flex items-center gap-3"
                                   :class="eventType === 'Studi Tour Kampus/Sekolah' ? 'border-aw-gold bg-aw-gold/5 font-semibold text-aw-navy' : 'border-slate-200'">
                                <input type="radio" name="event_type" value="Studi Tour Kampus/Sekolah" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">🎓 Studi Tour</span>
                                    <span class="text-[11px] text-slate-500 block">Kampus & Sekolah</span>
                                </div>
                            </label>

                            <label class="border rounded-2xl p-4 cursor-pointer hover:border-aw-gold transition-all flex items-center gap-3"
                                   :class="eventType === 'Capacity Building & Outbound' ? 'border-aw-gold bg-aw-gold/5 font-semibold text-aw-navy' : 'border-slate-200'">
                                <input type="radio" name="event_type" value="Capacity Building & Outbound" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">🏢 Capacity Building</span>
                                    <span class="text-[11px] text-slate-500 block">Outbound Perusahaan</span>
                                </div>
                            </label>

                            <label class="border rounded-2xl p-4 cursor-pointer hover:border-aw-gold transition-all flex items-center gap-3"
                                   :class="eventType === 'Family Gathering Instansi' ? 'border-aw-gold bg-aw-gold/5 font-semibold text-aw-navy' : 'border-slate-200'">
                                <input type="radio" name="event_type" value="Family Gathering Instansi" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">👨‍👩‍👧‍👦 Family Gathering</span>
                                    <span class="text-[11px] text-slate-500 block">Keluarga & Instansi</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Destinasi Wisata Selection -->
                    <div class="space-y-3 pt-4">
                        <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                            Pilih Destinasi Wisata Tujuan <span class="text-rose-500">*</span>
                        </label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-96 overflow-y-auto pr-2">
                            @foreach($destinations as $dest)
                                <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all flex items-start justify-between"
                                       :class="selectedDestination == '{{ $dest->id }}' ? 'border-aw-gold bg-aw-gold/5 shadow-md' : 'border-slate-200 hover:border-slate-300'">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2">
                                            <input type="radio" name="destination_id" value="{{ $dest->id }}" x-model="selectedDestination" required class="text-aw-gold focus:ring-aw-gold">
                                            <span class="font-bold text-sm text-aw-navy">{{ $dest->name }}</span>
                                        </div>
                                        <p class="text-xs text-slate-500 pl-6">📍 {{ $dest->location }}</p>
                                        <p class="text-xs font-extrabold text-aw-gold pl-6">{{ $dest->formatted_price }}</p>
                                    </div>
                                    <span class="text-[10px] bg-slate-100 text-slate-600 font-semibold px-2 py-0.5 rounded">
                                        {{ $dest->category->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Step 1 Button -->
                    <div class="pt-6 flex justify-end">
                        <button type="button" 
                                @click="if(selectedDestination) { step = 2 } else { alert('Silakan pilih salah satu destinasi wisata terlebih dahulu.') }"
                                class="bg-aw-gold hover:bg-aw-gold-600 text-white font-bold px-7 py-3 rounded-xl text-sm shadow-md transition-all">
                            Lanjut: Data Instansi &rarr;
                        </button>
                    </div>
                </div>


                <!-- ========================================================================= -->
                <!-- STEP 2: IDENTITAS KLIEN & INSTANSI -->
                <!-- ========================================================================= -->
                <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" class="space-y-6">
                    <div>
                        <h2 class="font-display font-bold text-xl text-aw-navy mb-1">Identitas Klien & Instansi</h2>
                        <p class="text-xs text-slate-500">Masukkan nama penanggung jawab dan nomor WhatsApp untuk penerimaan PDF Quotation.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- Nama PIC -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Nama Penanggung Jawab (PIC) <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="client_name" required placeholder="Contoh: Bpk. Ahmad Fauzi"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                        <!-- Nama Institusi -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Nama Kampus / Sekolah / Instansi <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="institution_name" required placeholder="Contoh: BEM FT ITS Surabaya / PT. Semen Indonesia"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                        <!-- WhatsApp Phone -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Nomor WhatsApp Aktif <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="phone" required placeholder="Contoh: 081234567890"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                            <span class="text-[11px] text-slate-400 block mt-1">Ringkasan tiket akan dikirimkan ke nomor ini via WhatsApp.</span>
                        </div>

                        <!-- Email (Optional) -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Email Instansi (Opsional)
                            </label>
                            <input type="email" name="email" placeholder="Contoh: pemesanan@its.ac.id"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                    </div>

                    <!-- Step 2 Buttons -->
                    <div class="pt-6 flex justify-between">
                        <button type="button" @click="step = 1" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-5 py-3 rounded-xl text-sm">
                            &larr; Kembali
                        </button>
                        <button type="button" @click="step = 3" class="bg-aw-gold hover:bg-aw-gold-600 text-white font-bold px-7 py-3 rounded-xl text-sm shadow-md">
                            Lanjut: Jadwal & Armada &rarr;
                        </button>
                    </div>
                </div>


                <!-- ========================================================================= -->
                <!-- STEP 3: TANGGAL, PESERTA & LOGISTIK -->
                <!-- ========================================================================= -->
                <div x-show="step === 3" x-cloak x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" class="space-y-6">
                    <div>
                        <h2 class="font-display font-bold text-xl text-aw-navy mb-1">Tanggal, Peserta & Armada</h2>
                        <p class="text-xs text-slate-500">Tentukan estimasi jumlah rombongan, moda transportasi, dan tanggal pelaksanaan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        
                        <!-- Tanggal Keberangkatan -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Tanggal Keberangkatan <span class="text-rose-500">*</span>
                            </label>
                            <input type="date" name="event_date" value="{{ old('event_date', $selectedDate ?? '') }}" required min="{{ date('Y-m-d') }}"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                        <!-- Tanggal Kepulangan -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Tanggal Pulang (Opsional untuk Multi-hari)
                            </label>
                            <input type="date" name="return_date" min="{{ date('Y-m-d') }}"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                        <!-- Quantitas Pax -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Estimasi Jumlah Peserta (Pax) <span class="text-rose-500">*</span>
                            </label>
                            <input type="number" name="pax" required min="1" x-model="paxCount"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                        <!-- Pilihan Armada Transportasi -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Moda Transportasi Armada <span class="text-rose-500">*</span>
                            </label>
                            <select name="transport_mode" x-model="transportMode" required class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                                <option value="Bus Pariwisata Big (45-59 Seat)">Bus Pariwisata Big (45 - 59 Seat)</option>
                                <option value="Bus Medium (30-35 Seat)">Bus Medium (30 - 35 Seat)</option>
                                <option value="HiAce / Elf Long (14-19 Seat)">HiAce / Elf Long (14 - 19 Seat)</option>
                                <option value="Kereta Api Executive Group">Kereta Api Executive Group</option>
                                <option value="Pesawat Terbang Group Charter">Pesawat Terbang Group Charter</option>
                            </select>
                        </div>

                    </div>

                    <!-- Catatan Tambahan -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                            Catatan / Permintaan Khusus (Opsional)
                        </label>
                        <textarea name="notes" rows="3" placeholder="Contoh: Mohon sertakan spanduk rombongan BEM FT ITS dan dokumentasi drone."
                                  class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold"></textarea>
                    </div>

                    <!-- Step 3 Buttons -->
                    <div class="pt-6 flex justify-between">
                        <button type="button" @click="step = 2" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-5 py-3 rounded-xl text-sm">
                            &larr; Kembali
                        </button>
                        <button type="button" @click="step = 4" class="bg-aw-gold hover:bg-aw-gold-600 text-white font-bold px-7 py-3 rounded-xl text-sm shadow-md">
                            Lanjut: Add-on Oleh-Oleh &rarr;
                        </button>
                    </div>
                </div>


                <!-- ========================================================================= -->
                <!-- STEP 4: ADD-ON PRODUK UMKM LOKAL & SUBMIT -->
                <!-- ========================================================================= -->
                <div x-show="step === 4" x-cloak x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" class="space-y-6">
                    <div>
                        <h2 class="font-display font-bold text-xl text-aw-navy mb-1">Add-on Oleh-Oleh UMKM Jawa Timur</h2>
                        <p class="text-xs text-slate-500">Pilih oleh-oleh khas daerah yang ingin langsung disertakan untuk seluruh peserta rombongan.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-80 overflow-y-auto pr-2">
                        @foreach($umkmProducts as $index => $prod)
                            <div class="border rounded-2xl p-4 border-slate-200 flex items-center justify-between bg-slate-50/60">
                                <div class="space-y-1 pr-2">
                                    <span class="font-bold text-sm text-aw-navy block">{{ $prod->name }}</span>
                                    <span class="text-xs text-slate-500 block">{{ $prod->producer }}</span>
                                    <span class="text-xs font-extrabold text-aw-gold block">{{ $prod->formatted_price }}</span>
                                </div>
                                <div class="w-24">
                                    <input type="hidden" name="umkm_products[{{ $index }}][id]" value="{{ $prod->id }}">
                                    <label class="text-[10px] text-slate-400 block font-semibold">Jumlah ({{ $prod->unit }})</label>
                                    <input type="number" min="0" value="0" name="umkm_products[{{ $index }}][quantity]" 
                                           class="w-full rounded-lg border-slate-300 text-xs text-center focus:ring-aw-gold">
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- RINGKASAN AKHIR BEFORE SUBMIT -->
                    <div class="bg-aw-navy text-white p-5 rounded-2xl border border-aw-sage/30 space-y-2 text-xs">
                        <div class="flex items-center justify-between font-bold text-aw-gold">
                            <span>Kategori Acara:</span>
                            <span x-text="eventType"></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Estimasi Peserta:</span>
                            <span class="font-semibold" x-text="paxCount + ' orang'"></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Armada Transportasi:</span>
                            <span class="font-semibold" x-text="transportMode"></span>
                        </div>
                    </div>

                    <!-- Final Action Buttons -->
                    <div class="pt-6 flex justify-between items-center">
                        <button type="button" @click="step = 3" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-5 py-3 rounded-xl text-sm">
                            &larr; Kembali
                        </button>

                        <button type="submit" 
                                class="bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold px-8 py-3.5 rounded-full text-sm shadow-xl hover:scale-105 transition-all flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Kirim & Generate Tiket Quotation</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
