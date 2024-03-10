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

    public function distributor()
    {
        /*
            return $this->hasOneThrough(
                Distributor::class,  // Model target yang ingin diakses (tujuan akhir)
                StokObat::class,    // Model perantara yang berfungsi sebagai penghubung antara model saat ini dan model target
                'obat_id',          // Nama kolom pada model perantara yang menghubungkan ke model saat ini
                'id',               // Nama kolom pada model target yang menjadi target untuk pencarian
                'id',               // Nama kolom pada model saat ini yang menjadi referensi untuk pencarian
                'distributor_id'    // Nama kolom pada model perantara yang menghubungkan ke model target
            );
        */
        return $this->hasOneThrough(Distributor::class, StokObat::class, 'obat_id', 'id', 'id', 'distributor_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
