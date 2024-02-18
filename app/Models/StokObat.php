<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'distributor_id',
        'obat_id',
        'stok',
        'harga_beli',
        'tanggal_beli',
        'harga_jual',
        'lokasi'
    ];

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
}
