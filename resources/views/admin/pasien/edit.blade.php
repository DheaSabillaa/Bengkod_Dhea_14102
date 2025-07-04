@extends('layout.app')

@section('title', 'Edit Pasien')

@section('nav-item')
@include('admin.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <h4>Edit Data Pasien</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $pasien->nama) }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $pasien->alamat) }}" required>
        </div>

        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" class="form-control" name="no_ktp" value="{{ old('no_ktp', $pasien->no_ktp) }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}" required>
        </div>

        <div class="mb-3">
            <label>No RM</label>
            <input type="text" class="form-control" name="no_rm" value="{{ old('no_rm', $pasien->no_rm) }}" readonly>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
