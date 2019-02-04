<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\scopeOfJobCode;
class ViewerLog extends Model
{
    use scopeOfJobCode;
    
    protected $table = 'viewerLog';
    protected $primaryKey = 'RunningNumber';
    public $timestamps = false;

    public function scopeOfAction($query, $action)
    {
        return $query->where('Action', $action);
    }

    public function scopeOfCompany($query, $company)
    {
        return $query->where('CompanyCode', $company);
    }

    public function scopeOfPreviousDay($query, $number)
    {   
        $nowDate = Carbon::createFromDate(2016, 8, 31, 'Asia/Bangkok');
        $DatePrevious = Carbon::createFromDate(2016, 8, 31, 'Asia/Bangkok')
                          ->subDays($number);
        return $query->whereBetween('CreateDate', [$DatePrevious, $nowDate]);
    }
    
    public function resumes()
    {
        return $this->belongsTo('App\Resume', 'Code', 'RunningNumber');
    }
}
