<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table='jabatan';

    protected $fillable = [
        'jabatan', 'keterangan',
    ];

       public function keterangan_user()
    {
        return $this->hasMany(User::class);
    }
}