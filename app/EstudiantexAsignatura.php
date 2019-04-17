<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstudiantexAsignatura extends Model
{
    use SoftDeletes;
    protected $table = 'estudiantexasignatura';
    protected $primaryKey = 'idestudiantexasignatura';
    public $timestamps = false;
    protected $guarded = [];

    public function estudiante(){
        return $this->belongsTo('App\Estudiante', 'idestudiante', 'idestudiante');
    }
    public function asignatura(){
        return $this->belongsTo('App\Asignatura', 'idasignatura', 'idasignatura');
    }
}
