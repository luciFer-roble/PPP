<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    use SoftDeletes;
    protected $table = 'tipodocumento';
    protected $primaryKey = 'idtipodocumento';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function documentop(){
        return $this->hasMany('App\DocumentoP');
    }
    public function formato(){
        return $this->hasMany('App\Formato');
    }
    public function carrera(){
        return $this->belongsTo('App\Carrera', 'idcarrera', 'idcarrera');
    }
}
