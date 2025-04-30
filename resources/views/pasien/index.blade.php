@extends('layout.app')

@section('title', 'Dashboard Pasien')

@section('nav-item')
@include('pasien.components.nav_item')
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dashboard Pasien</h3>
    </div>
    <div class="card-body">
        <p>Selamat datang, {{ auth()->user()->name }}!</p>
        <p>Silakan gunakan menu "Periksa" untuk membuat janji pemeriksaan dengan dokter.</p>
    </div>
</div>
@endsection