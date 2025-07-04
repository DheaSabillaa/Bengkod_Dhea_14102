@extends('layout.app')

@section('title', $pendaftaran->periksa ? 'Edit Hasil Pemeriksaan' : 'Tambah Hasil Pemeriksaan')

@section('nav-item')
    @include('dokter.components.nav_item')
@endsection

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">{{ $pendaftaran->periksa ? 'Edit Hasil Pemeriksaan Pasien' : 'Tambah Hasil Pemeriksaan Pasien' }}</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ $pendaftaran->periksa
        ? route('dokter.memeriksa.update', $pendaftaran->id)
        : route('dokter.memeriksa.store', $pendaftaran->id) }}"
        method="POST">

        @csrf
        @if ($pendaftaran->periksa)
            @method('PUT')
        @endif

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $pendaftaran->pasien->nama ?? 'Pasien Tidak Diketahui' }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="tgl_periksa" class="form-label">Tanggal dan Jam Pemeriksaan</label>
                    <input type="datetime-local" class="form-control" id="tgl_periksa" name="tgl_periksa"
                        value="{{ old('tgl_periksa', $pendaftaran->periksa ? \Carbon\Carbon::parse($pendaftaran->periksa->tgl_periksa)->format('Y-m-d\TH:i') : '2025-07-04T08:00') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3" required>{{ old('catatan', $pendaftaran->periksa->catatan ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="biaya_periksa" class="form-label">Biaya Pemeriksaan Total</label>
                    <input type="number" class="form-control" id="biaya_periksa" name="biaya_periksa"
                        value="{{ old('biaya_periksa', $pendaftaran->periksa ? $pendaftaran->periksa->biaya_periksa : 150000) }}"
                        required readonly>
                    <small id="biayaInfo" class="text-muted">Default: 150.000 + Harga Obat yang Dipilih</small>
                </div>

                <div class="mb-3">
                    <label for="obat" class="form-label">Daftar Obat</label>
                    <select class="form-control" id="obat" name="obat[]" multiple>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}"
                                data-harga="{{ $obat->harga ?? 0 }}"
                                @if ($pendaftaran->periksa && $pendaftaran->periksa->obats && $pendaftaran->periksa->obats->pluck('id')->contains($obat->id)) selected @endif>
                                {{ $obat->nama_obat }} (Rp {{ number_format($obat->harga ?? 0, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('dokter.memeriksa.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
</div>

<style>
    #obat option:checked {
        color: blue;
        font-weight: bold;
        background-color: #dff0ff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const biayaField = document.getElementById('biaya_periksa');
        const obatSelect = document.getElementById('obat');
        const jasaDokter = 150000;

        let currentBiaya = parseInt(biayaField.value) || jasaDokter;

        function updateBiaya() {
            let totalHargaObat = 0;

            for (let option of obatSelect.options) {
                if (option.selected) {
                    const harga = parseInt(option.getAttribute('data-harga')) || 0;
                    if (!isNaN(harga)) {
                        totalHargaObat += harga;
                    }
                }
            }

            const newBiaya = jasaDokter + totalHargaObat;
            biayaField.value = newBiaya;
        }

        obatSelect.addEventListener('change', updateBiaya);
    });
</script>

@endsection
