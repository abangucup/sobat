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

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function permintaan()
    {
        return $this->hasOne(Permintaan::class);
    }

    public function expired()
    {
        return $this->hasOne(Expired::class);
    }

    public function pemakaian()
    {
        return $this->hasOne(PemakaianObat::class);
    }
}
