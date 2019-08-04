<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fumado extends Model
{
    protected $fillable = ['cantidadCigarrosPorDia','tiempoComenzoAFumar','observaciones','expediente_id'];

    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
