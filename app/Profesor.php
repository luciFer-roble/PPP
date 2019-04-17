<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profesor extends Model
{
    use SoftDeletes;
    protected $table = 'profesor';
    protected $primaryKey = 'idprofesor';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function practica(){
        return $this->hasMany('App\Practica');
    }

    public function escuela(){
        return $this->belongsTo('App\Escuela', 'idescuela', 'idescuela');
    }

    public function coordinador(){
        return $this->hasMany('App\Coordinador');
    }
    public function user(){
        return $this->belongsTo('App\User', 'id', 'iduser');
    }
}
