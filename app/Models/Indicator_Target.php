<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator_Target extends Model
{
    //
    // protected $table = 'tm_indicator_target';
    // protected $primaryKey = 'INDICATOR_TARGET_ID';
    protected $table = 'tm_target_month';
    protected $primaryKey = 'TARGET_MONTH_ID';
    // protected $fillable = [
    //     'INDICATOR_YEAR',
    //     'WEIGHT',
    //     'TARGET'
    // ];
}
