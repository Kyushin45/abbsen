<?php

namespace App\Http\Controllers;

use App\Models\Relawan;
use App\Models\Absensi;
use Illuminate\Http\Request;

class RelawanController extends Controller
{
    public function index()
{
    $relawans = \App\Models\Relawan::latest()
        ->paginate(10, ['*'], 'halaman_relawan');

    $absensis = \App\Models\Absensi::with('relawan')
        ->latest('tanggal_masuk')
        ->paginate(10, ['*'], 'halaman_absensi');

    return view('dashboard', compact('relawans', 'absensis'));
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tim' => ['required', 'string', 'max:100'],
            'rfid_uid' => ['required', 'string', 'max:100', 'unique:relawans,rfid_uid'],
        ], [
            'nama.required' => 'Nama relawan wajib diisi.',
            'tim.required' => 'Tim wajib dipilih.',
            'rfid_uid.required' => 'UID RFID wajib diisi.',
            'rfid_uid.unique' => 'UID RFID sudah terdaftar.',
        ]);

        $data['rfid_uid'] = strtoupper(trim($data['rfid_uid']));

        // Periksa kembali UID setelah normalisasi huruf.
        if (Relawan::where('rfid_uid', $data['rfid_uid'])->exists()) {
            return back()
                ->withErrors(['rfid_uid' => 'UID RFID sudah terdaftar.'])
                ->withInput();
        }

        Relawan::create($data);

        return redirect()->route('dashboard')
            ->with('success', 'Relawan berhasil ditambahkan.');
        }

    
        public function edit(Relawan $relawan)
        {
            return view('relawan-edit', compact('relawan'));
        }

        public function update(Request $request, Relawan $relawan)
        {
            $data = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'tim' => [
                    'required',
                    'in:Team Keamanan,Tim Kebersihan,Tim Persiapan,Tim Pengolahan,Tim Pemorsian,Tim Driver,Tim Cuci Ompreng'
                ],
                'rfid_uid' => [
                    'required',
                    'string',
                    'max:100',
                    'unique:relawans,rfid_uid,' . $relawan->id
                ],
            ]);

            $relawan->update($data);

            return redirect()
                ->route('dashboard')
                ->with('success', 'Data relawan berhasil diperbarui.');
        }

        public function destroy(Relawan $relawan)
        {
            $relawan->delete();

            return redirect()
                ->route('dashboard')
                ->with('success', 'Data relawan berhasil dihapus.');
        }

}
