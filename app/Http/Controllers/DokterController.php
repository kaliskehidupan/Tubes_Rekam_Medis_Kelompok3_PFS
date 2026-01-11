<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // Menampilkan daftar dokter
    public function index()
    {
        $dokters = Dokter::latest()->paginate(10);
        return view('dokter.index', compact('dokters'));
    }

    // Form Tambah
    public function create()
    {
        return view('dokter.create');
    }

    // Proses Simpan
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter'     => 'required|string|max:255',
            'spesialisasi'    => 'required|string|max:100',
            'nomor_telepon'   => 'required|string|max:15',
        ]);

        Dokter::create($request->all());

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    // Halaman Detail (PENTING: Ini yang dipanggil tombol Detail)
    public function show(Dokter $dokter)
    {
        return view('dokter.show', compact('dokter'));
    }

    // Form Edit
    public function edit(Dokter $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    // Proses Update
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama_dokter'     => 'required|string|max:255',
            'spesialisasi'    => 'required|string|max:100',
            'nomor_telepon'   => 'required|string|max:15',
        ]);

        $dokter->update($request->all());

        return redirect()->route('dokter.index')->with('success', 'Data Dokter berhasil diperbarui.');
    }

    // Hapus Data
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data Dokter berhasil dihapus.');
    }
}