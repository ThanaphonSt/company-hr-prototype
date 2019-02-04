<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\CTR;
use App\scopeOfJobType;

class Job extends Model
{
    use scopeOfJobType;
    
    protected $table = 'Jobs';
    protected $primaryKey = 'RunningNumber';
    public $timestamps = false;
    protected $appends = ['view_count', 
        'apply_count', 
        'favorite_count', 
        'ctr', 
        'area', 
        'sub_job',
    ];

    public function getViewCountAttribute()
    {
        return $this->viewerLog()->ofAction('view')->ofPreviousDay(15)->count();
    }

    public function getApplyCountAttribute()
    {
        return $this->viewerLog()->ofAction('apply')->ofPreviousDay(15)->count();
    }

    public function getFavoriteCountAttribute()
    {
        return $this->viewerLog()->ofAction('favorite')->ofPreviousDay(15)->count();
    }

    public function getCtrAttribute()
    {
        $ctr = 0;
        $point = $this->ctr()->first();

        if ($point != null){
            $ctr = ($point->ViewCount / $point->ReloadCount) * 100;
        }

        return intval($ctr);
    }

    public function getAreaAttribute()
    {
        $modelTambon = $this->tambon()->first();
        $area = '';
        if($modelTambon != null){
            $tambon = $modelTambon->NAME_THAI;
            $amphoe = $modelTambon->AMPHOE_THAI;
            $province =  $modelTambon->PROVINCE_THAI;
            $area = $tambon.' '.$amphoe.' '.$province;
        }
        return $area;
    }

    public function getSubJobAttribute()
    {
        return $this->subJobType()->first()->Jobtype_Thai;
    }

    public function getReloadCountAttribute()
    {
        $CTR = $this->ctr()->first();
        $reload = 0;
        if($CTR != null) {
            $reload = $CTR->ReloadCount;
        }
        return $reload;
    }

    public function viewerLog()
	{
		return $this->hasMany('App\ViewerLog', 'JobCode', 'RunningNumber');
	}

    public function tambon()
    {
        return $this->belongsTo('App\Tambon', 'TAMBONCODE', 'T_CODE');
    }

    public function subJobType()
    {
        return $this->belongsTo('App\SubJobType', 'SubJobType', 'Code');
    }

    public function ctr()
    {
        return $this->hasOne('App\CTR', 'JobCode', 'RunningNumber');
    }

    public function scopeOnline($query)
    {
        return $query->where('OnlineStatus', 1);
    }
}
