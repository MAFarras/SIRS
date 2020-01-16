<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table='dokter';

    protected $fillable = [
        'nama', 'id_jenis', 'no_telp',
    ];

    public function jenisDokter()
    {
        return $this->belongsTo(\App\Jenis_Dokter::class, 'id_jenis');
    }

    public function jadwalDokter()
    {
        return $this->hasMany(Jadwal::class);
    }
}
