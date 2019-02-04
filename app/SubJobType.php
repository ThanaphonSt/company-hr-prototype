<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubJobType extends Model
{
    protected $table = 'SubJobType';
    protected $primaryKey = 'Code';
    public $timestamps = false;
}
