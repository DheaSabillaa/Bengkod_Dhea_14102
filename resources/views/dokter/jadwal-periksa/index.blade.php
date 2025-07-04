@extends('layout.app')

@section('title', 'Jadwal Periksa')

@section('nav-item')
    @include('dokter.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">

    <h3 class="mb-4 text-center">Daftar Jadwal Periksa</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('dokter.jadwal-periksa.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jadwal
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Status</th>
                    <th style="width: 160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwalPeriksas as $index => $jadwal)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ auth()->user()->nama }}</td>
                    <td>{{ $jadwal->hari }}</td>
                    <td>{{ $jadwal->jam_mulai }}</td>
                    <td>{{ $jadwal->jam_selesai }}</td>
                    <td>
                        <form action="{{ route('dokter.jadwal-periksa.toggleStatus', $jadwal->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm {{ $jadwal->status == 'Aktif' ? 'btn-success' : 'btn-secondary' }}">
                                {{ $jadwal->status }}
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('dokter.jadwal-periksa.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('dokter.jadwal-periksa.destroy', $jadwal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if($jadwalPeriksas->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Belum ada data jadwal.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
