<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadFisica extends Model
{
    protected $fillable = ['nombre','minutosDeDuracion','cantidadVecesPorSemana','creadaPorAdmin'];

    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_actividad_fisica', 'actividadFisica_id', 'expediente_id');
    }
}
