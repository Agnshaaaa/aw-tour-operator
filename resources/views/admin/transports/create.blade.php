@extends('layouts.admin')
@section('title', 'Tambah Armada — Admin AW Tour')
@section('page_title', 'Tambah Armada / Informasi Transportasi')
@section('content')
<div class="mx-auto max-w-4xl rounded-3xl border border-white/[0.07] bg-[#0B0B0E]/90 p-6 sm:p-8 shadow-xl">
    <p class="mb-6 text-sm text-zinc-400">Informasi yang disimpan di sini akan tampil pada katalog transportasi publik.</p>
    <form action="{{ route('admin.transports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @include('admin.transports._form')
    </form>
</div>
@endsection
