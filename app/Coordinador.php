<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coordinador extends Model
{
    use SoftDeletes;
    protected $table = 'coordinador';
    protected $primaryKey = 'idcoordinador';
    public $timestamps = false;
    protected $guarded = [];

    public function profesor(){
        return $this->belongsTo('App\Profesor', 'idprofesor', 'idprofesor');
    }

    public function carrera(){
        return $this->belongsTo('App\Carrera', 'idcarrera', 'idcarrera');
    }
}
