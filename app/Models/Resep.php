<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'stok_obat_id',
        'pemeriksaan_id',
        'jumlah',
        'keterangan'
    ];

    public function stokObat()
    {
        return $this->belongsTo(StokObat::class);
    }

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }
}
