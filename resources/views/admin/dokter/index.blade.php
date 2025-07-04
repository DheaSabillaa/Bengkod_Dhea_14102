@extends('layout.app')

@section('title', 'Data Dokter')

@section('nav-item')
    @include('admin.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <h4>{{ isset($dokterEdit) ? 'Edit Dokter' : 'Tambah Dokter' }}</h4>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan saat menyimpan data:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ isset($dokterEdit) ? route('admin.dokter.update', $dokterEdit->id) : route('admin.dokter.store') }}"
        method="POST">
        @csrf
        @if(isset($dokterEdit))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Nama Dokter</label>
            <input type="text" class="form-control" name="nama"
                value="{{ old('nama', $dokterEdit->nama ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat"
                value="{{ old('alamat', $dokterEdit->alamat ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" class="form-control" name="no_hp"
                value="{{ old('no_hp', $dokterEdit->no_hp ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>No Ktp</label>
            <input type="text" class="form-control" name="no_ktp"
                value="{{ old('no_ktp', $dokterEdit->no_ktp ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Poli</label>
                   <select name="poli" class="form-control" required>
    <option value="">-- Pilih Poli --</option>
    @foreach($poli as $p)
        <option value="{{ $p->nama_poli }}" {{ old('poli', $dokterEdit->poli ?? '') == $p->nama_poli ? 'selected' : '' }}>
            {{ $p->nama_poli }}
        </option>
    @endforeach
</select>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="text" class="form-control" name="email"
                value="{{ old('email', $dokterEdit->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="text" class="form-control" name="password"
                value="{{ old('password', $dokterEdit->password ?? '') }}" required>
        </div>

        <button class="btn btn-primary">{{ isset($dokterEdit) ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    <hr>

    <h4>Data Dokter</h4>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Poli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokters as $dokter)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dokter->nama }}</td>
                <td>{{ $dokter->alamat }}</td>
                <td>{{ $dokter->no_hp }}</td>
                <td>{{ $dokter->poli}}</td>
                <td>
                    <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-success btn-sm">Ubah</a>
                    <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus dokter ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
