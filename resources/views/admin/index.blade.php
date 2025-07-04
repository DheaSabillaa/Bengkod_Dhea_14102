@extends('layout.app')

@section('title', 'Dashboard Pasien')

@section('nav-item')
@include('admin.components.nav_item')
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dashboard Admin</h3>
    </div>
    <div class="card-body">
        <p>Selamat datang Admin!</p>

    </div>
</div>
@endsection
