<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;


    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'slug',
        'satuan',
        'no_batch',
        'tanggal_kedaluwarsa',
        'kapasitas',
        'satuan_kapasitas',
    ];

    public function stokObats()
    {
        return $this->hasMany(StokObat::class);
    }

    public function detailPesanans()
    {
        return $this->hasMany(DetailPesanan::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
