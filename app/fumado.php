<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fumado extends Model
{
    protected $fillable = ['cantidadCigarrosPorDia','tiempoComenzoAFumar','observaiones','expediente_id'];

    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
