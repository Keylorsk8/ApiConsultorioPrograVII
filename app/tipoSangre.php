<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoSangre extends Model
{
    public function expedientes()
    {
        return $this->hasMany('App\Expediente');
    }
}
