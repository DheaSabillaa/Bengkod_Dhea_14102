@extends('layout.app')

@section('title', 'Daftar Poli')

@section('nav-item')
    @include('pasien.components.nav_item')
@endsection

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4">Daftar Poli</h4>
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
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary text-white">Daftar Poli</div>
                <div class="card-body">
                    <form action="{{ route('pasien.poli.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Nomor Rekam Medis</label>
                            <input type="text" class="form-control" value="{{ $no_rm }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Pilih Poli</label>
                            <select name="id_poli" class="form-control" required>
                                <option value="">Pilih Poli</option>
                                @foreach($poli as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Pilih Jadwal</label>
                            <select name="id_jadwal_periksa" class="form-control" required>
                                <option value="">Pilih Jadwal</option>
                                @foreach($jadwal as $j)
                                    <option value="{{ $j->id }}">{{ $j->hari }} - {{ $j->dokter->nama }} ({{ $j->jam_mulai }} - {{ $j->jam_selesai }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Keluhan</label>
                            <textarea name="keluhan" class="form-control" required></textarea>
                        </div>
                        <input type="hidden" name="status" value="Belum diperiksa">
                        <button class="btn btn-primary">Daftar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-white">Riwayat Daftar Poli</div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped m-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Poli</th>
                                <th>Dokter</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Antrian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendaftarans as $index => $data)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $data->poli->nama_poli ?? '-' }}</td>
                                    <td>{{ $data->jadwalPeriksa->dokter->nama ?? '-' }}</td>
                                    <td>{{ $data->jadwalPeriksa->hari ?? '-' }}</td>
                                    <td>{{ $data->jadwalPeriksa->jam_mulai ?? '-' }}</td>
                                    <td>{{ $data->jadwalPeriksa->jam_selesai ?? '-' }}</td>
                                    <td>{{ $data->no_antrian }}</td>
                                    <td>
                                        <span class="badge bg-{{ $data->status == 'Belum diperiksa' ? 'danger' : 'success' }}">
                                            {{ $data->status }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($data->status == 'Belum diperiksa')
                                            <a href="{{ route('pasien.poli.detail', $data->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        @elseif($data->status == 'Sudah diperiksa')
                                            <a href="{{ route('pasien.poli.riwayat', $data->id) }}" class="btn btn-success btn-sm">Riwayat</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

