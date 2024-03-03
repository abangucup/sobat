<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_kirim_naskah',
        'status_verif_ppk',
        'status_verif_direktur',
        'status_pengiriman',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }

    // public function obats()
    // {
    //     return $this->hasManyThrough(Obat::class, DetailPesanan::class);
    // }
}
