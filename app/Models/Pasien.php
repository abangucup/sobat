<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_rekam_medis',
        'biodata_id'
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function pemeriksaans()
    {
        return $this->hasManyThrough(Pemeriksaan::class, Kunjungan::class);
    }

    public function riwayats()
    {
        return $this->hasMany(Riwayat::class);
    }
}
