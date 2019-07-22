<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $fillable = ['nombre','observaciones','expediente','creadaPorAdmin'];

    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_enfermedad', 'enfermedad_id', 'expediente_id');
    }
}
