<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table='ruangan';

    protected $fillable = [
        'nama', 'id_jenis', 'status',
    ];

    public function keteranganJenis()
    {
        return $this->belongsTo(\App\Jenis_Ruangan::class, 'id_jenis');
    }
}
