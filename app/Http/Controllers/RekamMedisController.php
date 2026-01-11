<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Obat;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    // 1. Tampilkan Daftar Rekam Medis
    public function index()
    {
        $records = RekamMedis::with(['pasien', 'dokter'])->latest()->paginate(10);
        return view('rekam-medis.index', compact('records'));
    }

    // 2. Form Tambah Rekam Medis
    public function create()
    {
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $obats = Obat::all();

        return view('rekam-medis.create', compact('pasiens', 'dokters', 'obats'));
    }

    // 3. Logika Simpan Data + Potong Stok Obat Otomatis
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'keluhan'   => 'required',
            'diagnosa'  => 'required',
            'obat_id'   => 'required|array', // Array ID obat
            'jumlah'    => 'required|array',  // Array jumlah per obat
        ]);

        // Gunakan Transaction agar data aman
        DB::beginTransaction();

        try {
            // A. Simpan data utama Rekam Medis
            $rm = RekamMedis::create([
                'pasien_id'   => $request->pasien_id,
                'dokter_id'   => $request->dokter_id,
                'keluhan'     => $request->keluhan,
                'diagnosa'    => $request->diagnosa,
                'tgl_periksa' => now(),
            ]);

            // B. Loop obat yang dipilih untuk simpan ke pivot & potong stok
            foreach ($request->obat_id as $key => $id) {
                $qtyDiberikan = $request->jumlah[$key];
                $obat = Obat::findOrFail($id);

                // Cek stok
                if ($obat->stok < $qtyDiberikan) {
                    throw new \Exception("Stok obat {$obat->nama_obat} tidak mencukupi!");
                }

                // Simpan ke tabel pivot (rekam_medis_obat)
                // Pastikan nama relasi di Model RekamMedis adalah 'obats' atau 'obat'
                $rm->obats()->attach($id, ['jumlah' => $qtyDiberikan]);

                // POTONG STOK OTOMATIS
                $obat->decrement('stok', $qtyDiberikan);
            }

            DB::commit();
            return redirect()->route('rekam-medis.index')->with('success', 'Rekam Medis berhasil disimpan & stok diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    // 4. Detail Rekam Medis
    public function show($id)
    {
        $rm = RekamMedis::with(['pasien', 'dokter', 'obats'])->findOrFail($id);
        return view('rekam-medis.show', compact('rm'));
    }
}
