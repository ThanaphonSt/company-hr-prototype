<?php
namespace App;

trait scopeOfJobType {

	public function scopeOfJobType($query, $jobtype)
    {
        return $query->where('JobType', $jobtype);
    }
}

