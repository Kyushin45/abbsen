<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Absensi Relawan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5" style="max-width:700px">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h4 class="mb-1">Edit Absensi Relawan</h4>
            <p class="text-secondary mb-4">
                {{ $absensi->relawan->nama ?? 'Relawan' }}
                — {{ $absensi->relawan->tim ?? '-' }}
            </p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('absensi.update', $absensi->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tanggal dan Jam Masuk</label>
                    <input type="datetime-local"
                           name="tanggal_masuk"
                           class="form-control"
                           value="{{ old('tanggal_masuk', $absensi->tanggal_masuk?->format('Y-m-d\TH:i')) }}"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Tanggal dan Jam Keluar</label>
                    <input type="datetime-local"
                           name="tanggal_keluar"
                           class="form-control"
                           value="{{ old('tanggal_keluar', $absensi->tanggal_keluar?->format('Y-m-d\TH:i')) }}">

                    <div class="form-text">
                        Kosongkan jika relawan masih bekerja. Untuk shift malam,
                        pilih tanggal keluar pada hari berikutnya.
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('dashboard') }}"
                       class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>