<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActividadFisica extends Model
{
    use SoftDeletes;
    protected $fillable = ['nombre','minutosDeDuracion','cantidadVecesPorSemana','creadaPorAdmin'];
    protected $dates = ['deleted_at'];
    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_actividad_fisica', 'actividadFisica_id', 'expediente_id');
    }
}
