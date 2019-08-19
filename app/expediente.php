<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $fillable = ['tipo_sangre_id'];
    public function perfil()
    {
        return $this->belongsTo('App\Perfil');
    }

    public function alcohol()
    {
        return $this->belongsTo('App\Alcohol');
    }

    public function medicamentos()
    {
        return $this->hasMany('App\Medicamentos');
    }

    public function fumados()
    {
        return $this->hasMany('App\Fumado');
    }

    public function alcoholes()
    {
        return $this->hasMany('App\Alcohol');
    }

    public function actividadesFisicas()
    {
        return $this->belongsToMany('App\ActividadFisica', 'expediente_actividad_fisica', 'expediente_id', 'actividadFisica_id');
    }

    public function alergias()
    {
        return $this->belongsToMany('App\Alergia', 'expediente_alergia', 'expediente_id', 'alergia_id');
    }

    public function cirugias()
    {
        return $this->hasMany('App\Cirugia');
    }

    public function tipoSangre()
    {
        return $this->belongsTo('App\tipoSangre');
    }

    public function enfermedades()
    {
        return $this->belongsToMany('App\Enfermedad', 'expediente_enfermedad', 'expediente_id', 'enfermedad_id');
    }
}
