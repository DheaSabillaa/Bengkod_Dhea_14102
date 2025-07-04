@extends('layout.app')

@section('title', 'Edit Poli')

@section('nav-item')
@include('admin.components.nav_item')
@endsection

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4">Edit Poli</h4>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mt-2">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.poli.update', $poli->id) }}" method="POST" class="card p-3 mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Poli</label>
        <input type="text" name="nama_poli" class="form-control"
               value="{{ old('nama_poli', $poli->nama_poli) }}" required>
    </div>

    <div class="mb-3">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control"
               value="{{ old('keterangan', $poli->keterangan) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.poli.index') }}" class="btn btn-secondary">Kembali</a>
</form>

</div>
@endsection
