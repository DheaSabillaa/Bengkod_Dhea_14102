@extends('layout.app')

@section('title', 'Edit Obat')

@section('nav-item')
@include('admin.components.nav_item')
@endsection

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4">Edit Obat</h4>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    {{-- Error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger mt-2">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit Obat --}}
    <form action="{{ route('admin.obat.update', $obat->id) }}" method="POST" class="card p-3 mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control" value="{{ old('nama_obat', $obat->nama_obat) }}" required>
        </div>
        <div class="mb-3">
            <label>Kemasan</label>
            <input type="text" name="kemasan" class="form-control" value="{{ old('kemasan', $obat->kemasan) }}" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $obat->harga) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
