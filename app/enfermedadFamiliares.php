<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnfermedadFamiliares extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
