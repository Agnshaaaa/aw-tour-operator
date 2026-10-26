@extends('layouts.admin')

@section('title', 'Kelola Kalender Tanggal Terpesan — Admin Control Panel')
@section('page_title', 'Kelola Kalender Ketersediaan Tanggal')

@section('content')
<div x-data="{ openModal: false, selectedDate: '' }">

    {{-- TOP BAR & MONTH NAVIGATION --}}
    <div class="bg-[#0B0B0E]/90 p-5 rounded-3xl border border-white/[0.07] shadow-xl space-y-4">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            
            {{-- Month & Year Navigation --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.calendar.index', ['year' => $prevMonth['year'], 'month' => $prevMonth['month']]) }}" 
                   class="p-2 rounded-xl bg-[#0B0B0E] hover:bg-[#121215] text-zinc-300 hover:text-white border border-white/[0.07] transition-colors"
                   title="Bulan Sebelumnya">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>

                <h2 class="font-serif text-lg font-bold text-white px-2">
                    {{ $monthName }}
                </h2>

                <a href="{{ route('admin.calendar.index', ['year' => $nextMonth['year'], 'month' => $nextMonth['month']]) }}" 
                   class="p-2 rounded-xl bg-[#0B0B0E] hover:bg-[#121215] text-zinc-300 hover:text-white border border-white/[0.07] transition-colors"
                   title="Bulan Berikutnya">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="{{ route('admin.calendar.index', ['year' => date('Y'), 'month' => date('n')]) }}" 
                   class="ml-2 px-3 py-1.5 rounded-xl bg-[#0B0B0E] hover:bg-[#121215] text-[11px] font-semibold text-zinc-400 hover:text-white border border-white/[0.07] transition-colors">
                    Hari Ini
                </a>
            </div>

            {{-- Action Button: Tambah Tanggal --}}
            <button @click="openModal = true; selectedDate = ''" 
                    class="w-full sm:w-auto px-4 py-2.5 bg-aw-gold text-slate-950 font-bold text-xs rounded-xl hover:bg-aw-gold/90 transition-all shadow-md flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Tanggal Terpesan</span>
            </button>
        </div>

        {{-- SUMMARY STATS --}}
        <div class="grid grid-cols-3 gap-3 pt-3 border-t border-white/[0.07]/80 text-xs">
            <div class="p-3 rounded-2xl bg-[#0B0B0E]/60 border border-white/[0.07]/60">
                <span class="text-zinc-400 text-[10px] uppercase font-semibold block">Total Terpesan Bulan Ini</span>
                <span class="text-lg font-bold text-white">{{ $stats['total_booked_month'] }} Tanggal</span>
            </div>
            <div class="p-3 rounded-2xl bg-[#0B0B0E]/60 border border-white/[0.07]/60">
                <span class="text-zinc-400 text-[10px] uppercase font-semibold block">Dari Tiket Quotation</span>
                <span class="text-lg font-bold text-emerald-400">{{ $stats['from_requests'] }} Tiket</span>
            </div>
            <div class="p-3 rounded-2xl bg-[#0B0B0E]/60 border border-white/[0.07]/60">
                <span class="text-zinc-400 text-[10px] uppercase font-semibold block">Blokir Manual Admin</span>
                <span class="text-lg font-bold text-aw-gold">{{ $stats['manual_blocks'] }} Tanggal</span>
            </div>
        </div>
    </div>

    {{-- CALENDAR GRID VISUALIZER --}}
    <div class="bg-[#0B0B0E]/90 p-6 rounded-3xl border border-white/[0.07] shadow-xl space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="font-serif text-base font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Visual Ketersediaan: {{ $monthName }}
            </h3>
            <div class="flex items-center gap-3 text-[11px] text-zinc-400">
                <span class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded bg-rose-500/30 border border-rose-500/60"></span>
                    <span>Terpesan (Booked)</span>
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="w-3 h-3 rounded bg-[#0B0B0E] border border-white/[0.09]"></span>
                    <span>Tersedia (Open)</span>
                </span>
            </div>
        </div>

        {{-- Day names header --}}
        <div class="grid grid-cols-7 gap-2 text-center text-[11px] font-bold text-zinc-400 uppercase tracking-wider py-2 border-b border-white/[0.07]">
            <div>Sen</div>
            <div>Sel</div>
            <div>Rab</div>
            <div>Kam</div>
            <div>Jum</div>
            <div class="text-aw-gold">Sab</div>
            <div class="text-rose-400">Min</div>
        </div>

        {{-- Month Days Grid --}}
        <div class="grid grid-cols-7 gap-2">
            {{-- Empty cells before first day --}}
            @for ($i = 1; $i < $startOfWeek; $i++)
                <div class="h-20 sm:h-24 rounded-2xl bg-[#060608]/40 border border-dashed border-white/[0.07]/50"></div>
            @endfor

            {{-- Calendar Day Cards --}}
            @for ($d = 1; $d <= $daysInMonth; $d++)
                @php
                    $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $d);
                    $isBooked = isset($bookedDatesMap[$dateStr]);
                    $record = $isBooked ? $bookedDatesMap[$dateStr] : null;
                    $isToday = $dateStr === date('Y-m-d');
                @endphp

                <div class="h-20 sm:h-24 p-2 rounded-2xl border transition-all flex flex-col justify-between text-left {{ $isBooked ? 'bg-rose-500/10 border-rose-500/40 text-rose-200' : 'bg-[#0B0B0E]/60 border-white/[0.07] hover:border-white/[0.09] text-zinc-300' }} {{ $isToday ? 'ring-2 ring-aw-gold/60' : '' }}">
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-bold {{ $isToday ? 'text-aw-gold' : '' }}">
                            {{ $d }}
                        </span>
                        @if($isBooked)
                            <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                        @endif
                    </div>

                    @if($isBooked)
                        <div class="truncate text-[10px] space-y-0.5">
                            <span class="font-semibold text-rose-300 block truncate" title="{{ $record->label }}">
                                {{ $record->label }}
                            </span>
                            @if($record->customRequest)
                                <a href="{{ route('admin.requests.show', $record->custom_request_id) }}" 
                                   class="text-[9px] text-aw-gold hover:underline block truncate">
                                    Tiket: {{ $record->customRequest->ticket_number }}
                                </a>
                            @else
                                <span class="text-[9px] text-zinc-400 block">Blokir Manual</span>
                            @endif
                        </div>
                    @else
                        <button type="button" 
                                @click="openModal = true; selectedDate = '{{ $dateStr }}'"
                                class="text-[10px] text-zinc-500 hover:text-aw-gold transition-colors opacity-0 hover:opacity-100 sm:block">
                            + Blokir
                        </button>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    {{-- DETAILED BOOKED DATES TABLE --}}
    <div class="bg-[#0B0B0E]/90 rounded-3xl p-6 border border-white/[0.07] shadow-xl space-y-4">
        <h3 class="font-serif text-base font-bold text-white flex items-center gap-2">
            <svg class="w-5 h-5 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-6 9l2 2 4-4"/></svg>
            Rincian Tanggal Terpesan Bulan Ini
        </h3>

        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left text-zinc-300">
                <thead class="bg-[#0B0B0E] text-zinc-400 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="px-4 py-3 rounded-l-xl">Tanggal</th>
                        <th class="px-4 py-3">Keterangan / Label</th>
                        <th class="px-4 py-3">Sumber Pemesanan</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-right rounded-r-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($bookedDates as $date)
                        <tr class="hover:bg-[#121215]/40 transition-colors">
                            <td class="px-4 py-3.5 font-bold text-white whitespace-nowrap flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $date->booked_date->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3.5 font-semibold text-zinc-200">
                                {{ $date->label }}
                            </td>
                            <td class="px-4 py-3.5">
                                @if($date->customRequest)
                                    <div class="flex flex-col">
                                        <a href="{{ route('admin.requests.show', $date->custom_request_id) }}" 
                                           class="font-bold text-aw-gold hover:underline">
                                            Tiket: {{ $date->customRequest->ticket_number }}
                                        </a>
                                        <span class="text-[11px] text-zinc-400">
                                            {{ $date->customRequest->institution_name }} ({{ $date->customRequest->pax }} pax)
                                        </span>
                                    </div>
                                @else
                                    <span class="px-2 py-0.5 rounded-md bg-[#121215] text-zinc-300 border border-white/[0.09] text-[10px] font-semibold">
                                        Blokir Manual Admin
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-center">
                                <span class="px-2.5 py-1 rounded-full bg-rose-500/20 text-rose-300 border border-rose-500/30 text-[10px] font-bold uppercase">
                                    Fully Booked
                                </span>
                            </td>
                            <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.calendar.destroy', $date->id) }}" 
                                      onsubmit="return confirm('Hapus tanggal terpesan ini ({{ $date->booked_date->format('d M Y') }})? Tanggal akan kembali tersedia untuk calon klien.');" 
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-1.5 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 text-xs font-semibold transition-colors inline-flex items-center gap-1"
                                            title="Lepaskan Tanggal">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        <span>Bebaskan</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-zinc-500">
                                Tidak ada tanggal terpesan di bulan {{ $monthName }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL TAMBAH TANGGAL TERPESAN --}}
    <div x-show="openModal" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#060608]/75 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="bg-[#0B0B0E] border border-white/[0.07] rounded-3xl p-6 w-full max-w-md shadow-2xl space-y-5"
             @click.away="openModal = false">
            
            <div class="flex items-center justify-between border-b border-white/[0.07] pb-3">
                <h3 class="font-serif text-base font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-aw-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Tambah Tanggal Terpesan Manual
                </h3>
                <button type="button" @click="openModal = false" class="text-zinc-400 hover:text-white p-1 rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.calendar.store') }}" class="space-y-4 text-xs">
                @csrf
                
                <div class="space-y-1.5">
                    <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2" for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                        Tanggal Yang Terpesan <span class="text-rose-400">*</span>
                    </label>
                    <input type="date" name="booked_date" id="booked_date" required 
                           :value="selectedDate"
                           class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner" />
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs md:text-sm font-medium text-zinc-400 mb-2" for class="block text-xs md:text-sm font-medium text-zinc-400 mb-2">
                        Keterangan / Label <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" name="label" id="label" required 
                           placeholder="Contoh: Booking Offline PT Pelindo / Libur Maintenance Armada" 
                           class="block w-full bg-zinc-950/80 border border-white/10 text-zinc-100 placeholder-zinc-500 rounded-xl px-4 py-3 text-sm transition-all focus:border-amber-500/50 focus:ring-1 focus:ring-amber-500/50 shadow-inner" />
                </div>

                <p class="text-[11px] text-zinc-400 bg-[#0B0B0E]/80 backdrop-blur-xl p-3 rounded-xl border border-white/[0.07]">
                    <div class="flex items-start gap-2 text-xs text-amber-300/90 bg-amber-500/10 border border-amber-500/20 p-3.5 rounded-xl">
                        <svg class="w-5 h-5 text-amber-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Tanggal ini akan ditandai merah (Fully Booked) di Interactive Availability Calendar halaman publik website.</span>
                    </div>
                </p>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" @click="openModal = false" 
                            class="px-4 py-2.5 bg-[#121215] hover:bg-slate-700 text-zinc-300 rounded-xl font-semibold transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 bg-aw-gold text-slate-950 font-bold rounded-xl hover:bg-aw-gold/90 transition-all shadow-md">
                        Simpan Tanggal
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
