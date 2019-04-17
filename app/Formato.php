<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formato extends Model
{
    use SoftDeletes;
    protected $table = 'formato';
    protected $primaryKey = 'idformato';
    public $timestamps = false;
    protected $guarded = [];

    public function tipodocumento(){
        return $this->belongsTo('App\TipoDocumento', 'idtipodocumento', 'idtipodocumento');
    }

}
