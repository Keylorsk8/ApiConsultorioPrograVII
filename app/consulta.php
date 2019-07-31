<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = ['nombre','ubicacion','precio','fecha','hora','user_id','perfil_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function perfil()
    {
        return $this->belongsTo('App\Perfil');
    }
}
