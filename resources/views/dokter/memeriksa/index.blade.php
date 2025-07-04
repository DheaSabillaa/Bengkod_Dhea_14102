@extends('layout.app')

@section('title', 'Jadwal Memeriksa')

@section('nav-item')
    @include('dokter.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Daftar Periksa Pasien</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No Urut</th>
                <th>Nama Pasien</th>
                <th>Keluhan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendaftarans as $pendaftaran)
                <tr>
                    <td>{{ $pendaftaran->no_antrian }}</td>
                    <td>{{ $pendaftaran->pasien->nama ?? 'Pasien Tidak Diketahui' }}</td>
                    <td>{{ $pendaftaran->keluhan }}</td>
                    <td>{{ $pendaftaran->status }}</td>
                    <td>
                        @if ($pendaftaran->status === 'Sudah diperiksa')
                            <a href="{{ route('dokter.memeriksa.edit', $pendaftaran->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        @else
                            <a href="{{ route('dokter.memeriksa.edit', $pendaftaran->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-clipboard-check"></i> Periksa
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
