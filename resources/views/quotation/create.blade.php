@extends('layouts.app')

@section('title', 'Custom Group Quotation Builder — AW Tour Operator Surabaya')

@push('styles')
<style>
    /* CSS Print Rules untuk Cetak Dokumen A4 Rinci */
    @media print {
        body * {
            visibility: hidden !important;
        }
        #quotation-document-card, #quotation-document-card * {
            visibility: visible !important;
        }
        #quotation-document-card {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 24px !important;
            box-shadow: none !important;
            border: 1px solid #cbd5e1 !important;
            background: #ffffff !important;
            color: #010818 !important;
        }
        .no-print {
            display: none !important;
        }
        @page {
            size: A4;
            margin: 12mm;
        }
    }
</style>
@endpush

@section('content')

<!-- Header Banner -->
<div class="bg-aw-navy text-white py-12 border-b border-aw-sage/20 no-print">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">B2B Customized Group Tour System</span>
        <h1 class="font-display text-3xl sm:text-4xl font-extrabold">Custom Group Quotation Builder</h1>
        <p class="text-slate-300 text-xs sm:text-sm max-w-2xl mx-auto">
            Rancang perjalanan rombongan Anda hanya dalam 4 langkah mudah. Dapatkan estimasi penawaran harga resmi (*Quotation Ticket*) dan terhubung langsung ke WhatsApp Admin.
        </p>
    </div>
</div>

