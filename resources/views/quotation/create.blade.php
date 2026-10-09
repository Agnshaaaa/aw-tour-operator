@extends('layouts.app')

@section('title', 'Custom Group Quotation Builder — AW Tour Operator Surabaya')
@push('styles')
<style>
    /* ─── Global Dark Form Inputs ─────────────────────────────────────── */

    /* Covers: input[type=text/email/tel/number/date/time], select, textarea */
    .aw-input,
    input.aw-input,
    select.aw-input,
    textarea.aw-input {
        width: 100%;
        background-color: rgba(2, 6, 23, 0.65) !important;
        background-image: none !important; /* reset Tailwind Forms bg */
        border: 1px solid rgba(255, 255, 255, 0.20) !important;
        border-radius: 0.75rem !important;
        color: #ffffff !important;
        font-size: 0.875rem !important;
        padding: 0.625rem 0.875rem !important;
        transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        outline: none !important;
        box-shadow: none !important;
        color-scheme: dark; /* makes date/time spinners white natively */
    }
    .aw-input::placeholder,
    input.aw-input::placeholder,
    select.aw-input::placeholder,
    textarea.aw-input::placeholder {
        color: rgba(148, 163, 184, 0.65) !important;
    }
    .aw-input:focus,
    input.aw-input:focus,
    select.aw-input:focus,
    textarea.aw-input:focus {
        border-color: rgba(45, 212, 191, 0.8) !important;
        box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.15) !important;
        background-color: rgba(2, 6, 23, 0.90) !important;
    }
    /* Date & Time pickers — make calendar/clock icon white (Webkit) */
    .aw-input::-webkit-calendar-picker-indicator {
        filter: invert(1) opacity(0.75);
        cursor: pointer;
    }
    .aw-input::-webkit-inner-spin-button,
    .aw-input::-webkit-outer-spin-button {
        filter: invert(1);
        opacity: 0.6;
    }

    /* ─── Select dropdown custom arrow ──────────────────────────────── */
    .aw-select {
        appearance: none !important;
        -webkit-appearance: none !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%232dd4bf'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 0.75rem center !important;
        background-size: 1.1rem !important;
        padding-right: 2.25rem !important;
    }
    .aw-select option {
        background-color: #0b132b;
        color: #ffffff;
    }

    /* ─── Transport / Hotel radio card ─────────────────────────────── */
    .aw-radio-card {
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 1rem;
        padding: 1rem;
        cursor: pointer;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        background: rgba(2, 6, 23, 0.50);
        color: #e2e8f0;
        transition: all 0.2s;
    }
    .aw-radio-card:hover {
        background: rgba(45, 212, 191, 0.10);
        border-color: rgba(45, 212, 191, 0.45);
    }

    /* ─── Sub-section card within a step ────────────────────────────── */
    .aw-sub-card {
        background: rgba(15, 23, 42, 0.55);
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 1.25rem;
        padding: 1.25rem;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    /* ─── High-contrast form label ──────────────────────────────────── */
    .aw-label {
        display: block;
        font-size: 0.70rem;
        font-weight: 700;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: #f1f5f9 !important; /* slate-100, always white */
        margin-bottom: 0.4rem;
    }

    /* ─── Section title / sub-header ───────────────────────────────── */
    .aw-section-title {
        font-size: 0.70rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #2dd4bf;
        display: inline-block;
        padding-bottom: 0.25rem;
        border-bottom: 2px solid rgba(45, 212, 191, 0.35);
        margin-bottom: 0.75rem;
    }

    /* ─── CSS Print Rules untuk Cetak Dokumen A4 Rinci ─────────────── */
    @media print {
        body * { visibility: hidden !important; }
        #quotation-document-card, #quotation-document-card * { visibility: visible !important; }
        #quotation-document-card {
            position: absolute !important; left: 0 !important; top: 0 !important;
            width: 100% !important; margin: 0 !important; padding: 24px !important;
            box-shadow: none !important; border: 1px solid #cbd5e1 !important;
            background: #ffffff !important; color: #010818 !important;
        }
        .no-print { display: none !important; }
        @page { size: A4; margin: 12mm; }
    }
</style>
@endpush

@section('content')

<div aria-hidden="true" class="pointer-events-none fixed inset-0 z-0">
    <img src="{{ asset('images/Bromo.jpg') }}" alt="" class="h-full w-full object-cover object-center">
    <div class="absolute inset-0 bg-slate-950/30"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-slate-950/10 via-slate-950/20 to-slate-950/45"></div>
</div>

<!-- Header Banner -->
<div class="relative z-10 bg-slate-950/35 text-white py-12 border-b border-white/10 backdrop-blur-sm no-print">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-xs font-bold uppercase tracking-widest text-aw-gold">B2B Customized Group Tour System</span>
        <h1 class="font-display text-3xl sm:text-4xl font-extrabold">Custom Group Quotation Builder</h1>
        <p class="text-slate-300 text-xs sm:text-sm max-w-2xl mx-auto">
            Rancang perjalanan rombongan Anda hanya dalam 4 langkah mudah. Dapatkan estimasi penawaran harga resmi (*Quotation Ticket*) dan terhubung langsung ke WhatsApp Admin.
        </p>
    </div>
</div>

