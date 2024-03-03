<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'username',
        'role',
        'biodata_id',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class);
    }

    public function akunDistributor()
    {
        return $this->hasOne(AkunDistributor::class);
    }
}
