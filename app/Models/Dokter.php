<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 👇 1. Pastikan baris ini ada biar Laravel kenal sama file temanmu
use App\Models\RekamMedis; 

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';

    protected $fillable = [
        'nama_dokter',
        'spesialisasi',
        'nomor_telepon'
    ];

    // 👇 2. Tambahkan Blok Fungsi Relasi ini di paling bawah (sebelum kurung tutup '}')
    public function rekamMedis()
    {
        // Artinya: Satu Dokter punya BANYAK Rekam Medis
        // Laravel otomatis mencari kolom 'dokter_id' di tabel rekam_medis
        return $this->hasMany(RekamMedis::class);
    }
}