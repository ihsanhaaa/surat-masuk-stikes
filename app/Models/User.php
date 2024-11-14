<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tempat_parkir_id',
        'nik',
        'picture',
        'phone_number',
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getPictureAttribute($value){
        if($value){
            return asset('images/profil/'.$value);
        }
    }

    public function tempatParkir()
    {
        return $this->belongsTo(TempatParkir::class);
    }

    public function potensiPendapatan()
    {
        return $this->hasMany(PotensiPendapatan::class);
    }

    public function fotoTempatParkir()
    {
        return $this->hasMany(FotoTempatParkir::class);
    }
}
