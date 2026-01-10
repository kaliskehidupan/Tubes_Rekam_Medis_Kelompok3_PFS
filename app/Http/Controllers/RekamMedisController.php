<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    // Tampilkan Daftar Rekam Medis
    public function index()
    {
        $records = RekamMedis::with(['pasien', 'dokter'])->latest()->paginate(10);
        return view('rekam-medis.index', compact('records'));
    }

    // Form Tambah (Halaman yang kamu cek tadi)
    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $obats = Obat::all();

        return view('rekam-medis.create', compact('pasiens', 'dokters', 'obats'));
    }

    // Logika Simpan Data
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'keluhan'   => 'required',
            'diagnosa'  => 'required',
            'obat_id'   => 'required|array', // Harus array karena pilih banyak obat
        ]);

        // 1. Simpan ke tabel rekam_medis
        $rm = RekamMedis::create([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'keluhan'   => $request->keluhan,
            'diagnosa'  => $request->diagnosa,
            'tgl_periksa' => $request->tgl_periksa ?? now(),
        ]);

        // 2. Simpan ke tabel pivot (rekam_medis_obat)
        // Ini yang menghubungkan banyak obat ke satu rekam medis
        $rm->obat()->attach($request->obat_id);

        return redirect()->route('rekam-medis.index')->with('success', 'Rekam Medis berhasil disimpan!');
    }

    // Detail Rekam Medis
    public function show($id)
    {
        $rm = RekamMedis::with(['pasien', 'dokter', 'obat'])->findOrFail($id);
        return view('rekam-medis.show', compact('rm'));
    }
}