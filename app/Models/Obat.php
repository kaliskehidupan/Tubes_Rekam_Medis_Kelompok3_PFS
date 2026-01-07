<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = ['nama_obat', 'jenis_obat', 'stok', 'keterangan'];

    public function rekamMedis()
    {
        // Many-to-Many ke Rekam Medis melalui tabel pivot
        return $this->belongsToMany(RekamMedis::class, 'rekam_medis_obat');
    }
}
