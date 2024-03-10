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

    public function users()
    {
        // id pertama = pada model user
        // id kedua = pada model akunDistributor
        // return $this->hasManyThrough(User::class, AkunDistributor::class, 'distributor_id', 'id', 'id', 'user_id')
        return $this->hasManyThrough(User::class, AkunDistributor::class);
    }

    public function stokObats()
    {
        return $this->hasMany(StokObat::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }
}
