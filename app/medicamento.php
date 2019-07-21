<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
