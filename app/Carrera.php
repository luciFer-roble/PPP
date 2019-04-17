<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrera extends Model
{
    use SoftDeletes;
    protected $table = 'carrera';
    protected $primaryKey = 'idcarrera';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function escuela(){
        return $this->belongsTo('App\Escuela', 'idescuela', 'idescuela');
    }
    public function estudiante(){
        return $this->hasMany('App\Estudiante');
    }

    public function coordinador(){
        return $this->hasOne('App\Coordinador');
    }

    public function malla(){
        return $this->hasMany('App\Malla');
    }
    public function tipodocumento(){
        return $this->hasMany('App\TipoDocumento');
    }
}
