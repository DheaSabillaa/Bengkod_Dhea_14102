@extends('layout.app')

@section('title', 'Detail Riwayat Pasien')

@section('nav-item')
    @include('dokter.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Detail Riwayat Periksa Pasien</h3>

    {{-- Data Pasien --}}
    <div class="mb-3">
        <strong>Nama Pasien:</strong> {{ $pasien->nama }}<br>
        <strong>No. RM:</strong> {{ $pasien->no_rm }}
    </div>

    {{-- Riwayat Pemeriksaan --}}
    <div class="card">
        <div class="card-header bg-light fw-bold">
            Riwayat Pemeriksaan oleh Dokter
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light text-center">
                    <tr>
                        <th>Tanggal Periksa</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftarans as $riwayat)
                        <tr>
                            <td class="text-center">
                                {{ $riwayat->periksa->tgl_periksa ?? '-' }}
                            </td>
                            <td>{{ $riwayat->poli->nama_poli ?? '-' }}</td>
                            <td>{{ $riwayat->jadwalPeriksa->dokter->nama ?? '-' }}</td>
                            <td>{{ $riwayat->periksa->catatan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada riwayat pemeriksaan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tombol kembali --}}
    <div class="mt-3">
        <a href="{{ route('dokter.riwayat-periksa.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>
@endsection