<!-- Main Form Section -->
<div class="relative z-10 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Form Multi-Step Container (Alpine.js State) -->
        <div x-data="{ 
                step: {{ isset($selectedDestinationId) && $selectedDestinationId ? 2 : (isset($selectedTransport) && $selectedTransport ? 3 : 1) }}, 
                totalSteps: 4,
                hasDraft: false,

                // Step 1 State
                eventType: 'Studi Tour Kampus/Sekolah',
                destinationChoice: '{{ $selectedDestinationId ?? '' }}',
                customDestinationInput: '',
                savedDestinationName: '',

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
                daratVehicle: @js($selectedTransport ?? ($transportOfferings->first()->name ?? '')),
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

                // Inisialisasi Auto-Save & Muat Draft dari localStorage
                init() {
                    this.loadDraft();
                    this.setupAutoSave();
                },

                loadDraft() {
                    try {
                        const raw = localStorage.getItem('quotation_builder_draft');
                        if (!raw) return;
                        const draft = JSON.parse(raw);
                        if (!draft || typeof draft !== 'object') return;

                        // Populasikan nilai Step 1
                        if (draft.eventType !== undefined && draft.eventType !== '') this.eventType = draft.eventType;
                        if (draft.destinationChoice !== undefined && draft.destinationChoice !== '') this.destinationChoice = draft.destinationChoice;
                        if (draft.customDestinationInput !== undefined) this.customDestinationInput = draft.customDestinationInput;
                        if (draft.savedDestinationName !== undefined) this.savedDestinationName = draft.savedDestinationName;

                        // Populasikan nilai Step 2
                        if (draft.clientName !== undefined) this.clientName = draft.clientName;
                        if (draft.institutionName !== undefined) this.institutionName = draft.institutionName;
                        if (draft.phone !== undefined) this.phone = draft.phone;
                        if (draft.email !== undefined) this.email = draft.email;

                        // Populasikan nilai Step 3
                        if (draft.eventDate !== undefined && draft.eventDate !== '') this.eventDate = draft.eventDate;
                        if (draft.returnDate !== undefined) this.returnDate = draft.returnDate;
                        if (draft.departureTime !== undefined) this.departureTime = draft.departureTime;
                        if (draft.returnTime !== undefined) this.returnTime = draft.returnTime;
                        if (draft.paxCount !== undefined && draft.paxCount !== '') this.paxCount = Number(draft.paxCount);
                        if (draft.departurePoint !== undefined) this.departurePoint = draft.departurePoint;
                        if (draft.pickupNotes !== undefined) this.pickupNotes = draft.pickupNotes;

                        if (draft.transportType !== undefined && draft.transportType !== '') this.transportType = draft.transportType;
                        if (draft.daratVehicle !== undefined && draft.daratVehicle !== '') this.daratVehicle = draft.daratVehicle;
                        if (draft.localTransport !== undefined) this.localTransport = draft.localTransport;
                        if (draft.customTransportDetails !== undefined) this.customTransportDetails = draft.customTransportDetails;

                        if (draft.needHotel !== undefined && draft.needHotel !== '') this.needHotel = draft.needHotel;
                        if (draft.hotelRooms !== undefined && draft.hotelRooms !== '') this.hotelRooms = Number(draft.hotelRooms);
                        if (draft.hotelRoomType !== undefined && draft.hotelRoomType !== '') this.hotelRoomType = draft.hotelRoomType;
                        if (draft.hotelNotes !== undefined) this.hotelNotes = draft.hotelNotes;

                        if (draft.specialNotes !== undefined) this.specialNotes = draft.specialNotes;

                        // Arahkan ke nomor step terakhir yang tersimpan (1-4)
                        if (draft.step && Number(draft.step) >= 1 && Number(draft.step) <= 4) {
                            this.step = parseInt(draft.step, 10);
                        }

                        this.hasDraft = true;
                    } catch (e) {
                        console.warn('Gagal membaca draft formulir dari localStorage:', e);
                    }
                },

                saveDraft() {
                    try {
                        const payload = {
                            step: this.step,
                            eventType: this.eventType,
                            destinationChoice: this.destinationChoice,
                            customDestinationInput: this.customDestinationInput,
                            savedDestinationName: this.destinationDisplayName,
                            clientName: this.clientName,
                            institutionName: this.institutionName,
                            phone: this.phone,
                            email: this.email,
                            eventDate: this.eventDate,
                            returnDate: this.returnDate,
                            departureTime: this.departureTime,
                            returnTime: this.returnTime,
                            paxCount: this.paxCount,
                            departurePoint: this.departurePoint,
                            pickupNotes: this.pickupNotes,
                            transportType: this.transportType,
                            daratVehicle: this.daratVehicle,
                            localTransport: this.localTransport,
                            customTransportDetails: this.customTransportDetails,
                            needHotel: this.needHotel,
                            hotelRooms: this.hotelRooms,
                            hotelRoomType: this.hotelRoomType,
                            hotelNotes: this.hotelNotes,
                            specialNotes: this.specialNotes,
                            updatedAt: new Date().toISOString()
                        };
                        localStorage.setItem('quotation_builder_draft', JSON.stringify(payload));
                        this.hasDraft = true;
                    } catch (e) {
                        console.warn('Gagal menyimpan draft formulir ke localStorage:', e);
                    }
                },

                setupAutoSave() {
                    const fields = [
                        'step', 'eventType', 'destinationChoice', 'customDestinationInput',
                        'clientName', 'institutionName', 'phone', 'email',
                        'eventDate', 'returnDate', 'departureTime', 'returnTime',
                        'paxCount', 'departurePoint', 'pickupNotes',
                        'transportType', 'daratVehicle', 'localTransport', 'customTransportDetails',
                        'needHotel', 'hotelRooms', 'hotelRoomType', 'hotelNotes', 'specialNotes'
                    ];

                    fields.forEach(field => {
                        this.$watch(field, () => {
                            this.saveDraft();
                        });
                    });
                },

                clearDraft() {
                    try {
                        localStorage.removeItem('quotation_builder_draft');
                        this.hasDraft = false;
                    } catch (e) {
                        console.warn('Gagal menghapus draft dari localStorage:', e);
                    }
                },

                resetDraftConfirm() {
                    if (confirm('Apakah Anda yakin ingin menghapus draf formulir yang tersimpan dan mengulang dari langkah awal?')) {
                        this.clearDraft();
                        window.location.href = '{{ route('quotation.create') }}';
                    }
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
                    this.saveDraft();
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
                    this.saveDraft();
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
                    this.saveDraft();
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
                    
                    let targetRadio = document.querySelector('input[name=dest_radio_item][value=\'' + this.destinationChoice + '\']');
                    if (targetRadio && targetRadio.dataset.name) {
                        return targetRadio.dataset.name;
                    }
                    let checkedRadio = document.querySelector('input[name=dest_radio_item]:checked');
                    if (checkedRadio && checkedRadio.dataset.name) {
                        return checkedRadio.dataset.name;
                    }
                    return this.savedDestinationName || 'Destinasi Pilihan';
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
             class="rounded-3xl shadow-2xl overflow-hidden relative border backdrop-blur-md bg-slate-900/50 border-white/15 shadow-slate-950/40">
            
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
                <div class="px-6 py-4 text-white border-b no-print bg-slate-950/80 border-white/10">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between text-xs font-semibold mb-3 gap-2">
                    <div class="flex items-center gap-3">
                        <span :class="step === 1 ? 'text-emerald-300' : 'text-aw-gold'" class="uppercase tracking-wider">
                            Langkah <span x-text="step"></span> dari <span x-text="totalSteps"></span>
                        </span>
                        <!-- Status Badge Draft Tersimpan -->
                        <span x-show="hasDraft" x-cloak class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 text-[10px] font-medium border border-emerald-500/30">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>Draft Tersimpan</span>
                        </span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-slate-400" x-text="
                            step === 1 ? 'Pilih Jenis Acara & Destinasi' : 
                            step === 2 ? 'Identitas Klien & Instansi' : 
                            step === 3 ? 'Logistik, Jadwal & Transportasi' : 'Review & Kirim Permintaan'
                        "></span>
                        <!-- Tombol Reset Draft jika ingin mulai ulang -->
                        <button type="button" 
                                x-show="hasDraft" 
                                x-cloak
                                @click="resetDraftConfirm()" 
                                class="text-[10px] text-slate-400 hover:text-rose-400 underline transition-colors"
                                title="Hapus draft dan mulai form baru">
                            Reset Form
                        </button>
                    </div>
                </div>

                <!-- Progress Track -->
                <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                    <div class="h-full transition-all duration-500"
                        :class="step === 1 ? 'bg-gradient-to-r from-emerald-400 to-green-300 shadow-[0_0_12px_rgba(52,211,153,0.8)]' : 'bg-gradient-to-r from-aw-gold to-aw-mint'"
                         :style="'width: ' + (step / totalSteps * 100) + '%'"></div>
                </div>

                <!-- Step Tabs Header -->
                <div class="grid grid-cols-4 gap-2 text-center text-[11px] pt-4 text-slate-400">
                    <div :class="step >= 1 ? (step === 1 ? 'text-emerald-300 font-bold' : 'text-aw-gold font-bold') : ''">1. Acara & Destinasi</div>
                    <div :class="step >= 2 ? (step === 1 ? 'text-emerald-300 font-bold' : 'text-aw-gold font-bold') : ''">2. Data Instansi</div>
                    <div :class="step >= 3 ? (step === 1 ? 'text-emerald-300 font-bold' : 'text-aw-gold font-bold') : ''">3. Logistik & Jadwal</div>
                    <div :class="step >= 4 ? (step === 1 ? 'text-emerald-300 font-bold' : 'text-aw-gold font-bold') : ''">4. Review & Kirim</div>
                </div>
            </div>

            <!-- FORM START -->
            <form action="{{ route('quotation.store') }}" method="POST" id="quotation-form" class="p-6 sm:p-10" @input="saveDraft()" @change="saveDraft()">
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
                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="space-y-8 text-slate-100">
                    <div>
                        <h2 class="font-display font-bold text-xl text-white mb-1">Pilih Jenis Acara & Destinasi</h2>
                        <p class="text-xs text-slate-300">Tentukan kategori acara rombongan Anda dan lokasi destinasi tujuan.</p>
                    </div>

                    <!-- Jenis Acara Rombongan -->
                    <div class="space-y-3">
                        <label class="block text-xs font-bold uppercase text-slate-200 tracking-wider">
                            Jenis Acara Rombongan <span class="text-rose-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                            <label class="group border rounded-2xl p-4 cursor-pointer flex items-center gap-3 bg-white/5 border-white/15 text-slate-100 hover:bg-white/10 hover:scale-[1.02] hover:border-emerald-400/60 transition-all duration-200"
                                :class="eventType === 'Studi Tour Kampus/Sekolah' ? 'border-2 border-emerald-400 bg-emerald-900/60 ring-2 ring-emerald-500/50 font-semibold text-white shadow-lg shadow-emerald-500/20' : ''">
                                <input type="radio" value="Studi Tour Kampus/Sekolah" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">Studi Tour</span>
                                    <span class="text-[11px] text-slate-300 block">Kampus & Sekolah</span>
                                </div>
                            </label>

                            <label class="group border rounded-2xl p-4 cursor-pointer flex items-center gap-3 bg-white/5 border-white/15 text-slate-100 hover:bg-white/10 hover:scale-[1.02] hover:border-emerald-400/60 transition-all duration-200"
                                :class="eventType === 'Capacity Building & Outbound' ? 'border-2 border-emerald-400 bg-emerald-900/60 ring-2 ring-emerald-500/50 font-semibold text-white shadow-lg shadow-emerald-500/20' : ''">
                                <input type="radio" value="Capacity Building & Outbound" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">Capacity Building</span>
                                    <span class="text-[11px] text-slate-300 block">Outbound Perusahaan</span>
                                </div>
                            </label>

                            <label class="group border rounded-2xl p-4 cursor-pointer flex items-center gap-3 bg-white/5 border-white/15 text-slate-100 hover:bg-white/10 hover:scale-[1.02] hover:border-emerald-400/60 transition-all duration-200"
                                :class="eventType === 'Family Gathering Instansi' ? 'border-2 border-emerald-400 bg-emerald-900/60 ring-2 ring-emerald-500/50 font-semibold text-white shadow-lg shadow-emerald-500/20' : ''">
                                <input type="radio" value="Family Gathering Instansi" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">Family Gathering</span>
                                    <span class="text-[11px] text-slate-300 block">Keluarga & Instansi</span>
                                </div>
                            </label>

                            <label class="group border rounded-2xl p-4 cursor-pointer flex items-center gap-3 bg-white/5 border-white/15 text-slate-100 hover:bg-white/10 hover:scale-[1.02] hover:border-emerald-400/60 transition-all duration-200"
                                :class="eventType === 'Study Tiru / Bundling' ? 'border-2 border-emerald-400 bg-emerald-900/60 ring-2 ring-emerald-500/50 font-semibold text-white shadow-lg shadow-emerald-500/20' : ''">
                                <input type="radio" value="Study Tiru / Bundling" x-model="eventType" class="text-aw-gold focus:ring-aw-gold">
                                <div>
                                    <span class="text-sm block font-bold">Study Tiru / Bundling</span>
                                    <span class="text-[11px] text-slate-300 block">Kunjungan & Program Khusus</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Destinasi Wisata Selection -->
                    <div class="space-y-4 pt-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-200 tracking-wider">
                                Pilih Destinasi Wisata Tujuan <span class="text-rose-500">*</span>
                            </label>
                            <p class="text-xs text-slate-300 mt-0.5">
                                Pilih destinasi yang tersedia atau ajukan destinasi sesuai kebutuhan perjalanan Anda.
                            </p>
                        </div>

                        <div class="space-y-6 max-h-[30rem] overflow-y-auto pr-2">
                            
                            {{-- A. DESTINASI POPULER --}}
                            <div class="space-y-2.5">
                                <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-200 bg-emerald-500/10 border border-emerald-400/20 px-2.5 py-1 rounded-md">
                                        Destinasi Populer
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach($destinations as $dest)
                                            <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all duration-200 flex items-start justify-between bg-white/5 border-white/15 text-slate-100 hover:bg-white/10 hover:scale-[1.02] hover:border-emerald-400/60"
                                                :class="destinationChoice == '{{ $dest->id }}' ? 'border-2 border-emerald-400 bg-emerald-900/60 ring-2 ring-emerald-500/50 shadow-lg shadow-emerald-500/20 text-white' : ''">
                                            <div class="space-y-1">
                                                <div class="flex items-center gap-2">
                                                    <input type="radio" 
                                                           name="dest_radio_item"
                                                           data-name="{{ $dest->name }}"
                                                           value="{{ $dest->id }}" 
                                                           x-model="destinationChoice" 
                                                           class="text-aw-gold focus:ring-aw-gold">
                                                    <span class="font-bold text-sm text-white">{{ $dest->name }}</span>
                                                </div>
                                                <p class="text-xs text-slate-300 pl-6">📍 {{ $dest->location }}</p>
                                                <p class="text-xs font-extrabold text-emerald-300 pl-6">{{ $dest->formatted_price }}</p>
                                            </div>
                                            <span class="text-[10px] bg-slate-950/70 text-slate-200 font-semibold px-2 py-0.5 rounded shrink-0 border border-white/10">
                                                {{ $dest->category->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- B. LUAR NEGERI --}}
                            <div class="space-y-2.5 pt-2 border-t border-slate-100">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-200 bg-emerald-500/10 border border-emerald-400/20 px-2.5 py-1 rounded-md">
                                        ✈️ Luar Negeri
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    {{-- Singapore --}}
                                        <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all duration-200 flex items-start justify-between bg-white/5 border-white/15 text-slate-100 hover:bg-white/10 hover:scale-[1.02] hover:border-emerald-400/60"
                                            :class="destinationChoice === 'singapore' ? 'border-2 border-emerald-400 bg-emerald-900/60 ring-2 ring-emerald-500/50 shadow-lg shadow-emerald-500/20 text-white' : ''">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <input type="radio" value="singapore" x-model="destinationChoice" class="text-aw-gold focus:ring-aw-gold">
                                                <span class="font-bold text-sm text-white">Singapore</span>
                                            </div>
                                            <p class="text-xs text-slate-300 pl-6">🇸🇬 Asia Tenggara</p>
                                            <p class="text-[11px] font-semibold text-slate-400 pl-6 italic">Harga berdasarkan quotation</p>
                                        </div>
                                    </label>

                                    {{-- Malaysia --}}
                                        <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all duration-200 flex items-start justify-between bg-white/5 border-white/15 text-slate-100 hover:bg-white/10 hover:scale-[1.02] hover:border-emerald-400/60"
                                            :class="destinationChoice === 'malaysia' ? 'border-2 border-emerald-400 bg-emerald-900/60 ring-2 ring-emerald-500/50 shadow-lg shadow-emerald-500/20 text-white' : ''">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <input type="radio" value="malaysia" x-model="destinationChoice" class="text-aw-gold focus:ring-aw-gold">
                                                <span class="font-bold text-sm text-white">Malaysia</span>
                                            </div>
                                            <p class="text-xs text-slate-300 pl-6">🇲🇾 Asia Tenggara</p>
                                            <p class="text-[11px] font-semibold text-slate-400 pl-6 italic">Harga berdasarkan quotation</p>
                                        </div>
                                    </label>

                                    {{-- Vietnam --}}
                                        <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all duration-200 flex items-start justify-between bg-white/5 border-white/15 text-slate-100 hover:bg-white/10 hover:scale-[1.02] hover:border-emerald-400/60"
                                            :class="destinationChoice === 'vietnam' ? 'border-2 border-emerald-400 bg-emerald-900/60 ring-2 ring-emerald-500/50 shadow-lg shadow-emerald-500/20 text-white' : ''">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <input type="radio" value="vietnam" x-model="destinationChoice" class="text-aw-gold focus:ring-aw-gold">
                                                <span class="font-bold text-sm text-white">Vietnam</span>
                                            </div>
                                            <p class="text-xs text-slate-300 pl-6">🇻🇳 Asia Tenggara</p>
                                            <p class="text-[11px] font-semibold text-slate-400 pl-6 italic">Harga berdasarkan quotation</p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- C. DESTINASI LAIN --}}
                            <div class="space-y-2.5 pt-2 border-t border-slate-100">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold uppercase tracking-wider text-amber-200 bg-amber-500/10 border border-amber-400/20 px-2.5 py-1 rounded-md">
                                        ✨ Request Destinasi Custom
                                    </span>
                                </div>

                                    <label class="border-2 rounded-2xl p-4 cursor-pointer transition-all duration-200 block bg-white/5 border-white/15 text-slate-100 hover:bg-white/10 hover:scale-[1.02] hover:border-emerald-400/60"
                                        :class="destinationChoice === 'other' ? 'border-2 border-emerald-400 bg-emerald-900/60 ring-2 ring-emerald-500/50 shadow-lg shadow-emerald-500/20 text-white' : ''">
                                    <div class="flex items-start justify-between">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <input type="radio" value="other" x-model="destinationChoice" class="text-aw-gold focus:ring-aw-gold">
                                                <span class="font-bold text-sm text-white">Destinasi Lain</span>
                                            </div>
                                            <p class="text-xs text-slate-300 pl-6">
                                                Belum menemukan tujuan yang Anda inginkan? Ajukan destinasi sesuai kebutuhan rombongan.
                                            </p>
                                            <p class="text-[11px] font-semibold text-slate-400 pl-6 italic">Harga berdasarkan quotation</p>
                                        </div>
                                    </div>
                                </label>

                                {{-- Input Teks Destinasi Lain --}}
                                <div x-show="destinationChoice === 'other'" 
                                     x-cloak 
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 -translate-y-2"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="bg-slate-950/70 border border-amber-400/30 rounded-2xl p-4 space-y-2 mt-2 backdrop-blur-md">
                                    <label class="aw-label text-amber-200">
                                        Masukkan destinasi yang diinginkan <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" 
                                           x-model="customDestinationInput" 
                                           placeholder="Contoh: Bali, Yogyakarta, Singapore, Malaysia, Vietnam, dll."
                                           class="aw-input">
                                     <span class="text-[11px] text-amber-100/80 block">
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
                                class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-white font-bold px-7 py-3 rounded-xl text-sm shadow-lg shadow-orange-950/40 hover:shadow-[0_0_24px_rgba(249,115,22,0.45)] hover:scale-[1.02] transition-all duration-200 flex items-center gap-2">
                            <span>Lanjut: Data Instansi</span> &rarr;
                        </button>
                    </div>
                </div>


                <!-- ========================================================================= -->
                <!-- STEP 2: IDENTITAS KLIEN & INSTANSI -->
                <!-- ========================================================================= -->
                <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" class="space-y-6">
                    <div>
                        <h2 class="font-display font-bold text-xl text-white mb-1">Identitas Klien &amp; Instansi</h2>
                        <p class="text-xs text-slate-300">Masukkan nama penanggung jawab dan nomor WhatsApp untuk penerimaan PDF Quotation.</p>
                    </div>

                    <div class="aw-sub-card space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            <!-- Nama PIC -->
                            <div>
                                <label class="aw-label">
                                    Nama Penanggung Jawab (PIC) <span class="text-rose-400">*</span>
                                </label>
                                <input type="text" x-model="clientName" required placeholder="Contoh: Bpk. Ahmad Fauzi"
                                       class="aw-input">
                            </div>

                            <!-- Nama Institusi -->
                            <div>
                                <label class="aw-label">
                                    Nama Kampus / Sekolah / Instansi <span class="text-rose-400">*</span>
                                </label>
                                <input type="text" x-model="institutionName" required placeholder="Contoh: BEM FT ITS Surabaya / PT. Semen Indonesia"
                                       class="aw-input">
                            </div>

                            <!-- WhatsApp Phone -->
                            <div>
                                <label class="aw-label">
                                    Nomor WhatsApp Aktif <span class="text-rose-400">*</span>
                                </label>
                                <input type="text" x-model="phone" required placeholder="Contoh: 081234567890"
                                       class="aw-input">
                                <span class="text-[11px] text-slate-400 block mt-1.5">Ringkasan tiket akan dikirimkan ke nomor ini via WhatsApp.</span>
                            </div>

                            <!-- Email (Optional) -->
                            <div>
                                <label class="aw-label">
                                    Email Instansi <span class="text-slate-400 font-normal normal-case">(Opsional)</span>
                                </label>
                                <input type="email" x-model="email" placeholder="Contoh: pemesanan@its.ac.id"
                                       class="aw-input">
                            </div>

                        </div>
                    </div>

                    <!-- Step 2 Buttons -->
                    <div class="pt-4 flex justify-between items-center">
                        <button type="button" @click="step = 1" class="bg-white/10 hover:bg-white/15 text-slate-200 border border-white/15 font-semibold px-5 py-3 rounded-xl text-sm transition-all">
                            &larr; Kembali
                        </button>
                        <button type="button" @click="validateStep2()" class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-white font-bold px-7 py-3 rounded-xl text-sm shadow-lg shadow-orange-950/40 hover:scale-[1.02] transition-all">
                            Lanjut: Logistik &amp; Jadwal &rarr;
                        </button>
                    </div>
                </div>


                <!-- ========================================================================= -->
                <!-- STEP 3: TANGGAL, PESERTA & TRANSPORTASI -->
                <!-- ========================================================================= -->
                <div x-show="step === 3" x-cloak x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" class="space-y-6">
                    <div>
                        <h2 class="font-display font-bold text-xl text-white mb-1">Tanggal, Peserta &amp; Transportasi</h2>
                        <p class="text-xs text-slate-300">Tentukan jadwal perjalanan, jumlah peserta, titik keberangkatan, dan kebutuhan transportasi rombongan.</p>
                    </div>

                    {{-- A. JADWAL PERJALANAN --}}
                    <div class="aw-sub-card space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="aw-section-title" style="margin-bottom:0;padding-bottom:0;border:none;">A. Jadwal Perjalanan Rombongan <span class="text-rose-400">*</span></span>
                            <span class="text-xs font-bold text-teal-300 bg-teal-500/15 px-3 py-1 rounded-full border border-teal-400/30" x-text="durationText"></span>
                        </div>
                        <div class="border-t border-white/10 pt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Tanggal Keberangkatan -->
                            <div>
                                <label class="aw-label">Tanggal Keberangkatan <span class="text-rose-400">*</span></label>
                                <input type="date"
                                       x-model="eventDate"
                                       @change="checkHotelAutoShow()"
                                       required
                                       min="{{ date('Y-m-d') }}"
                                       class="aw-input">
                            </div>

                            <!-- Tanggal Kepulangan -->
                            <div>
                                <label class="aw-label">Tanggal Pulang <span class="text-slate-400 font-normal normal-case">(Opsional jika 1 Hari)</span></label>
                                <input type="date"
                                       x-model="returnDate"
                                       @change="checkHotelAutoShow()"
                                       min="{{ date('Y-m-d') }}"
                                       class="aw-input">
                            </div>

                            <!-- Waktu Keberangkatan -->
                            <div>
                                <label class="aw-label">Waktu Keberangkatan</label>
                                <input type="time" x-model="departureTime" class="aw-input">
                                <span class="text-[11px] text-slate-400 block mt-1">Contoh: 07:00 WIB</span>
                            </div>

                            <!-- Waktu Tiba Kembali -->
                            <div>
                                <label class="aw-label">Waktu Tiba Kembali <span class="text-slate-400 font-normal normal-case">(Opsional)</span></label>
                                <input type="time" x-model="returnTime" class="aw-input">
                            </div>
                        </div>
                    </div>

                    {{-- B. JUMLAH PESERTA --}}
                    <div class="aw-sub-card space-y-3">
                        <span class="aw-section-title block">
                            B. Estimasi Jumlah Peserta (PAX) <span class="text-rose-400">*</span>
                        </span>
                        <div class="max-w-xs">
                            <div class="relative rounded-xl shadow-sm">
                                <input type="number" 
                                       x-model="paxCount" 
                                       required 
                                       min="1" 
                                       class="aw-input pr-20 font-bold text-white text-base">
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-xs font-bold text-teal-300">
                                    Peserta
                                </div>
                            </div>
                            <span class="text-[11px] text-slate-400 block mt-1.5">Data ini digunakan untuk rekomendasi kapasitas armada.</span>
                        </div>
                    </div>

                    {{-- C. TITIK KEBERANGKATAN --}}
                    <div class="aw-sub-card space-y-4">
                        <span class="aw-section-title block">
                            C. Titik Keberangkatan &amp; Penjemputan <span class="text-rose-400">*</span>
                        </span>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="aw-label">
                                    Titik Keberangkatan Rombongan <span class="text-rose-400">*</span>
                                </label>
                                <input type="text" 
                                       x-model="departurePoint" 
                                       required 
                                       placeholder="Contoh: Universitas Negeri Surabaya, Ketintang"
                                       class="aw-input">
                            </div>

                            <div>
                                <label class="aw-label">
                                    Lokasi Penjemputan / Catatan Penjemputan <span class="text-slate-400 font-normal normal-case">(Opsional)</span>
                                </label>
                                <input type="text" 
                                       x-model="pickupNotes" 
                                       placeholder="Contoh: Depan Rektorat UNESA Ketintang / Rest Area Tol Waru"
                                       class="aw-input">
                            </div>
                        </div>
                    </div>

                    {{-- D. RENCANA TRANSPORTASI --}}
                    <div class="aw-sub-card space-y-4">
                        <div>
                            <span class="aw-section-title block">
                                D. Rencana Transportasi <span class="text-rose-400">*</span>
                            </span>
                            <p class="text-xs text-slate-300 mt-1">
                                Pilih cara perjalanan rombongan. Untuk perjalanan menggunakan kereta atau pesawat, transportasi lokal dapat disiapkan untuk perjalanan selama di destinasi.
                            </p>
                        </div>

                        {{-- 3 Radio Choices for Transport Type --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="aw-radio-card"
                                   :class="transportType === 'darat' ? 'border-teal-400/80 bg-teal-500/15 text-white ring-2 ring-teal-400/30' : ''">
                                <input type="radio" value="darat" x-model="transportType" class="text-teal-400 focus:ring-teal-400 mt-1">
                                <div>
                                    <span class="font-bold text-sm text-white block">Transportasi Darat</span>
                                    <span class="text-xs text-slate-300 block mt-0.5">Bus Pariwisata / Hiace langsung ke tujuan</span>
                                </div>
                            </label>

                            <label class="aw-radio-card"
                                   :class="transportType === 'kereta' ? 'border-teal-400/80 bg-teal-500/15 text-white ring-2 ring-teal-400/30' : ''">
                                <input type="radio" value="kereta" x-model="transportType" class="text-teal-400 focus:ring-teal-400 mt-1">
                                <div>
                                    <span class="font-bold text-sm text-white block">Kereta Api + Lokal</span>
                                    <span class="text-xs text-slate-300 block mt-0.5">Kereta antar kota &amp; bus/Hiace lokal</span>
                                </div>
                            </label>

                            <label class="aw-radio-card"
                                   :class="transportType === 'pesawat' ? 'border-teal-400/80 bg-teal-500/15 text-white ring-2 ring-teal-400/30' : ''">
                                <input type="radio" value="pesawat" x-model="transportType" class="text-teal-400 focus:ring-teal-400 mt-1">
                                <div>
                                    <span class="font-bold text-sm text-white block">Pesawat + Lokal</span>
                                    <span class="text-xs text-slate-300 block mt-0.5">Penerbangan &amp; armada lokal di destinasi</span>
                                </div>
                            </label>
                        </div>

                        {{-- CONDITIONAL SUB-OPTIONS PER CASE --}}

                        {{-- CASE 1: TRANSPORTASI DARAT --}}
                        <div x-show="transportType === 'darat'" 
                             x-transition:enter="transition ease-out duration-200"
                             class="bg-black/40 border border-white/15 rounded-2xl p-5 space-y-4 backdrop-blur-md">
                            <label class="aw-label text-teal-300">
                                PILIH JENIS KENDARAAN ARMADA:
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @forelse($transportOfferings as $vehicle)
                                    <label class="bg-slate-950/60 border border-white/15 rounded-xl p-3.5 cursor-pointer flex items-center gap-3 text-xs font-bold text-white hover:border-teal-400/50 transition-all"
                                           :class="daratVehicle === @js($vehicle->name) ? 'border-teal-400 bg-teal-500/20 text-teal-200 ring-2 ring-teal-400/30' : ''">
                                        <input type="radio" value="{{ $vehicle->name }}" x-model="daratVehicle" class="text-teal-400 focus:ring-teal-400">
                                        <span class="text-slate-100">{{ $vehicle->name }}@if($vehicle->capacity) ({{ $vehicle->capacity }})@endif</span>
                                    </label>
                                @empty
                                    <p class="text-xs text-rose-300">Belum ada armada aktif. Silakan hubungi admin untuk menentukan transportasi.</p>
                                @endforelse
                            </div>

                            {{-- Estimasi Harga Info Pills --}}
                            <div class="pt-3 border-t border-white/10 text-xs space-y-2">
                                <p class="font-bold text-slate-200">Estimasi Patokan Harga Transportasi Darat:</p>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 pt-1">
                                    @foreach($transportOfferings as $vehicle)
                                        @if($vehicle->price_label)
                                            <div class="bg-slate-950/60 p-3 rounded-xl border border-white/15">
                                                <span class="font-bold text-slate-200 block">{{ $vehicle->name }}:</span>
                                                <span class="text-amber-300 font-bold text-xs mt-0.5 block">{{ $vehicle->price_label }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <p class="text-[10px] text-slate-400 italic pt-1">
                                    *Harga merupakan estimasi dan dapat menyesuaikan tanggal, rute, durasi perjalanan, dan ketersediaan armada.
                                </p>
                            </div>
                        </div>

                        {{-- CASE 2: KERETA API --}}
                        <div x-show="transportType === 'kereta'" 
                             x-transition:enter="transition ease-out duration-200"
                             class="bg-black/40 border border-white/15 rounded-2xl p-5 space-y-4 backdrop-blur-md">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-200">Transportasi Antar Kota: <strong class="text-teal-300">Kereta Api Group</strong></span>
                            </div>

                            <label class="aw-label text-teal-300">
                                Transportasi Lokal di Destinasi:
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                                @foreach($transportOfferings as $vehicle)
                                    <label class="bg-slate-950/60 border border-white/15 rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-semibold text-white hover:border-teal-400/50 transition-all"
                                           :class="localTransport === @js($vehicle->name) ? 'border-teal-400 bg-teal-500/20 text-teal-200 ring-2 ring-teal-400/30' : ''">
                                        <input type="radio" value="{{ $vehicle->name }}" x-model="localTransport" class="text-teal-400 focus:ring-teal-400">
                                        <span class="text-slate-100">{{ $vehicle->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- CASE 3: PESAWAT --}}
                        <div x-show="transportType === 'pesawat'" 
                             x-transition:enter="transition ease-out duration-200"
                             class="bg-black/40 border border-white/15 rounded-2xl p-5 space-y-4 backdrop-blur-md">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-200">Transportasi Antar Kota / Negara: <strong class="text-teal-300">Pesawat Terbang Charter / Group</strong></span>
                            </div>

                            <label class="aw-label text-teal-300">
                                Transportasi Lokal di Destinasi:
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5">
                                @foreach($transportOfferings as $vehicle)
                                    <label class="bg-slate-950/60 border border-white/15 rounded-xl p-3 cursor-pointer flex items-center gap-2 text-xs font-semibold text-white hover:border-teal-400/50 transition-all"
                                           :class="localTransport === @js($vehicle->name) ? 'border-teal-400 bg-teal-500/20 text-teal-200 ring-2 ring-teal-400/30' : ''">
                                        <input type="radio" value="{{ $vehicle->name }}" x-model="localTransport" class="text-teal-400 focus:ring-teal-400">
                                        <span class="text-slate-100">{{ $vehicle->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- CASE 4: KOMBINASI / CUSTOM --}}
                        <div x-show="transportType === 'custom'" 
                             x-transition:enter="transition ease-out duration-200"
                             class="bg-black/40 border border-white/15 rounded-2xl p-5 space-y-3 backdrop-blur-md">
                            <label class="aw-label text-teal-300">
                                Jelaskan Kebutuhan Transportasi Anda <span class="text-rose-400">*</span>
                            </label>
                            <textarea x-model="customTransportDetails" 
                                      rows="3" 
                                      placeholder="Contoh: Berangkat menggunakan kereta, kemudian menggunakan bus selama 3 hari di destinasi."
                                      class="aw-input"></textarea>
                        </div>

                        {{-- SMART DYNAMIC RECOMMENDATION BOX --}}
                        <div class="bg-amber-500/10 border border-amber-400/25 rounded-2xl p-4 flex items-start gap-3 text-xs text-amber-200 shadow-sm">
                            <span class="text-lg">💡</span>
                            <div>
                                <span class="font-bold block text-amber-300">Rekomendasi AW TOUR:</span>
                                <p x-show="transportType === 'kereta'" class="leading-relaxed text-amber-200/90 mt-0.5">
                                    Karena perjalanan menggunakan kereta api, rombongan tetap membutuhkan transportasi lokal setelah tiba di destinasi. Anda dapat memilih bus/Hiace atau menyerahkan pencarian armada kepada AW TOUR.
                                </p>
                                <p x-show="transportType === 'pesawat'" class="leading-relaxed text-amber-200/90 mt-0.5">
                                    Untuk perjalanan menggunakan pesawat, transportasi lokal di destinasi dapat disiapkan sesuai jumlah peserta dan itinerary perjalanan.
                                </p>
                                <p x-show="transportType === 'darat'" class="leading-relaxed text-amber-200/90 mt-0.5">
                                    Untuk perjalanan darat langsung, pilih jenis kendaraan sesuai kebutuhan rombongan atau serahkan pencarian armada kepada AW TOUR.
                                </p>
                                <p x-show="transportType === 'custom'" class="leading-relaxed text-amber-200/90 mt-0.5">
                                    Tuliskan rincian moda transportasi yang Anda harapkan. Tim AW TOUR akan memadukan moda perjalanan paling efisien &amp; fleksibel.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- E. PENGINAPAN (CONDITIONAL IF MULTI-DAY) --}}
                    <div x-show="returnDate && eventDate && returnDate > eventDate"
                         x-cloak
                         x-transition:enter="transition ease-out duration-300"
                         class="aw-sub-card space-y-4">

                        <div>
                            <span class="aw-section-title block">E. Kebutuhan Penginapan / Hotel</span>
                            <p class="text-xs text-slate-300 mt-1">
                                Sistem mendeteksi perjalanan multi-hari. Apakah rombongan membutuhkan penginapan?
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 max-w-xs">
                            <label class="aw-radio-card justify-center text-center text-xs font-bold"
                                   :class="needHotel === 'Ya' ? 'border-teal-400/80 bg-teal-500/15 text-white ring-2 ring-teal-400/30' : ''">
                                <input type="radio" value="Ya" x-model="needHotel" class="text-teal-400 focus:ring-teal-400 mr-1.5">
                                <span>Ya, Butuh Hotel</span>
                            </label>

                            <label class="aw-radio-card justify-center text-center text-xs font-bold"
                                   :class="needHotel === 'Tidak' ? 'border-teal-400/80 bg-teal-500/15 text-white ring-2 ring-teal-400/30' : ''">
                                <input type="radio" value="Tidak" x-model="needHotel" class="text-teal-400 focus:ring-teal-400 mr-1.5">
                                <span>Tidak Perlu</span>
                            </label>
                        </div>

                        {{-- SUB-OPTIONS IF NEED HOTEL = YA --}}
                        <div x-show="needHotel === 'Ya'"
                             x-transition:enter="transition ease-out duration-200"
                             class="bg-black/35 border border-teal-400/25 rounded-2xl p-5 space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- Jumlah Kamar Stepper --}}
                                <div>
                                    <label class="aw-label">Jumlah Kamar</label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="if(hotelRooms > 1) hotelRooms--"
                                                class="w-10 h-10 rounded-xl bg-white/10 border border-white/15 font-bold text-white hover:bg-white/20 flex items-center justify-center transition-all">-</button>
                                        <input type="number" x-model="hotelRooms" min="1"
                                               class="aw-input w-20 text-center font-bold text-white">
                                        <button type="button" @click="hotelRooms++"
                                                class="w-10 h-10 rounded-xl bg-white/10 border border-white/15 font-bold text-white hover:bg-white/20 flex items-center justify-center transition-all">+</button>
                                        <span class="text-xs font-semibold text-slate-300">Kamar</span>
                                    </div>
                                </div>

                                {{-- Preferensi Tipe Kamar --}}
                                <div>
                                    <label class="aw-label">Preferensi Tipe Kamar</label>
                                    <select x-model="hotelRoomType" class="aw-input aw-select">
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
                                <label class="aw-label">Catatan Penginapan <span class="text-slate-400 font-normal normal-case">(Opsional)</span></label>
                                <textarea x-model="hotelNotes"
                                          rows="2"
                                          placeholder="Contoh: Hotel minimal bintang 3, dekat pusat kota atau area wisata."
                                          class="aw-input"></textarea>
                            </div>

                            <p class="text-[11px] text-slate-400 italic">
                                *Penginapan akan dicarikan AW TOUR berdasarkan kebutuhan rombongan dan dikonfirmasi via WhatsApp.
                            </p>
                        </div>
                    </div>

                    {{-- F. CATATAN / PERMINTAAN KHUSUS --}}
                    <div class="aw-sub-card space-y-3">
                        <span class="aw-section-title block">F. Catatan / Permintaan Khusus <span class="text-slate-400 font-normal normal-case">(Opsional)</span></span>
                        <textarea x-model="specialNotes"
                                  rows="3"
                                  placeholder="Contoh: Mohon siapkan spanduk rombongan BEM, kebutuhan dokumentasi drone, atau konsumsi khusus."
                                  class="aw-input"></textarea>
                    </div>

                    {{-- G. RINGKASAN DINAMIS STEP 3 --}}
                    <div class="bg-slate-950/70 text-white rounded-2xl p-5 border border-white/15 space-y-3 text-xs shadow-xl backdrop-blur-md">
                        <div class="flex items-center justify-between border-b border-white/10 pb-2">
                            <span class="font-bold text-teal-300 uppercase tracking-wider text-[11px]">Ringkasan Kebutuhan Perjalanan:</span>
                            <span class="text-slate-400">Step 3 Preview</span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-slate-200">
                            <div>
                                <span class="text-slate-400 block text-[11px]">Destinasi Tujuan:</span>
                                <strong class="text-teal-300 text-sm" x-text="destinationDisplayName"></strong>
                            </div>

                            <div>
                                <span class="text-slate-400 block text-[11px]">Perjalanan &amp; Durasi:</span>
                                <strong class="text-white text-xs" x-text="(eventDate || 'Belum diisi') + ' (' + durationText + ')'"></strong>
                            </div>

                            <div>
                                <span class="text-slate-400 block text-[11px]">Estimasi Peserta:</span>
                                <strong class="text-white text-xs" x-text="paxCount + ' orang'"></strong>
                            </div>

                            <div>
                                <span class="text-slate-400 block text-[11px]">Titik Keberangkatan:</span>
                                <strong class="text-white text-xs" x-text="departurePoint || 'Belum diisi'"></strong>
                            </div>

                            <div class="sm:col-span-2">
                                <span class="text-slate-400 block text-[11px]">Transportasi:</span>
                                <strong class="text-amber-300 text-xs" x-text="transportModeSummary"></strong>
                            </div>

                            <div x-show="returnDate && eventDate && returnDate > eventDate" class="sm:col-span-2 border-t border-white/10 pt-2">
                                <span class="text-slate-400 block text-[11px]">Status Penginapan:</span>
                                <strong class="text-white text-xs" x-text="needHotel === 'Ya' ? ('Dibutuhkan (' + hotelRooms + ' Kamar, Tipe: ' + hotelRoomType + ')') : 'Tidak Diperlukan'"></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 Buttons -->
                    <div class="pt-4 flex justify-between items-center">
                        <button type="button" @click="step = 2" class="bg-white/10 hover:bg-white/15 text-slate-200 border border-white/15 font-semibold px-5 py-3 rounded-xl text-sm transition-all">
                            &larr; Kembali
                        </button>
                        <button type="button" @click="validateStep3()" class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-400 hover:to-orange-500 text-white font-bold px-7 py-3 rounded-xl text-sm shadow-lg shadow-orange-950/40 hover:scale-[1.02] transition-all">
                            Lanjut: Review &amp; Kirim &rarr;
                        </button>
                    </div>
                </div>


                <!-- ========================================================================= -->
                <!-- STEP 4: REVIEW & KIRIM (FINAL DOCUMENT CARD) -->
                <!-- ========================================================================= -->
                <div x-show="step === 4" x-cloak x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-x-4" class="space-y-6 text-slate-100">

                    <!-- Step Header -->
                    <div class="space-y-1">
                        <h2 class="font-display font-bold text-xl text-white">Review &amp; Kirim Permintaan Quotation</h2>
                        <p class="text-xs text-slate-400">Periksa kembali rincian perjalanan Anda sebelum mengirim permintaan kepada AW TOUR.</p>
                    </div>

                    <!-- DARK GLASSMORPHISM REVIEW CARD -->
                    <div id="quotation-document-card"
                         class="rounded-3xl border border-white/10 shadow-2xl shadow-slate-950/60 overflow-hidden"
                         style="background: rgba(5, 10, 30, 0.75); backdrop-filter: blur(12px);">

                        <!-- DOCUMENT HEADER -->
                        <div class="px-6 py-5 border-b border-white/10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"
                             style="background: rgba(2, 6, 20, 0.60);">
                            <div class="flex items-center gap-3">
                                <img src="{{ asset('images/logo.png') }}"
                                     alt="AW TOUR"
                                     class="h-9 w-auto object-contain"
                                     onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                                <div class="hidden w-10 h-7 rounded-full bg-gradient-to-r from-[#00a3e0] to-[#006286] flex items-center justify-center">
                                    <span class="font-extrabold text-xs text-[#80ee11] italic">AW</span>
                                </div>
                                <div>
                                    <h3 class="font-display font-bold text-base text-white tracking-wide">AW TOUR OPERATOR</h3>
                                    <p class="text-[10px] font-semibold text-teal-400 uppercase tracking-widest">Surabaya · B2B Group Tour</p>
                                </div>
                            </div>
                            <span class="inline-block px-3 py-1.5 bg-teal-500/15 text-teal-300 font-mono font-bold text-[10px] rounded-lg uppercase tracking-wider border border-teal-400/25">
                                RINCIAN PERMINTAAN QUOTATION
                            </span>
                        </div>

                        <div class="p-6 space-y-5">

                            <!-- SECTION 1: PERJALANAN & DESTINASI -->
                            <div class="space-y-3">
                                <p class="aw-section-title">1. Informasi Perjalanan &amp; Destinasi</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2.5 text-xs">
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Jenis Acara</span>
                                        <span class="font-semibold text-white text-right" x-text="eventType"></span>
                                    </div>
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Destinasi Tujuan</span>
                                        <span class="font-bold text-teal-300 text-right" x-text="destinationDisplayName"></span>
                                    </div>
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Tgl. Keberangkatan</span>
                                        <span class="font-semibold text-white text-right" x-text="eventDate || '-'"></span>
                                    </div>
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Tgl. Pulang</span>
                                        <span class="font-semibold text-white text-right" x-text="returnDate || '1 Hari (Day Trip)'"></span>
                                    </div>
                                    <div class="flex justify-between items-baseline gap-2 sm:col-span-2">
                                        <span class="text-slate-400 shrink-0">Durasi Perjalanan</span>
                                        <span class="font-extrabold text-amber-300 text-right" x-text="durationText"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- SECTION 2: ROMBONGAN & LOGISTIK -->
                            <div class="space-y-3 pt-4 border-t border-white/10">
                                <p class="aw-section-title">2. Rombongan &amp; Titik Keberangkatan</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2.5 text-xs">
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Jumlah Peserta</span>
                                        <span class="font-bold text-white text-right" x-text="paxCount + ' Orang (PAX)'"></span>
                                    </div>
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Waktu Berangkat</span>
                                        <span class="font-semibold text-white text-right" x-text="(departureTime || '07:00') + ' WIB'"></span>
                                    </div>
                                    <div class="flex justify-between items-baseline gap-2 sm:col-span-2">
                                        <span class="text-slate-400 shrink-0">Titik Keberangkatan</span>
                                        <span class="font-semibold text-white text-right" x-text="departurePoint || '-'"></span>
                                    </div>
                                    <div x-show="pickupNotes" class="flex justify-between items-baseline gap-2 sm:col-span-2">
                                        <span class="text-slate-400 shrink-0">Catatan Penjemputan</span>
                                        <span class="font-medium text-slate-300 text-right" x-text="pickupNotes"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- SECTION 3: TRANSPORTASI -->
                            <div class="space-y-3 pt-4 border-t border-white/10">
                                <p class="aw-section-title">3. Rencana Transportasi</p>
                                <div class="space-y-2 text-xs">
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Moda Utama</span>
                                        <span class="font-bold text-white text-right" x-text="
                                            transportType === 'darat' ? '🚌 Transportasi Darat' :
                                            (transportType === 'kereta' ? '🚂 Kereta Api + Transportasi Lokal' :
                                            (transportType === 'pesawat' ? '✈️ Pesawat + Transportasi Lokal' : '⚙️ Kombinasi / Custom'))
                                        "></span>
                                    </div>
                                    <div x-show="transportType === 'darat'" class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Jenis Kendaraan</span>
                                        <span class="font-bold text-teal-300 text-right" x-text="daratVehicle"></span>
                                    </div>
                                    <div x-show="transportType === 'kereta' || transportType === 'pesawat'" class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Transportasi Lokal</span>
                                        <span class="font-bold text-teal-300 text-right" x-text="localTransport"></span>
                                    </div>
                                    <div x-show="transportType === 'custom'" class="flex justify-between items-start gap-2">
                                        <span class="text-slate-400 shrink-0">Detail Custom</span>
                                        <span class="font-medium text-slate-300 text-right" x-text="customTransportDetails"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- SECTION 4: PENGINAPAN -->
                            <div class="space-y-3 pt-4 border-t border-white/10">
                                <p class="aw-section-title">4. Kebutuhan Penginapan / Hotel</p>
                                <div class="space-y-2 text-xs">
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Status Penginapan</span>
                                        <span class="font-bold text-white text-right" x-text="needHotel === 'Ya' ? '✅ Dibutuhkan' : '— Tidak Diperlukan'"></span>
                                    </div>
                                    <template x-if="needHotel === 'Ya'">
                                        <div class="space-y-2 pt-1">
                                            <div class="flex justify-between items-baseline gap-2">
                                                <span class="text-slate-400 shrink-0">Jumlah Kamar</span>
                                                <span class="font-bold text-white text-right" x-text="hotelRooms + ' Kamar'"></span>
                                            </div>
                                            <div class="flex justify-between items-baseline gap-2">
                                                <span class="text-slate-400 shrink-0">Tipe Kamar</span>
                                                <span class="font-bold text-white text-right" x-text="hotelRoomType"></span>
                                            </div>
                                            <div x-show="hotelNotes" class="flex justify-between items-start gap-2">
                                                <span class="text-slate-400 shrink-0">Catatan</span>
                                                <span class="font-medium text-slate-300 text-right" x-text="hotelNotes"></span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- SECTION 5: IDENTITAS PEMESAN -->
                            <div class="space-y-3 pt-4 border-t border-white/10">
                                <p class="aw-section-title">5. Identitas Pemesan / Instansi</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2.5 text-xs">
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Nama PIC</span>
                                        <span class="font-bold text-white text-right" x-text="clientName || '-'"></span>
                                    </div>
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Instansi / Kampus</span>
                                        <span class="font-bold text-white text-right" x-text="institutionName || '-'"></span>
                                    </div>
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">WhatsApp</span>
                                        <span class="font-bold text-emerald-400 text-right" x-text="phone || '-'"></span>
                                    </div>
                                    <div class="flex justify-between items-baseline gap-2">
                                        <span class="text-slate-400 shrink-0">Email</span>
                                        <span class="font-medium text-slate-300 text-right" x-text="email || '-'"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- SECTION 6: CATATAN KHUSUS -->
                            <div x-show="specialNotes" class="space-y-2 pt-4 border-t border-white/10">
                                <p class="aw-section-title">6. Catatan / Permintaan Khusus</p>
                                <p class="text-xs text-slate-300 italic bg-white/5 p-3 rounded-xl border border-white/10" x-text="specialNotes"></p>
                            </div>

                            <!-- STATUS NOTICE -->
                            <div class="bg-amber-500/10 border border-amber-400/25 rounded-2xl p-4 text-xs space-y-1">
                                <div class="flex items-center gap-2 font-bold text-amber-300">
                                    <span>🟠 STATUS: MENUNGGU KONFIRMASI AW TOUR</span>
                                </div>
                                <p class="text-amber-200/80 leading-relaxed text-[11px]">
                                    Rincian ini merupakan permintaan quotation dan bukan harga final. Harga resmi, ketersediaan armada, transportasi, dan penginapan akan dikonfirmasi langsung oleh tim konsultan AW TOUR.
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- ACTION BUTTONS BAR -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-4 no-print">
                        <button type="button" @click="step = 3"
                                class="w-full sm:w-auto bg-white/10 hover:bg-white/15 text-slate-200 border border-white/15 font-semibold px-5 py-3 rounded-xl text-sm transition-all">
                            &larr; Kembali
                        </button>

                        <div class="flex flex-wrap items-center justify-end gap-3 w-full sm:w-auto">
                            {{-- Button 1: Cetak Rincian --}}
                            <button type="button"
                                    @click="window.print()"
                                    class="py-3 px-4 rounded-xl border border-white/15 text-slate-300 text-xs font-bold hover:bg-white/10 transition-all flex items-center gap-2">
                                <span>🖨 Cetak Rincian</span>
                            </button>

                            {{-- Button 2: Download PNG --}}
                            <button type="button"
                                    @click="
                                        const card = document.getElementById('quotation-document-card');
                                        if (typeof html2canvas !== 'undefined' && card) {
                                            html2canvas(card, { scale: 2, backgroundColor: '#050a1e' }).then(canvas => {
                                                const link = document.createElement('a');
                                                link.download = 'AWT-Quotation-Request.png';
                                                link.href = canvas.toDataURL('image/png');
                                                link.click();
                                                showToast('Dokumen berhasil didownload!');
                                            });
                                        } else {
                                            window.print();
                                        }
                                    "
                                    class="py-3 px-4 rounded-xl border border-white/15 text-slate-300 text-xs font-bold hover:bg-white/10 transition-all flex items-center gap-2">
                                <span>⬇ Simpan / Download</span>
                            </button>

                            {{-- Button 3: Submit --}}
                            <button type="submit"
                                    class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold px-7 py-3.5 rounded-2xl text-sm shadow-xl shadow-emerald-950/40 hover:scale-105 transition-all flex items-center justify-center gap-2">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.157 4.228 4.223-1.111z"/>
                                </svg>
                                <span>Kirim via WhatsApp</span>
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
<script>
    /**
     * Helper untuk membersihkan draft Quotation Builder dari localStorage.
     * Dapat dipanggil kapan pun form di-reset atau setelah flow quotation berhasil.
     */
    function clearQuotationDraft() {
        try {
            localStorage.removeItem('quotation_builder_draft');
        } catch (e) {
            console.warn('Gagal membersihkan draft quotation dari localStorage:', e);
        }
    }
</script>
@endpush
