<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consulta extends Model
{
    use SoftDeletes;
    protected $fillable = ['nombre','ubicacion','precio','fecha','hora','user_id','perfil_id'];
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function perfil()
    {
        return $this->belongsTo('App\Perfil');
    }
}
