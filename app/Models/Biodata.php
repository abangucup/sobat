<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'slug',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'tanggal_lahir',
        'foto'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
