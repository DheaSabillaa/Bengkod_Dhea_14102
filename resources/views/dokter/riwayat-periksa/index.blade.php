@extends('layout.app')

@section('title', 'Riwayat Pasien')

@section('nav-item')
    @include('dokter.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Riwayat Pasien</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Alamat</th>
                    <th>No. KTP</th>
                    <th>No. Telepon</th>
                    <th>No. RM</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pasiens as $index => $pasien)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pasien->nama }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        <td>{{ $pasien->no_ktp }}</td>
                        <td>{{ $pasien->no_hp }}</td>
                        <td>{{ $pasien->no_rm }}</td>
                        <td>
                            <a href="{{ route('dokter.riwayat-periksa.detail', $pasien->id) }}" class="btn btn-info btn-sm">
                                Detail Riwayat Periksa
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data pasien.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
