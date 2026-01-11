<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Menampilkan daftar pasien dengan Pagination (Tugas Orang 4)
     */
    public function index()
    {
        // Mengambil data pasien terbaru, 10 data per halaman
        $pasiens = Pasien::latest()->paginate(10);
        return view('pasien.index', compact('pasiens'));
    }

    /**
     * Menampilkan form tambah pasien
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Menyimpan data pasien baru (Validasi Input)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|unique:pasiens,nik',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        Pasien::create($request->all());

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pasien
     */
    public function show(Pasien $pasien)
    {
        return view('pasien.show', compact('pasien'));
    }

    /**
     * Menampilkan form edit pasien
     */
    public function edit(Pasien $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    /**
     * Memperbarui data pasien
     */
    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nik' => 'required|numeric|unique:pasiens,nik,' . $pasien->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        $pasien->update($request->all());

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Menghapus data pasien
     */
    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
