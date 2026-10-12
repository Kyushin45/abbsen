
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Relawan - RFID Attendance</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        body {
            background: #f4f7fc;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .edit-card {
            max-width: 680px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 16px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, .04);
        }

        .icon-box {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 12px;
            font-size: 24px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
        }

        .form-control, .form-select {
            padding: 12px;
            border-radius: 9px;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            border-color: #2563eb;
        }

        @media (max-width: 576px) {
            .edit-card {
                margin: 15px;
                padding: 22px 17px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="edit-card">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="icon-box">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-1">Edit Data Relawan</h4>
                <p class="text-secondary small mb-0">
                    Perbarui identitas dan UID kartu RFID.
                </p>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('relawan.update', $relawan->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap Relawan</label>
                <input type="text"
                       name="nama"
                       id="nama"
                       class="form-control"
                       value="{{ old('nama', $relawan->nama) }}"
                       maxlength="255"
                       required>
            </div>

            <div class="mb-3">
                <label for="tim" class="form-label">Tim Relawan</label>
                <select name="tim" id="tim" class="form-select" required>
                    <option value="">Pilih tim</option>

                    @foreach([
                        'Team Keamanan',
                        'Tim Kebersihan',
                        'Tim Persiapan',
                        'Tim Pengolahan',
                        'Tim Pemorsian',
                        'Tim Driver',
                        'Tim Cuci Ompreng'
                    ] as $tim)
                        <option value="{{ $tim }}"
                            {{ old('tim', $relawan->tim) === $tim ? 'selected' : '' }}>
                            {{ $tim }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="rfid_uid" class="form-label">UID Kartu RFID</label>
                <input type="text"
                       name="rfid_uid"
                       id="rfid_uid"
                       class="form-control"
                       value="{{ old('rfid_uid', $relawan->rfid_uid) }}"
                       maxlength="100"
                       autocomplete="off"
                       required>

                <div class="form-text">
                    UID boleh tetap sama jika kartu tidak diganti.
                    UID tidak boleh sama dengan milik relawan lain.
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-end gap-2">
                <a href="{{ route('dashboard') }}"
                   class="btn btn-light border px-4">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-circle me-1"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
