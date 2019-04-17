<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TutorE extends Model
{
    use SoftDeletes;
    protected $table = 'tutore';
    protected $primaryKey = 'idtutore';
    public $timestamps = false;
    protected $guarded = [];

    public function practica(){
        return $this->hasMany('App\Practica');
    }

    public function empresa(){
        return $this->belongsTo('App\Empresa', 'idempresa', 'idempresa');
    }
    public function user(){
        return $this->belongsTo('App\User', 'iduser', 'id');
    }
}
