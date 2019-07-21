<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function perfil()
    {
        return $this->belongsTo('App\Perfil');
    }
}
