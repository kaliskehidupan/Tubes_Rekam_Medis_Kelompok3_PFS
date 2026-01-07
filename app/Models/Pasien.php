<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    // Tambahkan ini agar data bisa diinput secara massal
    protected $fillable = ['nama_pasien', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'nomor_telepon'];

    // Relasi ke Rekam Medis
    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class);
    }
}
