<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','primerApellido','segundoApellido','sexo','especialidad_id','rol_Id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function perfiles()
    {
        return $this->hasMany('App\Perfil');
    }

    //public function consultas()
    //{
  //      return $this->hasMany('App\Consulta');
//    }

    //public function enfermedad_familiares()
    //{
    //    return $this->hasMany('App\enfermedadFamiliares');
    //}
}
