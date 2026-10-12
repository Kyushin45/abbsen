
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - Absensi RFID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
            color: #243247;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #e5eaf1;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 18px;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
            color: #1769e0;
            margin-bottom: 35px;
        }

        .menu {
            display: block;
            padding: 13px 15px;
            margin-bottom: 8px;
            color: #64748b;
            text-decoration: none;
            border-radius: 10px;
        }

        .menu:hover,
        .menu.active {
            background: #eaf2ff;
            color: #1769e0;
        }

        .main {
            margin-left: 250px;
            padding: 35px;
        }

        .profile-card {
            background: white;
            border: 0;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(20, 50, 90, .05);
        }

        .avatar {
            width: 65px;
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #eaf2ff;
            color: #1769e0;
            font-size: 28px;
        }

        .form-control {
            padding: 12px;
            border-radius: 9px;
        }

        .btn-primary {
            background: #1769e0;
            border-color: #1769e0;
            border-radius: 9px;
            padding: 11px 18px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                border-right: 0;
                border-bottom: 1px solid #e5eaf1;
            }

            .brand {
                margin-bottom: 15px;
            }

            .main {
                margin-left: 0;
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="brand">
        <i class="bi bi-fingerprint me-2"></i> Absensi RFID
    </div>

    <a href="{{ route('dashboard') }}" class="menu">
        <i class="bi bi-grid me-2"></i> Dashboard
    </a>

    <a href="{{ route('dashboard') }}#data-relawan" class="menu">
        <i class="bi bi-people me-2"></i> Data Relawan
    </a>

    <a href="{{ route('dashboard') }}#tambah-relawan" class="menu">
        <i class="bi bi-person-plus me-2"></i> Tambah Relawan
    </a>

    <a href="{{ route('profil-admin') }}" class="menu active">
        <i class="bi bi-person-circle me-2"></i> Profil Admin
    </a>

    <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="menu border-0 bg-transparent w-100 text-start">
            <i class="bi bi-box-arrow-right me-2"></i> Keluar
        </button>
    </form>
</aside>

<main class="main">
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Profil Admin</h3>
        <p class="text-muted">Kelola informasi akun dan keamanan password Anda.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card profile-card mb-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-1">
                        {{ auth()->user()->name }}
                    </h5>
                    <div class="text-muted">
                        {{ auth()->user()->email }}
                    </div>
                    <span class="badge text-bg-primary mt-2">Administrator</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card profile-card">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-1">
                <i class="bi bi-shield-lock text-primary me-2"></i>
                Ganti Password
            </h5>

            <p class="text-muted mb-4">
                Masukkan password lama dan tentukan password baru Anda.
            </p>

            <form action="{{ route('profil-admin.password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">
                        Password Lama
                    </label>
                    <input type="password"
                           name="current_password"
                           id="current_password"
                           class="form-control"
                           autocomplete="current-password"
                           required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password Baru
                    </label>
                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           minlength="8"
                           autocomplete="new-password"
                           required>
                    <small class="text-muted">Minimal 8 karakter.</small>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           class="form-control"
                           minlength="8"
                           autocomplete="new-password"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check2-circle me-1"></i>
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</main>

</body>
</html>
