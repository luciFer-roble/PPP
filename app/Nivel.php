<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nivel extends Model
{
    use SoftDeletes;
    protected $table = 'nivel';
    protected $primaryKey = 'idnivel';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function malla(){
        return $this->belongsTo('App\Malla', 'idmalla', 'idmalla');
    }
    public function asignatura(){
        return $this->hasMany('App\Asignatura');
    }
    public function practica(){
        return $this->hasMany('App\Practica');
    }
}
