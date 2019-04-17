<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignatura extends Model
{
    use SoftDeletes;
    protected $table = 'asignatura';
    protected $primaryKey = 'idasignatura';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function nivel(){
        return $this->belongsTo('App\Nivel', 'idnivel', 'idnivel');
    }
    public function estudiantexasignatura(){
        return $this->hasMany('App\EstudiantexAsignatura');
    }
}
