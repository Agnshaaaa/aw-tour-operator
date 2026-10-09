@extends('layouts.app')

@section('title', 'Pilihan Transportasi — AW Tour Operator')
@section('meta_description', 'Pilihan armada transportasi untuk perjalanan rombongan AW Tour Operator.')

@section('content')
<section class="bg-aw-navy text-white py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
        <span class="inline-block px-4 py-1.5 rounded-full bg-aw-gold/20 text-aw-gold text-xs font-semibold uppercase tracking-wider border border-aw-gold/30">Armada Perjalanan</span>
        <h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-bold">Pilihan Transportasi</h1>
        <p class="max-w-2xl mx-auto text-slate-300">Informasi armada dan tipe kendaraan untuk membantu menyesuaikan perjalanan rombongan Anda.</p>
    </div>
</section>

<section class="py-12 bg-aw-cream/40 min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 text-sm text-amber-900">
            <strong class="block mb-1">Informasi harga</strong>
            Harga merupakan estimasi dan dapat berubah sesuai tanggal, rute, durasi, kebutuhan perjalanan, dan ketersediaan armada.
        </div>

        <div>
            <div class="mb-7">
                <p class="text-xs font-bold uppercase tracking-widest text-aw-gold">Armada perjalanan</p>
                <h2 class="font-display text-2xl sm:text-3xl font-bold text-aw-navy">Kendaraan Rombongan</h2>
            </div>
            @if($vehicles->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                    @foreach($vehicles as $vehicle)
                        <article class="bg-white rounded-3xl overflow-hidden shadow-lg border border-slate-200 flex flex-col">
                            <div class="relative h-56 bg-gradient-to-br from-slate-900 to-aw-navy">
                                @if($vehicle->image)
                                    <img src="{{ $vehicle->image }}" alt="{{ $vehicle->name }}" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-950/20 to-transparent"></div>
                                <div class="absolute bottom-4 left-5 right-5">
                                    @if($vehicle->capacity)<span class="inline-block mb-2 px-3 py-1 rounded-full bg-aw-gold text-white text-xs font-bold">{{ $vehicle->capacity }}</span>@endif
                                    <h3 class="font-display text-2xl font-bold text-white">{{ $vehicle->name }}</h3>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col gap-4">
                                <p class="text-sm text-slate-600 leading-relaxed">{{ $vehicle->description }}</p>
                                @if($vehicle->features)
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach($vehicle->features as $feature)
                                            <li class="px-2.5 py-1 rounded-lg bg-slate-100 text-xs text-slate-600">{{ $feature }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="mt-auto pt-4 border-t border-slate-100">
                                    @if($vehicle->price_label)<p class="font-display font-bold text-lg text-aw-gold mb-4">{{ $vehicle->price_label }}</p>@endif
                                    <a href="{{ route('quotation.create', ['transport' => $vehicle->name]) }}" class="block text-center bg-aw-navy hover:bg-aw-gold text-white font-bold text-sm py-3 px-4 rounded-xl transition-colors">Ajukan Quotation</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="rounded-2xl bg-white p-8 text-center text-slate-500">Informasi armada akan segera diperbarui.</p>
            @endif
        </div>

        @if($bodyTypes->isNotEmpty())
            <div class="bg-white rounded-3xl p-7 sm:p-10 border border-slate-200 shadow-lg">
                <div class="text-center mb-8">
                    <p class="text-xs font-bold uppercase tracking-widest text-aw-gold">Tipe bodi</p>
                    <h2 class="font-display font-bold text-2xl text-aw-navy">Pilihan Armada</h2>
                    <p class="text-sm text-slate-500 mt-2">Informasi tipe kendaraan yang tersedia dalam jaringan operasional.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 max-w-2xl mx-auto">
                    @foreach($bodyTypes as $type)
                        <article class="bg-aw-cream/40 border border-slate-200 rounded-2xl p-6 text-center space-y-2">
                            @if($type->image)<img src="{{ $type->image }}" alt="{{ $type->name }}" class="w-full h-36 object-cover rounded-xl">@else<div class="text-3xl">🚌</div>@endif
                            <h3 class="font-display font-bold text-lg text-aw-navy">{{ $type->name }}</h3>
                            @if($type->unit_count !== null)<span class="inline-block px-3 py-1 rounded-full bg-aw-gold/20 text-aw-gold text-xs font-extrabold">{{ $type->unit_count }} unit</span>@endif
                            @if($type->description)<p class="text-xs text-slate-500">{{ $type->description }}</p>@endif
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="bg-aw-navy text-white rounded-3xl p-8 sm:p-12 text-center space-y-5">
            <h2 class="font-display text-2xl sm:text-3xl font-bold">Belum yakin armada yang sesuai?</h2>
            <p class="max-w-2xl mx-auto text-slate-300">Ceritakan kebutuhan perjalanan rombongan Anda. Tim AW Tour akan membantu menyiapkan pilihan yang sesuai.</p>
            <a href="{{ route('quotation.create') }}" class="inline-flex px-7 py-3 rounded-full bg-aw-gold hover:bg-amber-600 text-white font-bold">Mulai Quotation</a>
        </div>
    </div>
</section>
@endsection
