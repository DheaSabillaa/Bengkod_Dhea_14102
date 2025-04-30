@extends('layout.app')

@section('title', 'Obat')

@section('nav-item')
    @include('dokter.components.nav_item')
@endsection


@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pemeriksaan Pasien</h3>
        <div class="card-tools">
            <a href="{{ route('dokter.tambah.pemeriksaan') }}" class="btn btn-primary">Tambah Pemeriksaan</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Pasien</th>
                    <th>Catatan Medis</th>
                    <th>Biaya Obat</th>
                    <th>Total Biaya</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->patient_name }}</td>
                        <td>{{ $record->medical_note }}</td>
                        <td>{{ number_format($record->medicine_cost, 0, ',', '.') }}</td>
                        <td>{{ number_format($record->total_cost, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection