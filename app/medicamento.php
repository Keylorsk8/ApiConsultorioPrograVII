<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    protected $fillable = ['nombre','descripcion','expediente_id'];

    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
