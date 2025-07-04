@extends('layout.app')

@section('title', 'Riwayat Periksa')

@section('nav-item')
    @include('pasien.components.nav_item')
@endsection

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4">Riwayat Periksa</h4>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Riwayat Periksa
        </div>
        <div class="card-body">

            {{-- Tambahkan Tanggal Periksa --}}
            <div class="mb-3">
                <strong>Tgl Periksa:</strong>
                <span>{{ $pendaftaran->created_at->format('Y-m-d H:i:s') }}</span>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nama Poli</label>
                         <p class="form-control-static">{{ $pendaftaran->poli->nama_poli ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Dokter</label>
                         <p class="form-control-static">{{ $pendaftaran->jadwalPeriksa->dokter->nama ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hari</label>
                        <p class="form-control-static">{{ $pendaftaran->periksa->tgl_periksa ?? '-' }}</p>
                    </div>
                            <div class="mb-3">
                        <label class="form-label">Nomor Antrian</label>
                        <p class="form-control-static badge bg-success">{{ $pendaftaran->no_antrian ?? '-' }}</p>
                </div>


            <div class="mt-4">
                <label class="form-label">Catatan</label>
                <p class="form-control-static">{{ $pendaftaran->periksa->catatan ?? 'Tidak ada catatan' }}</p>
            </div>

            <div class="mt-4">
                <label class="form-label">Daftar Obat</label>
                <p class="form-control-static">{{ $pendaftaran->periksa->daftar_obat ?? 'Tidak ada catatan' }}</p>
            </div>

              {{-- Tambahkan Biaya Periksa --}}
            <div class="mt-4">
                <div class="alert alert-danger fw-bold">
                    Biaya Periksa: {{ number_format($pendaftaran->periksa->biaya_periksa ?? 0, 0, ',', '.') }}
                </div>
            </div>

            <a href="{{ route('pasien.poli.index') }}" class="btn btn-primary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
