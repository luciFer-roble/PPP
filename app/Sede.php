<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sede extends Model
{
    use SoftDeletes;
    protected $table = 'sede';
    protected $primaryKey = 'idsede';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function convenio(){
        return $this->hasMany('App\Convenio');
    }

    public function universidad(){
        return $this->belongsTo('App\Universidad', 'iduniversidad', 'iduniversidad');
    }

    public function facultad(){
        return $this->hasMany('App\Facultad');
    }
}
