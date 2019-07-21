<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadFisica extends Model
{
    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_activadad_fisica', 'actividadFisica_id', 'expediente_id');
    }
}
