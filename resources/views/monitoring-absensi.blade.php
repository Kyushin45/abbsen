
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Monitoring Absensi RFID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        :root {
            --blue: #2563eb;
            --dark: #172b4d;
            --muted: #64748b;
            --bg: #f4f7fc;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--dark);
            font-family: Arial, sans-serif;
        }

        .navbar-custom {
            background: white;
            border-bottom: 1px solid #e8edf5;
            padding: 18px 0;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background: var(--blue);
            border-radius: 12px;
            font-size: 24px;
        }

        .content {
            max-width: 1400px;
            margin: auto;
            padding: 28px 20px;
        }

        .page-title {
            font-size: 26px;
            font-weight: 700;
        }

        .muted {
            color: var(--muted);
            font-size: 13px;
        }

        .panel, .stat-card {
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 3px 12px rgba(15, 23, 42, .025);
        }

        .stat-card {
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .stat-number {
            font-size: 30px;
            font-weight: 700;
            margin-top: 8px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 23px;
            background: #eff6ff;
            color: var(--blue);
        }

        .scan-input {
            padding: 14px;
            font-size: 16px;
            border-radius: 9px;
        }

        .btn-scan {
            padding: 12px 20px;
            color: white;
            background: var(--blue);
            border: 0;
            border-radius: 9px;
            font-weight: 600;
        }

        .btn-scan:hover {
            background: #1e40af;
            color: white;
        }

        .btn-scan:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .table {
            font-size: 13px;
            vertical-align: middle;
        }

        .table thead th {
            padding: 15px 12px;
            background: #f8fafc;
            color: var(--muted);
            font-size: 11px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 15px 12px;
            white-space: nowrap;
        }

        .person {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .person-avatar {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            color: var(--blue);
            background: #eff6ff;
            font-weight: 700;
        }

        .team {
            display: inline-block;
            background: #eff6ff;
            color: #1d4ed8;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 11px;
        }

        .status {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-in {
            color: #047857;
            background: #d1fae5;
        }

        .status-out {
            color: #475569;
            background: #f1f5f9;
        }

        .empty {
            text-align: center;
            color: #94a3b8;
            padding: 45px !important;
        }

        @media (max-width: 576px) {
            .content {
                padding: 20px 12px;
            }

            .panel, .stat-card {
                padding: 16px;
            }

            .page-title {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar-custom">
    <div class="container-fluid px-3 px-lg-4 d-flex align-items-center gap-3">
        <div class="brand-icon">
            <i class="bi bi-fingerprint"></i>
        </div>

        <div>
            <div class="fw-bold">RFID ATTENDANCE</div>
            <div class="muted">Monitoring Absensi Relawan</div>
        </div>

        <div class="ms-auto text-end">
            <div class="fw-semibold" id="clock">--:--:--</div>
            <div class="muted">{{ now()->format('d/m/Y') }}</div>
        </div>
    </div>
</nav>

<main class="content">

    <div class="mb-4">
        <h1 class="page-title">Monitoring Absensi</h1>
        <p class="muted">
            Pantau kehadiran relawan berdasarkan pembacaan kartu RFID.
        </p>
    </div>

    

    {{-- TABEL ABSENSI --}}
    <section class="panel">

        <div class="d-flex flex-column flex-md-row
                    justify-content-between gap-3 mb-4">

            <div>
                <h2 class="fs-5 fw-bold mb-1">Riwayat Absensi</h2>
                <p class="muted mb-0">
                    Jam keluar tetap tercatat walaupun pada hari berikutnya.
                </p>
            </div>

            <div class="d-flex flex-column flex-sm-row gap-2">
                <select id="statusFilter" class="form-select">
                    <option value="semua">Semua status</option>
                    <option value="masuk">Sedang bekerja</option>
                    <option value="keluar">Sudah pulang</option>
                </select>

                <input type="search"
                       id="search"
                       class="form-control"
                       placeholder="Cari nama atau tim...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA RELAWAN</th>
                        <th>TIM</th>
                        <th>TANGGAL MASUK</th>
                        <th>JAM MASUK</th>
                        <th>TANGGAL KELUAR</th>
                        <th>JAM KELUAR</th>
                        <th>STATUS</th>
                    </tr>
                </thead>

                <tbody id="attendanceBody">

                    @forelse($absensis as $absensi)
                        <tr data-status="{{ $absensi->tanggal_keluar ? 'keluar' : 'masuk' }}">

                            <td>{{ $absensis->firstItem() + $loop->index }}</td>

                            <td>
                                <div class="person">
                                    <div class="person-avatar">
                                        {{ strtoupper(substr($absensi->relawan->nama ?? '?', 0, 1)) }}
                                    </div>

                                    <span class="fw-semibold">
                                        {{ $absensi->relawan->nama ?? 'Relawan tidak ditemukan' }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span class="team">
                                    {{ $absensi->relawan->tim ?? '-' }}
                                </span>
                            </td>

                            <td>
                                {{ $absensi->tanggal_masuk?->format('d/m/Y') ?? '—' }}
                            </td>

                            <td class="fw-semibold text-success">
                                {{ $absensi->tanggal_masuk?->format('H:i:s') ?? '—' }}
                            </td>

                            <td>
                                {{ $absensi->tanggal_keluar?->format('d/m/Y') ?? '—' }}
                            </td>

                            <td class="fw-semibold">
                                {{ $absensi->tanggal_keluar?->format('H:i:s') ?? '—' }}
                            </td>

                            <td>
                                @if($absensi->tanggal_keluar)
                                    <span class="status status-out">
                                        Sudah Pulang
                                    </span>
                                @else
                                    <span class="status status-in">
                                        Sedang Bekerja
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="8" class="empty">
                                <i class="bi bi-calendar2-x fs-2 d-block mb-2"></i>
                                Belum ada data absensi.
                            </td>
                        </tr>
                    @endforelse

                    <tr id="noResult" style="display:none">
                        <td colspan="8" class="empty">
                            Tidak ada data yang cocok.
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
<div class="mt-4">
    <div class="muted text-center mb-3">
        Menampilkan {{ $absensis->firstItem() ?? 0 }}–{{ $absensis->lastItem() ?? 0 }}
        dari {{ $absensis->total() }} data absensi
    </div>

    <div class="d-flex justify-content-center">
        {{ $absensis->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>

        <div class="muted mt-3">
            <i class="bi bi-arrow-repeat me-1"></i>
            Data diperbarui otomatis setiap 15 detik.
        </div>

    </section>

    <footer class="text-center muted py-4">
        RFID Attendance System &copy; {{ date('Y') }}
    </footer>

</main>

<script>
    const scanForm = document.getElementById('scanForm');
    const rfidInput = document.getElementById('rfid_uid');
    const scanButton = document.getElementById('scanButton');
    const scanMessage = document.getElementById('scanMessage');
    const searchInput = document.getElementById('search');
    const statusFilter = document.getElementById('statusFilter');

    let sedangMemproses = false;

    // Jam berjalan zona waktu Indonesia.
    function updateClock() {
        document.getElementById('clock').textContent =
            new Intl.DateTimeFormat('id-ID', {
                timeZone: 'Asia/Jakarta',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            }).format(new Date());
    }

    updateClock();
    setInterval(updateClock, 1000);

    // Filter tabel.
    function filterTable() {
        const keyword = searchInput.value.toLowerCase().trim();
        const status = statusFilter.value;

        const rows = document.querySelectorAll(
            '#attendanceBody tr[data-status]'
        );

        let visible = 0;

        rows.forEach(row => {
            const matchesText =
                row.textContent.toLowerCase().includes(keyword);

            const matchesStatus =
                status === 'semua' || row.dataset.status === status;

            const tampil = matchesText && matchesStatus;
            row.style.display = tampil ? '' : 'none';

            if (tampil) visible++;
        });

        const noResult = document.getElementById('noResult');

        if (noResult) {
            noResult.style.display =
                rows.length > 0 && visible === 0 ? '' : 'none';
        }
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);

    // Scan RFID selalu dikirim menggunakan POST.
    scanForm.addEventListener('submit', async function(event) {
        event.preventDefault();

        if (sedangMemproses) return;

        const uid = rfidInput.value.trim();

        if (!uid) {
            rfidInput.focus();
            return;
        }

        sedangMemproses = true;
        scanButton.disabled = true;

        scanMessage.innerHTML =
            '<div class="alert alert-info mb-0">' +
            'Memproses kartu RFID...</div>';

        try {
            const response = await fetch(scanForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                },
                body: JSON.stringify({
                    rfid_uid: uid
                })
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(
                    result.message || 'Absensi gagal diproses.'
                );
            }

            const statusText = result.status === 'masuk'
                ? 'ABSEN MASUK BERHASIL'
                : 'ABSEN KELUAR BERHASIL';

            scanMessage.innerHTML = `
                <div class="alert alert-success mb-0">
                    <strong>${escapeHtml(statusText)}</strong><br>
                    ${escapeHtml(result.nama ?? '')}
                    — ${escapeHtml(result.tim ?? '')}<br>
                    ${escapeHtml(result.waktu ?? '')}<br>
                    ${escapeHtml(result.message ?? '')}
                </div>
            `;

            rfidInput.value = '';

            // Muat ulang tabel setelah pesan hasil sempat terbaca.
            setTimeout(() => {
                window.location.href = @json(route('absensi.monitoring'));
            }, 1200);

        } catch (error) {
            scanMessage.innerHTML = `
                <div class="alert alert-danger mb-0">
                    ${escapeHtml(error.message)}
                </div>
            `;

            rfidInput.select();

        } finally {
            sedangMemproses = false;
            scanButton.disabled = false;
            rfidInput.focus();
        }
    });

    function escapeHtml(value) {
        return String(value).replace(/[&<>"']/g, char => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        })[char]);
    }

    // Fokus awal untuk reader RFID tipe keyboard.
    rfidInput.focus();

    // Refresh otomatis. Tidak refresh ketika UID sedang diketik
    // atau pengguna sedang memakai kolom pencarian/filter.
    setInterval(() => {
        const inputBerisiUID = rfidInput.value.trim() !== '';
        const sedangCari = document.activeElement === searchInput;
        const sedangPilihFilter = document.activeElement === statusFilter;

        if (!sedangMemproses && !inputBerisiUID &&
            !sedangCari && !sedangPilihFilter) {
            window.location.reload();
        }
    }, 15000);
</script>

</body>
</html>
