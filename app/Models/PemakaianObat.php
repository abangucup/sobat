<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemakaianObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'stok_obat_id',
        'banyak',
        'catatan',
        'tanggal_pemakaian'
    ];

    public function stokObat()
    {
        return $this->belongsTo(StokObat::class);
    }
}
