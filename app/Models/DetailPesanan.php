<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'obat_id',
        'pemesanan_id',
        'jumlah',
        'harga_pesanan',
        'status_pengiriman'
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function verif()
    {
        return $this->hasOne(VerifPesanan::class);
    }
}
