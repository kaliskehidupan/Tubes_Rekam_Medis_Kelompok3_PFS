<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    // Karena nama tabel di migration tadi 'rekam_medis' (pakai underscore)
    // kita perlu tegaskan di sini agar Laravel tidak bingung
    protected $table = 'rekam_medis';

    protected $fillable = ['tanggal_periksa', 'keluhan', 'diagnosa', 'tindakan', 'pasien_id', 'dokter_id'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'rekam_medis_obat');
    }
}
