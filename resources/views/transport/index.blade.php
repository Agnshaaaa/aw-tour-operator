@extends('layouts.app')

@section('title', 'Pilihan Transportasi — AW Tour Operator')
@section('meta_description', 'Pilihan armada transportasi untuk perjalanan rombongan AW Tour Operator.')

@section('content')
<section class="bg-[#18181B] text-white pt-28 pb-16 sm:pt-36 sm:pb-20 border-b border-white/10 relative overflow-hidden">
    <div class="absolute -top-12 -right-12 w-64 h-64 bg-aw-gold/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <span class="badge-altesa-dark">Armada Perjalanan</span>
        <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-extrabold text-white">Pilihan Transportasi Rombongan</h1>
        <p class="max-w-2xl mx-auto text-slate-300 text-sm sm:text-base leading-relaxed">Informasi armada dan tipe kendaraan untuk membantu menyesuaikan perjalanan rombongan Anda.</p>
    </div>
</section>

<section class="py-16 bg-[#FCFAF7] min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        <div class="bg-[#FCFAF7] border border-[#F5F0E8] rounded-3xl p-5 text-xs sm:text-sm text-slate-700 shadow-sm">
            <strong class="block mb-1 text-aw-navy font-bold flex items-center gap-2">
                <span>📌</span> Informasi Estimasi Harga Armada
            </strong>
            <p class="leading-relaxed">Harga merupakan estimasi dan dapat disesuaikan menurut tanggal, rute, durasi kunjungan, serta fasilitas tambahan rombongan Anda.</p>
        </div>

        <div>
            <div class="mb-8">
                <span class="badge-altesa-peach">Armada Perjalanan</span>
                <h2 class="font-display text-2xl sm:text-4xl font-bold text-aw-navy mt-2">Kendaraan Rombongan</h2>
            </div>
            @if($vehicles->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($vehicles as $vehicle)
                        <article class="card-altesa overflow-hidden flex flex-col justify-between group">
                            <div>
                                <div class="relative h-60 bg-slate-900 overflow-hidden">
                                    @if($vehicle->image)
                                        <img src="{{ $vehicle->image }}" alt="{{ $vehicle->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#18181B]/85 via-transparent to-transparent"></div>
                                    <div class="absolute bottom-4 left-5 right-5">
                                        @if($vehicle->capacity)
                                            <span class="inline-block mb-2 badge-altesa-dark">
                                                {{ $vehicle->capacity }}
                                            </span>
                                        @endif
                                        <h3 class="font-display text-2xl font-bold text-white">{{ $vehicle->name }}</h3>
                                    </div>
                                </div>
                                <div class="p-6 flex-1 flex flex-col gap-4">
                                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">{{ $vehicle->description }}</p>
                                    @if($vehicle->features)
                                        <ul class="flex flex-wrap gap-2">
                                            @foreach($vehicle->features as $feature)
                                                <li class="px-3 py-1 rounded-full bg-[#FCFAF7] border border-[#F5F0E8] text-[11px] font-semibold text-slate-600">{{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>

                            <div class="p-6 pt-0 mt-auto">
                                <div class="pt-4 border-t border-[#F5F0E8]">
                                    @if($vehicle->price_label)
                                        <p class="font-display font-extrabold text-xl text-aw-gold-700 mb-4">{{ $vehicle->price_label }}</p>
                                    @endif
                                    <a href="{{ route('quotation.create', ['transport' => $vehicle->name]) }}" 
                                       class="w-full btn-altesa-dark !py-3 !text-xs text-center block">
                                        Ajukan Quotation
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="rounded-3xl bg-white p-12 text-center text-slate-500 border border-[#F5F0E8]">Informasi armada akan segera diperbarui.</p>
            @endif
        </div>

        @if($bodyTypes->isNotEmpty())
            <div class="card-altesa p-8 sm:p-12">
                <div class="text-center mb-10 space-y-2">
                    <span class="badge-altesa-peach">Tipe Bodi</span>
                    <h2 class="font-display font-bold text-2xl sm:text-3xl text-aw-navy">Pilihan Kategori Armada</h2>
                    <p class="text-xs sm:text-sm text-slate-500">Informasi tipe kendaraan yang tersedia dalam jaringan operasional resmi kami.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-2xl mx-auto">
                    @foreach($bodyTypes as $type)
                        <article class="bg-[#FCFAF7] border border-[#F5F0E8] rounded-3xl p-6 text-center space-y-3">
                            @if($type->image)
                                <img src="{{ $type->image }}" alt="{{ $type->name }}" class="w-full h-40 object-cover rounded-2xl shadow-sm">
                            @else
                                <div class="text-4xl py-2">🚌</div>
                            @endif
                            <h3 class="font-display font-bold text-lg text-aw-navy">{{ $type->name }}</h3>
                            @if($type->unit_count !== null)
                                <span class="badge-altesa-peach font-bold text-xs">{{ $type->unit_count }} unit</span>
                            @endif
                            @if($type->description)
                                <p class="text-xs text-slate-500 leading-relaxed">{{ $type->description }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="bg-[#18181B] text-white rounded-3xl p-8 sm:p-14 text-center space-y-6 relative overflow-hidden border border-white/10 shadow-2xl">
            <div class="absolute -top-16 left-1/2 -translate-x-1/2 w-80 h-80 bg-aw-gold/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                <span class="badge-altesa-dark">Konsultasi Rombongan</span>
                <h2 class="font-display text-2xl sm:text-4xl font-extrabold text-white">Belum yakin armada yang sesuai?</h2>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">Ceritakan kebutuhan dan jumlah peserta perjalanan rombongan Anda. Tim konsultan kami akan membantu merekomendasikan pilihan armada terbaik.</p>
                <div class="pt-2">
                    <a href="{{ route('quotation.create') }}" class="btn-altesa-primary !py-3.5 !px-8 text-sm">
                        Mulai Hitung Quotation
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
