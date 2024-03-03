<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'obat_id',
        'pemesanan_id',
        'jumlah',
        'harga_pesanan',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
