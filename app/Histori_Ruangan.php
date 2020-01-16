<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Histori_Ruangan extends Model
{
    protected $table='histori_ruangan';

    protected $fillable = [
        'id_ruangan', 'id_user', 'status', 'waktu',
    ];

    public function keteranganUser()
    {
        return $this->belongsTo(\App\User::class, 'id_user');
    }

    public function keteranganRuangan()
    {
        return $this->belongsTo(\App\Ruangan::class, 'id_ruangan');
    }
}
