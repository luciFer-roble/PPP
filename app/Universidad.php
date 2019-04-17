<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Universidad extends Model
{
    use SoftDeletes;
    protected $table = 'universidad';
    protected $primaryKey = 'iduniversidad';
    public $timestamps = false;
    protected $guarded = [];
    public $incrementing = false;

    public function sede(){
        return $this->hasMany('App\Sede');
    }

}
