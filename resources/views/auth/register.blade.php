
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin RFID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f4f8ff;
            color: #172b4d;
            font-family: Arial, sans-serif;
        }

        .register-wrapper {
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(37, 99, 235, .12);
        }

        /* Panel kiri */
        .register-banner {
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg, #1d4ed8, #2563eb, #60a5fa);
            color: white;
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: rgba(255, 255, 255, .18);
            font-size: 25px;
        }

        .banner-content {
            position: relative;
            z-index: 1;
            margin: 40px 0;
        }

        .banner-content h1 {
            font-size: 34px;
            line-height: 1.3;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .banner-content p {
            color: #dbeafe;
            line-height: 1.8;
            font-size: 14px;
        }

        .feature-list {
            margin-top: 28px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            font-size: 13px;
            color: #eff6ff;
        }

        .feature-icon {
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(255, 255, 255, .17);
            font-size: 17px;
        }

        .banner-footer {
            color: #dbeafe;
            font-size: 12px;
        }

        .circle {
            position: absolute;
            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 50%;
            pointer-events: none;
        }

        .circle-one {
            width: 300px;
            height: 300px;
            top: -130px;
            right: -100px;
        }

        .circle-two {
            width: 250px;
            height: 250px;
            bottom: -100px;
            left: -100px;
        }

        /* Panel register */
        .register-form-panel {
            padding: 42px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-heading {
            margin-bottom: 25px;
        }

        .form-heading h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .form-heading p {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 0;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-group {
            border: 1px solid #dbe4f0;
            border-radius: 10px;
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s;
        }

        .input-group:focus-within {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .1);
        }

        .input-group-text {
            background: white;
            color: #64748b;
            border: none;
            padding-left: 14px;
        }

        .form-control {
            border: none;
            padding: 11px 12px;
            font-size: 13px;
            box-shadow: none !important;
        }

        .form-control:focus {
            background: white;
        }

        .toggle-password {
            border: none;
            background: white;
            color: #64748b;
            padding: 0 14px;
        }

        .toggle-password:hover {
            color: #2563eb;
        }

        .btn-register {
            width: 100%;
            padding: 13px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-register:hover {
            background: #1d4ed8;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(37, 99, 235, .2);
        }

        .login-link {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .security-note {
            margin-top: 22px;
            text-align: center;
            color: #94a3b8;
            font-size: 11px;
        }

        .security-note i {
            color: #2563eb;
            margin-right: 4px;
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .register-wrapper {
                grid-template-columns: 1fr;
                max-width: 440px;
                min-height: auto;
                border-radius: 18px;
            }

            .register-banner {
                padding: 25px;
            }

            .banner-content {
                margin: 25px 0 5px;
            }

            .banner-content h1 {
                font-size: 25px;
            }

            .feature-list {
                margin-top: 20px;
            }

            .feature-item {
                margin-bottom: 12px;
            }

            .banner-footer {
                margin-top: 15px;
            }

            .register-form-panel {
                padding: 32px 25px;
            }

            .form-heading h2 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

<div class="register-wrapper">

    <!-- Panel informasi -->
    <section class="register-banner">
        <div class="circle circle-one"></div>
        <div class="circle circle-two"></div>

        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-fingerprint"></i>
            </div>
            <span>RFID ATTENDANCE</span>
        </div>

        <div class="banner-content">
            <h1>Buat Akun<br>Administrator</h1>

            <p>
                Mulai kelola sistem absensi karyawan secara
                digital dengan satu akun administrator.
            </p>

            <div class="feature-list">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <span>Akses panel admin dengan autentikasi</span>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <span>Kelola data dan kehadiran karyawan</span>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <span>Pantau catatan absensi masuk dan keluar</span>
                </div>
            </div>
        </div>

        <div class="banner-footer">
            &copy; {{ date('Y') }} RFID Attendance System
        </div>
    </section>

    <!-- Panel formulir register -->
    <section class="register-form-panel">

        <div class="form-heading">
            <h2>Daftar Admin</h2>
            <p>Lengkapi data berikut untuk membuat akun baru.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success small">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger small">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person"></i>
                    </span>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        autocomplete="name"
                        maxlength="255"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Admin</label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-envelope"></i>
                    </span>

                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="admin@email.com"
                        autocomplete="email"
                        maxlength="255"
                        required>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-lock"></i>
                    </span>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Minimal 8 karakter"
                        autocomplete="new-password"
                        minlength="8"
                        required>

                    <button
                        type="button"
                        class="toggle-password"
                        data-target="password"
                        aria-label="Tampilkan password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">
                    Konfirmasi Password
                </label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-shield-lock"></i>
                    </span>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        minlength="8"
                        required>

                    <button
                        type="button"
                        class="toggle-password"
                        data-target="password_confirmation"
                        aria-label="Tampilkan konfirmasi password">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-person-plus me-2"></i>
                Buat Akun Admin
            </button>
        </form>

        <p class="text-center text-secondary mt-4 mb-0"
           style="font-size: 13px;">
            Sudah memiliki akun?
            <a href="{{ route('login') }}" class="login-link">
                Login sekarang
            </a>
        </p>

        <div class="security-note">
            <i class="bi bi-shield-lock-fill"></i>
            Pendaftaran menggunakan koneksi aman
        </div>

    </section>

</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(function (button) {
        button.addEventListener('click', function () {
            const input = document.getElementById(this.dataset.target);
            const icon = this.querySelector('i');
            const showPassword = input.type === 'password';

            input.type = showPassword ? 'text' : 'password';

            icon.classList.toggle('bi-eye', !showPassword);
            icon.classList.toggle('bi-eye-slash', showPassword);

            this.setAttribute(
                'aria-label',
                showPassword ? 'Sembunyikan password' : 'Tampilkan password'
            );
        });
    });
</script>

</body>
</html>
