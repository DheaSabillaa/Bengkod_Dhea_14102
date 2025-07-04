@extends('layout.app')

@section('title', 'Mengelola Poli')

@section('nav-item')
@include('admin.components.nav_item')
@endsection

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4">Mengelola Poli</h4>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    {{-- Form Tambah/Edit Poli --}}
    <form action="{{ route('admin.poli.store') }}" method="POST" class="card p-3 mt-3">
        @csrf
        <div class="mb-3">
            <label>Nama Poli</label>
            <input type="text" name="nama_poli" class="form-control" value="{{ old('nama_poli') }}" required>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary">Reset</a>
    </form>

    {{-- Tabel Poli --}}
    <div class="card mt-4">
        <div class="card-header">
            <strong>Daftar Poli</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Poli</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($polis as $poli)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $poli->nama_poli }}</td>
                        <td>{{ $poli->keterangan }}</td>
                        <td>
                            <a href="{{ route('admin.poli.edit', $poli->id) }}" class="btn btn-success btn-sm">Edit</a>
                            <form action="{{ route('admin.poli.destroy', $poli->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($polis->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data poli</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
