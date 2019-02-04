<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tambon extends Model
{
    protected $table = 'LAND_TAMBON';
    protected $primaryKey = 'G_ID';
    public $timestamps = false;

    public function scopeOfProvince($query,$id)
    {
    	return $query->where('P_CODE',$id);

    }
}
