<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodoAcademico extends Model
{
    protected $table = 'periodoacademico';
    protected $primaryKey = 'idperiodoacademico';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function facultad(){
        return $this->belongsTo('App\Facultad', 'idfacultad', 'idfacultad');
    }
    public function practica(){
        return $this->hasMany('App\Practica');
    }
}
