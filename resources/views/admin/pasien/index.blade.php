@extends('layout.app')

@section('title', 'Data Pasien')

@section('nav-item')
    @include('admin.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <h4>{{ isset($pasienEdit) ? 'Edit' : 'Tambah' }} Pasien</h4>

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

    <form action="{{ isset($pasienEdit) ? route('admin.pasien.update', $pasienEdit->id) : route('admin.pasien.store') }}" method="POST">
        @csrf
        @if(isset($pasienEdit))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama', $pasienEdit->nama ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $pasienEdit->alamat ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" class="form-control" name="no_ktp" value="{{ old('no_ktp', $pasienEdit->no_ktp ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $pasienEdit->no_hp ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>No RM</label>
            <input type="text" class="form-control" name="no_rm"
                value="{{ old('no_rm', $pasienEdit->no_rm ?? '-') }}"
                readonly>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="{{ old('email', $pasienEdit->email ?? '') }}" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="text" class="form-control" name="password" value="{{ old('password', $pasienEdit->password?? '') }}" required>
        </div>
        <button class="btn btn-primary">{{ isset($pasienEdit) ? 'Update' : 'Simpan' }}</button>
        <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    <hr>

    <h4>Data Pasien</h4>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No KTP</th>
                <th>No HP</th>
                <th>No RM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pasiens as $pasien)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pasien->nama }}</td>
                <td>{{ $pasien->alamat }}</td>
                <td>{{ $pasien->no_ktp }}</td>
                <td>{{ $pasien->no_hp }}</td>
                <td>{{ $pasien->no_rm ?? ($pasien->janjiPeriksas->first()->no_rm ?? '-') }}</td>
                <td>
                    <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="btn btn-success btn-sm">Ubah</a>
                    <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus pasien ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
