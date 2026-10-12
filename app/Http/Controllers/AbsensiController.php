<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Relawan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    // Halaman monitoring tanpa login
    public function index()
{
    $absensis = \App\Models\Absensi::with('relawan')
        ->orderByDesc('tanggal_masuk')
        ->paginate(10);

    return view('monitoring-absensi', compact('absensis'));
}

    // UID RFID dikirim oleh reader
    public function scan(Request $request)
    {
        $data = $request->validate([
            'rfid_uid' => ['required', 'string', 'max:100'],
        ]);

        $relawan = Relawan::where('rfid_uid', trim($data['rfid_uid']))
            ->first();

        if (!$relawan) {
            return response()->json([
                'success' => false,
                'message' => 'Kartu RFID tidak terdaftar.',
            ], 404);
        }

        // Cari sesi yang belum selesai.
        // Tidak dibatasi tanggal, agar shift malam tetap berlanjut
        // sampai relawan melakukan tap keluar pada hari berikutnya.
        $absensi = Absensi::where('relawan_id', $relawan->id)
            ->whereNull('tanggal_keluar')
            ->latest('tanggal_masuk')
            ->first();

        $sekarang = now();

        if ($absensi) {
            $absensi->update([
                'tanggal_keluar' => $sekarang,
            ]);

            return response()->json([
                'success' => true,
                'status' => 'keluar',
                'nama' => $relawan->nama,
                'tim' => $relawan->tim,
                'waktu' => $sekarang->format('d-m-Y H:i:s'),
                'message' => 'Absen keluar berhasil.',
            ]);
        }

        Absensi::create([
            'relawan_id' => $relawan->id,
            'tanggal_masuk' => $sekarang,
        ]);

        return response()->json([
            'success' => true,
            'status' => 'masuk',
            'nama' => $relawan->nama,
            'tim' => $relawan->tim,
            'waktu' => $sekarang->format('d-m-Y H:i:s'),
            'message' => 'Absen masuk berhasil.',
        ]);
    }
    public function edit(Absensi $absensi)
{
    $absensi->load('relawan');

    return view('absensi-edit', compact('absensi'));
}

public function update(Request $request, Absensi $absensi)
{
    $data = $request->validate([
        'tanggal_masuk' => ['required', 'date'],
        'tanggal_keluar' => ['nullable', 'date', 'after_or_equal:tanggal_masuk'],
    ]);

    $absensi->update($data);

    return redirect()
        ->route('dashboard')
        ->with('success', 'Data absensi berhasil diperbarui.');
}
}
