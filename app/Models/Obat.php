<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

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

    public function stokObat()
    {
        return $this->hasMany(StokObat::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
