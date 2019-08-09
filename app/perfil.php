<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = ['nombre','primerApellido','segundoApellido','sexo','fechaNacimineto','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function expedientes()
    {
        return $this->hasMany('App\Expediente');
    }

    public function consultas()
    {
        return $this->hasMany('App\Consulta');
    }
}
