@extends('layout.app')

@section('title', 'Edit Dokter')

@section('nav-item')
@include('admin.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <h4>Edit Dokter</h4>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pesan error validasi --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan saat menyimpan data:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Dokter</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $dokter->nama) }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $dokter->alamat) }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $dokter->no_hp) }}" required>
        </div>

        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" class="form-control" name="no_ktp" value="{{ old('no_ktp', $dokter->no_ktp) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $dokter->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Password (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" class="form-control" name="password">
        </div>

        <div class="mb-3">
            <label>Poli</label>
            <select name="id_poli" class="form-control" required>
                <option value="">-- Pilih Poli --</option>
                @foreach($poli as $p)
                    <option value="{{ $p->id }}" {{ old('id_poli', $dokter->id_poli) == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_poli }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
