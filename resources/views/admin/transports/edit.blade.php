@extends('layouts.admin')
@section('title', 'Edit ' . $offering->name . ' — Admin AW Tour')
@section('page_title', 'Edit Informasi Armada')
@section('content')
<div class="mx-auto max-w-4xl rounded-3xl border border-slate-800 bg-aw-navy/90 p-6 sm:p-8 shadow-xl">
    <p class="mb-6 text-sm text-slate-400">Perbarui informasi <strong class="text-white">{{ $offering->name }}</strong> yang tampil pada website.</p>
    <form action="{{ route('admin.transports.update', $offering->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @include('admin.transports._form')
    </form>
</div>
@endsection
