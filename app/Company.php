<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'Companies';
    protected $primaryKey = 'RunningNumber';
    public $timestamps = false;

    public function viewerLog()
	{
		return $this->hasMany('App\ViewerLog', 'CompanyCode', 'RunningNumber');
	}

	public function jobs()
	{
		return $this->hasMany('App\Job', 'CompanyCode', 'RunningNumber');
	}
    public function scopeOfCompanyName($query,$word)
    {
    	return $query->where('CompanyName','like','%'.$word.'%');
    }
}