<!-- Main Form Section -->
<div class="py-12 bg-aw-cream/40 min-h-screen relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Form Multi-Step Container (Alpine.js State) -->
        <div x-data="{ 
                step: {{ isset($selectedDestinationId) && $selectedDestinationId ? 2 : (isset($selectedTransport) && $selectedTransport ? 3 : 1) }}, 
                totalSteps: 4,

                // Step 1 State
                eventType: 'Studi Tour Kampus/Sekolah',
                destinationChoice: '{{ $selectedDestinationId ?? '' }}',
                customDestinationInput: '',

                // Step 2 State
                clientName: '',
                institutionName: '',
                phone: '',
                email: '',

                // Step 3 State
                eventDate: '{{ $selectedDate ?? '' }}',
                returnDate: '',
                departureTime: '07:00',
                returnTime: '',
                paxCount: 30,
                departurePoint: '',
                pickupNotes: '',
                
                // Transport State
                transportType: '{{ $selectedTransport ? (str_contains($selectedTransport, 'Bus') || str_contains($selectedTransport, 'HiAce') ? 'darat' : 'darat') : 'darat' }}', 
                daratVehicle: '{{ $selectedTransport ?? 'Big Bus' }}', 
                localTransport: '', 
                customTransportDetails: '',

                // Hotel State
                needHotel: 'Tidak', 
                hotelRooms: 10,
                hotelRoomType: 'Belum menentukan', 
                hotelNotes: '',

                // Special Notes State
                specialNotes: '',

                // Toast Notification State
                toast: {
                    show: false,
                    message: ''
                },
                showToast(msg) {
                    this.toast.message = msg;
                    this.toast.show = true;
                    setTimeout(() => {
                        this.toast.show = false;
                    }, 3200);
                },

                // Step 1 Validation
                validateStep1() {
                    if (!this.eventType) {
                        this.showToast('Silakan pilih jenis acara terlebih dahulu.');
                        return;
                    }
                    if (!this.destinationChoice) {
                        this.showToast('Silakan pilih destinasi tujuan terlebih dahulu.');
                        return;
                    }
                    if (this.destinationChoice === 'other' && (!this.customDestinationInput || !this.customDestinationInput.trim())) {
                        this.showToast('Silakan masukkan destinasi yang ingin Anda tuju.');
                        return;
                    }
                    this.step = 2;
                    window.scrollTo({ top: 180, behavior: 'smooth' });
                },

                // Step 2 Validation
                validateStep2() {
                    if (!this.clientName || !this.clientName.trim()) {
                        this.showToast('Silakan isi Nama Penanggung Jawab (PIC).');
                        return;
                    }
                    if (!this.institutionName || !this.institutionName.trim()) {
                        this.showToast('Silakan isi Nama Kampus / Sekolah / Instansi.');
                        return;
                    }
                    if (!this.phone || !this.phone.trim()) {
                        this.showToast('Silakan isi Nomor WhatsApp Aktif.');
                        return;
                    }
                    this.step = 3;
                    window.scrollTo({ top: 180, behavior: 'smooth' });
                },

                // Step 3 Validation
                validateStep3() {
                    if (!this.eventDate) {
                        this.showToast('Silakan tentukan tanggal keberangkatan.');
                        return;
                    }
                    if (!this.paxCount || this.paxCount < 1) {
                        this.showToast('Silakan isi estimasi jumlah peserta (PAX).');
                        return;
                    }
                    if (!this.departurePoint || !this.departurePoint.trim()) {
                        this.showToast('Silakan isi titik keberangkatan rombongan.');
                        return;
                    }
                    if (!this.transportType) {
                        this.showToast('Silakan pilih rencana transportasi.');
                        return;
                    }
                    if (this.transportType === 'custom' && (!this.customTransportDetails || !this.customTransportDetails.trim())) {
                        this.showToast('Silakan jelaskan kebutuhan transportasi custom Anda.');
                        return;
                    }
                    if (this.returnDate && new Date(this.returnDate) < new Date(this.eventDate)) {
                        this.showToast('Tanggal pulang tidak boleh lebih awal dari tanggal keberangkatan.');
                        return;
                    }
                    this.step = 4;
                    window.scrollTo({ top: 180, behavior: 'smooth' });
                },

                // Computed Duration String
                get durationText() {
                    if (!this.eventDate) return '1 hari (Day Trip)';
                    if (!this.returnDate || this.eventDate === this.returnDate) return '1 hari (Day Trip)';
                    
                    let start = new Date(this.eventDate);
                    let end = new Date(this.returnDate);
                    let diffTime = Math.abs(end - start);
                    let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                    let nights = diffDays - 1;
                    
                    if (diffDays <= 1) return '1 hari (Day Trip)';
                    return diffDays + ' hari / ' + nights + ' malam';
                },

                // Computed Destination Display Name
                get destinationDisplayName() {
                    if (this.destinationChoice === 'singapore') return 'Singapore';
                    if (this.destinationChoice === 'malaysia') return 'Malaysia';
                    if (this.destinationChoice === 'vietnam') return 'Vietnam';
                    if (this.destinationChoice === 'other') return this.customDestinationInput || 'Destinasi Custom';
                    
                    let checkedRadio = document.querySelector('input[name=dest_radio_item]:checked');
                    if (checkedRadio && checkedRadio.dataset.name) {
                        return checkedRadio.dataset.name;
                    }
                    return 'Destinasi Pilihan';
                },

                // Computed Transport Mode Summary String
                get transportModeSummary() {
                    if (this.transportType === 'darat') {
                        return 'Transportasi Darat (' + this.daratVehicle + ')';
                    }
                    if (this.transportType === 'kereta') {
                        return 'Kereta Api + Transportasi Lokal (' + this.localTransport + ')';
                    }
                    if (this.transportType === 'pesawat') {
                        return 'Pesawat + Transportasi Lokal (' + this.localTransport + ')';
                    }
                    if (this.transportType === 'custom') {
                        return 'Kombinasi / Custom: ' + (this.customTransportDetails || 'Sesuai Permintaan');
                    }
                    return 'Transportasi Rombongan';
                },

                // Auto-toggle Need Hotel if Duration > 1 day
                checkHotelAutoShow() {
                    if (this.returnDate && this.eventDate && this.returnDate > this.eventDate) {
                        if (this.needHotel !== 'Ya' && this.needHotel !== 'Tidak') {
                            this.needHotel = 'Ya';
                        }
                    }
                }
             }" 
             class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden relative">
            
            <!-- TOAST NOTIFICATION POPUP -->
            <div x-show="toast.show" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                 class="fixed top-6 right-6 z-50 max-w-sm bg-aw-navy text-white px-5 py-4 rounded-2xl shadow-2xl border border-aw-gold/40 flex items-center gap-3.5 backdrop-blur-md no-print">
                <div class="w-8 h-8 rounded-xl bg-aw-gold/20 text-aw-gold flex items-center justify-center shrink-0 font-bold text-base">
                    ⚠️
                </div>
                <div class="flex-1">
                    <p class="text-xs font-bold text-aw-gold uppercase tracking-wider mb-0.5">Perhatian</p>
                    <p class="text-xs text-slate-200 font-medium leading-snug" x-text="toast.message"></p>
                </div>
                <button @click="toast.show = false" type="button" class="text-slate-400 hover:text-white text-xs font-bold ml-1">
                    ✕
                </button>
            </div>

            <!-- STEP PROGRESS BAR -->
            <div class="bg-slate-900 px-6 py-4 text-white border-b border-slate-800 no-print">
                <div class="flex items-center justify-between text-xs font-semibold mb-3">
                    <span class="text-aw-gold uppercase tracking-wider">
                        Langkah <span x-text="step"></span> dari <span x-text="totalSteps"></span>
                    </span>
                    <span class="text-slate-400" x-text="
                        step === 1 ? 'Pilih Jenis Acara & Destinasi' : 
                        step === 2 ? 'Identitas Klien & Instansi' : 
                        step === 3 ? 'Logistik, Jadwal & Transportasi' : 'Review & Kirim Permintaan'
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
                    <div :class="step >= 4 ? 'text-aw-gold font-bold' : ''">4. Review & Kirim</div>
                </div>
            </div>

            <!-- FORM START -->
            <form action="{{ route('quotation.store') }}" method="POST" id="quotation-form" class="p-6 sm:p-10">
                @csrf

                <!-- HIDDEN INPUTS TO SUBMIT ALL FORM DATA -->
                <input type="hidden" name="destination_id" :value="['singapore','malaysia','vietnam','other'].includes(destinationChoice) ? '' : destinationChoice">
                <input type="hidden" name="custom_destination" :value="
                    destinationChoice === 'singapore' ? 'Singapore' :
                    (destinationChoice === 'malaysia' ? 'Malaysia' :
                    (destinationChoice === 'vietnam' ? 'Vietnam' :
                    (destinationChoice === 'other' ? customDestinationInput : '')))
                ">
                <input type="hidden" name="client_name" :value="clientName">
                <input type="hidden" name="institution_name" :value="institutionName">
                <input type="hidden" name="phone" :value="phone">
                <input type="hidden" name="email" :value="email">
                <input type="hidden" name="event_type" :value="eventType">
                <input type="hidden" name="event_date" :value="eventDate">
                <input type="hidden" name="return_date" :value="returnDate">
                <input type="hidden" name="pax" :value="paxCount">
                <input type="hidden" name="transport_mode" :value="transportModeSummary">
                <input type="hidden" name="departure_point" :value="departurePoint">
                <input type="hidden" name="departure_time" :value="departureTime">
                <input type="hidden" name="return_time" :value="returnTime">
                <input type="hidden" name="pickup_notes" :value="pickupNotes">
                <input type="hidden" name="need_hotel" :value="needHotel">
                <input type="hidden" name="hotel_rooms" :value="hotelRooms">
                <input type="hidden" name="hotel_room_type" :value="hotelRoomType">
                <input type="hidden" name="hotel_notes" :value="hotelNotes">
                <input type="hidden" name="special_notes" :value="specialNotes">


                <!-- ========================================================================= -->
                <!-- STEP 1: PILIHAN ACARA & DESTINASI WISATA -->
                <!-- ========================================================================= -->
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="space-y-8">
                    <div>
                        <h2 class="font-display font-bold text-xl text-aw-navy mb-1">Pilih Jenis Acara & Destinasi</h2>
                        <p class="text-xs text-slate-500">Tentukan kategori acara rombongan Anda dan lokasi destinasi tujuan.</p>
                    </div>

                    <!-- Jenis Acara Rombongan -->
                    <div class="space-y-3">
                        <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                            Jenis Acara Rombongan <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                            <label class="border rounded-2xl p-4 cursor-pointer hover:border-aw-gold transition-all flex items-center gap-3"
                                   :class="eventType === 'Studi Tour Kampus/Sekolah' ? 'border-aw-gold bg-aw-gold/5 font-semibold text-aw-navy shadow-sm' : 'border-slate-200'">
                                <input type="radio" value="Studi Tour Kampus/Sekolah" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">🎓 Studi Tour</span>
                                    <span class="text-[11px] text-slate-500 block">Kampus & Sekolah</span>
                                </div>
                            </label>

                            <label class="border rounded-2xl p-4 cursor-pointer hover:border-aw-gold transition-all flex items-center gap-3"
                                   :class="eventType === 'Capacity Building & Outbound' ? 'border-aw-gold bg-aw-gold/5 font-semibold text-aw-navy shadow-sm' : 'border-slate-200'">
                                <input type="radio" value="Capacity Building & Outbound" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">🏢 Capacity Building</span>
                                    <span class="text-[11px] text-slate-500 block">Outbound Perusahaan</span>
                                </div>
                            </label>

                            <label class="border rounded-2xl p-4 cursor-pointer hover:border-aw-gold transition-all flex items-center gap-3"
                                   :class="eventType === 'Family Gathering Instansi' ? 'border-aw-gold bg-aw-gold/5 font-semibold text-aw-navy shadow-sm' : 'border-slate-200'">
                                <input type="radio" value="Family Gathering Instansi" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">👨‍👩‍👧‍👦 Family Gathering</span>
                                    <span class="text-[11px] text-slate-500 block">Keluarga & Instansi</span>
                                </div>
                            </label>

                            <label class="border rounded-2xl p-4 cursor-pointer hover:border-aw-gold transition-all flex items-center gap-3"
                                   :class="eventType === 'Study Tiru / Bundling' ? 'border-aw-gold bg-aw-gold/5 font-semibold text-aw-navy shadow-sm' : 'border-slate-200'">
                                <input type="radio" value="Study Tiru / Bundling" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">🤝 Study Tiru / Bundling</span>
                                    <span class="text-[11px] text-slate-500 block">Kunjungan & Program Khusus</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Destinasi Wisata Selection -->
                    <div class="space-y-4 pt-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                                Pilih Destinasi Wisata Tujuan <span class="text-rose-500">*</span>
                            </label>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Pilih destinasi yang tersedia atau ajukan destinasi sesuai kebutuhan perjalanan Anda.
                            </p>
                        </div>

                        <div class="space-y-6 max-h-[30rem] overflow-y-auto pr-2">
                            
                            {{-- A. DESTINASI POPULER --}}
                            <div class="space-y-2.5">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold uppercase tracking-wider text-aw-gold bg-aw-gold/10 px-2.5 py-1 rounded-md">
                                        🌴 Destinasi Populer
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach($destinations as $dest)
                                        <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all flex items-start justify-between"
                                               :class="destinationChoice == '{{ $dest->id }}' ? 'border-aw-gold bg-aw-gold/5 shadow-md' : 'border-slate-200 hover:border-slate-300'">
                                            <div class="space-y-1">
                                                <div class="flex items-center gap-2">
                                                    <input type="radio" 
                                                           name="dest_radio_item"
                                                           data-name="{{ $dest->name }}"
                                                           value="{{ $dest->id }}" 
                                                           x-model="destinationChoice" 
                                                           class="text-aw-gold focus:ring-aw-gold">
                                                    <span class="font-bold text-sm text-aw-navy">{{ $dest->name }}</span>
                                                </div>
                                                <p class="text-xs text-slate-500 pl-6">📍 {{ $dest->location }}</p>
                                                <p class="text-xs font-extrabold text-aw-gold pl-6">{{ $dest->formatted_price }}</p>
                                            </div>
                                            <span class="text-[10px] bg-slate-100 text-slate-600 font-semibold px-2 py-0.5 rounded shrink-0">
                                                {{ $dest->category->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- B. LUAR NEGERI --}}
                            <div class="space-y-2.5 pt-2 border-t border-slate-100">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md">
                                        ✈️ Luar Negeri
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    {{-- Singapore --}}
                                    <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all flex items-start justify-between"
                                           :class="destinationChoice === 'singapore' ? 'border-aw-gold bg-aw-gold/5 shadow-md' : 'border-slate-200 hover:border-slate-300'">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <input type="radio" value="singapore" x-model="destinationChoice" class="text-aw-gold focus:ring-aw-gold">
                                                <span class="font-bold text-sm text-aw-navy">Singapore</span>
                                            </div>
                                            <p class="text-xs text-slate-500 pl-6">🇸🇬 Asia Tenggara</p>
                                            <p class="text-[11px] font-semibold text-slate-500 pl-6 italic">Harga berdasarkan quotation</p>
                                        </div>
                                    </label>

                                    {{-- Malaysia --}}
                                    <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all flex items-start justify-between"
                                           :class="destinationChoice === 'malaysia' ? 'border-aw-gold bg-aw-gold/5 shadow-md' : 'border-slate-200 hover:border-slate-300'">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <input type="radio" value="malaysia" x-model="destinationChoice" class="text-aw-gold focus:ring-aw-gold">
                                                <span class="font-bold text-sm text-aw-navy">Malaysia</span>
                                            </div>
                                            <p class="text-xs text-slate-500 pl-6">🇲🇾 Asia Tenggara</p>
                                            <p class="text-[11px] font-semibold text-slate-500 pl-6 italic">Harga berdasarkan quotation</p>
                                        </div>
                                    </label>

                                    {{-- Vietnam --}}
                                    <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all flex items-start justify-between"
                                           :class="destinationChoice === 'vietnam' ? 'border-aw-gold bg-aw-gold/5 shadow-md' : 'border-slate-200 hover:border-slate-300'">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <input type="radio" value="vietnam" x-model="destinationChoice" class="text-aw-gold focus:ring-aw-gold">
                                                <span class="font-bold text-sm text-aw-navy">Vietnam</span>
                                            </div>
                                            <p class="text-xs text-slate-500 pl-6">🇻🇳 Asia Tenggara</p>
                                            <p class="text-[11px] font-semibold text-slate-500 pl-6 italic">Harga berdasarkan quotation</p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- C. DESTINASI LAIN --}}
                            <div class="space-y-2.5 pt-2 border-t border-slate-100">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold uppercase tracking-wider text-amber-800 bg-amber-100 px-2.5 py-1 rounded-md">
                                        ✨ Request Destinasi Custom
                                    </span>
                                </div>

                                <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all block"
                                       :class="destinationChoice === 'other' ? 'border-aw-gold bg-aw-gold/5 shadow-md' : 'border-slate-200 hover:border-slate-300'">
                                    <div class="flex items-start justify-between">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <input type="radio" value="other" x-model="destinationChoice" class="text-aw-gold focus:ring-aw-gold">
                                                <span class="font-bold text-sm text-aw-navy">Destinasi Lain</span>
                                            </div>
                                            <p class="text-xs text-slate-500 pl-6">
                                                Belum menemukan tujuan yang Anda inginkan? Ajukan destinasi sesuai kebutuhan rombongan.
                                            </p>
                                            <p class="text-[11px] font-semibold text-slate-500 pl-6 italic">Harga berdasarkan quotation</p>
                                        </div>
                                    </div>
                                </label>

                                {{-- Input Teks Destinasi Lain --}}
                                <div x-show="destinationChoice === 'other'" 
                                     x-cloak 
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 -translate-y-2"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="bg-amber-50/80 border border-amber-200 rounded-2xl p-4 space-y-2 mt-2">
                                    <label class="block text-xs font-bold uppercase text-amber-950">
                                        Masukkan destinasi yang diinginkan <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" 
                                           x-model="customDestinationInput" 
                                           placeholder="Contoh: Bali, Yogyakarta, Singapore, Malaysia, Vietnam, dll."
                                           class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold bg-white">
                                    <span class="text-[11px] text-amber-800 block">
                                        Tim AW TOUR akan menghitung estimasi biaya resmi sesuai destinasi yang Anda request.
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Step 1 Button -->
                    <div class="pt-6 flex justify-end">
                        <button type="button" 
                                @click="validateStep1()"
                                class="bg-aw-gold hover:bg-aw-gold-600 text-white font-bold px-7 py-3 rounded-xl text-sm shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                            <span>Lanjut: Data Instansi</span> &rarr;
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
                            <input type="text" x-model="clientName" required placeholder="Contoh: Bpk. Ahmad Fauzi"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                        <!-- Nama Institusi -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Nama Kampus / Sekolah / Instansi <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" x-model="institutionName" required placeholder="Contoh: BEM FT ITS Surabaya / PT. Semen Indonesia"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                        <!-- WhatsApp Phone -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Nomor WhatsApp Aktif <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" x-model="phone" required placeholder="Contoh: 081234567890"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                            <span class="text-[11px] text-slate-400 block mt-1">Ringkasan tiket akan dikirimkan ke nomor ini via WhatsApp.</span>
                        </div>

                        <!-- Email (Optional) -->
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Email Instansi (Opsional)
                            </label>
                            <input type="email" x-model="email" placeholder="Contoh: pemesanan@its.ac.id"
                                   class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                        </div>

                    </div>

                    <!-- Step 2 Buttons -->
                    <div class="pt-6 flex justify-between">
                        <button type="button" @click="step = 1" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-5 py-3 rounded-xl text-sm">
                            &larr; Kembali
                        </button>
                        <button type="button" @click="validateStep2()" class="bg-aw-gold hover:bg-aw-gold-600 text-white font-bold px-7 py-3 rounded-xl text-sm shadow-md">
                            Lanjut: Logistik & Jadwal &rarr;
                        </button>
                    </div>
                </div>


                <!-- ========================================================================= -->
                <!-- STEP 3: TANGGAL, PESERTA & TRANSPORTASI -->
                <!-- ========================================================================= -->
                <div x-show="step === 3" x-cloak x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" class="space-y-8">
                    <div>
                        <h2 class="font-display font-bold text-xl text-aw-navy mb-1">Tanggal, Peserta & Transportasi</h2>
                        <p class="text-xs text-slate-500">Tentukan jadwal perjalanan, jumlah peserta, titik keberangkatan, dan kebutuhan transportasi rombongan.</p>
                    </div>

                    {{-- A. JADWAL PERJALANAN --}}
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                                A. Jadwal Perjalanan Rombongan <span class="text-rose-500">*</span>
                            </label>
                            <span class="text-xs font-bold text-aw-gold bg-aw-gold/10 px-3 py-1 rounded-full border border-aw-gold/20" x-text="durationText"></span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Tanggal Keberangkatan -->
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">
                                    Tanggal Keberangkatan <span class="text-rose-500">*</span>
                                </label>
                                <input type="date" 
                                       x-model="eventDate" 
                                       @change="checkHotelAutoShow()" 
                                       required 
                                       min="{{ date('Y-m-d') }}"
                                       class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                            </div>

                            <!-- Tanggal Kepulangan -->
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">
                                    Tanggal Pulang (Opsional jika 1 Hari)
                                </label>
                                <input type="date" 
                                       x-model="returnDate" 
                                       @change="checkHotelAutoShow()" 
                                       min="{{ date('Y-m-d') }}"
                                       class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                            </div>

                            <!-- Perkiraan Waktu Keberangkatan -->
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">
                                    Perkiraan Waktu Keberangkatan (Jam)
                                </label>
                                <input type="time" x-model="departureTime"
                                       class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                                <span class="text-[11px] text-slate-400 block mt-1">Contoh: 07:00 WIB</span>
                            </div>

                            <!-- Perkiraan Waktu Kepulangan -->
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">
                                    Perkiraan Waktu Tiba Kembali (Jam)
                                </label>
                                <input type="time" x-model="returnTime"
                                       class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                                <span class="text-[11px] text-slate-400 block mt-1">Opsional / Perkiraan</span>
                            </div>
                        </div>
                    </div>

                    {{-- B. JUMLAH PESERTA --}}
                    <div class="space-y-3 pt-2 border-t border-slate-100">
                        <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                            B. Estimasi Jumlah Peserta (PAX) <span class="text-rose-500">*</span>
                        </label>
                        <div class="max-w-xs">
                            <div class="relative rounded-xl shadow-sm">
                                <input type="number" 
                                       x-model="paxCount" 
                                       required 
                                       min="1" 
                                       class="w-full rounded-xl border-slate-300 text-sm font-bold text-aw-navy pl-4 pr-16 focus:border-aw-gold focus:ring-aw-gold">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-xs font-bold text-slate-500">
                                    Peserta
                                </div>
                            </div>
                            <span class="text-[11px] text-slate-400 block mt-1">Data ini digunakan untuk rekomendasi kapasitas armada.</span>
                        </div>
                    </div>

                    {{-- C. TITIK KEBERANGKATAN --}}
                    <div class="space-y-3 pt-2 border-t border-slate-100">
                        <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                            C. Titik Keberangkatan & Penjemputan <span class="text-rose-500">*</span>
                        </label>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">
                                    Titik Keberangkatan Rombongan <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       x-model="departurePoint" 
                                       required 
                                       placeholder="Contoh: Universitas Negeri Surabaya, Ketintang"
                                       class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1">
                                    Lokasi Penjemputan / Catatan Penjemputan (Opsional)
                                </label>
                                <input type="text" 
                                       x-model="pickupNotes" 
                                       placeholder="Contoh: Depan Rektorat UNESA Ketintang / Rest Area Tol Waru"
                                       class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold">
                            </div>
                        </div>
                    </div>

                    {{-- D. RENCANA TRANSPORTASI --}}
                    <div class="space-y-4 pt-2 border-t border-slate-100">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                                D. Rencana Transportasi <span class="text-rose-500">*</span>
                            </label>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Pilih cara perjalanan rombongan. Untuk perjalanan menggunakan kereta atau pesawat, transportasi lokal dapat disiapkan untuk perjalanan selama di destinasi.
                            </p>
                        </div>

                        {{-- 4 Radio Choices for Transport Type --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all flex items-start gap-3"
                                   :class="transportType === 'darat' ? 'border-aw-gold bg-aw-gold/5 shadow-md' : 'border-slate-200 hover:border-slate-300'">
                                <input type="radio" value="darat" x-model="transportType" class="text-aw-gold focus:ring-aw-gold mt-1">
                                <div>
                                    <span class="font-bold text-sm text-aw-navy block">🚌 Transportasi Darat</span>
                                    <span class="text-xs text-slate-500 block">Bus Pariwisata / Hiace langsung ke tujuan</span>
                                </div>
                            </label>

                            <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all flex items-start gap-3"
                                   :class="transportType === 'kereta' ? 'border-aw-gold bg-aw-gold/5 shadow-md' : 'border-slate-200 hover:border-slate-300'">
                                <input type="radio" value="kereta" x-model="transportType" class="text-aw-gold focus:ring-aw-gold mt-1">
                                <div>
                                    <span class="font-bold text-sm text-aw-navy block">🚆 Kereta Api + Transportasi Lokal</span>
                                    <span class="text-xs text-slate-500 block">Kereta antar kota & bus/Hiace di destinasi</span>
                                </div>
                            </label>

                            <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all flex items-start gap-3"
                                   :class="transportType === 'pesawat' ? 'border-aw-gold bg-aw-gold/5 shadow-md' : 'border-slate-200 hover:border-slate-300'">
                                <input type="radio" value="pesawat" x-model="transportType" class="text-aw-gold focus:ring-aw-gold mt-1">
                                <div>
                                    <span class="font-bold text-sm text-aw-navy block">✈️ Pesawat + Transportasi Lokal</span>
                                    <span class="text-xs text-slate-500 block">Penerbangan & bus/Hiace lokal di destinasi</span>
                                </div>
                            </label>









                        </div>

                        {{-- CONDITIONAL SUB-OPTIONS PER CASE --}}

                        {{-- CASE 1: TRANSPORTASI DARAT --}}
                        <div x-show="transportType === 'darat'" class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-4">
                            <label class="block text-xs font-bold uppercase text-slate-700">
                                Pilih Jenis Kendaraan Armada:
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <label class="bg-white border rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-bold"
                                       :class="daratVehicle === 'Big Bus' ? 'border-aw-gold text-aw-navy ring-2 ring-aw-gold/20' : 'border-slate-200'">
                                    <input type="radio" value="Big Bus" x-model="daratVehicle" class="text-aw-gold focus:ring-aw-gold">
                                    <span>🚍 Big Bus (45 - 59 Seat)</span>
                                </label>

                                <label class="bg-white border rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-bold"
                                       :class="daratVehicle === 'Medium Bus' ? 'border-aw-gold text-aw-navy ring-2 ring-aw-gold/20' : 'border-slate-200'">
                                    <input type="radio" value="Medium Bus" x-model="daratVehicle" class="text-aw-gold focus:ring-aw-gold">
                                    <span>🚌 Medium Bus (30 - 35 Seat)</span>
                                </label>

                                <label class="bg-white border rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-bold"
                                       :class="daratVehicle === 'Hiace' ? 'border-aw-gold text-aw-navy ring-2 ring-aw-gold/20' : 'border-slate-200'">
                                    <input type="radio" value="Hiace" x-model="daratVehicle" class="text-aw-gold focus:ring-aw-gold">
                                    <span>🚐 Hiace (14 - 19 Seat)</span>
                                </label>


                            </div>

                            {{-- Estimasi Harga Info Pills --}}
                            <div class="pt-2 border-t border-slate-200/80 text-[11px] text-slate-600 space-y-1">
                                <p class="font-bold text-slate-700">Estimasi Patokan Harga Transportasi Darat:</p>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 pt-1 text-slate-600">
                                    <div class="bg-white p-2 rounded-lg border border-slate-200">
                                        <span class="font-bold text-slate-800 block">Big Bus:</span>
                                        <span class="text-aw-gold font-bold">Rp3.500.000 – Rp4.000.000/hari</span>
                                    </div>
                                    <div class="bg-white p-2 rounded-lg border border-slate-200">
                                        <span class="font-bold text-slate-800 block">Medium Bus:</span>
                                        <span class="text-aw-gold font-bold">Rp2.500.000 – Rp3.000.000/hari</span>
                                    </div>
                                    <div class="bg-white p-2 rounded-lg border border-slate-200">
                                        <span class="font-bold text-slate-800 block">Hiace:</span>
                                        <span class="text-aw-gold font-bold">Mulai Rp1.000.000/hari</span>
                                    </div>
                                </div>
                                <p class="text-[10px] text-slate-400 italic pt-1">
                                    *Harga merupakan estimasi dan dapat menyesuaikan tanggal, rute, durasi perjalanan, dan ketersediaan armada.
                                </p>
                            </div>
                        </div>

                        {{-- CASE 2: KERETA API --}}
                        <div x-show="transportType === 'kereta'" class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-aw-navy">Transportasi Antar Kota: <strong>Kereta Api Group</strong></span>
                            </div>

                            <label class="block text-xs font-bold uppercase text-slate-700">
                                Transportasi Lokal di Destinasi:
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                <label class="bg-white border rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-semibold"
                                       :class="localTransport === 'Big Bus' ? 'border-aw-gold text-aw-navy' : 'border-slate-200'">
                                    <input type="radio" value="Big Bus" x-model="localTransport" class="text-aw-gold focus:ring-aw-gold">
                                    <span>🚍 Big Bus</span>
                                </label>

                                <label class="bg-white border rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-semibold"
                                       :class="localTransport === 'Medium Bus' ? 'border-aw-gold text-aw-navy' : 'border-slate-200'">
                                    <input type="radio" value="Medium Bus" x-model="localTransport" class="text-aw-gold focus:ring-aw-gold">
                                    <span>🚌 Medium Bus</span>
                                </label>

                                <label class="bg-white border rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-semibold"
                                       :class="localTransport === 'Hiace' ? 'border-aw-gold text-aw-navy' : 'border-slate-200'">
                                    <input type="radio" value="Hiace" x-model="localTransport" class="text-aw-gold focus:ring-aw-gold">
                                    <span>🚐 Hiace</span>
                                </label>


                            </div>
                        </div>

                        {{-- CASE 3: PESAWAT --}}
                        <div x-show="transportType === 'pesawat'" class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-aw-navy">Transportasi Antar Kota / Negara: <strong>Pesawat Terbang Charter / Group</strong></span>
                            </div>

                            <label class="block text-xs font-bold uppercase text-slate-700">
                                Transportasi Lokal di Destinasi:
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                <label class="bg-white border rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-semibold"
                                       :class="localTransport === 'Big Bus' ? 'border-aw-gold text-aw-navy' : 'border-slate-200'">
                                    <input type="radio" value="Big Bus" x-model="localTransport" class="text-aw-gold focus:ring-aw-gold">
                                    <span>🚍 Big Bus</span>
                                </label>

                                <label class="bg-white border rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-semibold"
                                       :class="localTransport === 'Medium Bus' ? 'border-aw-gold text-aw-navy' : 'border-slate-200'">
                                    <input type="radio" value="Medium Bus" x-model="localTransport" class="text-aw-gold focus:ring-aw-gold">
                                    <span>🚌 Medium Bus</span>
                                </label>

                                <label class="bg-white border rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-semibold"
                                       :class="localTransport === 'Hiace' ? 'border-aw-gold text-aw-navy' : 'border-slate-200'">
                                    <input type="radio" value="Hiace" x-model="localTransport" class="text-aw-gold focus:ring-aw-gold">
                                    <span>🚐 Hiace</span>
                                </label>

                                
                            </div>
                        </div>

                        {{-- CASE 4: KOMBINASI / CUSTOM --}}
                        <div x-show="transportType === 'custom'" class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-3">
                            <label class="block text-xs font-bold uppercase text-slate-700">
                                Jelaskan Kebutuhan Transportasi Anda <span class="text-rose-500">*</span>
                            </label>
                            <textarea x-model="customTransportDetails" 
                                      rows="3" 
                                      placeholder="Contoh: Berangkat menggunakan kereta, kemudian menggunakan bus selama 3 hari di destinasi."
                                      class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold bg-white"></textarea>
                        </div>

                        {{-- SMART DYNAMIC RECOMMENDATION BOX --}}
                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-3 text-xs text-amber-900 shadow-sm">
                            <span class="text-lg">💡</span>
                            <div>
                                <span class="font-bold block text-amber-950">Rekomendasi AW TOUR:</span>
                                <p x-show="transportType === 'kereta'" class="leading-relaxed text-amber-900">
                                    Karena perjalanan menggunakan kereta api, rombongan tetap membutuhkan transportasi lokal setelah tiba di destinasi. Anda dapat memilih bus/Hiace atau menyerahkan pencarian armada kepada AW TOUR.
                                </p>
                                <p x-show="transportType === 'pesawat'" class="leading-relaxed text-amber-900">
                                    Untuk perjalanan menggunakan pesawat, transportasi lokal di destinasi dapat disiapkan sesuai jumlah peserta dan itinerary perjalanan.
                                </p>
                                <p x-show="transportType === 'darat'" class="leading-relaxed text-amber-900">
                                    Untuk perjalanan darat langsung, pilih jenis kendaraan sesuai kebutuhan rombongan atau serahkan pencarian armada kepada AW TOUR.
                                </p>
                                <p x-show="transportType === 'custom'" class="leading-relaxed text-amber-900">
                                    Tuliskan rincian moda transportasi yang Anda harapkan. Tim AW TOUR akan memadukan moda perjalanan paling efisien & fleksibel.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- E. PENGINAPAN (CONDITIONAL IF MULTI-DAY) --}}
                    <div x-show="returnDate && eventDate && returnDate > eventDate" 
                         x-cloak 
                         x-transition:enter="transition ease-out duration-300"
                         class="space-y-4 pt-2 border-t border-slate-100">
                        
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                                E. Kebutuhan Penginapan / Hotel 🏨
                            </label>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Sistem mendeteksi perjalanan Anda bersifat multi-hari. Apakah rombongan membutuhkan penginapan?
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 max-w-xs">
                            <label class="border-2 rounded-xl p-3 cursor-pointer text-center transition-all font-bold text-xs"
                                   :class="needHotel === 'Ya' ? 'border-aw-gold bg-aw-gold/10 text-aw-navy' : 'border-slate-200'">
                                <input type="radio" value="Ya" x-model="needHotel" class="text-aw-gold focus:ring-aw-gold mr-1.5">
                                <span>Ya, Butuh Hotel</span>
                            </label>

                            <label class="border-2 rounded-xl p-3 cursor-pointer text-center transition-all font-bold text-xs"
                                   :class="needHotel === 'Tidak' ? 'border-aw-gold bg-aw-gold/10 text-aw-navy' : 'border-slate-200'">
                                <input type="radio" value="Tidak" x-model="needHotel" class="text-aw-gold focus:ring-aw-gold mr-1.5">
                                <span>Tidak Perlu</span>
                            </label>
                        </div>

                        {{-- SUB-OPTIONS IF NEED HOTEL = YA --}}
                        <div x-show="needHotel === 'Ya'" class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- Jumlah Kamar Stepper --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">
                                        Jumlah Kamar
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="if(hotelRooms > 1) hotelRooms--" class="w-9 h-9 rounded-xl bg-white border border-slate-300 font-bold text-slate-700 hover:bg-slate-100 flex items-center justify-center">-</button>
                                        <input type="number" x-model="hotelRooms" min="1" class="w-20 rounded-xl border-slate-300 text-center text-sm font-bold focus:ring-aw-gold">
                                        <button type="button" @click="hotelRooms++" class="w-9 h-9 rounded-xl bg-white border border-slate-300 font-bold text-slate-700 hover:bg-slate-100 flex items-center justify-center">+</button>
                                        <span class="text-xs font-semibold text-slate-500">Kamar</span>
                                    </div>
                                </div>

                                {{-- Preferensi Tipe Kamar --}}
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1">
                                        Preferensi Tipe Kamar
                                    </label>
                                    <select x-model="hotelRoomType" class="w-full rounded-xl border-slate-300 text-xs focus:border-aw-gold focus:ring-aw-gold">
                                        <option value="Belum menentukan">Belum menentukan</option>
                                        <option value="Twin Bed (2 Kasur)">Twin Bed (2 Kasur)</option>
                                        <option value="Triple Bed (3 Kasur)">Triple Bed (3 Kasur)</option>
                                        <option value="Quad Bed (4 Kasur)">Quad Bed (4 Kasur)</option>
                                        <option value="Campuran">Campuran (Sesuai Rombongan)</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Catatan Penginapan --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">
                                    Catatan Penginapan (Opsional)
                                </label>
                                <textarea x-model="hotelNotes" 
                                          rows="2" 
                                          placeholder="Contoh: Hotel minimal bintang 3, dekat pusat kota atau dekat area wisata."
                                          class="w-full rounded-xl border-slate-300 text-xs focus:border-aw-gold focus:ring-aw-gold bg-white"></textarea>
                            </div>

                            <p class="text-[11px] text-slate-400 italic">
                                *Penginapan akan dicarikan oleh AW TOUR berdasarkan kebutuhan rombongan dan dikonfirmasi melalui WhatsApp.
                            </p>
                        </div>
                    </div>

                    {{-- F. CATATAN / PERMINTAAN KHUSUS --}}
                    <div class="space-y-3 pt-2 border-t border-slate-100">
                        <label class="block text-xs font-bold uppercase text-slate-700 tracking-wider">
                            F. Catatan / Permintaan Khusus (Opsional)
                        </label>
                        <textarea x-model="specialNotes" 
                                  rows="3" 
                                  placeholder="Contoh: Mohon siapkan spanduk rombongan BEM, kebutuhan dokumentasi drone, atau konsumsi khusus."
                                  class="w-full rounded-xl border-slate-300 text-sm focus:border-aw-gold focus:ring-aw-gold"></textarea>
                    </div>

                    {{-- G. RINGKASAN DINAMIS STEP 3 --}}
                    <div class="bg-aw-navy text-white rounded-2xl p-6 border border-aw-sage/30 space-y-3 text-xs shadow-lg">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <span class="font-bold text-aw-gold uppercase tracking-wider text-[11px]">Ringkasan Kebutuhan Perjalanan:</span>
                            <span class="text-slate-400">Step 3 Preview</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-slate-300">
                            <div>
                                <span class="text-slate-400 block text-[11px]">📍 Destinasi Tujuan:</span>
                                <strong class="text-white text-sm" x-text="destinationDisplayName"></strong>
                            </div>

                            <div>
                                <span class="text-slate-400 block text-[11px]">📅 Perjalanan & Durasi:</span>
                                <strong class="text-white text-xs" x-text="(eventDate || 'Belum diisi') + ' (' + durationText + ')'"></strong>
                            </div>

                            <div>
                                <span class="text-slate-400 block text-[11px]">👥 Estimasi Peserta:</span>
                                <strong class="text-white text-xs" x-text="paxCount + ' orang'"></strong>
                            </div>

                            <div>
                                <span class="text-slate-400 block text-[11px]">📌 Titik Keberangkatan:</span>
                                <strong class="text-white text-xs" x-text="departurePoint || 'Belum diisi'"></strong>
                            </div>

                            <div class="sm:col-span-2">
                                <span class="text-slate-400 block text-[11px]">🚌 Transportasi:</span>
                                <strong class="text-aw-gold text-xs" x-text="transportModeSummary"></strong>
                            </div>

                            <div x-show="returnDate && eventDate && returnDate > eventDate" class="sm:col-span-2 border-t border-white/10 pt-2">
                                <span class="text-slate-400 block text-[11px]">🏨 Status Penginapan:</span>
                                <strong class="text-white text-xs" x-text="needHotel === 'Ya' ? ('Dibutuhkan (' + hotelRooms + ' Kamar, Tipe: ' + hotelRoomType + ')') : 'Tidak Diperlukan'"></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 Buttons -->
                    <div class="pt-6 flex justify-between">
                        <button type="button" @click="step = 2" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-5 py-3 rounded-xl text-sm">
                            &larr; Kembali
                        </button>
                        <button type="button" @click="validateStep3()" class="bg-aw-gold hover:bg-aw-gold-600 text-white font-bold px-7 py-3 rounded-xl text-sm shadow-md">
                            Lanjut: Review & Kirim &rarr;
                        </button>
                    </div>
                </div>


                <!-- ========================================================================= -->
                <!-- STEP 4: REVIEW & KIRIM (FINAL DOCUMENT CARD) -->
                <!-- ========================================================================= -->
                <div x-show="step === 4" x-cloak x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" class="space-y-8">
                    <div>
                        <h2 class="font-display font-bold text-xl text-aw-navy mb-1">Review & Kirim Permintaan Quotation</h2>
                        <p class="text-xs text-slate-500">Periksa kembali rincian perjalanan Anda sebelum mengirim permintaan quotation kepada AW TOUR.</p>
                    </div>

                    <!-- FINAL FORMAL QUOTATION DOCUMENT CARD -->
                    <div id="quotation-document-card" 
                         class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-300 shadow-xl space-y-6 text-slate-800 relative">
                        
                        <!-- DOCUMENT HEADER BRANDING -->
                        <div class="border-b-2 border-slate-900 pb-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/logo.png') }}" 
                                     alt="AW TOUR" 
                                     class="h-10 w-auto object-contain"
                                     onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                <div class="hidden w-10 h-7 rounded-full bg-gradient-to-r from-[#00a3e0] to-[#006286] flex items-center justify-center">
                                    <span class="font-extrabold text-xs text-[#80ee11] italic">AW</span>
                                </div>
                                <div>
                                    <h3 class="font-display font-bold text-lg text-aw-navy tracking-wide">AW TOUR</h3>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Surabaya Operator</p>
                                </div>
                            </div>

                            <div class="text-left sm:text-right">
                                <span class="inline-block px-3 py-1 bg-slate-900 text-aw-gold font-mono font-bold text-xs rounded-lg uppercase tracking-wider">
                                    RINCIAN PERMINTAAN QUOTATION
                                </span>
                                <p class="text-[11px] text-slate-500 mt-1">
                                    Dokumen resmi sistem B2B Group Customized Tour
                                </p>
                            </div>
                        </div>

                        <!-- SECTION 1: INFORMASI PERJALANAN & DESTINASI -->
                        <div class="space-y-3">
                            <h4 class="font-display font-bold text-xs uppercase tracking-wider text-aw-gold border-b border-slate-200 pb-1">
                                1. Informasi Perjalanan & Destinasi
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Jenis Acara:</span>
                                    <span class="font-bold text-slate-900" x-text="eventType"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Destinasi Tujuan:</span>
                                    <span class="font-bold text-aw-navy" x-text="destinationDisplayName"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Tanggal Keberangkatan:</span>
                                    <span class="font-bold text-emerald-800" x-text="eventDate || '-'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Tanggal Pulang:</span>
                                    <span class="font-bold text-slate-900" x-text="returnDate || '1 Hari (Day Trip)'"></span>
                                </div>
                                <div class="flex justify-between sm:col-span-2">
                                    <span class="text-slate-500">Durasi Perjalanan:</span>
                                    <span class="font-extrabold text-aw-gold" x-text="durationText"></span>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: INFORMASI ROMBONGAN & LOGISTIK -->
                        <div class="space-y-3">
                            <h4 class="font-display font-bold text-xs uppercase tracking-wider text-aw-gold border-b border-slate-200 pb-1">
                                2. Informasi Rombongan & Titik Keberangkatan
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Jumlah Peserta:</span>
                                    <span class="font-bold text-slate-900" x-text="paxCount + ' Orang (PAX)'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Waktu Keberangkatan:</span>
                                    <span class="font-bold text-slate-900" x-text="(departureTime || '07:00') + ' WIB'"></span>
                                </div>
                                <div class="flex justify-between sm:col-span-2">
                                    <span class="text-slate-500">Titik Keberangkatan:</span>
                                    <span class="font-bold text-slate-900" x-text="departurePoint || '-'"></span>
                                </div>
                                <div x-show="pickupNotes" class="flex justify-between sm:col-span-2">
                                    <span class="text-slate-500">Catatan Penjemputan:</span>
                                    <span class="font-semibold text-slate-700" x-text="pickupNotes"></span>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: TRANSPORTASI -->
                        <div class="space-y-3">
                            <h4 class="font-display font-bold text-xs uppercase tracking-wider text-aw-gold border-b border-slate-200 pb-1">
                                3. Rencana Transportasi
                            </h4>
                            <div class="text-xs space-y-1.5">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Moda Transportasi Utama:</span>
                                    <span class="font-bold text-slate-900" x-text="
                                        transportType === 'darat' ? 'Transportasi Darat' :
                                        (transportType === 'kereta' ? 'Kereta Api + Transportasi Lokal' :
                                        (transportType === 'pesawat' ? 'Pesawat + Transportasi Lokal' : 'Kombinasi / Custom'))
                                    "></span>
                                </div>

                                <div x-show="transportType === 'darat'" class="flex justify-between">
                                    <span class="text-slate-500">Jenis Kendaraan:</span>
                                    <span class="font-bold text-aw-navy" x-text="daratVehicle"></span>
                                </div>

                                <div x-show="transportType === 'kereta' || transportType === 'pesawat'" class="flex justify-between">
                                    <span class="text-slate-500">Transportasi Lokal:</span>
                                    <span class="font-bold text-aw-navy" x-text="localTransport"></span>
                                </div>

                                <div x-show="transportType === 'custom'" class="flex justify-between">
                                    <span class="text-slate-500">Detail Transport Custom:</span>
                                    <span class="font-semibold text-slate-800" x-text="customTransportDetails"></span>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 4: PENGINAPAN -->
                        <div class="space-y-3">
                            <h4 class="font-display font-bold text-xs uppercase tracking-wider text-aw-gold border-b border-slate-200 pb-1">
                                4. Kebutuhan Penginapan / Hotel
                            </h4>
                            <div class="text-xs space-y-1.5">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Status Penginapan:</span>
                                    <span class="font-bold text-slate-900" x-text="needHotel === 'Ya' ? 'Dibutuhkan' : 'Tidak Diperlukan'"></span>
                                </div>

                                <template x-if="needHotel === 'Ya'">
                                    <div class="space-y-1.5 pt-1">
                                        <div class="flex justify-between">
                                            <span class="text-slate-500">Jumlah Kamar:</span>
                                            <span class="font-bold text-slate-900" x-text="hotelRooms + ' Kamar'"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-slate-500">Preferensi Tipe Kamar:</span>
                                            <span class="font-bold text-slate-900" x-text="hotelRoomType"></span>
                                        </div>
                                        <div x-show="hotelNotes" class="flex justify-between">
                                            <span class="text-slate-500">Catatan Penginapan:</span>
                                            <span class="font-semibold text-slate-700" x-text="hotelNotes"></span>
                                        </div>
                                        <p class="text-[11px] text-slate-500 italic pt-1">
                                            *Penginapan akan dicarikan oleh AW TOUR berdasarkan kebutuhan rombongan dan dikonfirmasi melalui WhatsApp.
                                        </p>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- SECTION 5: IDENTITAS PEMESAN -->
                        <div class="space-y-3">
                            <h4 class="font-display font-bold text-xs uppercase tracking-wider text-aw-gold border-b border-slate-200 pb-1">
                                5. Identitas Pemesan / Instansi
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-2 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Nama PIC:</span>
                                    <span class="font-bold text-slate-900" x-text="clientName || '-'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Instansi / Kampus:</span>
                                    <span class="font-bold text-slate-900" x-text="institutionName || '-'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Nomor WhatsApp:</span>
                                    <span class="font-bold text-emerald-800" x-text="phone || '-'"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Email:</span>
                                    <span class="font-semibold text-slate-700" x-text="email || '-'"></span>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 6: CATATAN KHUSUS -->
                        <div x-show="specialNotes" class="space-y-2 pt-1 border-t border-slate-200">
                            <h4 class="font-display font-bold text-xs uppercase tracking-wider text-aw-gold">
                                6. Catatan / Permintaan Khusus
                            </h4>
                            <p class="text-xs text-slate-700 italic bg-slate-50 p-3 rounded-xl border border-slate-200" x-text="specialNotes"></p>
                        </div>

                        <!-- STATUS PERMINTAAN NOTICE -->
                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-xs space-y-1">
                            <div class="flex items-center gap-2 font-bold text-amber-950">
                                <span>🟠 STATUS PERMINTAAN: MENUNGGU KONFIRMASI AW TOUR</span>
                            </div>
                            <p class="text-amber-900 leading-relaxed text-[11px]">
                                Rincian ini merupakan permintaan quotation dan bukan harga final. Harga resmi, ketersediaan armada, transportasi, dan penginapan akan dikonfirmasi langsung oleh tim konsultan AW TOUR.
                            </p>
                        </div>

                    </div>

                    <!-- ACTION BUTTONS BAR -->
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-4 no-print">
                        <button type="button" @click="step = 3" class="w-full sm:w-auto bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold px-5 py-3 rounded-xl text-sm">
                            &larr; Kembali
                        </button>

                        <div class="flex flex-wrap items-center justify-end gap-3 w-full sm:w-auto">
                            {{-- Button 1: Cetak Rincian (Window Print A4) --}}
                            <button type="button" 
                                    @click="window.print()" 
                                    class="py-3 px-4 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                                <span>🖨 Cetak Rincian</span>
                            </button>

                            {{-- Button 2: Download Dokumen PNG --}}
                            <button type="button" 
                                    @click="
                                        const card = document.getElementById('quotation-document-card');
                                        if (typeof html2canvas !== 'undefined' && card) {
                                            html2canvas(card, { scale: 2, backgroundColor: '#ffffff' }).then(canvas => {
                                                const link = document.createElement('a');
                                                link.download = 'AWT-Quotation-Request.png';
                                                link.href = canvas.toDataURL('image/png');
                                                link.click();
                                                showToast('Dokumen Rincian Quotation berhasil didownload!');
                                            });
                                        } else {
                                            window.print();
                                        }
                                    " 
                                    class="py-3 px-4 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                                <span>⬇ Simpan / Download</span>
                            </button>

                            {{-- Button 3: Main Submit Button (Kirim via WhatsApp) --}}
                            <button type="submit" 
                                    class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold px-7 py-3.5 rounded-2xl text-sm shadow-xl hover:scale-105 transition-all flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                                </svg>
                                <span>💬 Kirim via WhatsApp</span>
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection

@push('scripts')
{{-- Include html2canvas for instant client-side image generation --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
@endpush
