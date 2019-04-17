<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Malla extends Model
{
    use SoftDeletes;
    protected $table = 'mallacurricular';
    protected $primaryKey = 'idmalla';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function carrera(){
        return $this->belongsTo('App\Carrera', 'idcarrera', 'idcarrera');
    }
    public function nivel(){
        return $this->hasMany('App\Nivel');
    }
}
