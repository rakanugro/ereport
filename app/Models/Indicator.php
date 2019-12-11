<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    //
    protected $table = 'tm_indicator';
    protected $primaryKey = 'INDICATOR_ID';
    protected $fillable = [
        'INDICATOR_NAME',
        'FORMULA',
        'UNIT',
        'ACTIVE'
    ];
}
