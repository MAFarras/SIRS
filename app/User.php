<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';
    protected $fillable = [
        'nama', 'no_kerja', 'no_telepon', 'email', 'id_jabatan', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function jabatanUser()
    {
        return $this->belongsTo(\App\Jabatan::class, 'id_jabatan');
    }

    public function aktifUserJadwal()
    {
        return $this->hasMany(Histori_Jadwal::class);
    }

    public function aktifUserRuangan()
    {
        return $this->hasMany(Histori_Ruangan::class);
    }
}
