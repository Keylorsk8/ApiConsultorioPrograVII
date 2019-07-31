<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alergia extends Model
{
    use SoftDeletes;
    protected $fillable = ['nombre','categoria','reaccion','observacion','creadaPorAdmin'];

    protected $dates = ['deleted_at'];

    public function expedientes()
    {
        return $this->belongsToMany('App\Expediente', 'expediente_alergia', 'alergia_id', 'expediente_id');
    }
}
