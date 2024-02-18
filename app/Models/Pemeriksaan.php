<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kunjungan_id',
        'hasil_uji_lab',
        'deskripsi_tindakan',
        'hasil_pemeriksaan',
        'dokter_pemeriksa',
        'spesialisasi'
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }
}
