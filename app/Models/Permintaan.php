<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'stok_obat_id',
        'pengaju',
        'pemverifikasi',
        'banyak',
        'status_permintaan',
        'bidang',
        'catatan',
    ];

    public function stokObat()
    {
        return $this->belongsTo(StokObat::class);
    }

    public function userPengaju()
    {
        return $this->belongsTo(User::class, 'pengaju');
    }

    public function userPemverifikasi()
    {
        return $this->belongsTo(User::class, 'pemverifikasi');
    }
}
