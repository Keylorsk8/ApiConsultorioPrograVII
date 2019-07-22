<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cirugia extends Model
{
    protected $fillable = ['nombre','fecha','lugar','creadaPorAdmin'];

    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_cirugia', 'cirugia_id', 'expediente_id');
    }
}
