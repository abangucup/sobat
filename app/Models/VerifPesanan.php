<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifPesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemverifikasi',
        'detail_pesanan_id',
        'kondisi_pesanan',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPesanan()
    {
        return $this->belongsTo(DetailPesanan::class);
    }
}
