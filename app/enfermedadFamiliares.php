<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnfermedadFamiliares extends Model
{
    protected $fillable = ['nombre','quien','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
