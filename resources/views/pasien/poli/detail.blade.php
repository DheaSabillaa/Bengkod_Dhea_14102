@extends('layout.app')

@section('title', 'Detail Poli')

@section('nav-item')
    @include('pasien.components.nav_item')
@endsection

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4">Detail Poli</h4>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Detail Poli
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                        <p class="form-control-static">{{ $pendaftaran->jadwalPeriksa->hari ?? '-' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Mulai</label>
                        <p class="form-control-static">{{ $pendaftaran->jadwalPeriksa->jam_mulai ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Selesai</label>
                        <p class="form-control-static">{{ $pendaftaran->jadwalPeriksa->jam_selesai ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Antrian</label>
                        <p class="form-control-static badge bg-success">{{ $pendaftaran->no_antrian ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('pasien.poli.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection
