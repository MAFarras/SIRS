<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table='jadwal';

    protected $fillable = [
        'id_dokter', 'tanggal_mulai', 'tanggal_akhir', 'waktu_mulai', 'waktu_akhir',
    ];

    public function keteranganDokter()
    {
        return $this->belongsTo(\App\Dokter::class, 'id_dokter');
    }
}
