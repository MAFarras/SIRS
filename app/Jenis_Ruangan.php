<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_Ruangan extends Model
{
    protected $table='jenis_ruangan';

    protected $fillable = [
        'nama',
    ];

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class);
    }
}
