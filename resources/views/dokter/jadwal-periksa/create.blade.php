<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Periksa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f8fe;
            padding: 2rem;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="mb-4 text-center">Tambah Jadwal Periksa</h3>

        <div class="card p-4">
            <form action="{{ route('dokter.jadwal-periksa.store') }}" method="POST">
                @csrf
                {{-- <div class="mb-3">
                    <label for="dokter_id" class="form-label">Nama Dokter</label>
                    <select name="dokter_id" id="dokter_id" class="form-select" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <select name="hari" id="hari" class="form-select" required>
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                            <option value="{{ $hari }}">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('dokter.jadwal-periksa.index') }}" class="btn btn-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Jadwal
            </a>
        </div>
    </div>
</body>
</html>
