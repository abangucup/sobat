<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expired extends Model
{
    use HasFactory;

    protected $fillable = [
        'stok_obat_id',
        'status_pengembalian',
        'catatan',
        'balasan'
    ];

    public function stokObat()
    {
        return $this->belongsTo(StokObat::class);
    }
}
