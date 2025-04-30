@extends('layout.app')

@section('title', 'Obat')

@section('nav-item')
    @include('dokter.components.nav_item')
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Pemeriksaan Pasien</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('dokter.memeriksa.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="patient_name">Nama Pasien</label>
                <input type="text" name="patient_name" id="patient_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="medical_note">Catatan Medis</label>
                <textarea name="medical_note" id="medical_note" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="medicine_cost">Biaya Obat</label>
                <input type="number" name="medicine_cost" id="medicine_cost" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Biaya Statis</label>
                <input type="text" class="form-control" value="150,000" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('dokter.memeriksa.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection