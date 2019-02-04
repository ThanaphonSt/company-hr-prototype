<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\scopeOfJobCode;
use App\scopeOfJobType;

class ApplicationDataAnalyzer extends Model
{
    use scopeOfJobCode,scopeOfJobType;

    protected $table = 'Application_Data_Analyzer';
    protected $primaryKey = 'ApplicationID';
    public $timestamps = false;

    public function resume()
    {
        return $this->belongsTo('App\Resume', 'ResumeCode', 'RunningNumber');
    }

    public function scopeOfPreviousDay($query, $number)
    {   
        $nowDate = Carbon::createFromDate(2016, 8, 31, 'Asia/Bangkok');
        $DatePrevious = Carbon::createFromDate(2016, 8, 31, 'Asia/Bangkok')->subDays($number);
        return $query->whereBetween('ApplyDate', [$DatePrevious, $nowDate]);
    }
    
    public function scopeOfResumeCode($query, $resume)
    {
        return $query->where('ResumeCode', $resume);
    }
}
