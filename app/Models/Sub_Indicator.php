<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sub_Indicator extends Model
{
    //
    protected $table = 'tm_sub_indicator';
    protected $primaryKey = 'SUB_INDICATOR_ID';
    protected $fillable = [
        'SUB_DIVISION_NAME',
        'UNIT'
    ];
}
