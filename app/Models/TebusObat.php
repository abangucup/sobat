<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TebusObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemeriksaan_id',
        'status_bayar',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }
}
