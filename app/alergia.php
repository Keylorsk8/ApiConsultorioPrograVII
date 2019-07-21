<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_alergia', 'alergia_id', 'expediente_id');
    }
}
