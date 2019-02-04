<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'Resume';
    protected $primaryKey = 'RunningNumber';
   	protected $appends = ['area', 'province'];
    public $timestamps = false;

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

    public function getProvinceAttribute()
    {
    	$modelTambon = $this->tambon()->first();
        $province = '-';

        if($modelTambon != null){
    	   $province =  str_replace("จังหวัด","",$modelTambon->PROVINCE_THAI);
        }
        
    	return $province;
    }

    public function getThaidateAttribute()
    {
        $modelDOB = $this->DOB;

        $strYear = date("Y",strtotime($modelDOB)) + 543;
        $strMonth = date("n",strtotime($modelDOB));
        $strDay = date("j",strtotime($modelDOB));
        
        $strFullMonth = [
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        $strMonthThai = $strFullMonth[$strMonth];

        return "$strDay $strMonthThai พ.ศ.$strYear";
    }
    
    public function tambon()
    {
        return $this->belongsTo('App\Tambon', 'TAMBONCODE', 'T_CODE');
    }

    public function scopeOfjobType($query, $jobType)
    {
        return $query->where('JobType1', $jobType)
                     ->orwhere('JobType2', $jobType);
    }


}
