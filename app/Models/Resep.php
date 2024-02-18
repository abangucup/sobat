<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'obat_id',
        'pemeriksaan_id',
        'jumlah',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }
}
