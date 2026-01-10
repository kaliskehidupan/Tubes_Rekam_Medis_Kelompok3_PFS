<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pasien_id' => 'required',
            'keluhan'   => 'required',
            'diagnosa'  => 'required',
            'obat_id'   => 'required|array', // Array ID obat dari checkbox/select
            'jumlah'    => 'required|array',  // Array jumlah per obat
        ]);

        // Gunakan Transaction agar data aman jika terjadi error di tengah jalan
        DB::beginTransaction();

        try {
            // 1. Simpan data Rekam Medis
            $rm = RekamMedis::create([
                'pasien_id'   => $request->pasien_id,
                'keluhan'     => $request->keluhan,
                'diagnosa'    => $request->diagnosa,
                'tgl_periksa' => now(),
            ]);

            // 2. Loop obat yang dipilih
            foreach ($request->obat_id as $key => $id) {
                $qtyDiberikan = $request->jumlah[$key];
                $obat = Obat::findOrFail($id);

                // Cek apakah stok cukup
                if ($obat->stok < $qtyDiberikan) {
                    throw new \Exception("Stok obat {$obat->nama_obat} tidak mencukupi!");
                }

                // 3. Simpan ke tabel pivot
                $rm->obats()->attach($id, ['jumlah' => $qtyDiberikan]);

                // 4. POTONG STOK OTOMATIS
                $obat->decrement('stok', $qtyDiberikan);
            }

            DB::commit();
            return redirect()->route('user.records')->with('success', 'Rekam Medis berhasil disimpan & stok diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }
}