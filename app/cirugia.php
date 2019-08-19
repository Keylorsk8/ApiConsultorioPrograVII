<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cirugia extends Model
{
    protected $fillable = ['nombre','fecha','lugar','creadaPorAdmin','expediente_id'];

    public function expediente()
    {
        return $this->belongsTo('App\Expediente');
    }
}
