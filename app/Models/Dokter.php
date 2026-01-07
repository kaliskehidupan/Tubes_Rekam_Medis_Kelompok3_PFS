<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = ['nama_dokter', 'spesialisasi', 'nomor_telepon'];

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class);
    }
}
