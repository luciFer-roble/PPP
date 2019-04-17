<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;
    protected $table = 'empresa';
    protected $primaryKey = 'idempresa';
    public $timestamps = false;
    protected $guarded = [];

    public function convenio(){
        return $this->hasOne('App\Convenio');
    }

    public function tutore(){
        return $this->hasMany('App\TutorE');
    }

}
