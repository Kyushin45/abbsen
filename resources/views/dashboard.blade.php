<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin RFID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --blue: #2563eb;
            --blue-dark: #1e40af;
            --bg: #f4f7fc;
            --text: #172b4d;
            --muted: #64748b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 255px;
            padding: 25px 18px;
            background: white;
            border-right: 1px solid #e8edf5;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 8px;
            margin-bottom: 38px;
        }

        .brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            color: white;
            background: var(--blue);
            font-size: 24px;
        }

        .brand-title {
            font-size: 15px;
            font-weight: 700;
        }

        .brand-subtitle {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
        }

        .menu-label {
            margin: 20px 10px 10px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: #94a3b8;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            margin-bottom: 5px;
            color: #64748b;
            text-decoration: none;
            border-radius: 10px;
            font-size: 13px;
            transition: .2s;
        }

        .sidebar a i { font-size: 17px; }

        .sidebar a:hover,
        .sidebar a.active {
            color: var(--blue);
            background: #eff6ff;
            font-weight: 600;
        }

        .sidebar-bottom {
            position: absolute;
            bottom: 22px;
            left: 18px;
            right: 18px;
        }

        .admin-mini {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 5px;
            border-top: 1px solid #e8edf5;
            margin-bottom: 12px;
        }

        .avatar {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            background: #dbeafe;
            color: var(--blue);
            font-weight: 700;
        }

        .admin-name {
            font-size: 12px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .admin-role {
            font-size: 11px;
            color: var(--muted);
            margin-top: 4px;
        }

        .logout-btn {
            width: 100%;
            padding: 10px;
            background: white;
            color: #dc2626;
            border: 1px solid #fee2e2;
            border-radius: 9px;
            font-size: 13px;
        }

        .logout-btn:hover {
            background: #fef2f2;
        }

        .main {
            margin-left: 255px;
            padding: 30px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .page-title {
            font-size: 25px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .page-subtitle {
            color: var(--muted);
            font-size: 13px;
            margin: 0;
        }

        .date-badge {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 11px 15px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 10px;
            font-size: 12px;
            white-space: nowrap;
        }

        .stat-card,
        .panel {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 15px;
            padding: 23px;
            margin-bottom: 22px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, .025);
        }

        .stat-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 125px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 12px;
        }

        .stat-number {
            font-size: 30px;
            font-weight: 700;
            color: var(--text);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            font-size: 23px;
        }

        .icon-blue {
            color: #2563eb;
            background: #eff6ff;
        }

        .icon-green {
            color: #059669;
            background: #ecfdf5;
        }

        .icon-purple {
            color: #7c3aed;
            background: #f5f3ff;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 23px;
        }

        .panel-title {
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 6px;
        }

        .panel-subtitle {
            color: var(--muted);
            font-size: 12px;
            margin: 0;
        }

        .form-label {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .form-control,
        .form-select {
            padding: 12px 13px;
            border: 1px solid #dbe4f0;
            border-radius: 9px;
            font-size: 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .1);
        }

        .input-hint {
            margin-top: 7px;
            font-size: 11px;
            color: var(--muted);
        }

        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 17px;
            background: var(--blue);
            border: 1px solid var(--blue);
            border-radius: 9px;
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-primary-custom:hover {
            background: var(--blue-dark);
            color: white;
        }

        .table-search {
            width: 230px;
            max-width: 100%;
        }

        .table {
            font-size: 12px;
            vertical-align: middle;
        }

        .table thead th {
            padding: 14px 12px;
            background: #f8fafc;
            color: #64748b;
            font-size: 10px;
            letter-spacing: .4px;
            white-space: nowrap;
            border-bottom: 1px solid #e8edf5;
        }

        .table tbody td {
            padding: 15px 12px;
            border-color: #f1f5f9;
        }

        .person-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 160px;
        }

        .person-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border-radius: 10px;
            color: var(--blue);
            background: #eff6ff;
            font-weight: 700;
        }

        .person-name {
            font-weight: 600;
            color: #334155;
        }

        .team-badge {
            display: inline-block;
            padding: 6px 9px;
            background: #eff6ff;
            color: #1d4ed8;
            border-radius: 6px;
            font-size: 11px;
            white-space: nowrap;
        }

        .uid-code {
            font-family: Consolas, monospace;
            color: #475569;
            font-size: 12px;
            white-space: nowrap;
        }

        .empty-state {
            padding: 45px 15px !important;
            text-align: center;
            color: #94a3b8;
        }

        .empty-state i {
            display: block;
            font-size: 35px;
            margin-bottom: 12px;
        }

        .section-anchor {
            scroll-margin-top: 25px;
        }

        @media (max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                padding: 22px;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                padding: 16px;
                border-right: 0;
                border-bottom: 1px solid #e8edf5;
            }

            .brand {
                margin-bottom: 17px;
            }

            .menu-label {
                margin-top: 12px;
            }

            .sidebar a {
                display: inline-flex;
                margin: 2px;
                padding: 10px;
            }

            .sidebar-bottom {
                position: static;
                margin-top: 15px;
            }

            .admin-mini {
                margin-bottom: 5px;
            }

            .main {
                margin-left: 0;
                padding: 18px 13px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
                margin-bottom: 20px;
            }

            .page-title {
                font-size: 22px;
            }

            .stat-card {
                padding: 18px;
                min-height: 110px;
            }

            .panel {
                padding: 17px 13px;
            }

            .panel-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .table-search {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="brand">
        <div class="brand-icon">
            <i class="bi bi-fingerprint"></i>
        </div>
        <div>
            <div class="brand-title">RFID ATTENDANCE</div>
            <div class="brand-subtitle">Admin Management System</div>
        </div>
    </div>

    <div class="menu-label">MENU UTAMA</div>

    <a href="#dashboard" class="active">
        <i class="bi bi-grid-1x2"></i> Dashboard
    </a>

    <a href="#data-relawan">
        <i class="bi bi-people"></i> Data Relawan
    </a>

    <a href="#tambah-relawan">
        <i class="bi bi-person-plus"></i> Tambah Relawan
    </a>
    <a href="#riwayat-absensi">
    <i class="bi bi-clock-history"></i>
        Riwayat Absensi
    </a>

    <div class="menu-label">PENGATURAN</div>

    <a href="#manajemen-user" class="menu-link">
    <i class="bi bi-person-gear"></i> Manajemen User
</a>

    <a href="{{ route('profil-admin') }}" class="menu">
    <i class="bi bi-person-circle me-2"></i>
    Profil Admin
</a>

    <div class="sidebar-bottom">
        <div class="admin-mini">
            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <div class="admin-name">{{ Auth::user()->name }}</div>
                <div class="admin-role">Administrator</div>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </button>
        </form>
    </div>
</aside>

<main class="main">

    <!-- Dashboard -->
    <section id="dashboard" class="section-anchor">
        <div class="topbar">
            <div>
                <h1 class="page-title">Dashboard Admin</h1>
                <p class="page-subtitle">
                    Kelola relawan dan identitas kartu RFID dalam satu tempat.
                </p>
            </div>

            <div class="date-badge">
                <i class="bi bi-calendar3 text-primary"></i>
                {{ now()->format('d M Y') }}
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show small">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show small">
                <strong>Data belum dapat disimpan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="stat-card">
                    <div>
                        <div class="stat-label">Total Relawan</div>
                        <div class="stat-number">{{ $relawans->count() }}</div>
                        <div class="text-secondary small mt-2">Terdaftar di sistem</div>
                    </div>
                    <div class="stat-icon icon-blue">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="stat-card">
                    <div>
                        <div class="stat-label">Tim Terdaftar</div>
                        <div class="stat-number">
                            {{ $relawans->pluck('tim')->unique()->count() }}
                        </div>
                        <div class="text-secondary small mt-2">Tim relawan berbeda</div>
                    </div>
                    <div class="stat-icon icon-purple">
                        <i class="bi bi-diagram-3"></i>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4">
                <div class="stat-card">
                    <div>
                        <div class="stat-label">RFID Terdaftar</div>
                        <div class="stat-number">{{ $relawans->count() }}</div>
                        <div class="text-secondary small mt-2">UID sudah tercatat</div>
                    </div>
                    <div class="stat-icon icon-green">
                        <i class="bi bi-credit-card-2-front"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
    <div class="stat-card">
        <div>
            <div class="stat-label">Sedang Bekerja</div>
            <div class="stat-number">
                {{ $absensis->whereNull('tanggal_keluar')->count() }}
            </div>
            <div class="text-secondary small mt-2">
                Relawan belum absen keluar
            </div>
        </div>
        <div class="stat-icon icon-green">
            <i class="bi bi-person-check"></i>
        </div>
    </div>
</div>

<div class="col-12 col-sm-6 col-xl-4">
    <div class="stat-card">
        <div>
            <div class="stat-label">Sudah Pulang</div>
            <div class="stat-number">
                {{ $absensis->filter(fn($a) =>
                    $a->tanggal_keluar &&
                    $a->tanggal_keluar->isToday()
                )->count() }}
            </div>
            <div class="text-secondary small mt-2">
                Sesi selesai hari ini
            </div>
        </div>
        <div class="stat-icon icon-purple">
            <i class="bi bi-door-closed"></i>
        </div>
    </div>
</div>
        </div>
    </section>

    <!-- Form tambah relawan -->
    <section id="tambah-relawan" class="panel section-anchor">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Tambah Relawan</h2>
                <p class="panel-subtitle">
                    Daftarkan identitas relawan dan kartu RFID mereka.
                </p>
            </div>

            <div class="stat-icon icon-blue">
                <i class="bi bi-person-add"></i>
            </div>
        </div>

        <form action="{{ route('relawan.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="nama" class="form-label">Nama Lengkap Relawan</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Andi Saputra"
                        maxlength="255"
                        required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="tim" class="form-label">Tim Relawan</label>
                    <select id="tim" name="tim" class="form-select" required>
                        <option value="">Pilih tim relawan</option>
                        @foreach(['Team Keamanan', 'Tim Kebersihan', 'Tim Persiapan', 'Tim Pengolahan', 'Tim Pemorsian', 'Tim Driver', 'Tim Cuci Ompreng'] as $tim)
                            <option value="{{ $tim }}"
                                {{ old('tim') === $tim ? 'selected' : '' }}>
                                {{ $tim }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label for="rfid_uid" class="form-label">UID Kartu RFID</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-credit-card-2-front text-primary"></i>
                        </span>
                        <input
                            type="text"
                            id="rfid_uid"
                            name="rfid_uid"
                            class="form-control"
                            value="{{ old('rfid_uid') }}"
                            placeholder="Contoh: A1B2C3D4"
                            maxlength="100"
                            autocomplete="off"
                            required>
                    </div>
                    <div class="input-hint">
                        Masukkan UID kartu RFID sesuai hasil pembacaan reader.
                        UID harus unik dan tidak boleh digunakan relawan lain.
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end mt-4">
                    <button type="reset" class="btn btn-light border me-2 px-3">
                        Reset
                    </button>

                    <button type="submit" class="btn-primary-custom">
                        <i class="bi bi-person-plus"></i>
                        Simpan Relawan
                    </button>
                </div>
            </div>
        </form>
    </section>


<!-- Tabel relawan -->
<section id="data-relawan" class="panel section-anchor">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Data Relawan</h2>
            <p class="panel-subtitle">
                Daftar relawan yang tersimpan di database.
            </p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table mb-0" id="relawanTable">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA RELAWAN</th>
                    <th>TIM</th>
                    <th>UID RFID</th>
                    <th>TANGGAL DITAMBAHKAN</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                @forelse($relawans as $relawan)
                    <tr>
                        <td>{{ $relawans->firstItem() + $loop->index }}</td>

                        <td>
                            <div class="person-cell">
                                <div class="person-avatar">
                                    {{ strtoupper(substr($relawan->nama, 0, 1)) }}
                                </div>
                                <span class="person-name">
                                    {{ $relawan->nama }}
                                </span>
                            </div>
                        </td>

                        <td>
                            <span class="team-badge">
                                {{ $relawan->tim }}
                            </span>
                        </td>

                        <td>
                            <span class="uid-code">
                                {{ $relawan->rfid_uid }}
                            </span>
                        </td>

                        <td class="text-secondary">
                            {{ $relawan->created_at?->format('d/m/Y H:i') ?? '-' }}
                        </td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('relawan.edit', $relawan->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Edit relawan">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form action="{{ route('relawan.destroy', $relawan->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data relawan ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Hapus relawan">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-person-plus"></i>
                            <div class="fw-semibold mb-2">
                                Belum ada data relawan
                            </div>
                            <div>Tambahkan relawan melalui formulir di atas.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Data Relawan --}}
    @if ($relawans->hasPages())
        <div class="mt-4">
            <div class="text-secondary small text-center mb-3">
                Menampilkan {{ $relawans->firstItem() }}–{{ $relawans->lastItem() }}
                dari {{ $relawans->total() }} relawan
            </div>

            <div class="d-flex justify-content-center">
                {{ $relawans->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</section>

    
 <section id="riwayat-absensi" class="panel section-anchor">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Riwayat Absensi Relawan</h2>
            <p class="panel-subtitle">
                Data masuk dan keluar dari hasil scan RFID.
            </p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0" id="absensiTable">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA</th>
                    <th>TIM</th>
                    <th>TANGGAL MASUK</th>
                    <th>JAM MASUK</th>
                    <th>TANGGAL KELUAR</th>
                    <th>JAM KELUAR</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                @forelse($absensis as $absensi)
                    <tr>
                        <td>{{ $absensis->firstItem() + $loop->index }}</td>
                        <td>{{ $absensi->relawan->nama ?? 'Relawan tidak ditemukan' }}</td>
                        <td>{{ $absensi->relawan->tim ?? '-' }}</td>
                        <td>{{ $absensi->tanggal_masuk?->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ $absensi->tanggal_masuk?->format('H:i:s') ?? '-' }}</td>
                        <td>{{ $absensi->tanggal_keluar?->format('d/m/Y') ?? '—' }}</td>
                        <td>{{ $absensi->tanggal_keluar?->format('H:i:s') ?? '—' }}</td>
                        <td>
                            @if($absensi->tanggal_keluar)
                                <span class="badge text-bg-secondary">Sudah Pulang</span>
                            @else
                                <span class="badge text-bg-success">Sedang Bekerja</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('absensi.edit', $absensi->id) }}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            Belum ada riwayat absensi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($absensis->hasPages())
    <div class="mt-4">

        <div class="text-secondary small text-center mb-3">
            Menampilkan {{ $absensis->firstItem() }}–{{ $absensis->lastItem() }}
            dari {{ $absensis->total() }} riwayat absensi
        </div>

        <div class="d-flex justify-content-center">
            {{ $absensis->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endif
</section>

<!-- Manajemen User -->
<section id="manajemen-user" class="panel section-anchor">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Manajemen User</h2>
            <p class="panel-subtitle">
                Tambahkan akun baru agar dapat mengakses sistem absensi.
            </p>
        </div>

        <div class="stat-icon icon-blue">
            <i class="bi bi-person-plus"></i>
        </div>
    </div>

    @if(session('success_user'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success_user') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Gagal menambahkan user:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="row g-3">
            <div class="col-12 col-md-6">
                <label for="user_name" class="form-label">Nama Lengkap</label>
                <input
                    type="text"
                    id="user_name"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    maxlength="255"
                    required>
            </div>

            <div class="col-12 col-md-6">
                <label for="user_email" class="form-label">Email</label>
                <input
                    type="email"
                    id="user_email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    maxlength="255"
                    required>
            </div>

            <div class="col-12 col-md-6">
                <label for="user_password" class="form-label">Password</label>
                <input
                    type="password"
                    id="user_password"
                    name="password"
                    class="form-control"
                    placeholder="Minimal 8 karakter"
                    minlength="8"
                    autocomplete="new-password"
                    required>
            </div>

            <div class="col-12 col-md-6">
                <label for="user_password_confirmation"
                       class="form-label">Konfirmasi Password</label>
                <input
                    type="password"
                    id="user_password_confirmation"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Ulangi password"
                    minlength="8"
                    autocomplete="new-password"
                    required>
            </div>

            <div class="col-12 d-flex justify-content-end mt-4">
                <button type="reset" class="btn btn-light border me-2">
                    Reset
                </button>

                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-person-plus"></i>
                    Tambahkan User
                </button>
            </div>
        </div>
    </form>
</section>
    <!-- Profil admin -->
    <section id="profil" class="panel section-anchor">
        <div class="panel-header">
            <div>
                <h2 class="panel-title">Profil Admin</h2>
                <p class="panel-subtitle">Informasi akun yang sedang login.</p>
            </div>
            <div class="stat-icon icon-blue">
                <i class="bi bi-person-circle"></i>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="text-secondary small mb-2">Nama Lengkap</div>
                <div class="fw-semibold">{{ Auth::user()->name }}</div>
            </div>
            <div class="col-12 col-md-6">
                <div class="text-secondary small mb-2">Email</div>
                <div class="fw-semibold">{{ Auth::user()->email }}</div>
            </div>
            <div class="col-12">
                <div class="text-secondary small mb-2">Hak Akses</div>
                <span class="badge text-bg-primary">Administrator</span>
            </div>
        </div>
    </section>

    <div class="text-center text-secondary small py-3">
        RFID Attendance System &copy; {{ date('Y') }}
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Pencarian data relawan
    const searchInput = document.getElementById('searchRelawan');
    const table = document.getElementById('relawanTable');
    const noSearchResult = document.getElementById('noSearchResult');

    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        const rows = table.querySelectorAll('tbody tr:not(#noSearchResult):not(#emptyRow)');
        let visibleCount = 0;

        rows.forEach(function (row) {
            const match = row.textContent.toLowerCase().includes(keyword);
            row.style.display = match ? '' : 'none';

            if (match) visibleCount++;
        });

        noSearchResult.style.display =
            rows.length > 0 && visibleCount === 0 ? '' : 'none';
    });

    // Navigasi menu aktif
    
document.addEventListener('DOMContentLoaded', function () {
    const sections = document.querySelectorAll(
        'main > section.section-anchor'
    );

    const menuLinks = document.querySelectorAll(
        '.sidebar a[href^="#"]'
    );

    function showSection(sectionId) {
        let targetFound = false;

        sections.forEach(function (section) {
            const isTarget = section.id === sectionId;
            section.style.display = isTarget ? '' : 'none';

            if (isTarget) targetFound = true;
        });

        if (!targetFound) {
            const dashboard = document.getElementById('dashboard');
            if (dashboard) dashboard.style.display = '';
            sectionId = 'dashboard';
        }

        menuLinks.forEach(function (link) {
            link.classList.toggle(
                'active',
                link.getAttribute('href') === '#' + sectionId
            );
        });
    }

    menuLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            const sectionId = this.getAttribute('href').substring(1);

            if (document.getElementById(sectionId)) {
                event.preventDefault();
                history.replaceState(null, '', '#' + sectionId);
                showSection(sectionId);
            }
        });
    });

    const initialSection = window.location.hash.substring(1);
    showSection(initialSection || 'dashboard');
});

</script>

</body>
</html>