<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'slug',
        'telepon_perusahaan',
        'pemilik_perusahaan',
        'lokasi_perusahaan',
    ];

    public function akuns()
    {
        return $this->hasMany(AkunDistributor::class);
    }

    public function stok()
    {
        return $this->hasMany(StokObat::class);
    }

    public function obat()
    {
        return $this->hasMany(Obat::class, StokObat::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
