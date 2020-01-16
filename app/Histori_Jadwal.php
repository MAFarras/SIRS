<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Histori_Jadwal extends Model
{
    protected $table='histori_jadwal';

    protected $fillable = [
        'id_user', 'id_jadwal', 'waktu',
    ];

    public function keteranganUser()
    {
        return $this->belongsTo(\App\User::class, 'id_user');
    }

    public function keteranganDokter()
    {
        return $this->belongsTo(\App\Dokter::class, 'id_dokter');
    }
}
