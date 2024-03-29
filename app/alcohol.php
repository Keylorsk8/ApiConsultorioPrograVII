<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alcohol extends Model
{
    protected $fillable = ['tiempoDeComienzo','frecueciaDeConsumo','tomaActualmente','observaciones',
    'cerveza','consumoCerveza','vino','consumoVino','licor','consumoLicor','expediente_id'];

    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
