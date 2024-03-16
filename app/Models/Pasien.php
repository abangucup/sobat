<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_register',
        'biodata_id'
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }
    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class);
    }

    public function getRouteKeyName()
    {
        return 'no_register';
    }
}
