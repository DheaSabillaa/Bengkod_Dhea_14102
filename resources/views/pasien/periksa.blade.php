@extends('layout.app')

@section('title', 'Dashboard Pasien')

@section('nav-item')
@include('pasien.components.nav_item')
@endsection


@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Periksa</h3>
    </div>
    <div class="card-body">
        <p>Sebagai seorang pasien, saya ingin membuat janji pemeriksaan dengan dokter, agar saya dapat mendapatkan diagnosis dan pengobatan.</p>
        @if(!auth()->check())
            <div class="alert alert-danger">
                Anda harus login terlebih dahulu untuk membuat janji pemeriksaan.
            </div>
        @else
            <form action="{{ route('pasien.periksa.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="patient_name">Nama Pasien</label>
                    <input type="text" name="patient_name" id="patient_name" class="form-control" placeholder="Masukkan Nama Anda.." required>
                    @error('patient_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="medical_note">Keluhan</label>
                    <textarea name="medical_note" id="medical_note" class="form-control" required placeholder="Masukkan keluhan Anda..."></textarea>
                    @error('medical_note')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="appointment_date">Tanggal Janji</label>
                    <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
                    @error('appointment_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Buat Janji</button>
            </form>
        @endif
    </div>
</div>
@endsection