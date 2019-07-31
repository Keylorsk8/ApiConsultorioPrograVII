<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Enfermedad extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre','observaciones','expediente','creadaPorAdmin'];

    protected $dates = ['deleted_at'];

    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_enfermedad', 'enfermedad_id', 'expediente_id');
    }
}
