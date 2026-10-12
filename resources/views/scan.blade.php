 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Scan RFID - Absensi Relawan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            background: #f4f7fc;
            color: #172b4d;
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
            background: #2563eb;
            color: white;
            border-radius: 12px;
            font-size: 24px;
        }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 15px;
        }

        .scan-card {
            width: 100%;
            max-width: 480px;
            padding: 32px;
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, .05);
        }

        .scan-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 38px;
        }

        .scan-input {
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-size: 17px;
        }

        .btn-scan {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-weight: 600;
        }

        .btn-scan:hover {
            background: #1d4ed8;
            color: white;
        }

        footer {
            padding: 20px 12px;
            text-align: center;
            color: #64748b;
            font-size: 12px;
        }

        @media (max-width: 576px) {
            .scan-card {
                padding: 24px 18px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar-custom">
    <div class="container d-flex align-items-center gap-3">
        <div class="brand-icon">
            <i class="bi bi-fingerprint"></i>
        </div>

        <div>
            <div class="fw-bold">RFID ATTENDANCE</div>
            <div class="text-secondary small">Absensi Relawan</div>
        </div>

        <div class="ms-auto text-end">
            <div id="clock" class="fw-semibold">--:--:--</div>
            <div class="text-secondary small">{{ now()->format('d/m/Y') }}</div>
        </div>
    </div>
</nav>

<main>
    <div class="scan-card">
        <div class="scan-icon">
            <i class="bi bi-upc-scan"></i>
        </div>

        <h1 class="h4 fw-bold text-center mb-2">Scan Kartu RFID</h1>

        <p class="text-secondary text-center small mb-4">
            Tempelkan kartu pada reader untuk melakukan absensi.
        </p>

        <form id="scanForm" action="{{ route('absensi.scan') }}" method="POST">
            @csrf

            <input
                type="text"
                id="rfid_uid"
                name="rfid_uid"
                class="form-control scan-input mb-3"
                placeholder="Menunggu kartu RFID..."
                autocomplete="off"
                autofocus
                required
            >

            <button type="submit" id="scanButton" class="btn-scan">
                <i class="bi bi-fingerprint me-2"></i> Scan Absensi
            </button>
        </form>

        <div id="scanMessage" class="mt-3" aria-live="polite"></div>
    </div>
</main>

<footer>
    <div>RFID Attendance System &copy; {{ date('Y') }}</div>
    <div class="mt-1 fw-semibold">System@2026</div>
</footer>

<script>
    const form = document.getElementById('scanForm');
    const input = document.getElementById('rfid_uid');
    const button = document.getElementById('scanButton');
    const message = document.getElementById('scanMessage');

    let processing = false;

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

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, char => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        })[char]);
    }

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        if (processing) return;

        const uid = input.value.trim();
        if (!uid) {
            input.focus();
            return;
        }

        processing = true;
        button.disabled = true;
        message.innerHTML =
            '<div class="alert alert-info mb-0">Memproses absensi...</div>';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                },
                body: JSON.stringify({ rfid_uid: uid })
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.message || 'Absensi gagal diproses.');
            }

            const masuk = result.status === 'masuk';

            message.innerHTML = `
                <div class="alert alert-${masuk ? 'success' : 'primary'} mb-0">
                    <strong>${masuk ? 'ABSEN MASUK BERHASIL' : 'ABSEN KELUAR BERHASIL'}</strong>
                    <hr>
                    <div>${escapeHtml(result.nama)}</div>
                    <div>${escapeHtml(result.tim)}</div>
                    <div>${escapeHtml(result.waktu)}</div>
                    <div class="small mt-1">${escapeHtml(result.message)}</div>
                </div>
            `;

            input.value = '';

        } catch (error) {
            message.innerHTML = `
                <div class="alert alert-danger mb-0">
                    ${escapeHtml(error.message)}
                </div>
            `;
            input.select();

        } finally {
            processing = false;
            button.disabled = false;
            input.focus();
        }
    });

    // Fokuskan kembali kolom input untuk reader RFID tipe keyboard.
    document.addEventListener('click', function(event) {
        if (!event.target.closest('button')) {
            input.focus();
        }
    });

    input.focus();
</script>

</body>
</html>