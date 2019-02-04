<?php
namespace App;

trait scopeOfJobCode {

	public function scopeOfJobCode($query, $jobCode)
    {
        return $query->where('JobCode', $jobCode);
    }
}

