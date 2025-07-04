<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Periksa</title>
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
        <h3 class="mb-4 text-center">Edit Jadwal Periksa</h3>

        <div class="card p-4">
            <form action="{{ route('dokter.jadwal-periksa.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="hari" class="form-label">Hari</label>
                    <select name="hari" id="hari" class="form-select" required>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                            <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
                </div>

                <div class="mb-3">
                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Aktif" {{ $jadwal->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ $jadwal->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Update</button>
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
