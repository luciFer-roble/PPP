<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facultad extends Model
{
    use SoftDeletes;
    protected $table = 'facultad';
    protected $primaryKey = 'idfacultad';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function escuela(){
        return $this->hasMany('App\Escuela');
    }

    public function periodoacademico(){
        return $this->hasMany('App\PeriodoAcademico');
    }

    public function sede(){
        return $this->belongsTo('App\Sede', 'idsede', 'idsede');
    }

}
