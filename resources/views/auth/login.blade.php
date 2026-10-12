
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin RFID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f8ff;
            color: #172b4d;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1000px;
            min-height: 570px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(37, 99, 235, 0.12);
        }

        /* Panel kiri */
        .login-banner {
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
            background: rgba(255, 255, 255, 0.18);
            font-size: 25px;
        }

        .banner-content {
            position: relative;
            z-index: 1;
            margin: 45px 0;
        }

        .banner-content h1 {
            font-size: 35px;
            line-height: 1.3;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .banner-content p {
            color: #dbeafe;
            line-height: 1.8;
            font-size: 14px;
        }

        .rfid-illustration {
            display: flex;
            justify-content: center;
            margin: 25px 0;
        }

        .rfid-card {
            width: 190px;
            height: 120px;
            border-radius: 16px;
            background: linear-gradient(135deg, #ffffff, #dbeafe);
            color: #2563eb;
            padding: 20px;
            transform: rotate(-7deg);
            box-shadow: 0 18px 35px rgba(0, 0, 0, 0.18);
            position: relative;
        }

        .rfid-card .chip {
            font-size: 29px;
            margin-bottom: 8px;
        }

        .rfid-card .card-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .rfid-card .card-number {
            font-size: 12px;
            margin-top: 7px;
            letter-spacing: 2px;
        }

        .banner-footer {
            color: #dbeafe;
            font-size: 12px;
        }

        .circle {
            position: absolute;
            border: 1px solid rgba(255, 255, 255, 0.15);
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

        /* Panel kanan */
        .login-form-panel {
            padding: 55px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-heading {
            margin-bottom: 32px;
        }

        .form-heading h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #172b4d;
        }

        .form-heading p {
            color: #64748b;
            font-size: 14px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .input-group {
            border: 1px solid #dbe4f0;
            border-radius: 10px;
            overflow: hidden;
            transition: border-color .2s, box-shadow .2s;
        }

        .input-group:focus-within {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .input-group-text {
            background: white;
            color: #64748b;
            border: none;
            padding-left: 15px;
        }

        .form-control {
            border: none;
            padding: 13px 12px;
            font-size: 14px;
            box-shadow: none !important;
        }

        .form-control:focus {
            background: white;
        }

        .toggle-password {
            border: none;
            background: white;
            color: #64748b;
            padding: 0 15px;
        }

        .toggle-password:hover {
            color: #2563eb;
        }

        .form-check-input {
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .form-check-label {
            font-size: 13px;
            color: #64748b;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: .2s;
        }

        .btn-login:hover {
            background: #1d4ed8;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(37, 99, 235, .2);
        }

        .security-note {
            margin-top: 25px;
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

            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 440px;
                min-height: auto;
                border-radius: 18px;
            }

            .login-banner {
                padding: 25px;
                min-height: auto;
            }

            .banner-content {
                margin: 25px 0 10px;
            }

            .banner-content h1 {
                font-size: 25px;
            }

            .banner-content p {
                margin-bottom: 0;
            }

            .rfid-illustration {
                display: none;
            }

            .banner-footer {
                margin-top: 20px;
            }

            .login-form-panel {
                padding: 32px 25px;
            }

            .form-heading h2 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <!-- Panel informasi -->
    <section class="login-banner">
        <div class="circle circle-one"></div>
        <div class="circle circle-two"></div>

        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-fingerprint"></i>
            </div>
            <span>RFID ATTENDANCE</span>
        </div>

        <div class="banner-content">
            <h1>Sistem Absensi<br>Digital & Terintegrasi</h1>

            <p>
                Kelola kehadiran karyawan dengan lebih mudah,
                cepat, dan akurat melalui sistem absensi RFID.
            </p>

            <div class="rfid-illustration">
                <div class="rfid-card">
                    <div class="chip">
                        <i class="bi bi-wifi"></i>
                    </div>
                    <div class="card-label">ACCESS CARD</div>
                    <div class="card-number">RFID •••• 2026</div>
                </div>
            </div>
        </div>

        <div class="banner-footer">
            &copy; {{ date('Y') }} RFID Attendance System
        </div>
    </section>

    <!-- Panel login -->
    <section class="login-form-panel">

        <div class="form-heading">
            <h2>Login Admin</h2>
            <p>Masukkan akun Anda untuk mengakses dashboard.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success small">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger small">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="mb-4">
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
                        placeholder="admin@email.com"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                        autofocus>
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
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required>

                    <button
                        type="button"
                        class="toggle-password"
                        id="togglePassword"
                        aria-label="Tampilkan password">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="form-check-input"
                        value="1">

                    <label for="remember" class="form-check-label">
                        Ingat saya
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Masuk ke Dashboard
            </button>
        </form>

        <div class="security-note">
            <i class="bi bi-shield-lock-fill"></i>
            Halaman khusus administrator
        </div>

    </section>

</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';

        passwordInput.type = isPassword ? 'text' : 'password';

        eyeIcon.classList.toggle('bi-eye', !isPassword);
        eyeIcon.classList.toggle('bi-eye-slash', isPassword);

        togglePassword.setAttribute(
            'aria-label',
            isPassword ? 'Sembunyikan password' : 'Tampilkan password'
        );
    });
</script>

</body>
</html>
