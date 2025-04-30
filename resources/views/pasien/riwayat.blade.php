@extends('layout.app')

@section('title', 'Dashboard Pasien')

@section('nav-item')
@include('pasien.components.nav_item')
@endsection


@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Janji Pemeriksaan</h3>
    </div>
    <div class="card-body">
        @if(!isset($records) || $records->isEmpty())
            <p>Belum ada janji pemeriksaan yang dibuat.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Tanggal Janji</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record->patient_name }}</td>
                            <td>{{ $record->medical_note }}</td>
                            <td>{{ $record->appointment_date ? $record->appointment_date : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ route('pasien.periksa') }}" class="btn btn-primary mt-3">Buat Janji Baru</a>
    </div>
</div>
@endsection