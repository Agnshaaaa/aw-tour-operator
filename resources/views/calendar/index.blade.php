@extends('layouts.app')

@section('title', 'Kalender Ketersediaan Tanggal Tour - AW Tour Operator')
@section('meta_description', 'Cek jadwal ketersediaan tanggal tour rombongan B2B kampus & instansi secara real-time. Pilih tanggal luang dan ajukan Custom Quotation Tour Surabaya & Jawa Timur.')

@section('content')
{{-- HERO BANNER --}}
<section class="bg-aw-navy text-white pt-12 pb-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#D39252_1px,transparent_1px)] [background-size:16px_16px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-block px-4 py-1.5 rounded-full bg-aw-gold/20 text-aw-gold text-xs font-semibold uppercase tracking-wider mb-4 border border-aw-gold/30">
                📅 Live Availability Tracker
            </span>
            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                Kalender Ketersediaan Tanggal Tour
            </h1>
            <p class="text-gray-300 text-base sm:text-lg mb-6">
                Pantau ketersediaan slot tour rombongan B2B kampus, sekolah, dan perusahaan secara <span class="text-aw-gold font-semibold">real-time</span>. Pilih tanggal yang masih hijau untuk mengajukan Custom Tour!
            </p>

            {{-- Quick Info Badges --}}
            <div class="flex flex-wrap items-center justify-center gap-4 text-xs sm:text-sm text-gray-200">
                <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-lg backdrop-blur-sm">
                    <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span><strong>Hijau:</strong> Slot Kunjungan/Tour Tersedia</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-lg backdrop-blur-sm">
                    <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                    <span><strong>Merah:</strong> Fully Booked / Kuota Terisi</span>
                </div>
                <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-lg backdrop-blur-sm">
                    <span class="w-3 h-3 rounded-full bg-gray-400"></span>
                    <span><strong>Abu-abu:</strong> Tanggal Terlampaui</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAIN CALENDAR CONTENT --}}
<section class="py-12 bg-aw-cream/40 min-h-screen" x-data="calendarApp()">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- MONTH NAVIGATION & FILTERS HEADER --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mb-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                
                {{-- Prev / Next Month Buttons --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('calendar.index', ['year' => $prevMonth['year'], 'month' => $prevMonth['month']]) }}" 
                       class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 bg-white text-aw-navy hover:bg-aw-cream hover:border-aw-gold transition-all shadow-sm"
                       title="Bulan Sebelumnya">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>

                    <h2 class="text-2xl font-serif font-bold text-aw-navy min-w-[200px] text-center">
                        {{ $monthName }}
                    </h2>

                    <a href="{{ route('calendar.index', ['year' => $nextMonth['year'], 'month' => $nextMonth['month']]) }}" 
                       class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-gray-200 bg-white text-aw-navy hover:bg-aw-cream hover:border-aw-gold transition-all shadow-sm"
                       title="Bulan Berikutnya">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                {{-- Month & Year Selector Dropdown --}}
                <form method="GET" action="{{ route('calendar.index') }}" class="flex items-center gap-2">
                    <select name="month" class="px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-aw-gold focus:outline-none text-gray-700">
                        @php
                            $monthsIndo = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                        @endphp
                        @foreach($monthsIndo as $mNum => $mText)
                            <option value="{{ $mNum }}" {{ $mNum == $month ? 'selected' : '' }}>
                                {{ $mText }}
                            </option>
                        @endforeach
                    </select>

                    <select name="year" class="px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white focus:ring-2 focus:ring-aw-gold focus:outline-none text-gray-700">
                        @for($y = date('Y'); $y <= date('Y') + 2; $y++)
                            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>

                    <button type="submit" class="px-4 py-2 bg-aw-navy text-white text-sm font-semibold rounded-lg hover:bg-aw-forest transition-colors">
                        Lompat
                    </button>
                </form>

                {{-- Direct CTA --}}
                <a href="{{ route('quotation.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-aw-gold text-white font-semibold text-sm hover:bg-amber-600 transition-all shadow-md">
                    <span>⚡ Custom Quotation</span>
                </a>
            </div>
        </div>

        {{-- CALENDAR GRID CONTAINER --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-12">
            
            {{-- Header Day Names (Senin - Minggu) --}}
            <div class="grid grid-cols-7 bg-aw-navy text-white text-center font-semibold text-sm py-3.5 divide-x divide-white/10">
                <div>Senin</div>
                <div>Selasa</div>
                <div>Rabu</div>
                <div>Kamis</div>
                <div>Jumat</div>
                <div class="text-aw-gold">Sabtu</div>
                <div class="text-rose-300">Minggu</div>
            </div>

            {{-- Grid Cells --}}
            <div class="grid grid-cols-7 border-t border-gray-200 divide-x divide-y divide-gray-100 text-sm">
                
                {{-- Blank Offset Cells before the 1st of month --}}
                @for ($offset = 1; $offset < $startOfWeek; $offset++)
                    <div class="min-h-[100px] sm:min-h-[120px] bg-gray-50/60 p-2 opacity-40"></div>
                @endfor

                {{-- Days of the Current Month --}}
                @for ($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $dayTwoDigit = str_pad($day, 2, '0', STR_PAD_LEFT);
                        $monthTwoDigit = str_pad($month, 2, '0', STR_PAD_LEFT);
                        $fullDateStr = "{$year}-{$monthTwoDigit}-{$dayTwoDigit}";
                        
                        $isBooked = isset($bookedDatesMap[$fullDateStr]);
                        $bookedData = $isBooked ? $bookedDatesMap[$fullDateStr] : null;
                        $isPast = $fullDateStr < $todayStr;
                        $isToday = $fullDateStr === $todayStr;
                    @endphp

                    <div class="min-h-[100px] sm:min-h-[125px] p-2 transition-all relative flex flex-col justify-between group
                        {{ $isPast ? 'bg-gray-100/70 text-gray-400' : ($isBooked ? 'bg-rose-50/80 border-rose-200 hover:bg-rose-100/90' : 'bg-emerald-50/40 hover:bg-emerald-100/60 cursor-pointer') }}
                        {{ $isToday ? 'ring-2 ring-aw-gold ring-inset font-bold' : '' }}"
                         @if(!$isPast)
                             @click="openModal('{{ $fullDateStr }}', {{ $isBooked ? 'true' : 'false' }}, '{{ $isBooked ? addslashes($bookedData['label']) : '' }}')"
                         @endif
                    >
                        {{-- Top Header of Cell --}}
                        <div class="flex items-center justify-between w-full">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-semibold
                                {{ $isToday ? 'bg-aw-gold text-white shadow-sm' : ($isPast ? 'text-gray-400' : 'text-gray-800') }}">
                                {{ $day }}
                            </span>

                            @if($isToday)
                                <span class="text-[10px] bg-aw-navy text-white px-1.5 py-0.5 rounded uppercase tracking-wider font-semibold">Hari Ini</span>
                            @endif
                        </div>

                        {{-- Status Badge inside Cell --}}
                        <div class="mt-2">
                            @if($isPast)
                                <span class="inline-block text-[11px] px-2 py-0.5 rounded bg-gray-200 text-gray-500 font-medium">
                                    Lewat
                                </span>
                            @elseif($isBooked)
                                <div class="bg-rose-600 text-white p-1.5 rounded-lg shadow-sm">
                                    <div class="flex items-center gap-1 font-bold text-[11px] uppercase tracking-wide">
                                        <svg class="w-3 h-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Terisi</span>
                                    </div>
                                    <p class="text-[10px] opacity-90 truncate leading-tight mt-0.5 font-normal">
                                        {{ $bookedData['label'] ?? 'Fully Booked' }}
                                    </p>
                                </div>
                            @else
                                <div class="bg-emerald-100 text-emerald-800 border border-emerald-300/60 p-1.5 rounded-lg group-hover:bg-emerald-200 transition-all">
                                    <div class="flex items-center justify-between text-[11px] font-semibold">
                                        <span class="text-emerald-700">Tersedia</span>
                                        <svg class="w-3.5 h-3.5 text-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Hover Action Hint for Available Date --}}
                        @if(!$isPast && !$isBooked)
                            <div class="text-[10px] text-emerald-700 font-semibold text-right mt-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                Klik untuk Detail →
                            </div>
                        @endif
                    </div>
                @endfor

                {{-- Trailing Cells padding to complete last row --}}
                @php
                    $totalCells = ($startOfWeek - 1) + $daysInMonth;
                    $remainder = $totalCells % 7;
                    $trailingCells = $remainder == 0 ? 0 : 7 - $remainder;
                @endphp

                @for ($trail = 1; $trail <= $trailingCells; $trail++)
                    <div class="min-h-[100px] sm:min-h-[120px] bg-gray-50/60 p-2 opacity-40"></div>
                @endfor

            </div>
        </div>

        {{-- INFORMATIONAL BANNER & B2B NOTES --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-md flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-aw-navy/10 text-aw-navy flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-aw-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 4h4" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-aw-navy text-lg mb-1">Prioritas Rombongan B2B</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Sistem kami dirancang khusus untuk menangani rombongan besar instansi, studi ekskursi kampus, & corporate outing.
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-md flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-aw-gold/10 text-aw-gold flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-aw-navy text-lg mb-1">Hold Tanggal Sementara</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Anda dapat melakukan provisional booking (hold tanggal) selama 3 hari kerja sebelum konfirmasi DP resmi.
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-md flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-aw-navy text-lg mb-1">Butuh Respon Cepat?</h3>
                    <p class="text-xs text-gray-600 leading-relaxed mb-2">
                        Tim Admin kami bersiaga membantu jadwal padat rombongan Anda.
                    </p>
                    <a href="https://wa.me/6282233119092?text=Halo%20Admin%20AW%20Tour,%20saya%20ingin%20tanya%20ketersediaan%20jadwal%20tour" 
                       target="_blank" 
                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 hover:text-emerald-800">
                        <span>Hubungi WhatsApp Admin</span> →
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- INTERACTIVE MODAL FOR DATE DETAILS --}}
    <div x-show="showModal" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         @click.self="showModal = false">
        
        <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden border border-gray-100">
            {{-- Modal Header --}}
            <div class="p-6 text-white" :class="modalData.isBooked ? 'bg-rose-700' : 'bg-aw-navy'">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider"
                          :class="modalData.isBooked ? 'bg-white/20 text-white' : 'bg-emerald-500/30 text-emerald-300 border border-emerald-400/40'">
                        <span x-text="modalData.isBooked ? '🔴 Fully Booked' : '🟢 Tanggal Tersedia'"></span>
                    </span>

                    <button @click="showModal = false" class="text-white/80 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <h3 class="font-serif text-2xl font-bold text-white" x-text="formatDateIndo(modalData.date)"></h3>
                <p class="text-xs text-white/80 mt-1">Status ketersediaan armada & pemandu tour AW Tour Operator</p>
            </div>

            {{-- Modal Body --}}
            <div class="p-6 space-y-4">
                {{-- If Booked --}}
                <template x-if="modalData.isBooked">
                    <div class="space-y-4">
                        <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-rose-200 text-rose-800 flex items-center justify-center shrink-0 font-bold">!</div>
                                <div>
                                    <h4 class="font-bold text-rose-900 text-sm mb-1">Tanggal Terisi</h4>
                                    <p class="text-xs text-rose-800 leading-relaxed">
                                        Agenda pada tanggal ini: <strong x-text="modalData.label || 'Fully Booked'"></strong>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            Apakah jadwal Anda terikat pada tanggal ini? Anda dapat menghubungi tim kami untuk mendiskusikan kemungkinan penambahan armada cadangan atau rekomendasi tanggal terbaik terdekat.
                        </p>

                        <div class="pt-2 flex flex-col gap-2">
                            <a :href="'https://wa.me/6282233119092?text=Halo%20Admin%20AW%20Tour,%20saya%20ingin%20tanya%20opsi%20keberangkatan%20di%20tanggal%20' + modalData.date" 
                               target="_blank" 
                               class="w-full py-3 px-4 rounded-xl bg-emerald-600 text-white font-semibold text-sm hover:bg-emerald-700 transition-all text-center flex items-center justify-center gap-2 shadow-md">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                                </svg>
                                <span>Konsultasi Tanggal via WhatsApp</span>
                            </a>
                            
                            <button @click="showModal = false" class="w-full py-2.5 text-xs text-gray-500 hover:text-gray-800 font-semibold">
                                Tutup
                            </button>
                        </div>
                    </div>
                </template>

                {{-- If Available --}}
                <template x-if="!modalData.isBooked">
                    <div class="space-y-4">
                        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-emerald-200 text-emerald-800 flex items-center justify-center shrink-0 font-bold">✓</div>
                                <div>
                                    <h4 class="font-bold text-emerald-900 text-sm mb-1">Tanggal Bebas Dijadwalkan</h4>
                                    <p class="text-xs text-emerald-800 leading-relaxed">
                                        Slot bus & pemandu tour siap dipesan untuk rombongan Anda pada tanggal ini.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <ul class="text-xs text-gray-600 space-y-1.5 pl-4 list-disc">
                            <li>Layanan penjemputan gratis area Surabaya & sekitarnya.</li>
                            <li>Bebas kustomisasi destinasi wisata & paket UMKM souvenir.</li>
                            <li>Klaim harga B2B khusus rombongan instansi & kampus.</li>
                        </ul>

                        <div class="pt-2 flex flex-col gap-2">
                            <a :href="'{{ route('quotation.create') }}?date=' + modalData.date" 
                               class="w-full py-3 px-4 rounded-xl bg-aw-gold text-white font-semibold text-sm hover:bg-amber-600 transition-all text-center flex items-center justify-center gap-2 shadow-md">
                                <span>🚀 Pesan Tanggal Ini (Buat Quotation)</span>
                            </a>

                            <button @click="showModal = false" class="w-full py-2.5 text-xs text-gray-500 hover:text-gray-800 font-semibold">
                                Batal
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
function calendarApp() {
    return {
        showModal: false,
        modalData: {
            date: '',
            isBooked: false,
            label: ''
        },
        openModal(dateStr, isBooked, label = '') {
            this.modalData = {
                date: dateStr,
                isBooked: isBooked,
                label: label
            };
            this.showModal = true;
        },
        formatDateIndo(dateString) {
            if (!dateString) return '';
            const dateObj = new Date(dateString);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            return dateObj.toLocaleDateString('id-ID', options);
        }
    }
}
</script>
@endpush
@endsection
