<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Menampilkan daftar semua obat.
     */
    public function index()
    {
        // Mengambil data terbaru agar obat yang baru diinput muncul paling atas
        $obats = Obat::latest()->get();
        return view('obat.index', compact('obats'));
    }

    /**
     * Menyimpan data obat baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_obat'  => 'required|string|max:255|min:3',
            'jenis_obat' => 'required|string',
            'stok'       => 'required|integer|min:0', // Validasi: Stok tidak boleh minus
            'keterangan' => 'nullable|string',
        ]);

        Obat::create($validated);

        return redirect()->route('obat.index')
            ->with('success', 'Obat baru berhasil ditambahkan ke stok.');
    }

    /**
     * Menampilkan informasi detail satu obat dan riwayat penggunaannya.
     */
    public function show(Obat $obat)
    {
        /**
         * Mengambil riwayat pemeriksaan yang menggunakan obat ini.
         * Kita memuat relasi 'pasien' yang ada di dalam model RekamMedis.
         * latest() di sini mengurutkan berdasarkan kolom created_at di tabel rekam_medis.
         */
        $riwayat = $obat->rekamMedis()
                        ->with('pasien') 
                        ->latest()
                        ->get();

        return view('obat.show', compact('obat', 'riwayat'));
    }

    /**
     * Menampilkan form untuk mengedit data obat.
     */
    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    /**
     * Memperbarui data obat di database.
     */
    public function update(Request $request, Obat $obat)
    {
        $validated = $request->validate([
            'nama_obat'  => 'required|string|max:255|min:3',
            'jenis_obat' => 'required|string',
            'stok'       => 'required|integer|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $obat->update($validated);

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    /**
     * Menghapus obat dari database.
     */
    public function destroy(Obat $obat)
    {
        /**
         * Proteksi: Cek apakah obat masih tercatat di rekam medis pasien.
         * Jika masih ada, obat tidak boleh dihapus untuk menjaga integritas data medis.
         */
        if ($obat->rekamMedis()->exists()) {
            return redirect()->route('obat.index')
                ->with('error', 'Gagal: Obat ini tidak bisa dihapus karena masih tercatat dalam riwayat rekam medis pasien.');
        }

        $obat->delete();

        return redirect()->route('obat.index')
            ->with('success', 'Obat berhasil dihapus dari sistem.');
    }
}