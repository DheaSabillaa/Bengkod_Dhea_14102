@extends('layout.app')

@section('title', 'Obat')

@section('nav-item')
@include('admin.components.nav_item')
@endsection

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4">Obat</h4>

    {{-- Notifikasi sukses --}}
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

    {{-- Form Tambah Obat --}}
    <form action="{{ route('admin.obat.store') }}" method="POST" class="card p-3 mt-3">
        @csrf
        <div class="mb-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat" class="form-control" placeholder="Nama Obat" required>
        </div>
        <div class="mb-3">
            <label>Kemasan</label>
            <input type="text" name="kemasan" class="form-control" placeholder="Kemasan" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" placeholder="Harga" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    {{-- Tabel Obat --}}
    <div class="card mt-4">
        <div class="card-header">
            <strong>Obat</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obats as $obat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->kemasan }}</td>
                        <td>Rp. {{ number_format($obat->harga, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.obat.edit', $obat->id) }}" class="btn btn-success btn-sm">Edit</a>
                            <form action="{{ route('admin.obat.destroy', $obat->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data obat</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
