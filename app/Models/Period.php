<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    //
    protected $table = 'tm_period';
    protected $primaryKey = 'PERIOD_ID';
    protected $fillable = [
        'PERIOD_NAME'
    ];
}
