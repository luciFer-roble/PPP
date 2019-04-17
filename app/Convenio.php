<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convenio extends Model
{
    use SoftDeletes;
    protected $table = 'convenio';
    protected $primaryKey = 'idconvenio';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function empresa(){
        return $this->belongsTo('App\Empresa', 'idempresa', 'idempresa');
    }
    public function sede(){
    return $this->belongsTo('App\Sede', 'idsede', 'idsede');
}
}
