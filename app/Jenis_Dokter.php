<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_Dokter extends Model
{
    protected $table='jenis_dokter';

    protected $fillable = [
        'nama', 'keterangan',
    ];

    public function keterangan_dokter()
    {
        return $this->hasMany(Dokter::class);
    }
}
