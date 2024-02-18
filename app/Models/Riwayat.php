<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id',
        'riwayat_penyakit',
        'riwayat_operasi',
        'riwayat_alergi',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
