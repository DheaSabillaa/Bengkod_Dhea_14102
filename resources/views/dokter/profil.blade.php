@extends('layout.app')

@section('title', 'Profil Dokter')

@section('nav-item')
    @include('dokter.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Edit Data Dokter</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('dokter.profil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Dokter</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Dokter</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $user->alamat) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Telepon Dokter</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
